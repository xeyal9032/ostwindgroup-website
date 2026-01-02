<?php
require_once 'includes/database.php';
require_once 'includes/helpers.php';

// Only authenticated users can access uploads
if (!is_logged_in()) {
    http_response_code(401);
    exit;
}

$file_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($file_id <= 0) {
    http_response_code(400);
    exit;
}

try {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT id, user_id, file_url, file_type, original_name FROM uploaded_files WHERE id = ? AND user_id = ? LIMIT 1");
    $stmt->execute([$file_id, $user_id]);
    $file = $stmt->fetch();

    if (!$file) {
        http_response_code(404);
        exit;
    }

    $path = null;
    // Prefer private storage if available (new format stores absolute/relative path in file_url)
    // If file_url starts with 'storage/', treat it as private path.
    $file_url = (string)$file['file_url'];
    if (strpos($file_url, 'storage/') === 0) {
        $path = __DIR__ . '/' . $file_url;
    } else {
        // Legacy: stored under uploads/images/
        $path = __DIR__ . '/' . ltrim($file_url, '/');
    }

    if (!$path || !is_file($path)) {
        http_response_code(404);
        exit;
    }

    $mime = $file['file_type'] ?: 'application/octet-stream';
    header('Content-Type: ' . $mime);
    header('X-Content-Type-Options: nosniff');
    header('Content-Disposition: inline; filename="' . sanitize_email_header_value($file['original_name'] ?: 'file') . '"');
    header('Cache-Control: private, max-age=0, no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    readfile($path);
    exit;
} catch (Exception $e) {
    error_log("serve_upload.php error: " . $e->getMessage());
    http_response_code(500);
    exit;
}

