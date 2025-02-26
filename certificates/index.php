<form id="uploadForm" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <input type="text" name="newFileName" placeholder="Enter new file name (optional)">
    <button type="submit">Upload</button>
</form>

<div id="qrSection" style="display: none;">
    <p>QR Code:</p>
    <img id="qrCode" src="" alt="QR Code">
</div>
<a id="fileUrl" href="#" target="_blank"></a>
