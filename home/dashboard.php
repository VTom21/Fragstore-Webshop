<?php
session_start();
require '../config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit;
}

if (!isset($_FILES['profile_picture'])) {
    echo json_encode(['success' => false, 'error' => 'No file']);
    exit;
}

$file = $_FILES['profile_picture'];

if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'error' => 'Upload error']);
    exit;
}

$allowed = ['image/jpeg', 'image/png', 'image/webp'];
$mime = mime_content_type($file['tmp_name']);

if (!in_array($mime, $allowed)) {
    echo json_encode(['success' => false, 'error' => 'Invalid image type']);
    exit;
}

$imageData = file_get_contents($file['tmp_name']);

$stmt = $pdo->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
$stmt->execute([$imageData, $_SESSION['user_id']]);

echo json_encode(['success' => true]);
exit;
