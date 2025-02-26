<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $originalFileName = $_FILES["file"]["name"];
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

    // Get new file name from user input (if provided)
    $newFileName = !empty($_POST["newFileName"]) ? preg_replace("/[^a-zA-Z0-9_-]/", "", $_POST["newFileName"]) : pathinfo($originalFileName, PATHINFO_FILENAME);
    $newFileName .= "." . $fileExtension; // Append the correct file extension

    $targetPath = $uploadDir . time() . "_" . $newFileName; // Add timestamp to prevent overwrites

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) {
        $fileUrl = "https://ptu.examresultss.com/certificates/" . basename($targetPath);
        echo json_encode(["success" => true, "url" => $fileUrl]);
    } else {
        echo json_encode(["success" => false, "message" => "Upload failed"]);
    }
}
?>
