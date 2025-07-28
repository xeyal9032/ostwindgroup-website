<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

$page_title = 'Əlaqə - OstWindGroup';

// Form mesajı (whatsapp-send.php'den gelecek)
$message = '';

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
                             <a href="https://wa.me/380972580000" class="btn btn-primary" target="_blank">
                                 💬 WhatsApp
                             </a>
                             <a href="https://t.me/ostwindgroup" class="btn btn-primary" target="_blank">
                                 📱 Telegram
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
                    
                    <?php echo $message; ?>
                    
                    <form method="POST" action="telegram-send.php">
                        <div class="form-group">
                            <label for="name">Ad və Soyad *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-poçt *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Mövzu</label>
                            <select id="subject" name="subject">
                                <option value="">Mövzu seçin</option>
                                <option value="Universitet qəbulu">Universitet qəbulu</option>
                                <option value="Viza dəstəyi">Viza dəstəyi</option>
                                <option value="Konaklama">Konaklama</option>
                                <option value="Təhsil məsləhəti">Təhsil məsləhəti</option>
                                <option value="Diplom təsdiqi">Diplom təsdiqi</option>
                                <option value="Digər">Digər</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mesaj *</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            📱 Telegram-a Göndər
                        </button>
                        
                        <div class="whatsapp-direct" style="margin-top: 20px; text-align: center;">
                            <p style="margin-bottom: 10px; color: #666;">Və ya birbaşa WhatsApp ilə əlaqə saxlayın:</p>
                            <a href="https://wa.me/380972580000?text=Merhaba%2C%20OstWindGroup%20haqqında%20məlumat%20almaq%20istəyirəm" 
                               class="btn btn-success" 
                               target="_blank" 
                               style="background: #25D366; color: white; border: none;">
                                💬 WhatsApp ilə əlaqə
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