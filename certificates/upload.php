<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_POST['fileName'];
        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $newFileName = $fileName . '.' . $fileExtension;

        $uploadDirectory = 'uploads/';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $filePath = $uploadDirectory . $newFileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            $fileUrl = 'https://ptu.examresultss.com/certificates/certificates' . $newFileName;
            echo json_encode(['success' => true, 'url' => $fileUrl]);
        } else {
            echo json_encode(['success' => false, 'message' => 'File upload failed.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No file uploaded or file upload error.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>