<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Form verilerini al
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!require_valid_csrf_post()) {
        $error_message = "❌ Təhlükəsizlik yoxlaması uğursuz oldu. Zəhmət olmasa səhifəni yeniləyin və yenidən cəhd edin.";
        $success = false;
    } else {
    $education_level = clean_input($_POST['education_level'] ?? '');
    $full_name = clean_input($_POST['full_name'] ?? '');
    $phone = clean_input($_POST['phone'] ?? '');
    $email = clean_input($_POST['email'] ?? '');
    $message = clean_input($_POST['message'] ?? '');
    
    // Təhsil səviyyəsi adlarını təyin et
    $level_names = [
        'bachelor' => 'Bakalavr (Bachelor)',
        'master' => 'Magistratura (Master)',
        'phd' => 'Doktarantura (PhD)'
    ];
    
    $level_name = $level_names[$education_level] ?? 'Naməlum';
    
    // E-mail məzmunu
    $email_subject = "Yeni Təhsil Müraciəti - $level_name";
    $email_body = "
    <h2>🎓 Yeni Təhsil Müraciəti</h2>
    
    <h3>📋 Müraciət Məlumatları:</h3>
    <ul>
        <li><strong>Təhsil Səviyyəsi:</strong> $level_name</li>
        <li><strong>Ad Soyad:</strong> $full_name</li>
        <li><strong>Telefon:</strong> $phone</li>
        <li><strong>E-mail:</strong> $email</li>
        <li><strong>Əlavə Məlumat:</strong> $message</li>
    </ul>
    
    <p><strong>📅 Müraciət Tarixi:</strong> " . date('d.m.Y H:i:s') . "</p>
    
    <hr>
    <p><em>Bu müraciət OstWindGroup veb saytından göndərilmişdir.</em></p>
    ";
    
    // E-mail başlıqları
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: OstWindGroup <noreply@ostwindgroup.com>" . "\r\n";
    $headers .= "Reply-To: " . sanitize_email_header_value($email) . "\r\n";
    
    // E-mail göndər
    $email_sent = mail('info@ostwindgroup.com', $email_subject, $email_body, $headers);
    
    // Telegram mesajı (optional; configure via env)
    $bot_token = function_exists('ostwind_env') ? ostwind_env('TELEGRAM_BOT_TOKEN', '') : (getenv('TELEGRAM_BOT_TOKEN') ?: '');
    $chat_id = function_exists('ostwind_env') ? ostwind_env('TELEGRAM_CHAT_ID', '') : (getenv('TELEGRAM_CHAT_ID') ?: '');
    
    $telegram_message = "
🎓 <b>Yeni Təhsil Müraciəti</b>

📋 <b>Müraciət Məlumatları:</b>
• <b>Təhsil Səviyyəsi:</b> $level_name
• <b>Ad Soyad:</b> $full_name
• <b>Telefon:</b> $phone
• <b>E-mail:</b> $email
• <b>Əlavə Məlumat:</b> $message

📅 <b>Müraciət Tarixi:</b> " . date('d.m.Y H:i:s') . "

🌐 <b>Mənbə:</b> OstWindGroup Veb Saytı
    ";
    
    // Telegram API URL
    $telegram_url = "https://api.telegram.org/bot$bot_token/sendMessage";
    $telegram_data = [
        'chat_id' => $chat_id,
        'text' => $telegram_message,
        'parse_mode' => 'HTML'
    ];
    
    // Telegram mesajı göndər (only if configured)
    $telegram_sent = false;
    if (!empty($bot_token) && !empty($chat_id)) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $telegram_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $telegram_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_exec($ch);
        $telegram_sent = curl_errno($ch) === 0;
        curl_close($ch);
    }
    
    // Nəticəni yoxla
    $success = $email_sent || $telegram_sent;
    
    if ($success) {
        $success_message = "✅ Müraciətiniz uğurla göndərildi! Tezliklə sizinlə əlaqə saxlayacağıq.";
    } else {
        $error_message = "❌ Müraciət göndərilərkən xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.";
    }
    }
}

// Sayfa başlığı
$page_title = 'Müraciət Nəticəsi - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Result Section -->
    <section class="section result-section">
        <div class="container">
            <div class="result-content" data-aos="fade-up" data-aos-duration="800">
                <?php if (isset($success) && $success): ?>
                    <div class="success-message">
                        <div class="success-icon">✅</div>
                        <h2>Müraciətiniz Uğurla Göndərildi!</h2>
                        <p><?php echo $success_message; ?></p>
                        
                        <div class="next-steps">
                            <h3>📋 Növbəti Addımlar:</h3>
                            <ul>
                                <li>✅ Müraciətiniz təhlil edilir</li>
                                <li>📞 24 saat ərzində sizinlə əlaqə saxlanılacaq</li>
                                <li>📧 E-mail ünvanınızı yoxlayın</li>
                                <li>📱 WhatsApp və ya Telegram mesajlarınızı yoxlayın</li>
                            </ul>
                        </div>
                        
                        <div class="contact-info">
                            <h3>📞 Əlaqə Məlumatları:</h3>
                            <div class="contact-grid">
                                <div class="contact-item">
                                    <span class="contact-icon">📱</span>
                                    <span>WhatsApp: +380972580000</span>
                                </div>
                                <div class="contact-item">
                                    <span class="contact-icon">📧</span>
                                    <span>E-mail: info@ostwindgroup.com</span>
                                </div>
                                <div class="contact-item">
                                    <span class="contact-icon">🌐</span>
                                    <span>Veb: www.ostwindgroup.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="error-message">
                        <div class="error-icon">❌</div>
                        <h2>Xəta Baş Verdi</h2>
                        <p><?php echo $error_message ?? 'Naməlum xəta baş verdi.'; ?></p>
                        
                        <div class="error-help">
                            <h3>🔧 Həll Yolları:</h3>
                            <ul>
                                <li>✅ İnternet bağlantınızı yoxlayın</li>
                                <li>📞 Birbaşa əlaqə saxlayın: +380972580000</li>
                                <li>📧 E-mail göndərin: info@ostwindgroup.com</li>
                                <li>🔄 Səhifəni yeniləyib yenidən cəhd edin</li>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="action-buttons">
                    <a href="education-form.php" class="btn btn-secondary">
                        🔄 Yenidən Müraciət
                    </a>
                    <a href="contact.php" class="btn btn-primary">
                        📞 Əlaqə Saxlayın
                    </a>
                    <a href="universities.php" class="btn btn-outline">
                        🏫 Universitetlər
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Services -->
    <section class="section related-services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Digər Xidmətlərimiz
                </h2>
            </div>
            
            <div class="services-grid">
                <div class="service-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="service-icon">🏫</div>
                    <h3>Universitet Qəbulu</h3>
                    <p>Ukrayna universitetlərinə qəbul prosesi</p>
                    <a href="universities.php" class="btn btn-outline">Ətraflı</a>
                </div>
                
                <div class="service-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="service-icon">📋</div>
                    <h3>Viza Dəstəyi</h3>
                    <p>Tələbə vizası və sənədlərin hazırlanması</p>
                    <a href="documents.php" class="btn btn-outline">Ətraflı</a>
                </div>
                
                <div class="service-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="service-icon">🏠</div>
                    <h3>Konaklama</h3>
                    <p>Universitet yataqxanalarında yerləşdirmə</p>
                    <a href="contact.php" class="btn btn-outline">Ətraflı</a>
                </div>
                
                <div class="service-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="service-icon">🎓</div>
                    <h3>Akademik Dəstək</h3>
                    <p>Təhsil prosesində tam dəstək</p>
                    <a href="consultation.php" class="btn btn-outline">Ətraflı</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 