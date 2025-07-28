<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Ukrayna Universitetləri - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="800"><?php echo $translations['universities_title'] ?? 'Ukrayna Universitetləri'; ?></h1>
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <?php echo $translations['universities_subtitle'] ?? 'Ukraynanın ən yaxşı universitetləri ilə tanış olun'; ?>
            </p>
        </div>
    </section>

    <!-- Top Universities -->
    <section class="section top-universities">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Ən Yaxşı Universitetlər
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Ukraynanın aparıcı universitetlərindən biri.
                </p>
            </div>
            
            <div class="universities-grid">
                <div class="university-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="university-logo">
                        <img src="assets/images/kharkiv-police-university.jpg" alt="Xarkov Milli Daxili İşlər Universiteti" class="university-image">
                    </div>
                    <h3>Xarkov Milli Daxili İşlər Universiteti</h3>
                    <p class="university-location">📍 Xarkov</p>
                    <p>Ukraynanın ən nüfuzlu hüquq və polis universitetlərindən biri. 1921-ci ildən fəaliyyət göstərir.</p>
                    <div class="university-features">
                        <span class="feature-tag">Hüquq</span>
                        <span class="feature-tag">Polis</span>
                        <span class="feature-tag">Daxili İşlər</span>
                        <span class="feature-tag">$2500/il</span>
                    </div>
                    <div class="university-details">
                        <p><strong>Fakultələr:</strong> Hüquq, Polis İdarəetməsi, Kriminalistika</p>
                        <p><strong>Dil:</strong> Ukrayna, Rus, İngilis</p>
                        <p><strong>Müddət:</strong> 4 il (Bakalavr), 2 il (Magistr)</p>
                    </div>
                    <a href="university-details.php?id=1" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="university-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="university-logo">
                        <img src="assets/images/kharkiv-medical-university.jpg" alt="Xarkov Tibb Universiteti" class="university-image">
                    </div>
                    <h3>Xarkov Tibb Universiteti</h3>
                    <p class="university-location">📍 Xarkov</p>
                    <p>Ukraynanın ən qədim və nüfuzlu tibb universitetlərindən biri. 1805-ci ildən fəaliyyət göstərir.</p>
                    <div class="university-features">
                        <span class="feature-tag">Tibb</span>
                        <span class="feature-tag">Stomatologiya</span>
                        <span class="feature-tag">Farmaciya</span>
                        <span class="feature-tag">$3500/il</span>
                    </div>
                    <div class="university-details">
                        <p><strong>Fakultələr:</strong> Tibb, Stomatologiya, Farmaciya, Tibbi Biologiya</p>
                        <p><strong>Dil:</strong> Ukrayna, Rus, İngilis</p>
                        <p><strong>Müddət:</strong> 6 il (Tibb), 5 il (Stomatologiya), 4 il (Farmaciya)</p>
                        <p><strong>WHO Tanınma:</strong> Bəli</p>
                    </div>
                    <a href="university-details.php?id=2" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="university-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="university-logo">
                        <img src="assets/images/kharkiv-karazin-university.jpg" alt="Xarkov Karazin Universiteti" class="university-image">
                    </div>
                    <h3>Xarkov Karazin Universiteti</h3>
                    <p class="university-location">📍 Xarkov</p>
                    <p>Ukraynanın ən qədim və nüfuzlu universitetlərindən biri</p>
                    <div class="university-features">
                        <span class="feature-tag">Humanitar</span>
                        <span class="feature-tag">Təbiət</span>
                        <span class="feature-tag">İqtisadiyyat</span>
                    </div>
                    <a href="university-details.php?id=3" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="university-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="university-logo">
                        <img src="assets/images/kharkiv-aviation-university.jpg" alt="Xarkov Milli Aviasiya Universiteti" class="university-image">
                    </div>
                    <h3>Xarkov Milli Aviasiya Universiteti</h3>
                    <p class="university-location">📍 Xarkov</p>
                    <p>Aviasiya və kosmik texnologiyalar sahəsində lider</p>
                    <div class="university-features">
                        <span class="feature-tag">Aviasiya</span>
                        <span class="feature-tag">Mühəndislik</span>
                        <span class="feature-tag">Kosmik</span>
                    </div>
                    <a href="university-details.php?id=4" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="university-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="university-logo">
                        <img src="assets/images/ukraine-finance-academy.jpg" alt="Ukrayna FHN Akademiyası" class="university-image">
                    </div>
                    <h3>Ukrayna FHN Akademiyası</h3>
                    <p class="university-location">📍 Kiyev</p>
                    <p>Maliyyə və hüquq sahəsində ixtisaslaşmış akademiya</p>
                    <div class="university-features">
                        <span class="feature-tag">Maliyyə</span>
                        <span class="feature-tag">Hüquq</span>
                        <span class="feature-tag">İqtisadiyyat</span>
                    </div>
                    <a href="university-details.php?id=5" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="university-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="university-logo">
                        <img src="assets/images/ukraine-railway-academy.jpg" alt="Ukrayna Demir Yolu Akademiyası" class="university-image">
                    </div>
                    <h3>Ukrayna Demir Yolu Akademiyası</h3>
                    <p class="university-location">📍 Dnipro</p>
                    <p>Nəqliyyat və logistika sahəsində ixtisaslaşmış</p>
                    <div class="university-features">
                        <span class="feature-tag">Nəqliyyat</span>
                        <span class="feature-tag">Logistika</span>
                        <span class="feature-tag">Mühəndislik</span>
                    </div>
                    <a href="university-details.php?id=6" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="university-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="university-logo">
                        <img src="assets/images/lviv-polytechnic.jpg" alt="Lvov Politexnik Universiteti" onerror="this.src='https://via.placeholder.com/120x120/007AFF/FFFFFF?text=LPU'">
                    </div>
                    <h3>Lvov Politexnik Universiteti</h3>
                    <p class="university-location">📍 Lvov</p>
                    <div class="university-features">
                        <span class="feature-tag">Texniki</span>
                        <span class="feature-tag">1844-cü ildən</span>
                        <span class="feature-tag">Mühəndislik</span>
                    </div>
                    <p class="university-description">
                        Texniki təhsil sahəsində Ukraynanın aparıcı universitetlərindən biri.
                    </p>
                    <a href="university-details.php?id=7" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="university-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1000">
                    <div class="university-logo">
                        <img src="assets/images/kharkiv-polytechnic.jpg" alt="Xarkov Politexnik Universiteti" onerror="this.src='https://via.placeholder.com/120x120/007AFF/FFFFFF?text=KPI'">
                    </div>
                    <h3>Xarkov Politexnik Universiteti</h3>
                    <p class="university-location">📍 Xarkov</p>
                    <div class="university-features">
                        <span class="feature-tag">Texniki</span>
                        <span class="feature-tag">1885-ci ildən</span>
                        <span class="feature-tag">Mühəndislik</span>
                    </div>
                    <p class="university-description">
                        Mühəndislik və texnologiya sahəsində Ukraynanın ən yaxşı universitetlərindən biri.
                    </p>
                    <a href="university-details.php?id=8" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="university-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1200">
                    <div class="university-logo">
                        <img src="assets/images/kyiv-medical-university.jpg" alt="Kiyev Tibb Universiteti" onerror="this.src='https://via.placeholder.com/120x120/007AFF/FFFFFF?text=KMU'">
                    </div>
                    <h3>Kiyev Tibb Universiteti</h3>
                    <p class="university-location">📍 Kiyev</p>
                    <div class="university-features">
                        <span class="feature-tag">Tibb</span>
                        <span class="feature-tag">1841-ci ildən</span>
                        <span class="feature-tag">WHO Tanınma</span>
                    </div>
                    <p class="university-description">
                        Tibb sahəsində Ukraynanın ən yaxşı universitetlərindən biri, WHO tərəfindən tanınır.
                    </p>
                    <a href="university-details.php?id=9" class="btn btn-primary">Ətraflı</a>
                </div>
                
                <div class="university-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1400">
                    <div class="university-logo">
                        <img src="assets/images/kharkiv-medical-university.jpg" alt="Xarkov Tibb Universiteti" onerror="this.src='https://via.placeholder.com/120x120/007AFF/FFFFFF?text=KMU'">
                    </div>
                    <h3>Xarkov Tibb Universiteti</h3>
                    <p class="university-location">📍 Xarkov</p>
                    <div class="university-features">
                        <span class="feature-tag">Tibb</span>
                        <span class="feature-tag">1805-ci ildən</span>
                        <span class="feature-tag">WHO Tanınma</span>
                    </div>
                    <p class="university-description">
                        Ukraynanın ən köhnə tibb universitetlərindən biri, yüksək keyfiyyətli təhsil təklif edir.
                    </p>
                    <a href="university-details.php?id=10" class="btn btn-primary">Ətraflı</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Ukrainian Education System -->
    <section class="section education-system">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Ukrayna Təhsil Sistemi
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Ukraynada təhsil almaq üçün bütün məlumatlar
                </p>
            </div>
            
            <div class="education-grid">
                <div class="education-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="education-icon">🎓</div>
                    <h3>Bakalavr Təhsili</h3>
                    <p>4 il müddətində bakalavr dərəcəsi. Bütün sahələrdə təhsil proqramları mövcuddur.</p>
                    <ul>
                        <li>Müddət: 4 il</li>
                        <li>Qiymət: $2000-4000/il</li>
                        <li>Dil: Ukrayna, Rus, İngilis</li>
                        <li>Başlanğıc: Sentyabr</li>
                    </ul>
                </div>
                
                <div class="education-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="education-icon">📚</div>
                    <h3>Magistr Təhsili</h3>
                    <p>2 il müddətində magistr dərəcəsi. Bakalavr diplomu tələb olunur.</p>
                    <ul>
                        <li>Müddət: 2 il</li>
                        <li>Qiymət: $2500-5000/il</li>
                        <li>Dil: Ukrayna, Rus, İngilis</li>
                        <li>Başlanğıc: Sentyabr</li>
                    </ul>
                </div>
                
                <div class="education-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="education-icon">🏥</div>
                    <h3>Tibb Təhsili</h3>
                    <p>6 il müddətində tibb təhsili. WHO tərəfindən tanınır.</p>
                    <ul>
                        <li>Müddət: 6 il</li>
                        <li>Qiymət: $3500-6000/il</li>
                        <li>Dil: Ukrayna, Rus, İngilis</li>
                        <li>WHO Tanınma: Bəli</li>
                    </ul>
                </div>
                
                <div class="education-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="800">
                    <div class="education-icon">💼</div>
                    <h3>PhD Təhsili</h3>
                    <p>3-4 il müddətində doktorluq dərəcəsi. Magistr diplomu tələb olunur.</p>
                    <ul>
                        <li>Müddət: 3-4 il</li>
                        <li>Qiymət: $3000-7000/il</li>
                        <li>Dil: Ukrayna, Rus, İngilis</li>
                        <li>Elmi İş: Tələb olunur</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Living in Ukraine -->
    <section class="section living-ukraine">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Ukraynada Yaşayış
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Tələbələr üçün yaşayış şərtləri və xərclər
                </p>
            </div>
            
            <div class="living-grid">
                <div class="living-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="living-icon">🏠</div>
                    <h3>Yerləşmə</h3>
                    <p><strong>Universitet yataqxanası:</strong> $50-150/ay</p>
                    <p><strong>Şəxsi mənzil:</strong> $200-500/ay</p>
                    <p><strong>Kommunal xərclər:</strong> $50-100/ay</p>
                </div>
                
                <div class="living-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="living-icon">🍽️</div>
                    <h3>Yemək</h3>
                    <p><strong>Universitet yeməkxanası:</strong> $3-5/gün</p>
                    <p><strong>Restoran:</strong> $10-20/gün</p>
                    <p><strong>Ev yeməyi:</strong> $200-300/ay</p>
                </div>
                
                <div class="living-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="living-icon">🚇</div>
                    <h3>Nəqliyyat</h3>
                    <p><strong>Metro:</strong> $0.5-1/səfər</p>
                    <p><strong>Avtobus:</strong> $0.3-0.7/səfər</p>
                    <p><strong>Aylıq bilet:</strong> $20-30/ay</p>
                </div>
                
                <div class="living-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="living-icon">📱</div>
                    <h3>İnternet və Telefon</h3>
                    <p><strong>İnternet:</strong> $10-20/ay</p>
                    <p><strong>Mobil:</strong> $5-15/ay</p>
                    <p><strong>WiFi:</strong> Universitetdə pulsuz</p>
                </div>
            </div>
        </div>
    </section>

    <!-- University Categories -->
    <section class="section university-categories">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Universitet Kateqoriyaları
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Maraqlarınıza uyğun universitet tapın
                </p>
            </div>
            
            <div class="categories-grid">
                <div class="category-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="category-icon">🏛️</div>
                    <h3>Klassik Universitetlər</h3>
                    <p>Humanitar və təbiət elmləri sahəsində təhsil</p>
                    <a href="universities.php?category=classic" class="btn btn-secondary">Bax</a>
                </div>
                
                <div class="category-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="category-icon">⚙️</div>
                    <h3>Texniki Universitetlər</h3>
                    <p>Mühəndislik və texnologiya sahəsində təhsil</p>
                    <a href="universities.php?category=technical" class="btn btn-secondary">Bax</a>
                </div>
                
                <div class="category-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="category-icon">🏥</div>
                    <h3>Tibb Universitetlər</h3>
                    <p>Tibb və farmasiya sahəsində təhsil</p>
                    <a href="universities.php?category=medical" class="btn btn-secondary">Bax</a>
                </div>
                
                <div class="category-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="category-icon">🎨</div>
                    <h3>İncəsənət Universitetlər</h3>
                    <p>İncəsənət və mədəniyyət sahəsində təhsil</p>
                    <a href="universities.php?category=arts" class="btn btn-secondary">Bax</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Admission Requirements -->
    <section class="section admission-requirements">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Qəbul Tələbləri
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Ukrayna universitetlərinə qəbul üçün lazım olan sənədlər
                </p>
            </div>
            
            <div class="requirements-grid">
                <div class="requirement-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="requirement-icon">📋</div>
                    <h3>Lazımi Sənədlər</h3>
                    <ul>
                        <li>Orta təhsil haqqında şəhadətnamə (apostil ilə)</li>
                        <li>Sağlamlıq şəhadətnaməsi</li>
                        <li>Doğum şəhadətnaməsi</li>
                        <li>Pasport kopyası</li>
                        <li>Fotoşəkillər (3x4)</li>
                    </ul>
                </div>
                
                <div class="requirement-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="requirement-icon">📝</div>
                    <h3>Müraciət Prosesi</h3>
                    <ul>
                        <li>Universitet seçimi</li>
                        <li>Sənədlərin hazırlanması</li>
                        <li>Universitetə göndərilməsi</li>
                        <li>Qəbul məktubu</li>
                        <li>Viza müraciəti</li>
                    </ul>
                </div>
                
                <div class="requirement-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="requirement-icon">💰</div>
                    <h3>Qiymətlər</h3>
                    <ul>
                        <li>İllik təhsil haqqı: $2000-4000</li>
                        <li>Yerləşmə: $200-500/ay</li>
                        <li>Yemək: $200-300/ay</li>
                        <li>Nəqliyyat: $50-100/ay</li>
                        <li>Digər xərclər: $100-200/ay</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up" data-aos-duration="800">
                <h2>Universitet seçiminizə kömək edək!</h2>
                <p>Peşəkar komandamız sizin maraqlarınıza uyğun ən yaxşı universiteti tapmağınıza kömək edəcək.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary">Pulsuz Konsultasiya</a>
                    <a href="faculties.php" class="btn btn-secondary">Fakultələr</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Ukraine Section -->
    <section class="section universities-overview">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    <?php echo $translations['why_ukraine'] ?? 'Niyə Ukrayna?'; ?>
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <?php echo $translations['ukraine_advantages'] ?? 'Ukrayna təhsilinin üstünlükləri'; ?>
                </p>
            </div>
            
            <div class="overview-grid">
                <div class="overview-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="overview-icon">💰</div>
                    <h3>Əlverişli Qiymətlər</h3>
                    <p>Avropa standartlarında keyfiyyətli təhsil, lakin çox daha aşağı qiymətlərlə.</p>
                </div>
                
                <div class="overview-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="overview-icon">🌍</div>
                    <h3>Beynəlxalq Tanınma</h3>
                    <p>Ukrayna diplomları bütün dünyada tanınır və etibarlıdır.</p>
                </div>
                
                <div class="overview-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="overview-icon">🎓</div>
                    <h3>Geniş Proqram Seçimi</h3>
                    <p>Hər sahədə təhsil proqramları mövcuddur.</p>
                </div>
                
                <div class="overview-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="800">
                    <div class="overview-icon">🏛️</div>
                    <h3>Köhnə Təhsil Ənənələri</h3>
                    <p>100 ildən çox təhsil tarixi və köhnə ənənələr.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 