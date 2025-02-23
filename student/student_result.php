<?php
session_start();
include '../includes/db_connection.php';

if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

$roll_number = $_SESSION['student'];
$semester = isset($_GET['semester']) ? $_GET['semester'] : 'Semester 1';

$result = $conn->query("SELECT * FROM results WHERE roll_number='$roll_number' AND semester='$semester'");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    $row = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('/includes/images/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 90%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        select {
            padding: 5px;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }
        a {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background: #0056b3;
        }
        @media (max-width: 600px) {
            .container {
                width: 95%;
                padding: 20px;
            }
            select {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Dashboard</h2>
        <p><strong>Roll Number:</strong> <?php echo $roll_number; ?></p>
        <p><strong>Semester:</strong> 
            <form action="" method="GET" style="display:inline;">
                <select name="semester" onchange="this.form.submit()">
                    <option value="Semester 1" <?php echo ($semester == 'Semester 1') ? 'selected' : ''; ?>>Semester 1</option>
                    <option value="Semester 2" <?php echo ($semester == 'Semester 2') ? 'selected' : ''; ?>>Semester 2</option>
                    <option value="Semester 3" <?php echo ($semester == 'Semester 3') ? 'selected' : ''; ?>>Semester 3</option>
                    <option value="Semester 4" <?php echo ($semester == 'Semester 4') ? 'selected' : ''; ?>>Semester 4</option>
                </select>
            </form>
        </p>
        <?php if ($row) { ?>
            <p><strong>Download your result:</strong> <a href="<?php echo $row['file_url']; ?>" target="_blank">Download</a></p>
        <?php } else { ?>
            <p>No results found for this semester.</p>
        <?php } ?>
        <br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>