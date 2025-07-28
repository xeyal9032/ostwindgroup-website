<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Faydalı Sənədlər və Rehberlər - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="800"><?php echo $translations['documents_title'] ?? 'Faydalı Sənədlər və Rehberlər'; ?></h1>
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <?php echo $translations['documents_subtitle'] ?? 'Təhsil yolculuğunuz üçün lazım olan bütün sənədlər və rehberlər'; ?>
            </p>
        </div>
    </section>

    <!-- Documents Section -->
    <section class="section documents-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    <?php echo $translations['required_documents'] ?? 'Lazımi Sənədlər'; ?>
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <?php echo $translations['required_documents_desc'] ?? 'Ukrayna universitetlərinə qəbul üçün lazım olan sənədlər'; ?>
                </p>
            </div>
            
            <div class="documents-grid">
                <div class="document-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="document-icon">📋</div>
                    <h3>Müraciət Forması</h3>
                    <p>Universitetə müraciət üçün standart forma</p>
                    <div class="document-details">
                        <p><strong>Format:</strong> PDF</p>
                        <p><strong>Ölçü:</strong> 2 səhifə</p>
                        <p><strong>Dil:</strong> Azərbaycan, İngilis</p>
                    </div>
                    <a href="documents/application-form.pdf" class="btn btn-primary" download>
                        <span>📥 Endir</span>
                    </a>
                </div>
                
                <div class="document-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="document-icon">📝</div>
                    <h3>Motivasiya Məktubu</h3>
                    <p>Motivasiya məktubu yazmaq üçün nümunə</p>
                    <a href="documents/sample-letter.docx" class="btn btn-primary" download>
                        <span>📥 Endir</span>
                    </a>
                </div>
                
                <div class="document-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="document-icon">🛂</div>
                    <h3>Viza Rehberi</h3>
                    <p>Ukrayna viza müraciəti üçün ətraflı rehber</p>
                    <a href="documents/visa-guide.pdf" class="btn btn-primary" download>
                        <span>📥 Endir</span>
                    </a>
                </div>
                
                <div class="document-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="document-icon">🏠</div>
                    <h3>Yerləşmə Rehberi</h3>
                    <p>Ukraynada yerləşmə və yaşayış haqqında məlumat</p>
                    <a href="documents/accommodation-guide.pdf" class="btn btn-primary" download>
                        <span>📥 Endir</span>
                    </a>
                </div>
                
                <div class="document-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1000">
                    <div class="document-icon">💰</div>
                    <h3>Burs Rehberi</h3>
                    <p>Burs və təqaüd imkanları haqqında məlumat</p>
                    <a href="documents/scholarship-guide.pdf" class="btn btn-primary" download>
                        <span>📥 Endir</span>
                    </a>
                </div>
                
                <div class="document-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1200">
                    <div class="document-icon">🎓</div>
                    <h3>Diploma Tanınma</h3>
                    <p>Diploma tanınma prosesi haqqında məlumat</p>
                    <a href="documents/diploma-recognition.pdf" class="btn btn-primary" download>
                        <span>📥 Endir</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Guides Section -->
    <section class="section guides-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Ətraflı Rehberlər
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Təhsil yolculuğunuzun hər mərhələsi üçün rehberlər
                </p>
            </div>
            
            <div class="guides-grid">
                <div class="guide-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="guide-icon">🎯</div>
                    <h3>Universitet Seçimi</h3>
                    <p>Öz maraqlarınıza uyğun universitet seçmək üçün əsas amillər</p>
                    <ul class="guide-points">
                        <li>Universitet reytinqi</li>
                        <li>İxtisas keyfiyyəti</li>
                        <li>Qiymət və xərclər</li>
                        <li>Şəhər və yerləşmə</li>
                    </ul>
                </div>
                
                <div class="guide-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="guide-icon">📚</div>
                    <h3>Dil Hazırlığı</h3>
                    <p>Ukrayna və ya Rus dilini öyrənmək üçün tövsiyələr</p>
                    <ul class="guide-points">
                        <li>Dil kursları</li>
                        <li>Online resurslar</li>
                        <li>Praktika imkanları</li>
                        <li>İmtahan hazırlığı</li>
                    </ul>
                </div>
                
                <div class="guide-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="guide-icon">💼</div>
                    <h3>Karyera Planlaması</h3>
                    <p>Təhsil sonrası karyera imkanları və planlaması</p>
                    <ul class="guide-points">
                        <li>İş bazarı analizi</li>
                        <li>Karyera yolları</li>
                        <li>Staj imkanları</li>
                        <li>Şəbəkə qurma</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Timeline -->
    <section class="section application-timeline">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Müraciət Prosesi və Zaman Cədvəli
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Ukrayna universitetlərinə müraciət prosesinin addım-addım rehberi
                </p>
            </div>
            
            <div class="timeline-grid">
                <div class="timeline-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="timeline-icon">📅</div>
                    <h3>Mart - Aprel</h3>
                    <h4>Hazırlıq Mərhələsi</h4>
                    <ul>
                        <li>Universitet və ixtisas seçimi</li>
                        <li>Sənədlərin hazırlanması</li>
                        <li>Dil kurslarına başlama</li>
                        <li>Maliyyə planlaması</li>
                    </ul>
                </div>
                
                <div class="timeline-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="timeline-icon">📝</div>
                    <h3>May - İyun</h3>
                    <h4>Müraciət Mərhələsi</h4>
                    <ul>
                        <li>Universitetə müraciət</li>
                        <li>Sənədlərin göndərilməsi</li>
                        <li>Qəbul məktubunun gözlənməsi</li>
                        <li>Viza müraciəti</li>
                    </ul>
                </div>
                
                <div class="timeline-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="timeline-icon">✈️</div>
                    <h3>İyul - Avqust</h3>
                    <h4>Səyahət Hazırlığı</h4>
                    <ul>
                        <li>Viza alınması</li>
                        <li>Uçak biletinin alınması</li>
                        <li>Yerləşmə təşkili</li>
                        <li>Sağlamlıq yoxlaması</li>
                    </ul>
                </div>
                
                <div class="timeline-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="800">
                    <div class="timeline-icon">🎓</div>
                    <h3>Sentyabr</h3>
                    <h4>Təhsil Başlanğıcı</h4>
                    <ul>
                        <li>Ukraynaya səyahət</li>
                        <li>Universitetə qeydiyyat</li>
                        <li>Dil hazırlıq kursu (lazım olduqda)</li>
                        <li>Yeni həyata uyğunlaşma</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Required Documents Details -->
    <section class="section documents-details">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Lazımi Sənədlərin Ətraflı Siyahısı
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Ukrayna universitetlərinə qəbul üçün lazım olan bütün sənədlər
                </p>
            </div>
            
            <div class="documents-list">
                <div class="document-category" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <h3>📋 Əsas Sənədlər</h3>
                    <ul>
                        <li><strong>Orta təhsil şəhadətnaməsi</strong> (apostil ilə)</li>
                        <li><strong>Sağlamlıq şəhadətnaməsi</strong> (son 3 ay)</li>
                        <li><strong>Doğum şəhadətnaməsi</strong> (apostil ilə)</li>
                        <li><strong>Pasport kopyası</strong> (bütün səhifələr)</li>
                        <li><strong>Fotoşəkillər</strong> (3x4, 8 ədəd)</li>
                    </ul>
                </div>
                
                <div class="document-category" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <h3>📝 Əlavə Sənədlər</h3>
                    <ul>
                        <li><strong>Motivasiya məktubu</strong> (İngilis və ya Ukrayna dilində)</li>
                        <li><strong>CV/Resume</strong> (təhsil və təcrübə)</li>
                        <li><strong>Dil bilikləri səhadətnaməsi</strong> (lazım olduqda)</li>
                        <li><strong>İş təcrübəsi səhadətnaməsi</strong> (lazım olduqda)</li>
                        <li><strong>Maliyyə təminatı səhadətnaməsi</strong></li>
                    </ul>
                </div>
                
                <div class="document-category" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                    <h3>🛂 Viza Sənədləri</h3>
                    <ul>
                        <li><strong>Viza müraciət forması</strong></li>
                        <li><strong>Universitet qəbul məktubu</strong></li>
                        <li><strong>Maliyyə təminatı səhadətnaməsi</strong> ($5000 minimum)</li>
                        <li><strong>Sağlamlıq sığortası</strong> (1 il)</li>
                        <li><strong>Uçak biletinin təsdiqi</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section faq-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Tez-tez Verilən Suallar
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Ən çox soruşulan suallar və cavabları
                </p>
            </div>
            
            <div class="faq-grid">
                <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <h3>Hangi sənədlər lazımdır?</h3>
                    <p>Orta təhsil şəhadətnaməsi, sağlamlıq şəhadətnaməsi, pasport kopyası və fotoşəkillər əsas sənədlərdir.</p>
                </div>
                
                <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <h3>Viza prosesi nə qədər çəkir?</h3>
                    <p>Viza müraciəti prosesi adətən 2-4 həftə çəkir, lakin mövsümdən asılı olaraq dəyişə bilər.</p>
                </div>
                
                <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                    <h3>Dil bilməsəm necə?</h3>
                    <p>Dil bilməyən tələbələr üçün 1 illik hazırlıq kursu mövcuddur.</p>
                </div>
                
                <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                    <h3>İş tapa bilərəm?</h3>
                    <p>Təhsil müddətində məhdud iş imkanları var, amma təhsil sonrası geniş imkanlar mövcuddur.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up" data-aos-duration="800">
                <h2>Sənədlərinizə kömək edək!</h2>
                <p>Peşəkar komandamız sənədlərinizi hazırlamaq və müraciət prosesinizi idarə etmək üçün burada.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary">Pulsuz Konsultasiya</a>
                    <a href="about.php" class="btn btn-secondary">Haqqımızda</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 