<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = $translations['hero_title'] ?? 'OstWindGroup - Xaricdə Təhsil';

include 'includes/header.php';
?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">
                    <?php echo $translations['hero_title'] ?? 'OstWindGroup - Xaricdə Təhsil'; ?>
                </h1>
                <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <?php echo $translations['hero_subtitle'] ?? 'Ukraynada və xaricdə keyfiyyətli təhsil almaq yolunda sizin etibarlı tərəfdaşınızıq'; ?>
                </p>
                <div class="hero-buttons" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                    <a href="universities.php" class="btn btn-primary">
                        <?php echo $translations['hero_cta'] ?? 'Universitetlər'; ?>
                    </a>
                    <a href="register.php" class="btn btn-secondary">
                        <?php echo $translations['hero_secondary'] ?? 'Qeydiyyat'; ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="section about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text" data-aos="fade-right" data-aos-duration="800">
                    <h2>Haqqımızda</h2>
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

    <!-- Why Choose Us Section -->
    <section class="section why-choose-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Niyə Bizi Seçməlisiniz?
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Peşəkar komandamız və sınaqdan keçmiş metodlarımızla sizin uğurunuzu təmin edirik
                </p>
            </div>
            
            <div class="advantages-grid">
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="advantage-icon">🏆</div>
                    <h3>11 İllik Təcrübə</h3>
                    <p>2013-cü ildən bəri təhsil sahəsində fəaliyyət göstəririk</p>
                </div>
                
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="advantage-icon">👥</div>
                    <h3>2500+ Uğurlu Tələbə</h3>
                    <p>Müxtəlif ölkələrdən minlərlə tələbəyə kömək etdik</p>
                </div>
                
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="advantage-icon">✅</div>
                    <h3>100% Qeydiyyat Zəmanəti</h3>
                    <p>Seçilmiş universitetə qəbul zəmanəti veririk</p>
                </div>
                
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="advantage-icon">🌍</div>
                    <h3>5 Dildə Dəstək</h3>
                    <p>Türkcə, İngiliscə, Ukraynaca, Azərbaycanca, Rusca</p>
                </div>
                
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="advantage-icon">👨‍💼</div>
                    <h3>Peşəkar Komanda</h3>
                    <p>Təhsil sahəsində təcrübəli məsləhətçilər</p>
                </div>
                
                <div class="advantage-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="advantage-icon">💬</div>
                    <h3>Real Tələbə Rəyləri</h3>
                    <p>Uğurlu tələbələrimizin şəxsi təcrübələri</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links -->
    <section class="quick-links">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    <?php echo $translations['quick_links_title'] ?? 'Sürətli Keçidlər'; ?>
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <?php echo $translations['quick_links_subtitle'] ?? 'Əsas xidmətlərimizə tez çatın'; ?>
                </p>
            </div>
            
            <div class="links-grid">
                <a href="universities.php" class="link-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="link-icon">🏛️</div>
                    <h3><?php echo $translations['universities_link'] ?? 'Universitetlər'; ?></h3>
                    <p><?php echo $translations['universities_link_desc'] ?? 'Ukrayna universitetləri'; ?></p>
                </a>
                <a href="faculties.php" class="link-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="link-icon">🎓</div>
                    <h3><?php echo $translations['faculties_link'] ?? 'Fakultələr'; ?></h3>
                    <p><?php echo $translations['faculties_link_desc'] ?? 'İxtisaslar və fakultələr'; ?></p>
                </a>
                <a href="documents.php" class="link-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="link-icon">📋</div>
                    <h3><?php echo $translations['documents_link'] ?? 'Qəbul sənədləri'; ?></h3>
                    <p><?php echo $translations['documents_link_desc'] ?? 'Lazım olan sənədlər'; ?></p>
                </a>
                <a href="testimonials.php" class="link-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="link-icon">💬</div>
                    <h3><?php echo $translations['testimonials_link'] ?? 'Tələbə Rəyləri'; ?></h3>
                    <p><?php echo $translations['testimonials_link_desc'] ?? 'Uğurlu tələbələrimiz'; ?></p>
                </a>
                <a href="contact.php" class="link-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="link-icon">📞</div>
                    <h3><?php echo $translations['contact_link'] ?? 'Əlaqə'; ?></h3>
                    <p><?php echo $translations['contact_link_desc'] ?? 'Bizimlə əlaqə saxlayın'; ?></p>
                </a>
                <a href="register.php" class="link-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="link-icon">✍️</div>
                    <h3><?php echo $translations['register_link'] ?? 'Qeydiyyat'; ?></h3>
                    <p><?php echo $translations['register_link_desc'] ?? 'İndi qeydiyyatdan keçin'; ?></p>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title" data-aos="fade-down" data-aos-duration="800">
                    <?php echo $translations['cta_education_title'] ?? 'Ukraynada Təhsil Almaq İstəyirsiniz?'; ?>
                </h2>
                <p class="cta-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <?php echo $translations['cta_education_subtitle'] ?? 'Peşəkar komandamız sizə hər addımda kömək edəcək'; ?>
                </p>
                <div class="cta-buttons" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <a href="consultation.php" class="btn btn-primary">
                        <?php echo $translations['free_advice'] ?? 'Pulsuz Məsləhət'; ?>
                    </a>
                    <a href="register.php" class="btn btn-secondary">
                        <?php echo $translations['register_link'] ?? 'Qeydiyyat'; ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 