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

            let qrCodeUrl = `https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=${encodeURIComponent(fileUrl)}`;
            document.getElementById("qrCode").src = qrCodeUrl;

            document.getElementById("qrSection").style.display = "block";
        } else {
            alert("Upload failed. Try again.");
        }
    })
    .catch(error => console.error("Error:", error));
});
