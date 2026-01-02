<?php
require_once '../includes/database.php';
require_once '../includes/Language.php';
require_once '../includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Admin giriş yoxlaması
if(!is_logged_in()) {
    header("Location: ../login.php");
    exit();
}

// Admin yoxlaması (username admin olan və ya admin@example.com e-mail olan)
$user_id = $_SESSION['user_id'];
try {
    $stmt = $conn->prepare("SELECT username, email, is_admin FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    // Fallback if DB not migrated yet
    error_log("Admin auth query failed: " . $e->getMessage());
    $stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    $user['is_admin'] = 0;
}

// Admin yoxlaması - prefer role flag (is_admin)
$is_admin = !empty($user['is_admin']);
// Backward-compatible fallback if DB not migrated yet
if (!$is_admin) {
    $is_admin = ($user['username'] === 'admin' || $user['email'] === 'admin@ostwindgroup.com' || $user['email'] === 'admin@example.com');
}

if(!$is_admin) {
    header("Location: ../index.php");
    exit();
}

$page_title = 'Admin Panel - OstWindGroup';

// Statistika məlumatları
$stmt = $conn->query("SELECT COUNT(*) as total_users FROM users");
$total_users = $stmt->fetch()['total_users'];

$stmt = $conn->query("SELECT COUNT(*) as total_files FROM uploaded_files");
$total_files = $stmt->fetch()['total_files'];

$stmt = $conn->query("SELECT COUNT(*) as today_users FROM users WHERE DATE(created_at) = CURDATE()");
$today_users = $stmt->fetch()['today_users'];

$stmt = $conn->query("SELECT COUNT(*) as today_files FROM uploaded_files WHERE DATE(upload_date) = CURDATE()");
$today_files = $stmt->fetch()['today_files'];

include '../includes/header.php';
?>

<style>
.admin-container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
}

.admin-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 30px;
    text-align: center;
}

.admin-header h1 {
    margin: 0;
    font-size: 32px;
}

.admin-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.stat-number {
    font-size: 36px;
    font-weight: bold;
    color: #667eea;
    margin-bottom: 10px;
}

.stat-label {
    color: #666;
    font-size: 14px;
}

.admin-sections {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.admin-section {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.admin-section h3 {
    margin-top: 0;
    color: #333;
    border-bottom: 2px solid #667eea;
    padding-bottom: 10px;
}

.admin-links {
    list-style: none;
    padding: 0;
}

.admin-links li {
    margin-bottom: 10px;
}

.admin-links a {
    display: block;
    padding: 12px 15px;
    background: #f8f9fa;
    color: #333;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.admin-links a:hover {
    background: #667eea;
    color: white;
    transform: translateX(5px);
}

.recent-users {
    max-height: 300px;
    overflow-y: auto;
}

.user-item {
    padding: 10px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.user-item:last-child {
    border-bottom: none;
}

.user-info {
    flex: 1;
}

.user-name {
    font-weight: bold;
    color: #333;
}

.user-email {
    color: #666;
    font-size: 12px;
}

.user-date {
    color: #999;
    font-size: 11px;
}

.admin-actions {
    margin-top: 20px;
    text-align: center;
}

.admin-btn {
    display: inline-block;
    padding: 12px 24px;
    background: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
    transition: background 0.3s ease;
}

.admin-btn:hover {
    background: #5a6fd8;
}

.admin-btn.danger {
    background: #ff6b6b;
}

.admin-btn.danger:hover {
    background: #ee5a52;
}
</style>

<div class="admin-container">
    <div class="admin-header">
        <h1>👨‍💼 Admin Panel</h1>
        <p>OstWindGroup İdarəetmə Paneli</p>
        <p><strong>Xoş gəlmisiniz, <?php echo htmlspecialchars($user['username']); ?>!</strong></p>
    </div>
    
    <div class="admin-stats">
        <div class="stat-card">
            <div class="stat-number"><?php echo $total_users; ?></div>
            <div class="stat-label">Ümumi İstifadəçi</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number"><?php echo $total_files; ?></div>
            <div class="stat-label">Ümumi Fayl</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number"><?php echo $today_users; ?></div>
            <div class="stat-label">Bu Gün Qeydiyyat</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number"><?php echo $today_files; ?></div>
            <div class="stat-label">Bu Gün Yüklənən</div>
        </div>
    </div>
    
    <div class="admin-sections">
        <div class="admin-section">
            <h3>📊 İdarəetmə</h3>
            <ul class="admin-links">
                <li><a href="users.php">👥 İstifadəçiləri İdarə Et</a></li>
                <li><a href="files.php">📁 Faylları İdarə Et</a></li>
                <li><a href="settings.php">⚙️ Tənzimləmələr</a></li>
                <li><a href="logs.php">📋 Sistem Logları</a></li>
            </ul>
        </div>
        
        <div class="admin-section">
            <h3>📈 Son İstifadəçilər</h3>
            <div class="recent-users">
                <?php
                $stmt = $conn->query("SELECT username, email, created_at FROM users ORDER BY created_at DESC LIMIT 10");
                $recent_users = $stmt->fetchAll();
                
                if ($recent_users): ?>
                    <?php foreach ($recent_users as $recent_user): ?>
                        <div class="user-item">
                            <div class="user-info">
                                <div class="user-name"><?php echo htmlspecialchars($recent_user['username']); ?></div>
                                <div class="user-email"><?php echo htmlspecialchars($recent_user['email']); ?></div>
                            </div>
                            <div class="user-date"><?php echo date('d.m.Y', strtotime($recent_user['created_at'])); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Hələ istifadəçi yoxdur.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="admin-actions">
        <a href="../index.php" class="admin-btn">🏠 Ana Səhifə</a>
        <a href="../logout.php" class="admin-btn danger">🚪 Çıxış Et</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?> 