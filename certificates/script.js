document.getElementById("uploadForm").addEventListener("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("upload.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text()) // Get raw response
    .then(text => {
        try {
            console.log("Raw Response:", text); // Log response
            return JSON.parse(text); // Try parsing JSON
        } catch (error) {
            throw new Error("Invalid JSON Response: " + text);
        }
    })
    .then(data => {
        if (data.success) {
            let fileUrl = data.url;
            document.getElementById("fileUrl").href = fileUrl;
            document.getElementById("fileUrl").textContent = fileUrl;

            let qrCodeUrl = `https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=${encodeURIComponent(fileUrl)}`;
            console.log("QR Code URL:", qrCodeUrl); // ✅ Debug QR Code URL
            document.getElementById("qrCode").src = qrCodeUrl;
            document.getElementById("qrSection").style.display = "block";
        } else {
            alert("Upload failed: " + data.message);
        }
    })
    .catch(error => {
        console.error("Fetch error:", error);
        alert("Upload failed. Error: " + error.message);
    });
});
