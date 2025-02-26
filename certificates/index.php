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
        <h2>Upload a File & Generate QR Code</h2>
        <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" id="fileInput" required>
            <input type="text" name="newFileName" id="newFileName" placeholder="Enter new file name (optional)">
            <button type="submit">Upload & Generate QR</button>
        </form>

        <div id="qrSection" style="display: none;">
            <p>File URL: <a id="fileUrl" href="#" target="_blank"></a></p>
            <img id="qrCode" src="" alt="QR Code">
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
