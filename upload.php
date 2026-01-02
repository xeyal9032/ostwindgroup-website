<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Kullanıcı giriş yapmamışsa login sayfasına yönlendir
if(!is_logged_in()) {
    redirect_to_login();
}

$message = '';
$error = '';

// Fotoğraf yükleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    if (!require_valid_csrf_post()) {
        $error = $translations['csrf_invalid'] ?? 'Security check failed. Please refresh the page and try again.';
    } else {
    // Private storage (served via serve_upload.php)
    $upload_dir = 'storage/uploads/images/';
    // Validate by detected MIME (do not trust client-provided mime)
    $allowed_mimes = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif',
        'image/webp' => 'webp',
    ];
    $max_size = 5 * 1024 * 1024; // 5MB
    
    // Upload klasörünü oluştur
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $file = $_FILES['photo'];
    $file_name = $file['name'];
    $file_size = $file['size'];
    $file_tmp = $file['tmp_name'];
    $file_type = $file['type']; // informational only (client-provided)
    
    // Detect real mime type
    $detected_mime = null;
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if ($finfo) {
            $detected_mime = finfo_file($finfo, $file_tmp);
            finfo_close($finfo);
        }
    }
    
    // Hata kontrolü
    if ($file['error'] !== UPLOAD_ERR_OK) {
        switch ($file['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $error = 'Dosya boyutu çok büyük (PHP limiti).';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $error = 'Dosya boyutu çok büyük (Form limiti).';
                break;
            case UPLOAD_ERR_PARTIAL:
                $error = 'Dosya kısmen yüklendi.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $error = 'Dosya seçilmedi.';
                break;
            default:
                $error = 'Bilinmeyen hata oluştu.';
        }
    } elseif ($detected_mime === null || !isset($allowed_mimes[$detected_mime])) {
        $error = 'Sadece JPG, PNG, GIF ve WEBP formatları kabul edilir.';
    } elseif ($file_size > $max_size) {
        $error = 'Dosya boyutu 5MB\'dan büyük olamaz.';
    } else {
        // Extra image validation
        if (@getimagesize($file_tmp) === false) {
            $error = 'Geçersiz görüntü dosyası.';
        } else {
        // Güvenli dosya adı oluştur
        $file_extension = $allowed_mimes[$detected_mime];
        $new_file_name = bin2hex(random_bytes(16)) . '.' . $file_extension;
        $upload_path = $upload_dir . $new_file_name;
        
        // Dosyayı yükle
        if (move_uploaded_file($file_tmp, $upload_path)) {
            // Veritabanına kaydet
            $user_id = $_SESSION['user_id'];
            $original_name = $file_name;
            // Store relative private path in DB; served via serve_upload.php?id=...
            $file_url = $upload_path;
            
            $stmt = $conn->prepare("INSERT INTO uploaded_files (user_id, original_name, file_name, file_url, file_size, file_type, upload_date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
            
            if ($stmt->execute([$user_id, $original_name, $new_file_name, $file_url, $file_size, $file_type])) {
                $message = 'Fotoğraf başarıyla yüklendi!';
            } else {
                $error = 'Veritabanına kayıt sırasında hata oluştu.';
                // Yüklenen dosyayı sil
                unlink($upload_path);
            }
        } else {
            $error = 'Dosya yüklenirken hata oluştu.';
        }
        }
    }
    }
}

// Kullanıcının yüklediği fotoğrafları getir
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM uploaded_files WHERE user_id = ? ORDER BY upload_date DESC");
$stmt->execute([$user_id]);
$uploaded_files = $stmt->fetchAll();

$page_title = $translations['upload_title'] ?? 'Fotoğraf Yükle';

// Modern upload sayfası CSS
$additional_css = '
    .upload-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 120px 20px 40px;
    }
    
    .upload-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        padding: 48px;
        position: relative;
        overflow: hidden;
    }
    
    .upload-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .upload-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .upload-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }
    
    .upload-header p {
        color: #666;
        font-size: 16px;
    }
    
    .upload-area {
        border: 3px dashed #e1e5e9;
        border-radius: 16px;
        padding: 60px 20px;
        text-align: center;
        margin-bottom: 32px;
        transition: all 0.3s ease;
        background: #f8f9fa;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .upload-area:hover {
        border-color: #667eea;
        background: #f0f4ff;
        transform: translateY(-2px);
    }
    
    .upload-area.dragover {
        border-color: #667eea;
        background: #e8f2ff;
        transform: scale(1.02);
    }
    
    .upload-icon {
        font-size: 48px;
        color: #667eea;
        margin-bottom: 16px;
    }
    
    .upload-text {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .upload-subtext {
        color: #666;
        font-size: 14px;
    }
    
    .file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    .upload-btn {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 32px;
    }
    
    .upload-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
    }
    
    .upload-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    
    .message {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-weight: 500;
        text-align: center;
    }
    
    .message.success {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
    }
    
    .message.error {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    .uploaded-files {
        margin-top: 40px;
    }
    
    .uploaded-files h3 {
        font-size: 20px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 20px;
    }
    
    .file-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .file-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 16px;
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .file-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        border-color: #667eea;
    }
    
    .file-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 12px;
    }
    
    .file-name {
        font-size: 12px;
        color: #666;
        margin-bottom: 8px;
        word-break: break-all;
    }
    
    .file-size {
        font-size: 11px;
        color: #999;
        margin-bottom: 8px;
    }
    
    .file-date {
        font-size: 10px;
        color: #999;
    }
    
    .file-actions {
        margin-top: 12px;
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    
    .file-btn {
        padding: 4px 8px;
        border: none;
        border-radius: 4px;
        font-size: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .file-btn.copy {
        background: #667eea;
        color: white;
    }
    
    .file-btn.delete {
        background: #ff6b6b;
        color: white;
    }
    
    .file-btn:hover {
        transform: scale(1.05);
    }
    
    .back-link {
        position: absolute;
        top: 24px;
        left: 24px;
        color: #666;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .back-link:hover {
        color: #1a1a1a;
    }
    
    .progress-bar {
        width: 100%;
        height: 4px;
        background: #e1e5e9;
        border-radius: 2px;
        overflow: hidden;
        margin-top: 16px;
        display: none;
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        width: 0%;
        transition: width 0.3s ease;
    }
';

include 'includes/header.php';
?>

<div class="upload-page">
    <a href="index.php" class="back-link">
        ← Ana Səhifəyə Qayıt
    </a>
    
    <div class="upload-container">
        <div class="upload-header">
            <h1><?php echo $translations['upload_title'] ?? 'Fotoğraf Yükle'; ?></h1>
            <p><?php echo $translations['upload_subtitle'] ?? 'Fotoğraflarınızı güvenli bir şekilde yükleyin'; ?></p>
        </div>
        
        <?php if ($message): ?>
            <div class="message success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="message error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data" id="uploadForm">
            <?php echo csrf_input_field(); ?>
            <div class="upload-area" id="uploadArea">
                <div class="upload-icon">📸</div>
                <div class="upload-text"><?php echo $translations['upload_drag_drop'] ?? 'Fotoğrafı buraya sürükleyin veya tıklayın'; ?></div>
                <div class="upload-subtext"><?php echo $translations['upload_formats'] ?? 'JPG, PNG, GIF, WEBP (Maksimum 5MB)'; ?></div>
                <input type="file" name="photo" id="fileInput" class="file-input" accept="image/*" required>
            </div>
            
            <div class="progress-bar" id="progressBar">
                <div class="progress-fill" id="progressFill"></div>
            </div>
            
            <button type="submit" class="upload-btn" id="uploadBtn">
                <?php echo $translations['upload_button'] ?? 'Fotoğraf Yükle'; ?>
            </button>
        </form>
        
        <?php if (!empty($uploaded_files)): ?>
            <div class="uploaded-files">
                <h3><?php echo $translations['uploaded_files'] ?? 'Yüklenen Fotoğraflar'; ?></h3>
                <div class="file-grid">
                    <?php foreach ($uploaded_files as $file): ?>
                        <div class="file-card">
                            <img src="<?php echo 'serve_upload.php?id=' . (int)$file['id']; ?>" alt="<?php echo htmlspecialchars($file['original_name']); ?>" class="file-image">
                            <div class="file-name"><?php echo htmlspecialchars($file['original_name']); ?></div>
                            <div class="file-size"><?php echo format_file_size($file['file_size']); ?></div>
                            <div class="file-date"><?php echo date('d.m.Y H:i', strtotime($file['upload_date'])); ?></div>
                            <div class="file-actions">
                                <button class="file-btn copy" onclick="copyFileUrl('<?php echo 'serve_upload.php?id=' . (int)$file['id']; ?>')">
                                    <?php echo $translations['copy_url'] ?? 'URL Kopyala'; ?>
                                </button>
                                <button class="file-btn delete" onclick="deleteFile(<?php echo $file['id']; ?>)">
                                    <?php echo $translations['delete'] ?? 'Sil'; ?>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Drag and drop functionality
const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('fileInput');
const uploadForm = document.getElementById('uploadForm');
const progressBar = document.getElementById('progressBar');
const progressFill = document.getElementById('progressFill');
const uploadBtn = document.getElementById('uploadBtn');
const csrfToken = <?php echo json_encode(generate_csrf_token()); ?>;

uploadArea.addEventListener('click', () => fileInput.click());

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        updateFileName();
    }
});

fileInput.addEventListener('change', updateFileName);

function updateFileName() {
    if (fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        uploadArea.querySelector('.upload-text').textContent = `Seçilen dosya: ${fileName}`;
    }
}

// Form submission with progress
uploadForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(uploadForm);
    uploadBtn.disabled = true;
    uploadBtn.textContent = 'Yükleniyor...';
    progressBar.style.display = 'block';
    
    try {
        const response = await fetch('upload.php', {
            method: 'POST',
            body: formData
        });
        
        if (response.ok) {
            location.reload();
        } else {
            throw new Error('Upload failed');
        }
    } catch (error) {
        alert('Yükleme sırasında hata oluştu. Lütfen tekrar deneyin.');
        uploadBtn.disabled = false;
        uploadBtn.textContent = 'Fotoğraf Yükle';
        progressBar.style.display = 'none';
    }
});

// Copy file URL
function copyFileUrl(url) {
    navigator.clipboard.writeText(window.location.origin + '/' + url).then(() => {
        alert('URL kopyalandı!');
    });
}

// Delete file
function deleteFile(fileId) {
    if (confirm('Bu dosyayı silmek istediğinizden emin misiniz?')) {
        fetch('delete_file.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken,
            },
            body: JSON.stringify({ file_id: fileId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Dosya silinirken hata oluştu.');
            }
        });
    }
}
</script>

<?php
include 'includes/footer.php';
?> 