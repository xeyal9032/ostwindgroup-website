<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Konsultasiyaya Yazılın - OstWindGroup';

include 'includes/header.php';

// Form processing
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!require_valid_csrf_post()) {
        $error_message = 'Təhlükəsizlik yoxlaması uğursuz oldu. Zəhmət olmasa səhifəni yeniləyin və yenidən cəhd edin.';
    } else {
    $name = clean_input($_POST['name'] ?? '');
    $email = clean_input($_POST['email'] ?? '');
    $phone = clean_input($_POST['phone'] ?? '');
    $university = clean_input($_POST['university'] ?? '');
    $specialty = clean_input($_POST['specialty'] ?? '');
    $message = clean_input($_POST['message'] ?? '');
    
    // Validation
    if (empty($name) || empty($email) || empty($phone)) {
        $error_message = 'Ad, e-mail və telefon sahələri məcburidir.';
    } elseif (!is_valid_email($email)) {
        $error_message = 'Zəhmət olmasa düzgün e-mail ünvanı daxil edin.';
    } else {
        // Send email (you can customize this part)
        $to = 'info@ostwindgroup.az';
        $subject = sanitize_email_header_value('Yeni Konsultasiya Müraciəti - ' . $name);
        $email_content = "
        Yeni konsultasiya müraciəti:
        
        Ad: $name
        E-mail: $email
        Telefon: $phone
        Maraqlı olduğu universitet: $university
        Maraqlı olduğu ixtisas: $specialty
        Mesaj: $message
        ";
        
        $safe_email = sanitize_email_header_value($email);
        $headers = 'From: ' . $safe_email . "\r\n" .
                   'Reply-To: ' . $safe_email . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        
        if (mail($to, $subject, $email_content, $headers)) {
            $success_message = 'Müraciətiniz uğurla göndərildi! Tezliklə sizinlə əlaqə saxlayacağıq.';
        } else {
            $error_message = 'Müraciət göndərilərkən xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.';
        }
    }
    }
}
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="800"><?php echo $translations['consultation_title'] ?? 'Konsultasiyaya Yazılın'; ?></h1>
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <?php echo $translations['consultation_subtitle'] ?? 'Pulsuz konsultasiya üçün müraciət edin'; ?>
            </p>
        </div>
    </section>

    <!-- Consultation Form -->
    <section class="section consultation-form-section">
        <div class="container">
            <div class="form-container">
                <div class="form-info" data-aos="fade-right" data-aos-duration="800">
                    <h2>Pulsuz Konsultasiya</h2>
                    <p>Peşəkar komandamız sizin təhsil yolculuğunuzda sizə kömək etməyə hazırdır. Aşağıdakı formu doldurun və biz sizinlə əlaqə saxlayacağıq.</p>
                    
                    <div class="consultation-benefits">
                        <h3>Konsultasiya Xidmətlərimiz:</h3>
                        <ul>
                            <li>✅ Pulsuz ilk görüş</li>
                            <li>✅ Universitet seçimi</li>
                            <li>✅ İxtisas məsləhəti</li>
                            <li>✅ Maliyyə planlaması</li>
                            <li>✅ Sənəd hazırlama</li>
                            <li>✅ Viza dəstəyi</li>
                        </ul>
                    </div>
                    
                    <div class="contact-info">
                        <h3>Əlaqə Məlumatları:</h3>
                        <div class="contact-item">
                            <div class="contact-icon">📞</div>
                            <div>
                                <strong>Telefon:</strong><br>
                                +994 50 123 45 67
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">📧</div>
                            <div>
                                <strong>E-mail:</strong><br>
                                info@ostwindgroup.az
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">📍</div>
                            <div>
                                <strong>Ünvan:</strong><br>
                                Bakı şəhəri, Azərbaycan
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-content" data-aos="fade-left" data-aos-duration="800">
                    <?php if ($success_message): ?>
                        <div class="alert alert-success">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($error_message): ?>
                        <div class="alert alert-error">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" class="consultation-form">
                        <?php echo csrf_input_field(); ?>
                        <div class="form-group">
                            <label for="name">Ad və Soyad *</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-mail *</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Telefon *</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="university">Maraqlı olduğu universitet</label>
                            <select id="university" name="university">
                                <option value="">Seçin</option>
                                <option value="Xarkov Milli Universiteti" <?php echo ($_POST['university'] ?? '') === 'Xarkov Milli Universiteti' ? 'selected' : ''; ?>>Xarkov Milli Universiteti</option>
                                <option value="Kiyev Milli Universiteti" <?php echo ($_POST['university'] ?? '') === 'Kiyev Milli Universiteti' ? 'selected' : ''; ?>>Kiyev Milli Universiteti</option>
                                <option value="Lvov Politexnik Universiteti" <?php echo ($_POST['university'] ?? '') === 'Lvov Politexnik Universiteti' ? 'selected' : ''; ?>>Lvov Politexnik Universiteti</option>
                                <option value="Xarkov Politexnik Universiteti" <?php echo ($_POST['university'] ?? '') === 'Xarkov Politexnik Universiteti' ? 'selected' : ''; ?>>Xarkov Politexnik Universiteti</option>
                                <option value="Kiyev Tibb Universiteti" <?php echo ($_POST['university'] ?? '') === 'Kiyev Tibb Universiteti' ? 'selected' : ''; ?>>Kiyev Tibb Universiteti</option>
                                <option value="Xarkov Tibb Universiteti" <?php echo ($_POST['university'] ?? '') === 'Xarkov Tibb Universiteti' ? 'selected' : ''; ?>>Xarkov Tibb Universiteti</option>
                                <option value="Digər" <?php echo ($_POST['university'] ?? '') === 'Digər' ? 'selected' : ''; ?>>Digər</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="specialty">Maraqlı olduğu ixtisas</label>
                            <select id="specialty" name="specialty">
                                <option value="">Seçin</option>
                                <option value="Kompüter Elmləri" <?php echo ($_POST['specialty'] ?? '') === 'Kompüter Elmləri' ? 'selected' : ''; ?>>Kompüter Elmləri</option>
                                <option value="Həkimlik" <?php echo ($_POST['specialty'] ?? '') === 'Həkimlik' ? 'selected' : ''; ?>>Həkimlik</option>
                                <option value="Elektrik Mühəndisliyi" <?php echo ($_POST['specialty'] ?? '') === 'Elektrik Mühəndisliyi' ? 'selected' : ''; ?>>Elektrik Mühəndisliyi</option>
                                <option value="Farmasiya" <?php echo ($_POST['specialty'] ?? '') === 'Farmasiya' ? 'selected' : ''; ?>>Farmasiya</option>
                                <option value="İqtisadiyyat" <?php echo ($_POST['specialty'] ?? '') === 'İqtisadiyyat' ? 'selected' : ''; ?>>İqtisadiyyat</option>
                                <option value="Beynəlxalq Münasibətlər" <?php echo ($_POST['specialty'] ?? '') === 'Beynəlxalq Münasibətlər' ? 'selected' : ''; ?>>Beynəlxalq Münasibətlər</option>
                                <option value="Digər" <?php echo ($_POST['specialty'] ?? '') === 'Digər' ? 'selected' : ''; ?>>Digər</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Əlavə məlumat</label>
                            <textarea id="message" name="message" rows="4" placeholder="Sualınız və ya əlavə məlumatınızı yazın..."><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-full">
                            Konsultasiya Tələb Et
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Our Consultation -->
    <section class="section why-consultation">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Niyə Bizim Konsultasiyamızı Seçməlisiniz?
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Peşəkar komandamızın üstünlükləri
                </p>
            </div>
            
            <div class="consultation-benefits-grid">
                <div class="benefit-item" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="benefit-icon">🏆</div>
                    <h3>11 İllik Təcrübə</h3>
                    <p>2013-cü ildən bəri təhsil sahəsində fəaliyyət göstəririk və minlərlə tələbənin uğuruna şahid olmuşuq.</p>
                </div>
                
                <div class="benefit-item" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="benefit-icon">👥</div>
                    <h3>2500+ Uğurlu Tələbə</h3>
                    <p>Bu günə qədər 2500-dən çox tələbəni uğurla yurtdışı universitetlərinə yerləşdirmişik.</p>
                </div>
                
                <div class="benefit-item" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="benefit-icon">✅</div>
                    <h3>100% Zəmanət</h3>
                    <p>Əgər qeydiyyat uğursuz olarsa, ödənişinizi tam qaytarırıq - tam zəmanət!</p>
                </div>
                
                <div class="benefit-item" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="benefit-icon">🌍</div>
                    <h3>5 Dildə Dəstək</h3>
                    <p>Azərbaycan, İngilis, Ukrayna, Rus və Türk dillərində tam dəstək təmin edirik.</p>
                </div>
                
                <div class="benefit-item" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1000">
                    <div class="benefit-icon">👨‍💼</div>
                    <h3>Peşəkar Komanda</h3>
                    <p>Təhsil sahəsində təcrübəli və sertifikatlı məsləhətçilərdən ibarət komandamız.</p>
                </div>
                
                <div class="benefit-item" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1200">
                    <div class="benefit-icon">💬</div>
                    <h3>24/7 Dəstək</h3>
                    <p>Həftənin 7 günü, 24 saat sizinləyik. Hər zaman suallarınızı cavablandırırıq.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up" data-aos-duration="800">
                <h2>Hazırsınızsa, sizinlə tanış olaq!</h2>
                <p>Peşəkar komandamız sizin təhsil yolculuğunuzda sizə kömək etməyə hazırdır.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary">Əlaqə</a>
                    <a href="about.php" class="btn btn-secondary">Haqqımızda</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 