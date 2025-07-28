<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

$page_title = 'İstifadə Şərtləri - OstWindGroup';

include 'includes/header.php';
?>

<main>
    <section class="section">
        <div class="container">
            <div class="content-wrapper">
                <h1 data-aos="fade-down" data-aos-duration="800">İstifadə Şərtləri</h1>
                
                <div class="content-text" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <p><strong>Son yeniləmə tarixi:</strong> 1 Yanvar 2024</p>
                    
                    <h2>1. Ümumi Şərtlər</h2>
                    <p>OstWindGroup veb saytını istifadə etməklə, bu İstifadə Şərtlərini qəbul etmiş olursunuz. Bu şərtlər sizin veb saytımızı istifadə etməyinizi idarə edir.</p>
                    
                    <h2>2. Xidmətlərimiz</h2>
                    <p>OstWindGroup aşağıdakı xidmətləri təqdim edir:</p>
                    <ul>
                        <li>Universitet qəbul xidmətləri</li>
                        <li>Viza dəstəyi</li>
                        <li>Konaklama təşkili</li>
                        <li>Təhsil məsləhəti</li>
                        <li>Akademik dəstək</li>
                        <li>Diplom təsdiqi</li>
                    </ul>
                    
                    <h2>3. İstifadəçi Öhdəlikləri</h2>
                    <p>Veb saytımızı istifadə edərkən aşağıdakı qaydalara riayət etməlisiniz:</p>
                    <ul>
                        <li>Dəqiq və tam məlumat təqdim etmək</li>
                        <li>Şəxsi məlumatlarınızı qorumaq</li>
                        <li>Veb saytımızı qanunsuz məqsədlər üçün istifadə etməmək</li>
                        <li>Digər istifadəçilərin hüquqlarına hörmət etmək</li>
                        <li>Virus və ya zərərli proqram təqdim etməmək</li>
                    </ul>
                    
                    <h2>4. Qeydiyyat və Hesab</h2>
                    <p>Xidmətlərimizdən tam istifadə etmək üçün qeydiyyatdan keçməlisiniz:</p>
                    <ul>
                        <li>18 yaşından yuxarı olmalısınız</li>
                        <li>Dəqiq məlumat təqdim etməlisiniz</li>
                        <li>Hesab məlumatlarınızı qorumaqla məsuliyyət daşıyırsınız</li>
                        <li>Hesabınızın təhlükəsizliyini təmin etməlisiniz</li>
                    </ul>
                    
                    <h2>5. Ödəniş Şərtləri</h2>
                    <p>Xidmətlərimiz üçün ödəniş şərtləri:</p>
                    <ul>
                        <li>Qiymətlər USD və ya EUR ilə göstərilir</li>
                        <li>Ödəniş bank köçürməsi və ya online ödəniş ilə edilə bilər</li>
                        <li>Ödəniş məbləği xidmət başlamazdan əvvəl ödənilməlidir</li>
                        <li>Vergi və komissiya xərcləri müştəri tərəfindən ödənilir</li>
                    </ul>
                    
                    <h2>6. Ləğv və Geri Qaytarma</h2>
                    <p>Xidmət ləğv etmə şərtləri:</p>
                    <ul>
                        <li>Xidmət başlamazdan 7 gün əvvəl tam geri qaytarma</li>
                        <li>Xidmət başladıqdan sonra qismi geri qaytarma</li>
                        <li>Qəbul olunmayan hallarda tam geri qaytarma</li>
                        <li>Geri qaytarma 30 gün ərzində edilir</li>
                    </ul>
                    
                    <h2>7. Zəmanət və Məsuliyyət</h2>
                    <p>Zəmanət şərtləri:</p>
                    <ul>
                        <li>100% qəbul zəmanəti veririk</li>
                        <li>Xidmətlərimizin keyfiyyətini zəmanət edirik</li>
                        <li>Qəbul olunmayan hallarda tam geri qaytarma</li>
                        <li>Məlumatların dəqiqliyini zəmanət edirik</li>
                    </ul>
                    
                    <h2>8. Məlumatların İstifadəsi</h2>
                    <p>Veb saytımızda təqdim etdiyiniz məlumatlar:</p>
                    <ul>
                        <li>Xidmətlərimizi təqdim etmək üçün istifadə olunur</li>
                        <li>Gizlilik siyasətimizə uyğun qorunur</li>
                        <li>Üçüncü tərəflərlə razılıq olmadan paylaşılmır</li>
                        <li>Qanuni tələblərə uyğun saxlanılır</li>
                    </ul>
                    
                    <h2>9. İntellektual Mülkiyyət</h2>
                    <p>Veb saytımızın məzmunu:</p>
                    <ul>
                        <li>OstWindGroup-un mülkiyyətidir</li>
                        <li>Müəllif hüquqları qorunur</li>
                        <li>İcazəsiz istifadə qadağandır</li>
                        <li>Kopyalama və paylaşma qadağandır</li>
                    </ul>
                    
                    <h2>10. Məhdudiyyətlər</h2>
                    <p>Veb saytımızın istifadəsi ilə bağlı məhdudiyyətlər:</p>
                    <ul>
                        <li>Qanunsuz məqsədlər üçün istifadə qadağandır</li>
                        <li>Virus və zərərli proqram təqdim etmək qadağandır</li>
                        <li>Digər istifadəçiləri narahat etmək qadağandır</li>
                        <li>Sistemə zərər vurmaq qadağandır</li>
                    </ul>
                    
                    <h2>11. Dəyişikliklər</h2>
                    <p>Bu İstifadə Şərtlərini istənilən vaxt dəyişə bilərik. Dəyişikliklər veb saytımızda dərc ediləcək və sizə bildiriləcək.</p>
                    
                    <h2>12. Əlaqə</h2>
                    <p>Bu İstifadə Şərtləri ilə bağlı suallarınız varsa, bizimlə əlaqə saxlayın:</p>
                    <ul>
                        <li><strong>E-poçt:</strong> legal@ostwindgroup.com</li>
                        <li><strong>Telefon:</strong> +380 96 258 00 00</li>
                        <li><strong>Ünvan:</strong> Bakı şəhəri, Rüstəm Rüstəmov 44</li>
                    </ul>
                    
                    <h2>13. Qanuni Məhkəmə</h2>
                    <p>Bu İstifadə Şərtləri Azərbaycan Respublikasının qanunlarına uyğun olaraq təfsil edilir. Hər hansı mübahisə Azərbaycan məhkəmələrində həll edilir.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 