<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_FILES["file"])) {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
    exit;
}

$uploadDir = "certificates/";  // Ensure this folder exists!
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$originalFileName = $_FILES["file"]["name"];
$fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

$allowedExtensions = ["jpg", "jpeg", "png", "pdf"];
if (!in_array($fileExtension, $allowedExtensions)) {
    echo json_encode(["success" => false, "message" => "Invalid file type"]);
    exit;
}

// Generate a sanitized file name
$newFileName = !empty($_POST["newFileName"]) ? preg_replace("/[^a-zA-Z0-9_-]/", "", $_POST["newFileName"]) : pathinfo($originalFileName, PATHINFO_FILENAME);
$newFileName .= "." . $fileExtension;

$targetPath = $uploadDir . time() . "_" . $newFileName;

if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) {
    $fileUrl = "https://ptu.examresultss.com/certificates/" . basename($targetPath);
    echo json_encode(["success" => true, "url" => $fileUrl]);
    exit;
} else {
    echo json_encode(["success" => false, "message" => "Upload failed"]);
    exit;
}
