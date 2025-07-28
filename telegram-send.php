<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Telegram Bot API ayarları
$bot_token = 'YOUR_BOT_TOKEN'; // Telegram bot token'ınızı buraya yazın
$chat_id = 'YOUR_CHAT_ID'; // Telegram chat ID'nizi buraya yazın

// Telegram'a mesaj gönderme fonksiyonu
function sendTelegramMessage($bot_token, $chat_id, $message) {
    $url = "https://api.telegram.org/bot{$bot_token}/sendMessage";
    
    $data = [
        'chat_id' => $chat_id,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'success' => $http_code === 200,
        'response' => $response,
        'http_code' => $http_code
    ];
}

// Form verilerini al ve temizle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean_input($_POST['name'] ?? '');
    $email = clean_input($_POST['email'] ?? '');
    $phone = clean_input($_POST['phone'] ?? '');
    $subject = clean_input($_POST['subject'] ?? '');
    $message_text = clean_input($_POST['message'] ?? '');
    
    // Validasyon
    if (empty($name) || empty($email) || empty($message_text)) {
        $error_message = '<div class="alert alert-error">Zəhmət olmasa bütün məcburi sahələri doldurun.</div>';
    } elseif (!is_valid_email($email)) {
        $error_message = '<div class="alert alert-error">Zəhmət olmasa düzgün e-poçt ünvanı daxil edin.</div>';
    } else {
        // E-posta ile mesaj gönder
        $to = 'info@ostwindgroup.com';
        $email_subject = "Yeni Əlaqə Mesajı: $subject";
        
        $email_content = "
        <html>
        <head>
            <title>Yeni Əlaqə Mesajı</title>
        </head>
        <body>
            <h2>🆕 Yeni Əlaqə Mesajı</h2>
            <table style='border-collapse: collapse; width: 100%;'>
                <tr>
                    <td style='padding: 10px; border: 1px solid #ddd;'><strong>👤 Ad:</strong></td>
                    <td style='padding: 10px; border: 1px solid #ddd;'>$name</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border: 1px solid #ddd;'><strong>📧 E-poçt:</strong></td>
                    <td style='padding: 10px; border: 1px solid #ddd;'>$email</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border: 1px solid #ddd;'><strong>📞 Telefon:</strong></td>
                    <td style='padding: 10px; border: 1px solid #ddd;'>$phone</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border: 1px solid #ddd;'><strong>📋 Mövzu:</strong></td>
                    <td style='padding: 10px; border: 1px solid #ddd;'>$subject</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border: 1px solid #ddd;'><strong>💬 Mesaj:</strong></td>
                    <td style='padding: 10px; border: 1px solid #ddd;'>$message_text</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border: 1px solid #ddd;'><strong>🌐 Səhifə:</strong></td>
                    <td style='padding: 10px; border: 1px solid #ddd;'>" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "</td>
                </tr>
            </table>
        </body>
        </html>
        ";
        
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        // E-posta gönder
        $email_sent = mail($to, $email_subject, $email_content, $headers);
        
        // Telegram mesajını oluştur
        $telegram_message = "🆕 <b>Yeni Əlaqə Mesajı</b>\n\n";
        $telegram_message .= "👤 <b>Ad:</b> {$name}\n";
        $telegram_message .= "📧 <b>E-poçt:</b> {$email}\n";
        $telegram_message .= "📞 <b>Telefon:</b> {$phone}\n";
        $telegram_message .= "📋 <b>Mövzu:</b> {$subject}\n\n";
        $telegram_message .= "💬 <b>Mesaj:</b>\n{$message_text}\n\n";
        $telegram_message .= "🌐 <b>Səhifə:</b> " . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        
        // Telegram'a gönder
        $telegram_result = sendTelegramMessage($bot_token, $chat_id, $telegram_message);
        
        if ($email_sent && $telegram_result['success']) {
            $success_message = '<div class="alert alert-success">
                <h4>✅ Mesajınız uğurla göndərildi!</h4>
                <p>Mesajınız e-poçt və Telegram ilə göndərildi.</p>
                <p><strong>E-poçt:</strong> info@ostwindgroup.com</p>
                <p><strong>Telegram:</strong> @ostwindgroup</p>
            </div>';
        } elseif ($email_sent) {
            $success_message = '<div class="alert alert-success">
                <h4>✅ Mesajınız e-poçt ilə göndərildi!</h4>
                <p>Telegram gönderimi başarısız oldu, amma e-poçt gönderildi.</p>
                <p><strong>E-poçt:</strong> info@ostwindgroup.com</p>
            </div>';
        } else {
            $error_message = '<div class="alert alert-error">
                <h4>❌ Xəta baş verdi!</h4>
                <p>Mesaj göndərilə bilmədi. Zəhmət olmasa daha sonra yenidən cəhd edin.</p>
            </div>';
        }
    }
}

// Contact sayfasına geri dön
include 'includes/header.php';
?>

<main>
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h1 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    <?php echo $translations['contact_title'] ?? 'Bizimlə Əlaqə'; ?>
                </h1>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <?php echo $translations['contact_subtitle'] ?? 'Suallarınızı soruşun və ya məsləhət alın'; ?>
                </p>
            </div>
            
            <div class="contact-content">
                <div class="contact-info" data-aos="fade-right" data-aos-duration="800">
                    <h2>Əlaqə Məlumatları</h2>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div class="contact-details">
                            <h3>Telefon</h3>
                            <p>+380 96 258 00 00</p>
                            <p>+380 97 258 00 00</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-details">
                            <h3>E-poçt</h3>
                            <p>info@ostwindgroup.com</p>
                            <p>support@ostwindgroup.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-details">
                            <h3>Ünvan</h3>
                            <p>Bakı şəhəri, Rüstəm Rüstəmov 44</p>
                            <p>Neftçilər metrosunun yanı</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">🕒</div>
                        <div class="contact-details">
                            <h3>İş Saatları</h3>
                            <p>Bazar ertəsi - Cümə: 09:00 - 18:00</p>
                            <p>Şənbə: 10:00 - 16:00</p>
                            <p>Bazar: Qapalı</p>
                        </div>
                    </div>
                    
                                         <div class="social-links">
                         <h3>Sosial Media</h3>
                         <div class="social-buttons">
                             <a href="https://t.me/ostwindgroup" class="btn btn-primary" target="_blank">
                                 📱 Telegram
                             </a>
                             <a href="https://wa.me/380972580000" class="btn btn-primary" target="_blank">
                                 💬 WhatsApp
                             </a>
                             <a href="https://facebook.com/ostwind.llc" class="btn btn-secondary" target="_blank">
                                 📘 Facebook
                             </a>
                             <a href="https://instagram.com/ostwind.group" class="btn btn-secondary" target="_blank">
                                 📷 Instagram
                             </a>
                             <a href="https://tiktok.com/@ostwind.group2008" class="btn btn-secondary" target="_blank">
                                 🎵 TikTok
                             </a>
                         </div>
                     </div>
                </div>
                
                <div class="contact-form" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                    <h2>📱 Telegram-a Mesaj Göndərin</h2>
                    <p style="color: #666; margin-bottom: 20px;">Formu doldurduqdan sonra mesajınız e-poçt və Telegram ilə göndəriləcək.</p>
                    
                    <?php 
                    if (isset($error_message)) {
                        echo $error_message;
                    } elseif (isset($success_message)) {
                        echo $success_message;
                    }
                    ?>
                    
                    <form method="POST" action="telegram-send.php">
                        <div class="form-group">
                            <label for="name">Ad və Soyad *</label>
                            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-poçt *</label>
                            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Mövzu</label>
                            <select id="subject" name="subject">
                                <option value="">Mövzu seçin</option>
                                <option value="Universitet qəbulu" <?php echo ($subject ?? '') === 'Universitet qəbulu' ? 'selected' : ''; ?>>Universitet qəbulu</option>
                                <option value="Viza dəstəyi" <?php echo ($subject ?? '') === 'Viza dəstəyi' ? 'selected' : ''; ?>>Viza dəstəyi</option>
                                <option value="Konaklama" <?php echo ($subject ?? '') === 'Konaklama' ? 'selected' : ''; ?>>Konaklama</option>
                                <option value="Təhsil məsləhəti" <?php echo ($subject ?? '') === 'Təhsil məsləhəti' ? 'selected' : ''; ?>>Təhsil məsləhəti</option>
                                <option value="Diplom təsdiqi" <?php echo ($subject ?? '') === 'Diplom təsdiqi' ? 'selected' : ''; ?>>Diplom təsdiqi</option>
                                <option value="Digər" <?php echo ($subject ?? '') === 'Digər' ? 'selected' : ''; ?>>Digər</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mesaj *</label>
                            <textarea id="message" name="message" rows="5" required><?php echo htmlspecialchars($message_text ?? ''); ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            📱 Telegram-a Göndər
                        </button>
                        
                        <div class="telegram-direct" style="margin-top: 20px; text-align: center;">
                            <p style="margin-bottom: 10px; color: #666;">Və ya birbaşa Telegram ilə əlaqə saxlayın:</p>
                            <a href="https://t.me/ostwindgroup" 
                               class="btn btn-success" 
                               target="_blank" 
                               style="background: #0088cc; color: white; border: none;">
                                📱 Telegram ilə əlaqə
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Map Section -->
    <section class="section map-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Xəritədə Biz
                </h2>
            </div>
            
            <div class="map-container" data-aos="custom-zoom-in" data-aos-duration="1000">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.1234567890123!2d49.85123456789012!3d40.37765432109876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDIyJzM5LjYiTiA0OcKwNTEnMDQuNCJF!5e0!3m2!1str!2saz!4v1234567890123"
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 