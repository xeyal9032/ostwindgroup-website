<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Necə İşləyir? - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="800">Necə İşləyir?</h1>
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                OstWindGroup ilə təhsil yolculuğunuzun addım-addım prosesi
            </p>
        </div>
    </section>

    <!-- Process Steps -->
    <section class="section demo-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Təhsil Prosesi
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Sizin uğurunuz üçün addım-addım işləyirik
                </p>
            </div>
            
            <div class="demo-steps">
                <div class="step-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>İlk Görüş və Konsultasiya</h3>
                        <p>Tələbə ilə ilk görüş keçiririk, təhsil hədəflərini, maraqlarını və imkanlarını müəyyən edirik. Bu mərhələdə sizin üçün ən yaxşı seçimləri təklif edirik.</p>
                        <ul class="step-details">
                            <li>Pulsuz ilk konsultasiya</li>
                            <li>Təhsil hədəflərinin müəyyən edilməsi</li>
                            <li>Maliyyə imkanlarının qiymətləndirilməsi</li>
                            <li>Universitet və ixtisas seçimi</li>
                        </ul>
                    </div>
                    <div class="demo-image">
                        <img src="images/consultation.jpg" alt="Konsultasiya" onerror="this.src='https://via.placeholder.com/300x200/007AFF/FFFFFF?text=Konsultasiya'">
                    </div>
                </div>
                
                <div class="step-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Sənədlərin Hazırlanması</h3>
                        <p>Bütün lazımi sənədləri peşəkar şəkildə hazırlayırıq. Bu mərhələdə sənədlərinizin düzgün formatda və tələblərə uyğun olmasını təmin edirik.</p>
                        <ul class="step-details">
                            <li>Sənədlərin toplanması və yoxlanması</li>
                            <li>Apostil və tərcümə xidmətləri</li>
                            <li>Motivasiya məktubunun hazırlanması</li>
                            <li>Müraciət formasının doldurulması</li>
                        </ul>
                    </div>
                    <div class="demo-image">
                        <img src="images/documents.jpg" alt="Sənədlər" onerror="this.src='https://via.placeholder.com/300x200/007AFF/FFFFFF?text=Sənədlər'">
                    </div>
                </div>
                
                <div class="step-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Universitetə Müraciət</h3>
                        <p>Seçilmiş universitetə müraciəti idarə edirik. Bu mərhələdə universitetlə əlaqə saxlayırıq və müraciət prosesini izləyirik.</p>
                        <ul class="step-details">
                            <li>Universitetə müraciətin göndərilməsi</li>
                            <li>Müraciətin izlənilməsi</li>
                            <li>Universitetdən cavabın alınması</li>
                            <li>Qəbul məktubunun təmin edilməsi</li>
                        </ul>
                    </div>
                    <div class="demo-image">
                        <img src="images/application.jpg" alt="Müraciət" onerror="this.src='https://via.placeholder.com/300x200/007AFF/FFFFFF?text=Müraciət'">
                    </div>
                </div>
                
                <div class="step-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="800">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Viza və Səyahət</h3>
                        <p>Viza müraciəti prosesində tam dəstək təmin edirik və səyahət təşkilatında kömək edirik.</p>
                        <ul class="step-details">
                            <li>Viza müraciəti sənədlərinin hazırlanması</li>
                            <li>Viza müraciətinin idarə edilməsi</li>
                            <li>Hava yolu biletinin təmin edilməsi</li>
                            <li>Səyahət təlimatları</li>
                        </ul>
                    </div>
                    <div class="demo-image">
                        <img src="images/visa.jpg" alt="Viza" onerror="this.src='https://via.placeholder.com/300x200/007AFF/FFFFFF?text=Viza'">
                    </div>
                </div>
                
                <div class="step-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="1000">
                    <div class="step-number">5</div>
                    <div class="step-content">
                        <h3>Yerləşmə və Adaptasiya</h3>
                        <p>Ukraynaya çatdıqdan sonra yerləşmə və adaptasiya prosesində dəstək təmin edirik.</p>
                        <ul class="step-details">
                            <li>Yataqxana və ya mənzil təmin edilməsi</li>
                            <li>Universitetə qeydiyyat</li>
                            <li>Şəhərə tanışlıq</li>
                            <li>Dəvam edən dəstək</li>
                        </ul>
                    </div>
                    <div class="demo-image">
                        <img src="images/accommodation.jpg" alt="Yerləşmə" onerror="this.src='https://via.placeholder.com/300x200/007AFF/FFFFFF?text=Yerləşmə'">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Guide -->
    <section class="section demo-video">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Video Rehber
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    OstWindGroup ilə təhsil prosesi haqqında ətraflı video
                </p>
            </div>
            
            <div class="video-container" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                <iframe 
                    width="100%" 
                    height="500" 
                    src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
                    title="OstWindGroup Təhsil Prosesi" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <!-- Timeline -->
    <section class="section timeline-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Zaman Xətti
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Təhsil prosesinin təxmini müddətləri
                </p>
            </div>
            
            <div class="timeline">
                <div class="timeline-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="timeline-date">Mart - May</div>
                    <div class="timeline-content">
                        <h3>İlk Hazırlıq</h3>
                        <p>Konsultasiya, universitet seçimi və sənədlərin hazırlanması</p>
                    </div>
                </div>
                
                <div class="timeline-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="timeline-date">İyun - İyul</div>
                    <div class="timeline-content">
                        <h3>Müraciət</h3>
                        <p>Universitetə müraciət və qəbul məktubunun alınması</p>
                    </div>
                </div>
                
                <div class="timeline-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="timeline-date">Avqust</div>
                    <div class="timeline-content">
                        <h3>Viza</h3>
                        <p>Viza müraciəti və səyahət təşkilatı</p>
                    </div>
                </div>
                
                <div class="timeline-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="800">
                    <div class="timeline-date">Sentyabr</div>
                    <div class="timeline-content">
                        <h3>Başlama</h3>
                        <p>Ukraynaya səyahət və təhsilin başlanması</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="section success-stories">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Uğur Hekayələri
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    OstWindGroup vasitəsilə uğur qazanmış tələbələrimizin hekayələri
                </p>
            </div>
            
            <div class="stories-grid">
                <div class="story-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="story-image">
                        <img src="images/student-1.jpg" alt="Tələbə" onerror="this.src='https://via.placeholder.com/200x200/007AFF/FFFFFF?text=Tələbə'">
                    </div>
                    <div class="story-content">
                        <h3>Əli Məmmədov</h3>
                        <p class="story-university">Xarkov Milli Universiteti</p>
                        <p class="story-specialty">Kompüter Elmləri</p>
                        <p class="story-text">"OstWindGroup sayəsində Xarkov Milli Universitetinə qəbul oldum. Bütün proses çox asan və peşəkar idi."</p>
                    </div>
                </div>
                
                <div class="story-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="story-image">
                        <img src="images/student-2.jpg" alt="Tələbə" onerror="this.src='https://via.placeholder.com/200x200/007AFF/FFFFFF?text=Tələbə'">
                    </div>
                    <div class="story-content">
                        <h3>Aysu Əliyeva</h3>
                        <p class="story-university">Kiyev Tibb Universiteti</p>
                        <p class="story-specialty">Həkimlik</p>
                        <p class="story-text">"Tibb sahəsində təhsil almaq həmişə arzum idi. OstWindGroup bu arzumu reallaşdırdı."</p>
                    </div>
                </div>
                
                <div class="story-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="story-image">
                        <img src="images/student-3.jpg" alt="Tələbə" onerror="this.src='https://via.placeholder.com/200x200/007AFF/FFFFFF?text=Tələbə'">
                    </div>
                    <div class="story-content">
                        <h3>Murad Hüseynov</h3>
                        <p class="story-university">Lvov Politexnik Universiteti</p>
                        <p class="story-specialty">Elektrik Mühəndisliyi</p>
                        <p class="story-text">"Mühəndislik sahəsində yüksək keyfiyyətli təhsil alıram. OstWindGroup komandasına minnətdaram."</p>
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
                <p>Peşəkar komandamız sizin təhsil yolculuğunuzda sizə kömək etməyə hazırdır.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary">Pulsuz Konsultasiya</a>
                    <a href="about.php" class="btn btn-secondary">Haqqımızda</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 