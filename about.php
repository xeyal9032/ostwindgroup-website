<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Haqqımızda - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="800">Haqqımızda</h1>
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                OstWindGroup haqqında ətraflı məlumat
            </p>
        </div>
    </section>

    <!-- About Content -->
    <section class="section about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text" data-aos="fade-right" data-aos-duration="800">
                    <h2>OstWindGroup Kimdir?</h2>
                    <p class="about-description">
                        <strong>OstWindGroup</strong> — Ukraynada və xaricdə təhsil almaq istəyən tələbələr üçün hazırlanmış kapsamlı bir bilgi və dəstək platformudur. 2013-cü ildən bəri təhsil, burs, viza, universitet qeydiyyat prosesləri və daha çoxu burada!
                    </p>
                    
                    <div class="target-audience">
                        <h3>Kimlər üçün?</h3>
                        <ul>
                            <li>🎓 Yurtdışında təhsil almaq istəyən lise məzunları</li>
                            <li>👨‍👩‍👧‍👦 Ailələr və valideynlər</li>
                            <li>🎯 Tələbə məsləhətçiləri</li>
                            <li>🌍 Beynəlxalq təhsil axtaranlar</li>
                        </ul>
                    </div>

                    <div class="mission-vision">
                        <h3>Missiyamız</h3>
                        <p>Hər bir tələbənin yüksək keyfiyyətli təhsil almaq hüququnu təmin etmək və onların beynəlxalq təhsil yolculuğunda etibarlı tərəfdaş olmaq.</p>
                        
                        <h3>Vizyonumuz</h3>
                        <p>Beynəlxalq təhsil sahəsində aparıcı və etibarlı platforma olmaq, tələbələrin gələcək karyeralarını qurmaqlarına kömək etmək.</p>
                    </div>
                </div>
                
                <div class="about-stats" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">11+</div>
                            <div class="stat-label">İllik təcrübə</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">2500+</div>
                            <div class="stat-label">Uğurlu tələbə</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Qeydiyyat zəmanəti</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">5</div>
                            <div class="stat-label">Dil dəstəyi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section team-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Komandamız
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Peşəkar və təcrübəli komandamız sizin uğurunuz üçün çalışır
                </p>
            </div>
            
            <div class="team-grid">
                <div class="team-member" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="member-photo">
                        <img src="images/team-member-1.jpg" alt="Komanda üzvü" onerror="this.src='https://via.placeholder.com/200x200/007AFF/FFFFFF?text=OstWindGroup'">
                    </div>
                    <h3>Əli Məmmədov</h3>
                    <p class="member-role">Baş Direktor</p>
                    <p class="member-description">11 illik təhsil sahəsində təcrübəsi olan peşəkar.</p>
                </div>
                
                <div class="team-member" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="member-photo">
                        <img src="images/team-member-2.jpg" alt="Komanda üzvü" onerror="this.src='https://via.placeholder.com/200x200/007AFF/FFFFFF?text=OstWindGroup'">
                    </div>
                    <h3>Aysu Əliyeva</h3>
                    <p class="member-role">Təhsil Məsləhətçisi</p>
                    <p class="member-description">Beynəlxalq təhsil sahəsində mütəxəssis.</p>
                </div>
                
                <div class="team-member" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="member-photo">
                        <img src="images/team-member-3.jpg" alt="Komanda üzvü" onerror="this.src='https://via.placeholder.com/200x200/007AFF/FFFFFF?text=OstWindGroup'">
                    </div>
                    <h3>Murad Hüseynov</h3>
                    <p class="member-role">Viza Məsləhətçisi</p>
                    <p class="member-description">Viza və sənəd hazırlama sahəsində təcrübəli.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="section values-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Dəyərlərimiz
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Bizim fəaliyyətimizi idarə edən əsas prinsiplər
                </p>
            </div>
            
            <div class="values-grid">
                <div class="value-item" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="value-icon">🤝</div>
                    <h3>Etibarlılıq</h3>
                    <p>Hər zaman tələbələrimizin maraqlarını qoruyuruq və şəffaf əməkdaşlıq təmin edirik.</p>
                </div>
                
                <div class="value-item" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="value-icon">🎯</div>
                    <h3>Keyfiyyət</h3>
                    <p>Yalnız ən yaxşı universitetlər və təhsil proqramları ilə əməkdaşlıq edirik.</p>
                </div>
                
                <div class="value-item" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="value-icon">💡</div>
                    <h3>İnnovasiya</h3>
                    <p>Müasir texnologiyalardan istifadə edərək təhsil prosesini asanlaşdırırıq.</p>
                </div>
                
                <div class="value-item" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="value-icon">❤️</div>
                    <h3>Qayğı</h3>
                    <p>Hər bir tələbənin uğuru bizim üçün vacibdir və tam dəstək təmin edirik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up" data-aos-duration="800">
                <h2>Hazırsınızsa, gəlin sizinlə tanış olaq!</h2>
                <p>Peşəkar komandamız sizin təhsil yolculuğunuzda sizə kömək etməyə hazırdır.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary">Bizimlə Əlaqə</a>
                    <a href="universities.php" class="btn btn-secondary">Universitetlər</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 