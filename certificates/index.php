<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code File Uploader</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Upload a File & Generate QR Code</h2>
        <form id="uploadForm" enctype="multipart/form-data">
            <input type="file" name="file" id="fileInput" required>
            <input type="text" name="newFileName" placeholder="Enter new file name (optional)">
            <button type="submit">Upload & Generate QR</button>
        </form>

        <div id="result" style="display: none;">
            <h3>File Uploaded Successfully!</h3>
            <a id="fileUrl" href="#" target="_blank">Download File</a>
            <h3>QR Code:</h3>
            <img id="qrCode" src="" alt="QR Code">
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
