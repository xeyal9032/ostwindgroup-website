<?php
require_once 'includes/database.php';
require_once 'includes/helpers.php';

// JSON response header
header('Content-Type: application/json');

// Kullanıcı giriş yapmamışsa hata döndür
if(!is_logged_in()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// POST request kontrolü
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// JSON input'u al
$input = json_decode(file_get_contents('php://input'), true);
$file_id = $input['file_id'] ?? null;

// CSRF token doğrulama (header veya body)
$headers = function_exists('getallheaders') ? getallheaders() : [];
$csrf_token = $headers['X-CSRF-Token'] ?? $headers['x-csrf-token'] ?? ($input['csrf_token'] ?? null);
if (!verify_csrf_token($csrf_token ?? '')) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'CSRF validation failed']);
    exit;
}

if (!$file_id) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'File ID is required']);
    exit;
}

try {
    // Dosyanın kullanıcıya ait olduğunu kontrol et
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM uploaded_files WHERE id = ? AND user_id = ?");
    $stmt->execute([$file_id, $user_id]);
    $file = $stmt->fetch();
    
    if (!$file) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'File not found or access denied']);
        exit;
    }
    
    // Dosyayı fiziksel olarak sil
    if (file_exists($file['file_url'])) {
        unlink($file['file_url']);
    }
    
    // Veritabanından sil
    $stmt = $conn->prepare("DELETE FROM uploaded_files WHERE id = ? AND user_id = ?");
    $result = $stmt->execute([$file_id, $user_id]);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'File deleted successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to delete file from database']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    error_log("delete_file.php error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
?> 