<?php
require_once '../includes/database.php';
require_once '../includes/Language.php';
require_once '../includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Admin kontrolü
if (!is_logged_in()) {
    redirect_to_login();
}

$error = '';
$success = '';

// İstatistikleri al
try {
    // Öğrenci sayısı
    $stmt = $conn->query("SELECT COUNT(*) as student_count FROM students WHERE status = 'active'");
    $student_count = $stmt->fetch()['student_count'];
    
    // Öğretmen sayısı
    $stmt = $conn->query("SELECT COUNT(*) as teacher_count FROM teachers WHERE status = 'active'");
    $teacher_count = $stmt->fetch()['teacher_count'];
    
    // Ders sayısı
    $stmt = $conn->query("SELECT COUNT(*) as course_count FROM courses WHERE status = 'active'");
    $course_count = $stmt->fetch()['course_count'];
    
    // Üniversite sayısı
    $stmt = $conn->query("SELECT COUNT(*) as university_count FROM universities WHERE status = 'active'");
    $university_count = $stmt->fetch()['university_count'];
    
    // Son kayıt olan öğrenciler
    $stmt = $conn->query("SELECT * FROM students ORDER BY created_at DESC LIMIT 5");
    $recent_students = $stmt->fetchAll();
    
    // Üniversitelere göre öğrenci dağılımı
    $stmt = $conn->query("SELECT university, COUNT(*) as count FROM students WHERE status = 'active' GROUP BY university ORDER BY count DESC LIMIT 5");
    $university_distribution = $stmt->fetchAll();
    
} catch (PDOException $e) {
    $error = 'Veritabanı hatası: ' . $e->getMessage();
}

$page_title = 'Admin Dashboard - OstWindGroup';
include '../includes/header.php';
?>

<main class="container" style="padding-top: 2rem;">
    <div class="admin-header" style="margin-bottom: 2rem;">
        <h1>🎓 OstWindGroup Admin Dashboard</h1>
        <p>Üniversite yönetim sistemi</p>
    </div>

    <?php if ($error): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="message success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <!-- İstatistikler -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div class="card" data-aos="fade-up" data-aos-duration="600">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 2rem;">👥</div>
                <div>
                    <h3 style="margin: 0; color: var(--primary-color);"><?php echo $student_count; ?></h3>
                    <p style="margin: 0; color: var(--text-muted);">Aktiv Tələbələr</p>
                </div>
            </div>
        </div>

        <div class="card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 2rem;">👨‍🏫</div>
                <div>
                    <h3 style="margin: 0; color: var(--primary-color);"><?php echo $teacher_count; ?></h3>
                    <p style="margin: 0; color: var(--text-muted);">Müəllimlər</p>
                </div>
            </div>
        </div>

        <div class="card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 2rem;">📚</div>
                <div>
                    <h3 style="margin: 0; color: var(--primary-color);"><?php echo $course_count; ?></h3>
                    <p style="margin: 0; color: var(--text-muted);">Dərslər</p>
                </div>
            </div>
        </div>

        <div class="card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 2rem;">🏛️</div>
                <div>
                    <h3 style="margin: 0; color: var(--primary-color);"><?php echo $university_count; ?></h3>
                    <p style="margin: 0; color: var(--text-muted);">Universitetlər</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ana İçerik Grid -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        
        <!-- Sol Kolon -->
        <div>
            <!-- Son Kayıt Olan Öğrenciler -->
            <div class="card" data-aos="fade-up" data-aos-duration="800">
                <h3>📝 Son Qeydiyyat Olan Tələbələr</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <th style="text-align: left; padding: 0.75rem;">Tələbə Nömrəsi</th>
                                <th style="text-align: left; padding: 0.75rem;">Ad Soyad</th>
                                <th style="text-align: left; padding: 0.75rem;">Universitet</th>
                                <th style="text-align: left; padding: 0.75rem;">Tarix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_students as $student): ?>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 0.75rem;"><?php echo htmlspecialchars($student['student_number']); ?></td>
                                <td style="padding: 0.75rem;"><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></td>
                                <td style="padding: 0.75rem;"><?php echo htmlspecialchars($student['university']); ?></td>
                                <td style="padding: 0.75rem;"><?php echo date('d.m.Y', strtotime($student['created_at'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 1rem;">
                    <a href="students.php" class="btn btn-primary btn-sm">Bütün Tələbələr</a>
                </div>
            </div>

            <!-- Üniversite Dağılımı -->
            <div class="card" style="margin-top: 2rem;" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <h3>📊 Universitetlərə Görə Tələbə Dağılımı</h3>
                <div style="margin-top: 1rem;">
                    <?php foreach ($university_distribution as $uni): ?>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        <span><?php echo htmlspecialchars($uni['university']); ?></span>
                        <span style="font-weight: bold; color: var(--primary-color);"><?php echo $uni['count']; ?> tələbə</span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Sağ Kolon -->
        <div>
            <!-- Hızlı İşlemler -->
            <div class="card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                <h3>⚡ Sürətli Əməliyyatlar</h3>
                <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                    <a href="add-student.php" class="btn btn-primary">➕ Yeni Tələbə Əlavə Et</a>
                    <a href="add-teacher.php" class="btn btn-secondary">👨‍🏫 Yeni Müəllim Əlavə Et</a>
                    <a href="add-course.php" class="btn btn-outline">📚 Yeni Dərs Əlavə Et</a>
                    <a href="grades.php" class="btn btn-outline">📊 Notları İdarə Et</a>
                    <a href="schedule.php" class="btn btn-outline">📅 Dərs Cədvəli</a>
                </div>
            </div>

            <!-- Sistem Durumu -->
            <div class="card" style="margin-top: 2rem;" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                <h3>🔧 Sistem Statusu</h3>
                <div style="margin-top: 1rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0;">
                        <span>Veritabanı</span>
                        <span style="color: var(--success-color);">✅ Aktiv</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0;">
                        <span>Web Server</span>
                        <span style="color: var(--success-color);">✅ Aktiv</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0;">
                        <span>Son Yeniləmə</span>
                        <span><?php echo date('d.m.Y H:i'); ?></span>
                    </div>
                </div>
            </div>

            <!-- Son Aktiviteler -->
            <div class="card" style="margin-top: 2rem;" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                <h3>📋 Son Fəaliyyətlər</h3>
                <div style="margin-top: 1rem;">
                    <div style="padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        <small style="color: var(--text-muted);"><?php echo date('d.m.Y H:i'); ?></small>
                        <p style="margin: 0.25rem 0;">Sistem yenidən başladıldı</p>
                    </div>
                    <div style="padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        <small style="color: var(--text-muted);"><?php echo date('d.m.Y H:i', strtotime('-1 hour')); ?></small>
                        <p style="margin: 0.25rem 0;">Yeni tələbə qeydiyyatı</p>
                    </div>
                    <div style="padding: 0.5rem 0;">
                        <small style="color: var(--text-muted);"><?php echo date('d.m.Y H:i', strtotime('-2 hours')); ?></small>
                        <p style="margin: 0.25rem 0;">Not sistemi yeniləndi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.admin-header {
    text-align: center;
    padding: 2rem 0;
    background: linear-gradient(135deg, var(--primary-50), var(--bg-secondary));
    border-radius: var(--radius-xl);
    margin-bottom: 2rem;
}

.admin-header h1 {
    margin: 0;
    color: var(--primary-color);
}

.admin-header p {
    margin: 0.5rem 0 0 0;
    color: var(--text-secondary);
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    main .container > div:last-child {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include '../includes/footer.php'; ?> 