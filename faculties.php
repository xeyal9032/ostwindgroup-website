<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Fakultələr və İxtisaslar - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="800"><?php echo $translations['faculties_title'] ?? 'Fakultələr və İxtisaslar'; ?></h1>
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <?php echo $translations['faculties_subtitle'] ?? 'Ukrayna universitetlərində mövcud olan fakultələr və ixtisaslar'; ?>
            </p>
        </div>
    </section>

    <!-- Faculties Overview -->
    <section class="section faculties-overview">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    <?php echo $translations['education_fields'] ?? 'Təhsil Sahələri'; ?>
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <?php echo $translations['education_fields_desc'] ?? 'Ukrayna universitetlərində təhsil ala biləcəyiniz əsas sahələr'; ?>
                </p>
            </div>
            
            <div class="faculties-grid">
                <div class="faculty-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="faculty-icon">🏥</div>
                    <h3>Tibb və Sağlamlıq</h3>
                    <p>Həkimlik, stomatologiya, farmasiya və digər tibb sahələri</p>
                    <ul class="faculty-specialties">
                        <li>Həkimlik (6 il) - $3500-6000/il</li>
                        <li>Stomatologiya (5 il) - $4000-7000/il</li>
                        <li>Farmasiya (5 il) - $3000-5000/il</li>
                        <li>Nəzəriyyə (4 il) - $2500-4000/il</li>
                        <li>Kardioloji</li>
                        <li>Nevrologiya</li>
                        <li>Onkologiya</li>
                        <li>Pediatriya</li>
                    </ul>
                    <div class="faculty-details">
                        <p><strong>Ən Yaxşı Universitetlər:</strong> Xarkov Tibb, Kiyev Tibb, Lvov Tibb</p>
                        <p><strong>WHO Tanınma:</strong> Bəli</p>
                        <p><strong>İş Sahələri:</strong> Xəstəxanalar, Klinikalar, Araşdırma Mərkəzləri</p>
                    </div>
                    <a href="faculties.php?category=medical" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="faculty-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="faculty-icon">⚙️</div>
                    <h3>Mühəndislik və Texnologiya</h3>
                    <p>Mühəndislik, kompüter elmləri və texnologiya sahələri</p>
                    <ul class="faculty-specialties">
                        <li>Kompüter Elmləri</li>
                        <li>Elektrik Mühəndisliyi</li>
                        <li>Mexanika Mühəndisliyi</li>
                        <li>Kimya Mühəndisliyi</li>
                    </ul>
                    <a href="faculties.php?category=engineering" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="faculty-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="faculty-icon">🏛️</div>
                    <h3>Humanitar Elmlər</h3>
                    <p>Filologiya, tarix, fəlsəfə və sosial elmlər</p>
                    <ul class="faculty-specialties">
                        <li>Filologiya</li>
                        <li>Tarix</li>
                        <li>Fəlsəfə</li>
                        <li>Psixologiya</li>
                    </ul>
                    <a href="faculties.php?category=humanities" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="faculty-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="faculty-icon">🔬</div>
                    <h3>Təbiət Elmləri</h3>
                    <p>Fizika, kimya, biologiya və riyaziyyat</p>
                    <ul class="faculty-specialties">
                        <li>Fizika</li>
                        <li>Kimya</li>
                        <li>Biologiya</li>
                        <li>Riyaziyyat</li>
                    </ul>
                    <a href="faculties.php?category=sciences" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="faculty-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1000">
                    <div class="faculty-icon">💼</div>
                    <h3>İqtisadiyyat və Biznes</h3>
                    <p>İqtisadiyyat, biznes idarəetməsi və maliyyə</p>
                    <ul class="faculty-specialties">
                        <li>İqtisadiyyat</li>
                        <li>Biznes İdarəetməsi</li>
                        <li>Maliyyə və Kredit</li>
                        <li>Mühasibat</li>
                    </ul>
                    <a href="faculties.php?category=economics" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="faculty-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1200">
                    <div class="faculty-icon">🎨</div>
                    <h3>İncəsənət və Mədəniyyət</h3>
                    <p>Musiqi, rəssamlıq, dizayn və mədəniyyət</p>
                    <ul class="faculty-specialties">
                        <li>Musiqi</li>
                        <li>Rəssamlıq</li>
                        <li>Dizayn</li>
                        <li>Mədəniyyətşünaslıq</li>
                    </ul>
                    <a href="faculties.php?category=arts" class="btn btn-primary">Ətraflı</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Specialties -->
    <section class="section popular-specialties">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Ən Populyar İxtisaslar
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Tələbələr arasında ən çox tələb olunan ixtisaslar
                </p>
            </div>
            
            <div class="specialties-grid">
                <div class="specialty-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="specialty-icon">💻</div>
                    <h3>Kompüter Elmləri</h3>
                    <p>Proqramlaşdırma, AI, verilənlər bazası və şəbəkə texnologiyaları</p>
                    <div class="specialty-details">
                        <span class="duration">4 il</span>
                        <span class="degree">Bakalavr</span>
                        <span class="demand">Yüksək</span>
                    </div>
                </div>
                
                <div class="specialty-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="specialty-icon">🏥</div>
                    <h3>Həkimlik</h3>
                    <p>Ümumi həkimlik, cərrahiyyə və müxtəlif tibb sahələri</p>
                    <div class="specialty-details">
                        <span class="duration">6 il</span>
                        <span class="degree">Bakalavr</span>
                        <span class="demand">Yüksək</span>
                    </div>
                </div>
                
                <div class="specialty-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="specialty-icon">⚡</div>
                    <h3>Elektrik Mühəndisliyi</h3>
                    <p>Elektrik sistemləri, avtomatlaşdırma və enerji texnologiyaları</p>
                    <div class="specialty-details">
                        <span class="duration">4 il</span>
                        <span class="degree">Bakalavr</span>
                        <span class="demand">Orta</span>
                    </div>
                </div>
                
                <div class="specialty-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="800">
                    <div class="specialty-icon">💊</div>
                    <h3>Farmasiya</h3>
                    <p>Dərman hazırlama, farmakologiya və dərman təhlükəsizliyi</p>
                    <div class="specialty-details">
                        <span class="duration">5 il</span>
                        <span class="degree">Bakalavr</span>
                        <span class="demand">Yüksək</span>
                    </div>
                </div>
                
                <div class="specialty-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="1000">
                    <div class="specialty-icon">💰</div>
                    <h3>İqtisadiyyat</h3>
                    <p>Makro və mikro iqtisadiyyat, beynəlxalq iqtisadi münasibətlər</p>
                    <div class="specialty-details">
                        <span class="duration">4 il</span>
                        <span class="degree">Bakalavr</span>
                        <span class="demand">Orta</span>
                    </div>
                </div>
                
                <div class="specialty-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="1200">
                    <div class="specialty-icon">🌍</div>
                    <h3>Beynəlxalq Münasibətlər</h3>
                    <p>Diplomatiya, beynəlxalq hüquq və siyasi elmlər</p>
                    <div class="specialty-details">
                        <span class="duration">4 il</span>
                        <span class="degree">Bakalavr</span>
                        <span class="demand">Orta</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Education Levels -->
    <section class="section education-levels">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Təhsil Səviyyələri
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Ukrayna universitetlərində mövcud olan təhsil səviyyələri
                </p>
            </div>
            
            <div class="levels-grid">
                <div class="level-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="level-icon">🎓</div>
                    <h3>Bakalavr</h3>
                    <p class="level-duration">4-6 il</p>
                    <p class="level-description">
                        Orta təhsil əsasında qəbul. Əsas təhsil səviyyəsi.
                    </p>
                    <ul class="level-requirements">
                        <li>Orta təhsil şəhadətnaməsi</li>
                        <li>Yaş: 17+</li>
                        <li>Dil bilikləri</li>
                    </ul>
                </div>
                
                <div class="level-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="level-icon">🎓🎓</div>
                    <h3>Magistr</h3>
                    <p class="level-duration">1-2 il</p>
                    <p class="level-description">
                        Bakalavr diplomu əsasında qəbul. Dərin təhsil.
                    </p>
                    <ul class="level-requirements">
                        <li>Bakalavr diplomu</li>
                        <li>Yaş: 21+</li>
                        <li>Dil bilikləri</li>
                    </ul>
                </div>
                
                <div class="level-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="level-icon">🎓🎓🎓</div>
                    <h3>Doktorantura</h3>
                    <p class="level-duration">3-4 il</p>
                    <p class="level-description">
                        Magistr diplomu əsasında qəbul. Elmi dərəcə.
                    </p>
                    <ul class="level-requirements">
                        <li>Magistr diplomu</li>
                        <li>Yaş: 23+</li>
                        <li>Elmi iş təcrübəsi</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Specialties -->
    <section class="section popular-specialties">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Ən Populyar İxtisaslar
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Ukraynada ən çox tələb olunan və yüksək maaşlı ixtisaslar
                </p>
            </div>
            
            <div class="specialties-grid">
                <div class="specialty-card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="specialty-icon">💻</div>
                    <h3>Kompüter Elmləri</h3>
                    <p><strong>Müddət:</strong> 4 il</p>
                    <p><strong>Qiymət:</strong> $2500-4000/il</p>
                    <p><strong>Maaş:</strong> $3000-8000/ay</p>
                    <p><strong>İş Sahələri:</strong> IT şirkətləri, Startuplar, Banklar</p>
                    <div class="specialty-features">
                        <span class="feature">Proqramlaşdırma</span>
                        <span class="feature">AI/ML</span>
                        <span class="feature">Cybersecurity</span>
                    </div>
                </div>
                
                <div class="specialty-card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="specialty-icon">🏥</div>
                    <h3>Tibb</h3>
                    <p><strong>Müddət:</strong> 6 il</p>
                    <p><strong>Qiymət:</strong> $3500-6000/il</p>
                    <p><strong>Maaş:</strong> $2000-10000/ay</p>
                    <p><strong>İş Sahələri:</strong> Xəstəxanalar, Klinikalar, Araşdırma</p>
                    <div class="specialty-features">
                        <span class="feature">WHO Tanınma</span>
                        <span class="feature">Beynəlxalq</span>
                        <span class="feature">Yüksək Tələb</span>
                    </div>
                </div>
                
                <div class="specialty-card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="specialty-icon">⚡</div>
                    <h3>Elektrik Mühəndisliyi</h3>
                    <p><strong>Müddət:</strong> 4 il</p>
                    <p><strong>Qiymət:</strong> $2000-3500/il</p>
                    <p><strong>Maaş:</strong> $2500-6000/ay</p>
                    <p><strong>İş Sahələri:</strong> Enerji, Avtomobil, Telekommunikasiya</p>
                    <div class="specialty-features">
                        <span class="feature">Enerji</span>
                        <span class="feature">Avtomobil</span>
                        <span class="feature">Telekom</span>
                    </div>
                </div>
                
                <div class="specialty-card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="specialty-icon">💰</div>
                    <h3>Maliyyə və İqtisadiyyat</h3>
                    <p><strong>Müddət:</strong> 4 il</p>
                    <p><strong>Qiymət:</strong> $2000-3000/il</p>
                    <p><strong>Maaş:</strong> $2000-5000/ay</p>
                    <p><strong>İş Sahələri:</strong> Banklar, Audit, Konsaltinq</p>
                    <div class="specialty-features">
                        <span class="feature">Banking</span>
                        <span class="feature">Audit</span>
                        <span class="feature">Konsaltinq</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Career Opportunities -->
    <section class="section career-opportunities">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Karyera İmkanları
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Ukrayna diplomu ilə işləyə biləcəyiniz ölkələr və sahələr
                </p>
            </div>
            
            <div class="career-grid">
                <div class="career-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="career-icon">🇪🇺</div>
                    <h3>Avropa Birliyi</h3>
                    <p>Ukrayna diplomları AB-də tanınır və işləyə bilərsiniz.</p>
                    <ul>
                        <li>Almaniya</li>
                        <li>Polşa</li>
                        <li>Çexiya</li>
                        <li>Baltik ölkələri</li>
                    </ul>
                </div>
                
                <div class="career-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="career-icon">🇺🇸</div>
                    <h3>ABŞ və Kanada</h3>
                    <p>Müəyyən sahələrdə əlavə təsdiq tələb olunur.</p>
                    <ul>
                        <li>Tibb sahəsi</li>
                        <li>Mühəndislik</li>
                        <li>İqtisadiyyat</li>
                        <li>İnformatika</li>
                    </ul>
                </div>
                
                <div class="career-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="career-icon">🌍</div>
                    <h3>Digər Ölkələr</h3>
                    <p>Ukrayna diplomları bir çox ölkədə tanınır.</p>
                    <ul>
                        <li>Rusiya</li>
                        <li>Belarus</li>
                        <li>Qazaxıstan</li>
                        <li>Azərbaycan</li>
                    </ul>
                </div>
                
                <div class="career-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="800">
                    <div class="career-icon">🏢</div>
                    <h3>Ukraynada İş</h3>
                    <p>Ukraynada yüksək maaşlı iş imkanları.</p>
                    <ul>
                        <li>IT sahəsi</li>
                        <li>Maliyyə</li>
                        <li>Mühəndislik</li>
                        <li>Tibb</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Language Programs -->
    <section class="section language-programs">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Dil Proqramları
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Təhsil ala biləcəyiniz dillər
                </p>
            </div>
            
            <div class="language-grid">
                <div class="language-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="language-icon">🇺🇦</div>
                    <h3>Ukrayna Dili</h3>
                    <p>Ən çox təklif olunan dil. 1 il hazırlıq kursu mövcuddur.</p>
                    <div class="language-info">
                        <span class="prep-course">Hazırlıq kursu: 1 il</span>
                        <span class="cost">Qiymət: $1500-2000/il</span>
                    </div>
                </div>
                
                <div class="language-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="language-icon">🇷🇺</div>
                    <h3>Rus Dili</h3>
                    <p>Ənənəvi seçim. Bir çox universitetdə mövcuddur.</p>
                    <div class="language-info">
                        <span class="prep-course">Hazırlıq kursu: 1 il</span>
                        <span class="cost">Qiymət: $1500-2000/il</span>
                    </div>
                </div>
                
                <div class="language-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="language-icon">🇬🇧</div>
                    <h3>İngilis Dili</h3>
                    <p>Beynəlxalq proqramlar. Məhdud sayda universitetdə.</p>
                    <div class="language-info">
                        <span class="prep-course">Hazırlıq kursu: 6 ay</span>
                        <span class="cost">Qiymət: $3000-5000/il</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up" data-aos-duration="800">
                <h2>İxtisas seçiminizə kömək edək!</h2>
                <p>Peşəkar komandamız sizin maraqlarınıza və imkanlarınıza uyğun ən yaxşı ixtisası seçməyinizə kömək edəcək.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary">Pulsuz Konsultasiya</a>
                    <a href="universities.php" class="btn btn-secondary">Universitetlər</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 