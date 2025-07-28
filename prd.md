# Product Requirements Document (PRD)
## OstWindGroup - Ukrayna Təhsil Konsultasiya Platformu

---

## 1. Proje Genel Bakışı

### 1.1 Proje Adı
**OstWindGroup** - Ukrayna Təhsil Konsultasiya Platformu

### 1.2 Proje Açıklaması
OstWindGroup, Azərbaycanlı tələbələrin Ukrayna universitetlərində təhsil alması üçün tam xidmət göstərən konsultasiya platformudur. Platforma universitet seçimi, qəbul prosesi, sənəd hazırlama və viza dəstəyi kimi xidmətləri təqdim edir.

### 1.3 Məqsəd və Hədəflər
- **Əsas Məqsəd**: Azərbaycanlı tələbələrin Ukrayna universitetlərində təhsil almasını asanlaşdırmaq
- **Hədəflər**:
  - Ukrayna universitetləri haqqında ətraflı məlumat təqdim etmək
  - Qəbul prosesini sadələşdirmək
  - Peşəkar konsultasiya xidmətləri göstərmək
  - Tələbə rəyləri və təcrübələrini paylaşmaq
  - Çoxdilli dəstək təmin etmək

### 1.4 Hədəf Auditoriya
- **Əsas Hədəf**: Azərbaycanlı tələbələr (17-25 yaş)
- **İkinci Hədəf**: Tələbə valideynləri
- **Üçüncü Hədəf**: Təhsil müəssisələri və konsultantlar

---

## 2. Texniki Spesifikasiyalar

### 2.1 Texnologiya Stack
- **Backend**: PHP 7.4+
- **Frontend**: HTML5, CSS3, JavaScript
- **Server**: PHP Built-in Server (Development)
- **Dil Dəstəyi**: Çoxdilli sistem (Azərbaycan, Türk, İngilis, Ukrayna, Rus)
- **Animasiyalar**: AOS (Animate On Scroll)
- **Responsive Design**: Mobile-first approach

### 2.2 Fayl Strukturu
```
/
├── index.php                 # Ana səhifə
├── universities.php          # Universitetlər səhifəsi
├── faculties.php             # Fakultələr və ixtisaslar
├── documents.php             # Sənədlər və rehberlər
├── testimonials.php          # Tələbə rəyləri
├── contact.php               # Əlaqə səhifəsi
├── register.php              # Qeydiyyat səhifəsi
├── consultation.php          # Konsultasiya səhifəsi
├── login.php                 # Giriş səhifəsi
├── logout.php                # Çıxış
├── profile.php               # Profil səhifəsi
├── includes/
│   ├── database.php          # Veritabanı konfiqurasiyası
│   ├── Language.php          # Dil sistemi
│   ├── helpers.php           # Köməkçi funksiyalar
│   ├── header.php            # Səhifə başlığı
│   └── footer.php            # Səhifə ayağı
├── languages/
│   ├── az.php                # Azərbaycan dili
│   ├── tr.php                # Türk dili
│   ├── en.php                # İngilis dili
│   ├── ua.php                # Ukrayna dili
│   └── ru.php                # Rus dili
├── assets/
│   ├── css/                  # CSS faylları
│   ├── js/                   # JavaScript faylları
│   └── images/               # Şəkillər
└── prd.md                    # Bu sənəd
```

---

## 3. Funksional Tələblər

### 3.1 Ana Səhifə (index.php)
**Məqsəd**: Platformanın əsas giriş nöqtəsi və xidmətlərin ümumi baxışı

**Funksiyalar**:
- Hero bölməsi (əsas mesaj və CTA)
- Sürətli keçidlər (6 əsas səhifəyə link)
- CTA bölməsi (konsultasiya və qeydiyyat)
- Responsive dizayn
- AOS animasiyaları

**Məzmun**:
- Platforma haqqında qısa məlumat
- Əsas xidmətlərin siyahısı
- Əlaqə məlumatları
- Dil seçimi

### 3.2 Universitetlər Səhifəsi (universities.php)
**Məqsəd**: Ukrayna universitetləri haqqında ətraflı məlumat

**Funksiyalar**:
- Universitet kartları
- Hər universitet üçün ətraflı məlumat
- Yerləşmə məlumatları
- Qiymət məlumatları
- Ətraflı baxış linkləri

**Məzmun**:
- Kyiv National University
- Lviv Polytechnic National University
- Kharkiv National University
- Odesa National University
- Və digər universitetlər

### 3.3 Fakultələr Səhifəsi (faculties.php)
**Məqsəd**: Mövcud fakultələr və ixtisaslar haqqında məlumat

**Funksiyalar**:
- Fakultə kateqoriyaları
- İxtisas siyahıları
- Təhsil müddətləri
- Karyera imkanları

**Kateqoriyalar**:
- Tibb və Sağlamlıq
- Mühəndislik və Texnologiya
- Humanitar Elmlər
- Təbiət Elmləri
- İqtisadiyyat və Biznes
- Hüquq və Siyasi Elmlər

### 3.4 Sənədlər Səhifəsi (documents.php)
**Məqsəd**: Qəbul üçün lazım olan sənədlər və rehberlər

**Funksiyalar**:
- Lazımi sənədlərin siyahısı
- Endirilə bilən fayllar
- Rehberlər və nümunələr
- Viza məlumatları

**Məzmun**:
- Müraciət forması
- Motivasiya məktubu nümunəsi
- Viza rehberi
- Yerləşmə rehberi
- Burs rehberi
- Diploma tanınma məlumatları

### 3.5 Tələbə Rəyləri (testimonials.php)
**Məqsəd**: Uğurlu tələbələrin təcrübələrini paylaşmaq

**Funksiyalar**:
- Tələbə rəyləri
- Video rəylər
- Universitetə görə filtr
- Rəy əlavə etmə forması
- Statistika məlumatları

**Məzmun**:
- Uğurlu tələbə hekayələri
- Təcrübə paylaşımları
- Məsləhətlər
- Statistika (tələbə sayı, məmnuniyyət dərəcəsi)

### 3.6 Əlaqə Səhifəsi (contact.php)
**Məqsəd**: İstifadəçilərin komanda ilə əlaqə saxlaması

**Funksiyalar**:
- Əlaqə forması
- Əlaqə məlumatları
- Xəritə
- İş saatları

**Məzmun**:
- Telefon nömrələri
- E-poçt ünvanları
- Fiziki ünvan
- Sosial media linkləri

### 3.7 Qeydiyyat Səhifəsi (register.php)
**Məqsəd**: Yeni istifadəçilərin qeydiyyatdan keçməsi

**Funksiyalar**:
- Qeydiyyat forması
- Validasiya
- Şifrə təhlükəsizliyi
- E-poçt təsdiqi

**Məlumat sahələri**:
- İstifadəçi adı
- E-poçt
- Şifrə
- Şifrə təsdiqi

### 3.8 Konsultasiya Səhifəsi (consultation.php)
**Məqsəd**: Pulsuz konsultasiya xidməti təklifi

**Funksiyalar**:
- Konsultasiya forması
- Xidmət təsvirləri
- Maraqlı universitet/ixtisas seçimi
- Avtomatik cavab sistemi

**Xidmətlər**:
- Pulsuz ilk görüş
- Universitet seçimi
- İxtisas məsləhəti
- Maliyyə planlaması
- Sənəd hazırlama
- Viza dəstəyi

---

## 4. Qeyri-Funksional Tələblər

### 4.1 Performans
- **Səhifə yükləmə müddəti**: < 3 saniyə
- **Server cavab müddəti**: < 500ms
- **Eyni vaxtda istifadəçi**: 100+

### 4.2 Təhlükəsizlik
- **Şifrə təhlükəsizliyi**: Minimum 8 simvol, böyük/kiçik hərf, rəqəm
- **SQL Injection qorunması**: Prepared statements
- **XSS qorunması**: Input sanitization
- **CSRF qorunması**: Token-based protection

### 4.3 Responsive Dizayn
- **Desktop**: 1920px və yuxarı
- **Tablet**: 768px - 1024px
- **Mobile**: 320px - 767px
- **Touch-friendly**: Minimum 44px touch targets

### 4.4 Brauzer Dəstəyi
- **Chrome**: 90+
- **Firefox**: 88+
- **Safari**: 14+
- **Edge**: 90+

### 4.5 Erişim (Accessibility)
- **WCAG 2.1 AA** standartları
- **Keyboard navigation** dəstəyi
- **Screen reader** uyğunluğu
- **Color contrast** tələbləri

---

## 5. Dil Sistemi

### 5.1 Dəstəklənən Dillər
1. **Azərbaycan dili** (az) - Əsas dil
2. **Türk dili** (tr) - İkinci dil
3. **İngilis dili** (en) - Beynəlxalq dil
4. **Ukrayna dili** (ua) - Hədəf ölkə dili
5. **Rus dili** (ru) - Regional dil

### 5.2 Dil Sistemi Xüsusiyyətləri
- **Session-based** dil seçimi
- **URL parameter** dəstəyi (?lang=az)
- **Fallback** sistemi
- **Dynamic content** tərcüməsi
- **Language selector** komponenti

### 5.3 Tərcümə Strukturu
```php
// languages/az.php
return [
    'universities_title' => 'Ukrayna Universitetləri',
    'faculties_title' => 'Fakultələr və İxtisaslar',
    'contact_title' => 'Bizimlə Əlaqə',
    // ... digər tərcümələr
];
```

---

## 6. İstifadəçi Təcrübəsi (UX)

### 6.1 Naviqasiya
- **Top navigation bar** - Əsas səhifələr
- **Breadcrumbs** - Səhifə yolu
- **Quick links** - Sürətli keçidlər
- **Footer links** - Əlavə məlumatlar

### 6.2 Vizual Dizayn
- **Color scheme**: Professional blue/white
- **Typography**: Modern, readable fonts
- **Icons**: Emoji və SVG ikonlar
- **Animations**: Subtle AOS animasiyaları

### 6.3 İnteraktiv Elementlər
- **Hover effects** - Kartlar və düymələr
- **Smooth transitions** - Səhifə keçidləri
- **Loading states** - Yükləmə göstəriciləri
- **Form validation** - Real-time validasiya

---

## 7. Veritabanı Strukturu

### 7.1 Əsas Cədvəllər
```sql
-- İstifadəçilər
users (
    id, username, email, password, 
    created_at, updated_at, status
)

-- Universitetlər
universities (
    id, name, location, description, 
    website, contact_info, image
)

-- Fakultələr
faculties (
    id, name, university_id, description, 
    duration, requirements
)

-- Tələbə rəyləri
testimonials (
    id, student_name, university, program, 
    rating, review, created_at
)

-- Konsultasiya müraciətləri
consultations (
    id, name, email, phone, 
    interested_university, interested_specialty, 
    message, status, created_at
)
```

---

## 8. SEO və Marketing

### 8.1 SEO Optimizasiyası
- **Meta tags** - Hər səhifə üçün
- **Structured data** - Schema markup
- **Sitemap** - XML sitemap
- **Robots.txt** - Search engine directives

### 8.2 Content Strategy
- **Blog section** - Təhsil məqalələri
- **FAQ section** - Tez-tez soruşulan suallar
- **Success stories** - Uğur hekayələri
- **News section** - Təhsil xəbərləri

### 8.3 Social Media Integration
- **Social sharing** - Səhifə paylaşımı
- **Social login** - Sosial media ilə giriş
- **Social proof** - Sosial media rəyləri

---

## 9. Analytics və Monitoring

### 9.1 Web Analytics
- **Google Analytics** - İstifadəçi davranışı
- **Heatmaps** - Səhifə istifadəsi
- **Conversion tracking** - Məqsəd tamamlama
- **A/B testing** - Performans testləri

### 9.2 Performance Monitoring
- **Page load times** - Səhifə yükləmə müddəti
- **Server response times** - Server cavab müddəti
- **Error tracking** - Xəta izləmə
- **Uptime monitoring** - Sistem işləmə müddəti

---

## 10. Təhlükəsizlik Tələbləri

### 10.1 Data Protection
- **GDPR compliance** - Məlumat qorunması
- **Data encryption** - Məlumat şifrələmə
- **Secure storage** - Təhlükəsiz saxlama
- **Data backup** - Məlumat yedəkləmə

### 10.2 Authentication & Authorization
- **Secure login** - Təhlükəsiz giriş
- **Password hashing** - Şifrə hash-ləmə
- **Session management** - Sessiya idarəetməsi
- **Role-based access** - Rol əsaslı giriş

---

## 11. Deployment və Hosting

### 11.1 Development Environment
- **Local development** - PHP built-in server
- **Version control** - Git
- **Code review** - Pull request process
- **Testing** - Unit və integration testlər

### 11.2 Production Environment
- **Web server** - Apache/Nginx
- **PHP version** - 7.4+
- **Database** - MySQL 8.0+
- **SSL certificate** - HTTPS dəstəyi
- **CDN** - Content delivery network

---

## 12. Gələcək İnkişaf Planları

### 12.1 Qısa Müddətli (3-6 ay)
- **Mobile app** - iOS və Android
- **Live chat** - Canlı söhbət
- **Video consultations** - Video konsultasiyalar
- **Payment integration** - Ödəniş sistemi

### 12.2 Orta Müddətli (6-12 ay)
- **AI chatbot** - Süni intellekt söhbət botu
- **Personalized recommendations** - Fərdi tövsiyələr
- **Advanced analytics** - Təkmilləşdirilmiş analitika
- **Multi-language content** - Çoxdilli məzmun

### 12.3 Uzun Müddətli (1+ il)
- **International expansion** - Beynəlxalq genişlənmə
- **Partnership integrations** - Tərəfdaşlıq inteqrasiyaları
- **Advanced AI features** - Təkmilləşdirilmiş AI xüsusiyyətləri
- **Blockchain integration** - Blockchain inteqrasiyası

---

## 13. Risk Analizi

### 13.1 Texniki Risklər
- **Server downtime** - Server dayanıqlığı
- **Data loss** - Məlumat itkisi
- **Security breaches** - Təhlükəsizlik pozuntuları
- **Performance issues** - Performans problemləri

### 13.2 Biznes Risklər
- **Market competition** - Bazar rəqabəti
- **Regulatory changes** - Qanunvericilik dəyişiklikləri
- **Economic factors** - İqtisadi amillər
- **User adoption** - İstifadəçi qəbulu

### 13.3 Risk Mitigation
- **Regular backups** - Müntəzəm yedəkləmə
- **Security audits** - Təhlükəsizlik auditləri
- **Performance monitoring** - Performans izləmə
- **User feedback** - İstifadəçi rəyi

---

## 14. Success Metrics

### 14.1 User Engagement
- **Page views** - Səhifə baxışları
- **Session duration** - Sessiya müddəti
- **Bounce rate** - Sıçrama dərəcəsi
- **Return visitors** - Təkrar ziyarətçilər

### 14.2 Business Metrics
- **Lead generation** - Potensial müştəri əldə etmə
- **Conversion rate** - Çevrilmə dərəcəsi
- **Customer satisfaction** - Müştəri məmnuniyyəti
- **Revenue growth** - Gəlir artımı

### 14.3 Technical Metrics
- **Page load speed** - Səhifə yükləmə sürəti
- **Uptime** - İşləmə müddəti
- **Error rate** - Xəta dərəcəsi
- **Mobile performance** - Mobil performans

---

## 15. Nəticə

Bu PRD sənədi OstWindGroup platformasının tam funksional tələblərini, texniki spesifikasiyalarını və gələcək inkişaf planlarını əhatə edir. Platforma Azərbaycanlı tələbələrin Ukrayna universitetlərində təhsil almasını asanlaşdırmaq üçün dizayn edilmişdir və müasir web texnologiyalarından istifadə edərək istifadəçi dostu təcrübə təqdim edir.

**Əsas Uğur Faktorları:**
- Çoxdilli dəstək
- Responsive dizayn
- Peşəkar konsultasiya xidmətləri
- İstifadəçi dostu interfeys
- Təhlükəsiz və etibarlı sistem

**Növbəti Addımlar:**
1. Bu PRD-nin təsdiqlənməsi
2. Texniki dizayn sənədlərinin hazırlanması
3. Development timeline-in müəyyən edilməsi
4. Resource allocation-un planlaşdırılması
5. Development prosesinin başladılması

---

**Sənəd Versiyası**: 1.0  
**Son Yeniləmə**: 2024  
**Hazırlayan**: AI Assistant  
**Təsdiqləyən**: [Təsdiqləyən şəxs] 