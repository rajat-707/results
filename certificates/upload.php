<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
    exit;
}

if (!isset($_FILES["file"])) {
    echo json_encode(["success" => false, "message" => "No file received"]);
    exit;
}

$uploadDir = "certificates/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$originalFileName = $_FILES["file"]["name"];
$fileTmpName = $_FILES["file"]["tmp_name"];
$fileSize = $_FILES["file"]["size"];
$fileError = $_FILES["file"]["error"];
$fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

$allowedExtensions = ["jpg", "jpeg", "png", "pdf"];
if (!in_array($fileExtension, $allowedExtensions)) {
    echo json_encode(["success" => false, "message" => "Invalid file type"]);
    exit;
}

if ($fileError !== 0) {
    echo json_encode(["success" => false, "message" => "Upload error: " . $fileError]);
    exit;
}

// Generate a sanitized file name
$newFileName = !empty($_POST["newFileName"]) ? preg_replace("/[^a-zA-Z0-9_-]/", "", $_POST["newFileName"]) : pathinfo($originalFileName, PATHINFO_FILENAME);
$newFileName .= "." . $fileExtension;

$targetPath = $uploadDir . time() . "_" . $newFileName;

if (move_uploaded_file($fileTmpName, $targetPath)) {
    $fileUrl = "https://ptu.examresultss.com/certificates/" . basename($targetPath);
    echo json_encode(["success" => true, "url" => $fileUrl]);
    exit;
} else {
    echo json_encode(["success" => false, "message" => "Failed to move uploaded file"]);
    exit;
}
?>
