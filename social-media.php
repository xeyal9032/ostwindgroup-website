<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Sosial Media - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="800">Sosial Media</h1>
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                Sosial media hesablarımıza qoşulun və yeniliklərdən xəbərdar olun
            </p>
        </div>
    </section>

    <!-- Social Media Channels -->
    <section class="section social-media-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Sosial Media Hesablarımız
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Yeniliklərdən xəbərdar olmaq üçün bizi izləyin
                </p>
            </div>
            
            <div class="social-grid">
                <div class="social-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="social-icon">📘</div>
                    <h3>Facebook</h3>
                    <p>Facebook səhifəmizdə universitetlər, təhsil imkanları və tələbə hekayələri paylaşırıq.</p>
                    <div class="social-stats">
                        <span class="followers">5K+ İzləyici</span>
                        <span class="posts">Gündəlik paylaşım</span>
                    </div>
                                                <a href="https://facebook.com/ostwind.llc" class="btn btn-primary" target="_blank">
                        Facebook-a Qoşul
                    </a>
                </div>
                
                <div class="social-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="social-icon">📷</div>
                    <h3>Instagram</h3>
                    <p>Instagram-da universitet həyatı, tələbə təcrübələri və vizual məzmunlar paylaşırıq.</p>
                    <div class="social-stats">
                        <span class="followers">8K+ İzləyici</span>
                        <span class="posts">Gündəlik paylaşım</span>
                    </div>
                    <a href="https://instagram.com/ostwind.group" class="btn btn-primary" target="_blank">
                        Instagram-a Qoşul
                    </a>
                </div>
                
                <div class="social-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="social-icon">📺</div>
                    <h3>YouTube</h3>
                    <p>YouTube kanalımızda universitet turları, tələbə müsahibələri və təhsil videoları yayımlayırıq.</p>
                    <div class="social-stats">
                        <span class="followers">3K+ Abunə</span>
                        <span class="posts">Həftəlik video</span>
                    </div>
                    <a href="https://youtube.com/ostwindgroup" class="btn btn-primary" target="_blank">
                        YouTube-a Abunə Ol
                    </a>
                </div>
                
                <div class="social-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="800">
                    <div class="social-icon">💼</div>
                    <h3>LinkedIn</h3>
                    <p>LinkedIn-də peşəkar məzmunlar, karyera məsləhətləri və sənaye yenilikləri paylaşırıq.</p>
                    <div class="social-stats">
                        <span class="followers">2K+ İzləyici</span>
                        <span class="posts">Həftəlik paylaşım</span>
                    </div>
                    <a href="https://linkedin.com/company/ostwindgroup" class="btn btn-primary" target="_blank">
                        LinkedIn-ə Qoşul
                    </a>
                </div>
                
                <div class="social-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1000">
                    <div class="social-icon">🐦</div>
                    <h3>Twitter</h3>
                    <p>Twitter-da sürətli yeniliklər, təhsil xəbərləri və qısa məsləhətlər paylaşırıq.</p>
                    <div class="social-stats">
                        <span class="followers">1K+ İzləyici</span>
                        <span class="posts">Gündəlik paylaşım</span>
                    </div>
                    <a href="https://twitter.com/ostwindgroup" class="btn btn-primary" target="_blank">
                        Twitter-a Qoşul
                    </a>
                </div>
                
                <div class="social-card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="1200">
                    <div class="social-icon">📱</div>
                    <h3>TikTok</h3>
                    <p>TikTok-da əyləncəli və məlumatlandırıcı qısa videolar paylaşırıq.</p>
                    <div class="social-stats">
                        <span class="followers">500+ İzləyici</span>
                        <span class="posts">Gündəlik video</span>
                    </div>
                    <a href="https://tiktok.com/@ostwind.group2008" class="btn btn-primary" target="_blank">
                        TikTok-a Qoşul
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Posts -->
    <section class="section latest-posts">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Son Paylaşımlar
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Sosial media hesablarımızdan son paylaşımlar
                </p>
            </div>
            
            <div class="posts-grid">
                <div class="post-card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="post-image">
                        <img src="images/post-1.jpg" alt="Post" onerror="this.src='https://via.placeholder.com/300x200/007AFF/FFFFFF?text=Post'">
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-platform">📘 Facebook</span>
                            <span class="post-date">2 saat əvvəl</span>
                        </div>
                        <h3>Xarkov Milli Universiteti Turu</h3>
                        <p>Xarkov Milli Universitetinin gözəl kampusunu və təhsil imkanlarını göstərdik. Bu prestijli universitetdə təhsil almaq istəyirsinizmi?</p>
                        <div class="post-stats">
                            <span>👍 245</span>
                            <span>💬 23</span>
                            <span>📤 12</span>
                        </div>
                    </div>
                </div>
                
                <div class="post-card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="post-image">
                        <img src="images/post-2.jpg" alt="Post" onerror="this.src='https://via.placeholder.com/300x200/007AFF/FFFFFF?text=Post'">
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-platform">📷 Instagram</span>
                            <span class="post-date">5 saat əvvəl</span>
                        </div>
                        <h3>Tələbə Həyatı - Kiyev</h3>
                        <p>Kiyevdə təhsil alan tələbələrimizin gündəlik həyatından gözəl anlar. Universitet yataqxanası, kitabxana və şəhər mənzərələri.</p>
                        <div class="post-stats">
                            <span>❤️ 567</span>
                            <span>💬 45</span>
                            <span>📤 89</span>
                        </div>
                    </div>
                </div>
                
                <div class="post-card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="post-image">
                        <img src="images/post-3.jpg" alt="Post" onerror="this.src='https://via.placeholder.com/300x200/007AFF/FFFFFF?text=Post'">
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-platform">📺 YouTube</span>
                            <span class="post-date">1 gün əvvəl</span>
                        </div>
                        <h3>Viza Müraciəti Rehberi</h3>
                        <p>Ukrayna tələbə vizası üçün müraciət prosesini ətraflı izah edən video. Bütün addımları və lazımi sənədləri göstərdik.</p>
                        <div class="post-stats">
                            <span>👁️ 1.2K</span>
                            <span>👍 234</span>
                            <span>💬 67</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Benefits -->
    <section class="section social-benefits">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">
                    Sosial Media-da Bizi İzləməyin Üstünlükləri
                </h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    Niyə sosial media hesablarımıza qoşulmalısınız?
                </p>
            </div>
            
            <div class="benefits-grid">
                <div class="benefit-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <div class="benefit-icon">📢</div>
                    <h3>Yeniliklərdən Xəbərdar Olun</h3>
                    <p>Universitet qəbul tarixləri, viza dəyişiklikləri və təhsil yeniliklərindən ilk xəbərdar olun.</p>
                </div>
                
                <div class="benefit-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <div class="benefit-icon">🎓</div>
                    <h3>Universitet Turları</h3>
                    <p>Universitetlərin kampuslarını, yataqxanalarını və təhsil imkanlarını virtual olaraq görün.</p>
                </div>
                
                <div class="benefit-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="600">
                    <div class="benefit-icon">👥</div>
                    <h3>Tələbə Təcrübələri</h3>
                    <p>Uğurlu tələbələrimizin hekayələrini və təcrübələrini oxuyun və ilham alın.</p>
                </div>
                
                <div class="benefit-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="800">
                    <div class="benefit-icon">💡</div>
                    <h3>Məsləhətlər və İpucları</h3>
                    <p>Təhsil, viza və yaşayış haqqında faydalı məsləhətlər və ipucları əldə edin.</p>
                </div>
                
                <div class="benefit-item" data-aos="fade-right" data-aos-duration="800" data-aos-delay="1000">
                    <div class="benefit-icon">🎉</div>
                    <h3>Xüsusi Təkliflər</h3>
                    <p>Sosial media izləyicilərimiz üçün xüsusi endirimlər və təkliflər.</p>
                </div>
                
                <div class="benefit-item" data-aos="fade-left" data-aos-duration="800" data-aos-delay="1200">
                    <div class="benefit-icon">🤝</div>
                    <h3>Birbaşa Əlaqə</h3>
                    <p>Sosial media vasitəsilə birbaşa suallarınızı soruşun və dərhal cavab alın.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="section newsletter-section">
        <div class="container">
            <div class="newsletter-content" data-aos="fade-up" data-aos-duration="800">
                <h2>Yeniliklərdən Xəbərdar Olun</h2>
                <p>Sosial media hesablarımıza qoşulun və ən son yeniliklərdən xəbərdar olun!</p>
                
                <div class="social-links">
                    <a href="https://facebook.com/ostwind.llc" class="social-link facebook" target="_blank">
                        <span>📘 Facebook</span>
                    </a>
                    <a href="https://instagram.com/ostwind.group" class="social-link instagram" target="_blank">
                        <span>📷 Instagram</span>
                    </a>
                    <a href="https://youtube.com/ostwindgroup" class="social-link youtube" target="_blank">
                        <span>📺 YouTube</span>
                    </a>
                    <a href="https://linkedin.com/company/ostwindgroup" class="social-link linkedin" target="_blank">
                        <span>💼 LinkedIn</span>
                    </a>
                    <a href="https://twitter.com/ostwindgroup" class="social-link twitter" target="_blank">
                        <span>🐦 Twitter</span>
                    </a>
                    <a href="https://tiktok.com/@ostwind.group2008" class="social-link tiktok" target="_blank">
                        <span>📱 TikTok</span>
                    </a>
                </div>
                
                <div class="newsletter-form">
                    <h3>E-mail Bülleteni</h3>
                    <p>Həftəlik bülletenimizə abunə olun və ən mühüm yenilikləri əldə edin.</p>
                    <form class="newsletter-form-content">
                        <input type="email" placeholder="E-mail ünvanınızı daxil edin" required>
                        <button type="submit" class="btn btn-primary">Abunə Ol</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up" data-aos-duration="800">
                <h2>Sosial media hesablarımıza qoşulun!</h2>
                <p>Yeniliklərdən xəbərdar olmaq və bizimlə əlaqədə qalmaq üçün sosial media hesablarımıza qoşulun.</p>
                <div class="cta-buttons">
                    <a href="https://instagram.com/ostwind.group" class="btn btn-primary" target="_blank">Instagram</a>
                    <a href="contact.php" class="btn btn-secondary">Əlaqə</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 