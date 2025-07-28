<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Təhsil Formu - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Hero Section -->
    <section class="hero education-hero">
        <div class="container">
            <div class="hero-content">
                <h1 data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">
                    🎓 Təhsil Formu
                </h1>
                <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    Xaricdə təhsil almaq istəyən tələbələr üçün xüsusi hazırlanmış təhsil formu
                </p>
            </div>
        </div>
    </section>

    <!-- Education Form Section -->
    <section class="section education-form-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Təhsil Səviyyəsi Seçin
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Hansı təhsil səviyyəsində oxumaq istəyirsiniz?
                </p>
            </div>

            <div class="education-levels" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                <div class="education-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="education-icon">🎓</div>
                    <h3>Bakalavr (Bachelor)</h3>
                    <p>4 illik ali təhsil proqramı</p>
                    <ul class="education-features">
                        <li>✅ 4 il müddət</li>
                        <li>✅ Attestat ilə qəbul</li>
                        <li>✅ Azərbaycan dilində təhsil</li>
                        <li>✅ Rus dilində təhsil</li>
                        <li>✅ İngilis dilində təhsil</li>
                        <li>✅ Ukrayna vətəndaşlığı</li>
                    </ul>
                    <a href="universities.php?level=bachelor" class="btn btn-primary">
                        Bakalavr Proqramları
                    </a>
                </div>

                <div class="education-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="education-icon">🎯</div>
                    <h3>Magistratura (Master)</h3>
                    <p>2 illik magistr proqramı</p>
                    <ul class="education-features">
                        <li>✅ 2 il müddət</li>
                        <li>✅ Bakalavr diplomu ilə qəbul</li>
                        <li>✅ Azərbaycan dilində təhsil</li>
                        <li>✅ Rus dilində təhsil</li>
                        <li>✅ İngilis dilində təhsil</li>
                        <li>✅ Ukrayna vətəndaşlığı</li>
                    </ul>
                    <a href="universities.php?level=master" class="btn btn-primary">
                        Magistratura Proqramları
                    </a>
                </div>

                <div class="education-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="education-icon">👨‍🎓</div>
                    <h3>Doktarantura (PhD)</h3>
                    <p>3 illik doktorantura proqramı</p>
                    <ul class="education-features">
                        <li>✅ 3 il müddət</li>
                        <li>✅ Magistr diplomu ilə qəbul</li>
                        <li>✅ Azərbaycan dilində təhsil</li>
                        <li>✅ Rus dilində təhsil</li>
                        <li>✅ İngilis dilində təhsil</li>
                        <li>✅ Ukrayna vətəndaşlığı</li>
                    </ul>
                    <a href="universities.php?level=phd" class="btn btn-primary">
                        Doktarantura Proqramları
                    </a>
                </div>
            </div>

            <!-- Quick Application Form -->
            <div class="quick-application" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                <h3>Tez Müraciət Formu</h3>
                <p>Hansı təhsil səviyyəsini seçdiyinizi bilmək istəyirik</p>
                
                <form action="education-process.php" method="POST" class="education-form">
                    <div class="form-group">
                        <label for="education_level">Təhsil Səviyyəsi *</label>
                        <select name="education_level" id="education_level" required>
                            <option value="">Seçin...</option>
                            <option value="bachelor">🎓 Bakalavr (Bachelor)</option>
                            <option value="master">🎯 Magistratura (Master)</option>
                            <option value="phd">👨‍🎓 Doktarantura (PhD)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="full_name">Ad Soyad *</label>
                        <input type="text" name="full_name" id="full_name" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefon Nömrəsi *</label>
                        <input type="tel" name="phone" id="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email">
                    </div>

                    <div class="form-group">
                        <label for="message">Əlavə Məlumat</label>
                        <textarea name="message" id="message" rows="4" placeholder="Hansı sahədə təhsil almaq istəyirsiniz?"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        📝 Müraciət Göndər
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="section benefits-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Niyə Ukraynada Təhsil?
                </h2>
            </div>

            <div class="benefits-grid">
                <div class="benefit-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="benefit-icon">🇺🇦</div>
                    <h3>Avropa Standartları</h3>
                    <p>Ukrayna təhsil sistemi Avropa standartlarına uyğundur</p>
                </div>

                <div class="benefit-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="benefit-icon">💰</div>
                    <h3>Ucuz Təhsil</h3>
                    <p>Avropaya nisbətən çox daha ucuz təhsil xərcləri</p>
                </div>

                <div class="benefit-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="benefit-icon">🌍</div>
                    <h3>Beynəlxalq Tanınma</h3>
                    <p>Ukrayna diplomları bütün dünyada tanınır</p>
                </div>

                <div class="benefit-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="benefit-icon">🏠</div>
                    <h3>Konaklama İmkanları</h3>
                    <p>Universitet yataqxanalarında ucuz konaklama</p>
                </div>

                <div class="benefit-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1000">
                    <div class="benefit-icon">🎯</div>
                    <h3>Peşəkar Dəstək</h3>
                    <p>11 illik təcrübə ilə tam dəstək xidməti</p>
                </div>

                <div class="benefit-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1200">
                    <div class="benefit-icon">📚</div>
                    <h3>Keyfiyyətli Təhsil</h3>
                    <p>Yüksək keyfiyyətli təhsil və müasir tədris metodları</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up" data-aos-duration="800">
                <h2>Hazırsınızsa Başlayaq!</h2>
                <p>Xaricdə təhsil yolculuğunuzda sizinləyik</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary">
                        📞 Əlaqə Saxlayın
                    </a>
                    <a href="universities.php" class="btn btn-secondary">
                        🏫 Universitetlər
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 