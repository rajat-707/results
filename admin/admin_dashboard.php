<?php
session_start();
include '../includes/db_connection.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $roll_number = $_POST["roll_number"];
    $password = $_POST["password"];
    $semester = $_POST["semester"]; // Get the semester
    $upload_dir = "../uploads/$semester/"; // Organize files by semester

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = basename($_FILES["file"]["name"]);
    $target_file = $upload_dir . $roll_number . "_" . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["pdf", "jpg", "jpeg", "png"];

    if (in_array($file_type, $allowed_types) && move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO results (roll_number, password, semester, file_url) VALUES ('$roll_number', '$password', '$semester', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "File uploaded successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid file type or upload failed.";
    }
    header("Location: admin_dashboard.php");
    exit();
}

$result = $conn->query("SELECT * FROM results");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; text-align: center; }
        .container { width: 50%; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background: #007bff; color: white; }
        input, button { padding: 10px; margin: 5px; border-radius: 5px; border: 1px solid #ddd; }
        button { background: #007bff; color: white; cursor: pointer; border: none; }
        button:hover { background: #0056b3; }
        a { text-decoration: none; color: white; background: #dc3545; padding: 10px 15px; border-radius: 5px; }
        a:hover { background: #c82333; }
        form { display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="roll_number" placeholder="Enter Roll Number" required>
            <input type="text" name="password" placeholder="Enter Password" required>
            <input type="text" name="semester" placeholder="Enter Semester (e.g., Semester 1)" required>
            <input type="file" name="file" required>
            <button type="submit">Upload</button>
        </form>
        <h3>Uploaded Files</h3>
        <table>
            <tr>
                <th>Roll Number</th>
                <th>Password</th>
                <th>Semester</th>
                <th>Download Link</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['roll_number']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['semester']; ?></td>
                <td><a href="<?php echo $row['file_url']; ?>" target="_blank">Download</a></td>
                <td>
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="roll_number" value="<?php echo $row['roll_number']; ?>" required>
                        <input type="text" name="password" value="<?php echo $row['password']; ?>" required>
                        <input type="text" name="semester" value="<?php echo $row['semester']; ?>" required>
                        <button type="submit">Edit</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>  
        <br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
