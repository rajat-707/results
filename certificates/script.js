document.getElementById("uploadForm").addEventListener("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("upload.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let fileUrl = data.url;
            document.getElementById("fileUrl").href = fileUrl;
            document.getElementById("fileUrl").textContent = fileUrl;

            // Generate QR Code
            let qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(fileUrl)}`;
            document.getElementById("qrCode").src = qrCodeUrl;

            document.getElementById("result").style.display = "block";
        } else {
            alert("Upload failed: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Upload failed. Please try again.");
    });
});
