<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $uploadDir = "certificates/";
    
    // Ensure the directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmpPath = $_FILES["file"]["tmp_name"];
    $originalFileName = $_FILES["file"]["name"];
    $fileExt = pathinfo($originalFileName, PATHINFO_EXTENSION);

    // Get new file name from user input, else keep original name
    $newFileName = !empty($_POST["filename"]) ? $_POST["filename"] . "." . $fileExt : $originalFileName;
    $destinationPath = $uploadDir . $newFileName;

    // Move the uploaded file
    if (move_uploaded_file($fileTmpPath, $destinationPath)) {
        $fileUrl = "https://ptu.examresultss.com/certificates/" . $destinationPath;
    } else {
        $errorMsg = "File upload failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Upload File & Generate QR Code</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <input type="text" name="filename" placeholder="Enter new file name (optional)">
            <button type="submit">Upload & Generate</button>
        </form>

        <?php if (isset($fileUrl)): ?>
            <p>File Uploaded: <a href="<?= $fileUrl ?>" target="_blank"><?= $fileUrl ?></a></p>
            <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?= urlencode($fileUrl) ?>" alt="QR Code">
        <?php elseif (isset($errorMsg)): ?>
            <p class="error"><?= $errorMsg ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
