<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

$page_title = 'Gizlilik Siyasəti - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <section class="section">
        <div class="container">
            <div class="content-wrapper">
                <h1 data-aos="fade-down" data-aos-duration="800">Gizlilik Siyasəti</h1>
                
                <div class="content-text" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <p><strong>Son yeniləmə tarixi:</strong> 1 Yanvar 2024</p>
                    
                    <h2>1. Ümumi Məlumat</h2>
                    <p>OstWindGroup ("biz", "bizim", "şirkət") olaraq, sizin gizliliyinizi qorumağımızı və şəxsi məlumatlarınızın təhlükəsizliyini təmin etməyimizi öhdəmizə götürürük. Bu Gizlilik Siyasəti, veb saytımızı ziyarət etdiyiniz zaman və ya xidmətlərimizdən istifadə etdiyiniz zaman toplanan məlumatları necə istifadə etdiyimizi açıqlayır.</p>
                    
                    <h2>2. Topladığımız Məlumatlar</h2>
                    <h3>2.1 Şəxsi Məlumatlar</h3>
                    <ul>
                        <li>Ad və soyad</li>
                        <li>E-poçt ünvanı</li>
                        <li>Telefon nömrəsi</li>
                        <li>Doğum tarixi</li>
                        <li>Pasport məlumatları</li>
                        <li>Təhsil məlumatları</li>
                    </ul>
                    
                    <h3>2.2 Avtomatik Toplanan Məlumatlar</h3>
                    <ul>
                        <li>IP ünvanı</li>
                        <li>Brauzer növü</li>
                        <li>İstifadə etdiyiniz səhifələr</li>
                        <li>Ziyarət vaxtı</li>
                        <li>Cookies məlumatları</li>
                    </ul>
                    
                    <h2>3. Məlumatların İstifadəsi</h2>
                    <p>Topladığımız məlumatları aşağıdakı məqsədlər üçün istifadə edirik:</p>
                    <ul>
                        <li>Xidmətlərimizi təqdim etmək</li>
                        <li>Universitet qəbul prosesini idarə etmək</li>
                        <li>Viza və konaklama xidmətlərini təmin etmək</li>
                        <li>Müştəri dəstəyi təqdim etmək</li>
                        <li>Yanacaq və təkmilləşdirmələr</li>
                        <li>Qanuni tələblərə uyğunluq</li>
                    </ul>
                    
                    <h2>4. Məlumatların Paylaşılması</h2>
                    <p>Şəxsi məlumatlarınızı aşağıdakı hallarda üçüncü tərəflərlə paylaşa bilərik:</p>
                    <ul>
                        <li>Razılığınız olduqda</li>
                        <li>Qanuni tələblərə uyğun olaraq</li>
                        <li>Xidmətlərimizi təqdim etmək üçün zəruri olduqda</li>
                        <li>Güvenlik məqsədləri üçün</li>
                    </ul>
                    
                    <h2>5. Məlumatların Təhlükəsizliyi</h2>
                    <p>Şəxsi məlumatlarınızı qorumaq üçün aşağıdakı tədbirləri görürük:</p>
                    <ul>
                        <li>SSL şifrələmə</li>
                        <li>Təhlükəsiz verilənlər bazası</li>
                        <li>Məhdud giriş hüquqları</li>
                        <li>Müntəzəm təhlükəsizlik yoxlamaları</li>
                    </ul>
                    
                    <h2>6. Cookies İstifadəsi</h2>
                    <p>Veb saytımızda cookies istifadə edirik. Cookies kiçik mətn fayllarıdır ki, kompüterinizə yerləşdirilir və səhifələrimizi daha yaxşı təcrübə üçün istifadə olunur.</p>
                    
                    <h2>7. Sizin Hüquqlarınız</h2>
                    <p>Aşağıdakı hüquqlara maliksiniz:</p>
                    <ul>
                        <li>Şəxsi məlumatlarınızı görmək</li>
                        <li>Düzəliş etmək</li>
                        <li>Silinməsini tələb etmək</li>
                        <li>İstifadəyə məhdudiyyət qoymaq</li>
                        <li>Məlumatların köçürülməsini tələb etmək</li>
                    </ul>
                    
                    <h2>8. Uşaqların Gizliliyi</h2>
                    <p>13 yaşından kiçik uşaqlardan qəsdən şəxsi məlumat toplamırıq. Əgər belə məlumat toplandığını bilirsinizsə, bizimlə əlaqə saxlayın.</p>
                    
                    <h2>9. Beynəlxalq Məlumat Köçürməsi</h2>
                    <p>Məlumatlarınız Ukrayna və digər ölkələrdə emal edilə bilər. Bu ölkələrdə məlumat qorunması standartları fərqli ola bilər.</p>
                    
                    <h2>10. Siyasət Dəyişiklikləri</h2>
                    <p>Bu Gizlilik Siyasətini istənilən vaxt yeniləyə bilərik. Dəyişikliklər veb saytımızda dərc ediləcək.</p>
                    
                    <h2>11. Əlaqə</h2>
                    <p>Bu Gizlilik Siyasəti ilə bağlı suallarınız varsa, bizimlə əlaqə saxlayın:</p>
                    <ul>
                        <li><strong>E-poçt:</strong> privacy@ostwindgroup.com</li>
                        <li><strong>Telefon:</strong> +380 96 258 00 00</li>
                        <li><strong>Ünvan:</strong> Bakı şəhəri, Rüstəm Rüstəmov 44</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 