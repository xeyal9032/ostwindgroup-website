<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Canlı Dəstək - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="800">Canlı Dəstək</h1>
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                24/7 canlı dəstək xidmətimizlə sizinləyik
            </p>
        </div>
    </section>

    <!-- Live Support Channels -->
    <section class="section live-support-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Dəstək Kanalları
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Sizinlə əlaqə saxlayacağımız müxtəlif üsullar
                </p>
            </div>
            
            <div class="support-grid">
                <div class="support-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="support-icon">💬</div>
                    <h3>WhatsApp</h3>
                    <p>WhatsApp vasitəsilə dərhal cavab alın</p>
                    <div class="support-details">
                        <span class="response-time">Dərhal cavab</span>
                        <span class="availability">24/7</span>
                    </div>
                    <a href="https://wa.me/994501234567" class="btn btn-primary" target="_blank">
                        WhatsApp-a Yaz
                    </a>
                </div>
                
                <div class="support-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="support-icon">📱</div>
                    <h3>Telegram</h3>
                    <p>Telegram kanalımıza qoşulun və yeniliklərdən xəbərdar olun</p>
                    <div class="support-details">
                        <span class="response-time">5 dəqiqə</span>
                        <span class="availability">24/7</span>
                    </div>
                    <a href="https://t.me/ostwindgroup" class="btn btn-primary" target="_blank">
                        Telegram-a Qoşul
                    </a>
                </div>
                
                <div class="support-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="support-icon">📞</div>
                    <h3>Telefon</h3>
                    <p>Birbaşa telefonla əlaqə saxlayın</p>
                    <div class="support-details">
                        <span class="response-time">Dərhal</span>
                        <span class="availability">09:00-18:00</span>
                    </div>
                    <a href="tel:+994501234567" class="btn btn-primary">
                        Zəng Et
                    </a>
                </div>
                
                <div class="support-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="support-icon">📧</div>
                    <h3>E-mail</h3>
                    <p>E-mail vasitəsilə ətraflı məlumat alın</p>
                    <div class="support-details">
                        <span class="response-time">24 saat</span>
                        <span class="availability">24/7</span>
                    </div>
                    <a href="mailto:info@ostwindgroup.az" class="btn btn-primary">
                        E-mail Göndər
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Team -->
    <section class="section support-team">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Dəstək Komandamız
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Sizin suallarınızı cavablandıran peşəkar komandamız
                </p>
            </div>
            
            <div class="team-grid">
                <div class="team-member" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="member-photo">
                        <img src="images/support-1.jpg" alt="Dəstək üzvü" onerror="this.src='https://via.placeholder.com/200x200/007AFF/FFFFFF?text=Dəstək'">
                    </div>
                    <h3>Əli Məmmədov</h3>
                    <p class="member-role">Baş Dəstək Məsləhətçisi</p>
                    <p class="member-description">11 illik təcrübəsi ilə təhsil sahəsində mütəxəssis.</p>
                    <div class="member-contact">
                        <span>📞 +994 50 123 45 67</span>
                        <span>📧 ali@ostwindgroup.az</span>
                    </div>
                </div>
                
                <div class="team-member" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="member-photo">
                        <img src="images/support-2.jpg" alt="Dəstək üzvü" onerror="this.src='https://via.placeholder.com/200x200/007AFF/FFFFFF?text=Dəstək'">
                    </div>
                    <h3>Aysu Əliyeva</h3>
                    <p class="member-role">Təhsil Məsləhətçisi</p>
                    <p class="member-description">Beynəlxalq təhsil sahəsində təcrübəli məsləhətçi.</p>
                    <div class="member-contact">
                        <span>📞 +994 50 123 45 68</span>
                        <span>📧 aysu@ostwindgroup.az</span>
                    </div>
                </div>
                
                <div class="team-member" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="member-photo">
                        <img src="images/support-3.jpg" alt="Dəstək üzvü" onerror="this.src='https://via.placeholder.com/200x200/007AFF/FFFFFF?text=Dəstək'">
                    </div>
                    <h3>Murad Hüseynov</h3>
                    <p class="member-role">Viza Məsləhətçisi</p>
                    <p class="member-description">Viza və sənəd hazırlama sahəsində mütəxəssis.</p>
                    <div class="member-contact">
                        <span>📞 +994 50 123 45 69</span>
                        <span>📧 murad@ostwindgroup.az</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Hours -->
    <section class="section support-hours">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Dəstək Saatları
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Həftənin hər günü sizinləyik
                </p>
            </div>
            
            <div class="hours-grid">
                <div class="hours-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="day">Bazar ertəsi - Cümə</div>
                    <div class="time">09:00 - 18:00</div>
                    <div class="service">Tam xidmət</div>
                </div>
                
                <div class="hours-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="day">Şənbə</div>
                    <div class="time">10:00 - 16:00</div>
                    <div class="service">Məhdud xidmət</div>
                </div>
                
                <div class="hours-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="day">Bazar</div>
                    <div class="time">12:00 - 16:00</div>
                    <div class="service">Təcili dəstək</div>
                </div>
                
                <div class="hours-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="800">
                    <div class="day">WhatsApp/Telegram</div>
                    <div class="time">24/7</div>
                    <div class="service">Tam xidmət</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Common Questions -->
    <section class="section common-questions">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Tez-tez Soruşulan Suallar
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Dəstək komandamıza ən çox soruşulan suallar
                </p>
            </div>
            
            <div class="questions-grid">
                <div class="question-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <h3>Nə vaxt dəstək ala bilərəm?</h3>
                    <p>WhatsApp və Telegram vasitəsilə 24/7 dəstək ala bilərsiniz. Telefon dəstəyi həftəiçi 09:00-18:00 arası mövcuddur.</p>
                </div>
                
                <div class="question-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <h3>Hansı dillərdə dəstək ala bilərəm?</h3>
                    <p>Azərbaycan, İngilis, Ukrayna, Rus və Türk dillərində dəstək təmin edirik.</p>
                </div>
                
                <div class="question-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                    <h3>Dəstək pulsuzdur?</h3>
                    <p>Bəli, bütün dəstək xidmətlərimiz tamamilə pulsuzdur.</p>
                </div>
                
                <div class="question-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                    <h3>Nə qədər tez cavab alacağam?</h3>
                    <p>WhatsApp və Telegram vasitəsilə dərhal, telefonla dəqiqələr ərzində, e-mail ilə 24 saat ərzində cavab alacaqsınız.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="section contact-form-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Bizimlə Əlaqə
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Sualınızı göndərin, tezliklə cavablandıraq
                </p>
            </div>
            
            <div class="contact-form-container" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                <form class="contact-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-name">Ad və Soyad</label>
                            <input type="text" id="contact-name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-email">E-mail</label>
                            <input type="email" id="contact-email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-subject">Mövzu</label>
                        <select id="contact-subject" name="subject" required>
                            <option value="">Seçin</option>
                            <option value="universitet-secimi">Universitet Seçimi</option>
                            <option value="viza-muracieti">Viza Müraciəti</option>
                            <option value="senəd-hazırlama">Sənəd Hazırlama</option>
                            <option value="qiymət-məlumatı">Qiymət Məlumatı</option>
                            <option value="digər">Digər</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-message">Mesaj</label>
                        <textarea id="contact-message" name="message" rows="5" placeholder="Sualınızı və ya məlumatınızı yazın..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full">
                        Mesaj Göndər
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up" data-aos-duration="800">
                <h2>Hazırsınızsa, sizinlə əlaqə saxlayaq!</h2>
                <p>Peşəkar komandamız sizin suallarınızı cavablandırmağa hazırdır.</p>
                <div class="cta-buttons">
                    <a href="https://wa.me/994501234567" class="btn btn-primary" target="_blank">WhatsApp</a>
                    <a href="contact.php" class="btn btn-secondary">Əlaqə</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 