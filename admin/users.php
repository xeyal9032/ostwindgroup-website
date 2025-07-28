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

// Admin yoxlaması
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Admin yoxlaması - username admin və ya e-mail admin@ostwindgroup.com
if($user['username'] !== 'admin' && $user['email'] !== 'admin@ostwindgroup.com') {
    header("Location: ../index.php");
    exit();
}

$message = '';
$error = '';

// İstifadəçi silmə əməliyyatı
if(isset($_POST['delete_user'])) {
    $delete_id = (int)$_POST['delete_user'];
    
    if($delete_id != $user_id) { // Admin özünü silə bilməz
        try {
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            if($stmt->execute([$delete_id])) {
                $message = "İstifadəçi uğurla silindi.";
            } else {
                $error = "İstifadəçi silinərkən xəta baş verdi.";
            }
        } catch (Exception $e) {
            $error = "Xəta: " . $e->getMessage();
        }
    } else {
        $error = "Admin özünü silə bilməz!";
    }
}

$page_title = 'İstifadəçiləri İdarə Et - Admin Panel';

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

.users-table {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.users-table table {
    width: 100%;
    border-collapse: collapse;
}

.users-table th,
.users-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.users-table th {
    background: #f8f9fa;
    font-weight: 600;
    color: #333;
}

.users-table tr:hover {
    background: #f8f9fa;
}

.user-actions {
    display: flex;
    gap: 10px;
}

.action-btn {
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 12px;
    text-decoration: none;
    color: white;
}

.action-btn.view {
    background: #667eea;
}

.action-btn.edit {
    background: #ffc107;
}

.action-btn.delete {
    background: #dc3545;
}

.action-btn:hover {
    opacity: 0.8;
}

.message {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.message.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.message.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
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

.search-box {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
}

.search-box input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.search-box button {
    padding: 10px 20px;
    background: #667eea;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.search-box button:hover {
    background: #5a6fd8;
}
</style>

<div class="admin-container">
    <div class="admin-header">
        <h1>👥 İstifadəçiləri İdarə Et</h1>
        <p>Bütün istifadəçiləri görün və idarə edin</p>
    </div>
    
    <?php if ($message): ?>
        <div class="message success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="İstifadəçi adı və ya e-mail ilə axtarın...">
        <button onclick="searchUsers()">🔍 Axtar</button>
    </div>
    
    <div class="users-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>İstifadəçi Adı</th>
                    <th>E-mail</th>
                    <th>Qeydiyyat Tarixi</th>
                    <th>Status</th>
                    <th>Əməliyyatlar</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                <?php
                $stmt = $conn->query("SELECT id, username, email, created_at FROM users ORDER BY created_at DESC");
                $users = $stmt->fetchAll();
                
                foreach ($users as $user_data):
                    $isAdmin = ($user_data['username'] === 'admin' || $user_data['email'] === 'admin@ostwindgroup.com');
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($user_data['id']); ?></td>
                    <td>
                        <?php echo htmlspecialchars($user_data['username']); ?>
                        <?php if ($isAdmin): ?>
                            <span style="background: #667eea; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px;">Admin</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($user_data['email']); ?></td>
                    <td><?php echo date('d.m.Y H:i', strtotime($user_data['created_at'])); ?></td>
                    <td>
                        <?php if ($isAdmin): ?>
                            <span style="color: #667eea;">Admin</span>
                        <?php else: ?>
                            <span style="color: #28a745;">Aktiv</span>
                        <?php endif; ?>
                    </td>
                    <td class="user-actions">
                        <a href="user_details.php?id=<?php echo $user_data['id']; ?>" class="action-btn view">👁️ Gör</a>
                        <?php if (!$isAdmin): ?>
                            <a href="edit_user.php?id=<?php echo $user_data['id']; ?>" class="action-btn edit">✏️ Düzəlt</a>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Bu istifadəçini silmək istədiyinizə əminsiniz?')">
                                <input type="hidden" name="delete_user" value="<?php echo $user_data['id']; ?>">
                                <button type="submit" class="action-btn delete">🗑️ Sil</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="admin-actions">
        <a href="index.php" class="admin-btn">🏠 Admin Panel</a>
        <a href="../index.php" class="admin-btn">🌐 Ana Səhifə</a>
    </div>
</div>

<script>
function searchUsers() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const tableBody = document.getElementById('usersTableBody');
    const rows = tableBody.getElementsByTagName('tr');
    
    for (let row of rows) {
        const username = row.cells[1].textContent.toLowerCase();
        const email = row.cells[2].textContent.toLowerCase();
        
        if (username.includes(searchTerm) || email.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

// Enter düyməsi ilə axtarış
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchUsers();
    }
});
</script>

<?php include '../includes/footer.php'; ?> 