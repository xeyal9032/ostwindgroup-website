<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = 'Tez-tez Verilən Suallar - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="800">Tez-tez Verilən Suallar</h1>
            <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                Ən çox soruşulan suallar və ətraflı cavabları
            </p>
        </div>
    </section>

    <!-- FAQ Categories -->
    <section class="section faq-categories">
        <div class="container">
            <div class="categories-tabs">
                <button class="tab-btn active" data-category="general">Ümumi Suallar</button>
                <button class="tab-btn" data-category="admission">Qəbul</button>
                <button class="tab-btn" data-category="visa">Viza</button>
                <button class="tab-btn" data-category="costs">Xərclər</button>
                <button class="tab-btn" data-category="life">Yaşayış</button>
            </div>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="section faq-content">
        <div class="container">
            <!-- General Questions -->
            <div class="faq-category active" id="general">
                <div class="faq-grid">
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <h3>OstWindGroup nə edir?</h3>
                        <p>OstWindGroup Ukrayna və xaricdə təhsil almaq istəyən tələbələrə kömək edən peşəkar təhsil məsləhətçiliyi şirkətidir. Universitet seçimi, sənəd hazırlama, viza müraciəti və yerləşmə kimi bütün prosesləri idarə edirik.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                        <h3>Niyə Ukrayna?</h3>
                        <p>Ukrayna Avropa standartlarında keyfiyyətli təhsil təklif edir, lakin çox daha aşağı qiymətlərlə. Ukrayna diplomları bütün dünyada tanınır və etibarlıdır.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                        <h3>Hangi dillərdə təhsil ala bilərəm?</h3>
                        <p>Ukrayna universitetlərində Ukrayna, Rus və İngilis dillərində təhsil ala bilərsiniz. Dil bilməyən tələbələr üçün 1 illik hazırlıq kursu mövcuddur.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                        <h3>OstWindGroup-un təcrübəsi nə qədərdir?</h3>
                        <p>OstWindGroup 2013-cü ildən bəri fəaliyyət göstərir və bu günə qədər 2500-dən çox tələbəni uğurla yurtdışı universitetlərinə yerləşdirmişik.</p>
                    </div>
                </div>
            </div>

            <!-- Admission Questions -->
            <div class="faq-category" id="admission">
                <div class="faq-grid">
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <h3>Hangi sənədlər lazımdır?</h3>
                        <p>Orta təhsil şəhadətnaməsi (apostil ilə), sağlamlıq şəhadətnaməsi, doğum şəhadətnaməsi, pasport kopyası və fotoşəkillər (3x4) əsas sənədlərdir.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                        <h3>Qəbul şansım nə qədərdir?</h3>
                        <p>Lazımi sənədlər düzgün hazırlandıqda və tələblərə uyğun olduqda qəbul şansı çox yüksəkdir. OstWindGroup 100% qeydiyyat zəmanəti təmin edir.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                        <h3>İmtahan verməliyəm?</h3>
                        <p>Çox vaxt əlavə imtahan tələb olunmur, amma bəzi ixtisaslar üçün müsahibə və ya test tələb oluna bilər.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                        <h3>Nə vaxt müraciət etməliyəm?</h3>
                        <p>Ən yaxşı vaxt mart-may aylarıdır. Bu vaxt müraciət etməklə sentyabrda təhsilə başlaya bilərsiniz.</p>
                    </div>
                </div>
            </div>

            <!-- Visa Questions -->
            <div class="faq-category" id="visa">
                <div class="faq-grid">
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <h3>Viza prosesi nə qədər çəkir?</h3>
                        <p>Viza müraciəti prosesi adətən 2-4 həftə çəkir, lakin mövsümdən asılı olaraq dəyişə bilər.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                        <h3>Viza üçün hansı sənədlər lazımdır?</h3>
                        <p>Qəbul məktubu, səyahət sığortası, maliyyə təminatı sənədləri, sağlamlıq şəhadətnaməsi və pasport lazımdır.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                        <h3>Viza rədd olunarsa nə edəcəyəm?</h3>
                        <p>Viza rədd olunarsa, səbəbi araşdırırıq və yenidən müraciət edirik. OstWindGroup viza prosesində tam dəstək təmin edir.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                        <h3>Viza qiyməti nə qədərdir?</h3>
                        <p>Ukrayna tələbə vizası adətən $50-100 arasıdır, lakin ölkədən ölkəyə dəyişə bilər.</p>
                    </div>
                </div>
            </div>

            <!-- Costs Questions -->
            <div class="faq-category" id="costs">
                <div class="faq-grid">
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <h3>Təhsil haqqı nə qədərdir?</h3>
                        <p>İllik təhsil haqqı $2000-4000 arasıdır. İxtisas və universitetə görə dəyişə bilər.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                        <h3>Yaşayış xərcləri nə qədərdir?</h3>
                        <p>Aylıq yaşayış xərcləri $400-800 arasıdır. Bu yataqxana, yemək, nəqliyyat və digər xərcləri əhatə edir.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                        <h3>Burs imkanları var?</h3>
                        <p>Bəli, Ukrayna universitetlərində müxtəlif burs və təqaüd imkanları mövcuddur. Yaxşı akademik nəticələrə görə burs ala bilərsiniz.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                        <h3>İş tapa bilərəm?</h3>
                        <p>Təhsil müddətində məhdud iş imkanları var, amma təhsil sonrası geniş imkanlar mövcuddur.</p>
                    </div>
                </div>
            </div>

            <!-- Life Questions -->
            <div class="faq-category" id="life">
                <div class="faq-grid">
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <h3>Yerləşmə problemi var?</h3>
                        <p>Universitetlərin yataqxanaları mövcuddur və OstWindGroup yerləşmə prosesində kömək edir.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                        <h3>Sağlamlıq xidmətləri necədir?</h3>
                        <p>Ukraynada yaxşı sağlamlıq xidmətləri mövcuddur. Tələbələr üçün səyahət sığortası tələb olunur.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                        <h3>İqlim necədir?</h3>
                        <p>Ukraynada 4 fəsil var. Qış soyuq, yay isti keçir. Əsasən mülayim iqlimə malikdir.</p>
                    </div>
                    
                    <div class="faq-item" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                        <h3>Nəqliyyat necədir?</h3>
                        <p>Şəhərlərdə metro, avtobus, trolleybus və tramvay mövcuddur. Tələbələr üçün ucuz nəqliyyat kartları var.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section contact-faq">
        <div class="container">
            <div class="contact-faq-content" data-aos="fade-up" data-aos-duration="800">
                <h2>Sualınızın cavabını tapa bilmədiniz?</h2>
                <p>Bizimlə əlaqə saxlayın, sualınızı cavablandıraq!</p>
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="contact-icon">📞</div>
                        <h3>Telefon</h3>
                        <p>+994 50 123 45 67</p>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">📧</div>
                        <h3>E-mail</h3>
                        <p>info@ostwindgroup.az</p>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">💬</div>
                        <h3>WhatsApp</h3>
                        <p>+994 50 123 45 67</p>
                    </div>
                </div>
                <a href="contact.php" class="btn btn-primary">Bizimlə Əlaqə</a>
            </div>
        </div>
    </section>
</main>

<script>
// FAQ Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const faqCategories = document.querySelectorAll('.faq-category');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            
            // Remove active class from all tabs and categories
            tabBtns.forEach(b => b.classList.remove('active'));
            faqCategories.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding category
            this.classList.add('active');
            document.getElementById(category).classList.add('active');
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?> 