<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Niyə Bizi Seçməlisiniz? - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="800">Niyə Bizi Seçməlisiniz?</h1>
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                Peşəkar komandamız və sınaqdan keçmiş metodlarımızla sizin uğurunuzu təmin edirik
            </p>
        </div>
    </section>

    <!-- Advantages Section -->
    <section class="section why-choose-section">
        <div class="container">
            <div class="advantages-grid">
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="advantage-icon">🏆</div>
                    <h3>11 İllik Təcrübə</h3>
                    <p>2013-cü ildən bəri təhsil sahəsində fəaliyyət göstəririk və minlərlə tələbənin uğuruna şahid olmuşuq.</p>
                </div>
                
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="advantage-icon">👥</div>
                    <h3>2500+ Uğurlu Tələbə</h3>
                    <p>Bu günə qədər 2500-dən çox tələbəni uğurla yurtdışı universitetlərinə yerləşdirmişik.</p>
                </div>
                
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="advantage-icon">✅</div>
                    <h3>100% Qeydiyyat Zəmanəti</h3>
                    <p>Əgər qeydiyyat uğursuz olarsa, ödənişinizi tam qaytarırıq - tam zəmanət!</p>
                </div>
                
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="advantage-icon">🌍</div>
                    <h3>5 Dildə Dəstək</h3>
                    <p>Azərbaycan, İngilis, Ukrayna, Rus və Türk dillərində tam dəstək təmin edirik.</p>
                </div>
                
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1000">
                    <div class="advantage-icon">👨‍💼</div>
                    <h3>Peşəkar Komanda</h3>
                    <p>Təhsil sahəsində təcrübəli və sertifikatlı məsləhətçilərdən ibarət komandamız.</p>
                </div>
                
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1200">
                    <div class="advantage-icon">💬</div>
                    <h3>Real Tələbə Rəyləri</h3>
                    <p>Məmnun tələbələrimizin real rəyləri və uğur hekayələri ilə tanış olun.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="section process-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    İş Prosesimiz
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Sizin uğurunuz üçün addım-addım işləyirik
                </p>
            </div>
            
            <div class="process-steps">
                <div class="process-step" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>İlk Görüş</h3>
                        <p>Tələbə ilə ilk görüş keçiririk, təhsil hədəflərini və imkanlarını müəyyən edirik.</p>
                    </div>
                </div>
                
                <div class="process-step" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Universitet Seçimi</h3>
                        <p>Tələbənin maraqlarına və imkanlarına uyğun ən yaxşı universitetləri təklif edirik.</p>
                    </div>
                </div>
                
                <div class="process-step" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Sənəd Hazırlama</h3>
                        <p>Bütün lazımi sənədləri hazırlayırıq və universitetə göndəririk.</p>
                    </div>
                </div>
                
                <div class="process-step" data-aos="fade-left" data-aos-duration="800" data-aos-delay="800">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Viza Dəstəyi</h3>
                        <p>Viza müraciəti prosesində tam dəstək təmin edirik.</p>
                    </div>
                </div>
                
                <div class="process-step" data-aos="fade-right" data-aos-duration="800" data-aos-delay="1000">
                    <div class="step-number">5</div>
                    <div class="step-content">
                        <h3>Yerə Yerləşmə</h3>
                        <p>Universitetə qəbul olduqdan sonra yerləşmə və adaptasiya dəstəyi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section services-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Xidmətlərimiz
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Təhsil yolculuğunuzun hər mərhələsində yanınızdayıq
                </p>
            </div>
            
            <div class="services-grid">
                <div class="service-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="service-icon">🎓</div>
                    <h3>Universitet Qeydiyyatı</h3>
                    <p>Seçdiyiniz universitetə qeydiyyat prosesini tam idarə edirik.</p>
                </div>
                
                <div class="service-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="service-icon">📋</div>
                    <h3>Sənəd Hazırlama</h3>
                    <p>Bütün lazımi sənədləri peşəkar şəkildə hazırlayırıq.</p>
                </div>
                
                <div class="service-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="service-icon">🛂</div>
                    <h3>Viza Dəstəyi</h3>
                    <p>Viza müraciəti və müsahibə hazırlığında kömək edirik.</p>
                </div>
                
                <div class="service-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="service-icon">🏠</div>
                    <h3>Yerləşmə</h3>
                    <p>Universitet yaxınlığında yerləşmə seçimlərini təmin edirik.</p>
                </div>
                
                <div class="service-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1000">
                    <div class="service-icon">✈️</div>
                    <h3>Hava Yolu</h3>
                    <p>Ən yaxşı qiymətlərlə bilet təmin edirik.</p>
                </div>
                
                <div class="service-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1200">
                    <div class="service-icon">📞</div>
                    <h3>24/7 Dəstək</h3>
                    <p>Təhsil müddəti boyunca tam dəstək təmin edirik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section testimonials-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Tələbələrimizin Rəyləri
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Uğurlu tələbələrimizin real hekayələri
                </p>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="testimonial-content">
                        <p>"OstWindGroup sayəsində Xarkov Milli Universitetinə qəbul oldum. Komanda çox peşəkar və köməkçi idi."</p>
                    </div>
                    <div class="testimonial-author">
                        <h4>Əli Məmmədov</h4>
                        <p>Xarkov Milli Universiteti, İnformatika</p>
                    </div>
                </div>
                
                <div class="testimonial-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="testimonial-content">
                        <p>"Viza prosesi çox asan oldu. OstWindGroup komandası hər addımda mənə kömək etdi."</p>
                    </div>
                    <div class="testimonial-author">
                        <h4>Aysu Əliyeva</h4>
                        <p>Kiyev Milli Universiteti, Tibb</p>
                    </div>
                </div>
                
                <div class="testimonial-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="testimonial-content">
                        <p>"11 illik təcrübəsi olan komanda gerçəkən fərq yaradır. Çox məmnunam!"</p>
                    </div>
                    <div class="testimonial-author">
                        <h4>Murad Hüseynov</h4>
                        <p>Lvov Politexnik Universiteti, Mühəndislik</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up" data-aos-duration="800">
                <h2>Hazırsınızsa, sizinlə işləməyə başlayaq!</h2>
                <p>Peşəkar komandamız sizin uğurunuz üçün burada.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary">Pulsuz Konsultasiya</a>
                    <a href="about.php" class="btn btn-secondary">Haqqımızda</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 