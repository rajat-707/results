<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .qr-code {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>QR Code Generator</h1>
        <form id="uploadForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Upload File:</label>
                <input type="file" id="file" name="file" required>
            </div>
            <div class="form-group">
                <label for="fileName">File Name (without extension):</label>
                <input type="text" id="fileName" name="fileName" required>
            </div>
            <button type="submit">Generate QR Code</button>
        </form>
        <div class="qr-code" id="qrCodeContainer">
            <!-- QR Code will be displayed here -->
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const qrCodeContainer = document.getElementById('qrCodeContainer');
                    qrCodeContainer.innerHTML = '';
                    new QRCode(qrCodeContainer, {
                        text: data.url,
                        width: 200,
                        height: 200
                    });
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>