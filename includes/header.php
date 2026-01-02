<?php
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$current_lang = $language->getCurrentLang();
$translations = $language->getTranslations();

// Security headers + CSP (nonce-based)
$csp_nonce = base64_encode(random_bytes(16));
$GLOBALS['ostwind_csp_nonce'] = $csp_nonce;

if (!headers_sent()) {
    $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
    if ($is_https) {
        header('Strict-Transport-Security: max-age=15552000; includeSubDomains');
    }

    $csp = "default-src 'self'; "
        . "base-uri 'self'; "
        . "object-src 'none'; "
        . "form-action 'self'; "
        . "frame-ancestors 'self'; "
        . "img-src 'self' data: https:; "
        . "style-src 'self' 'unsafe-inline' https://unpkg.com; "
        . "script-src 'self' 'nonce-{$csp_nonce}' https://unpkg.com https://embed.tawk.to; "
        . "connect-src 'self' https://embed.tawk.to https://*.tawk.to wss://*.tawk.to; "
        . "frame-src 'self' https://www.google.com https://embed.tawk.to https://*.tawk.to;";
    header('Content-Security-Policy: ' . $csp);
}

// Sayfa başlığı varsayılan değeri
if (!isset($page_title)) {
    $page_title = $translations['site_title'] ?? 'OstWindGroup';
}

// Tema modu
$theme_class = get_theme_class();
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>" class="<?php echo $theme_class; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Ukraynada və xaricdə keyfiyyətli təhsil almaq üçün OstWindGroup - 2013-cü ildən bəri 2500+ uğurlu tələbə. Universitet qəbulu, viza, konaklama və tam dəstək xidmətləri.">
    <meta name="keywords" content="ukraynada təhsil, xaricdə təhsil, xarkov universitetləri, ukrayna universitetləri, xaricdə oxumaq, tələbə vizası, ukraynada təhsil qiymətləri, attestatla ali təhsil">
    <meta name="author" content="OstWindGroup">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="Ukraynada və xaricdə keyfiyyətli təhsil almaq üçün OstWindGroup - 2013-cü ildən bəri 2500+ uğurlu tələbə.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://ostwindgroup.com">
    <meta property="og:image" content="https://ostwindgroup.com/images/og-image.jpg">
    <meta property="og:site_name" content="OstWindGroup">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta name="twitter:description" content="Ukraynada və xaricdə keyfiyyətli təhsil almaq üçün OstWindGroup - 2013-cü ildən bəri 2500+ uğurlu tələbə.">
    <meta name="twitter:image" content="https://ostwindgroup.com/images/twitter-card.jpg">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://ostwindgroup.com<?php echo $_SERVER['REQUEST_URI']; ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">
    
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <?php if (isset($additional_css)): ?>
        <?php echo $additional_css; ?>
    <?php endif; ?>
    
    <!-- Custom AOS Animations -->
    <style>
        /* Custom AOS Animations */
        [data-aos="custom-fade-up"] {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }
        
        [data-aos="custom-fade-up"].aos-animate {
            opacity: 1;
            transform: translateY(0);
        }
        
        [data-aos="custom-zoom-in"] {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.6s ease;
        }
        
        [data-aos="custom-zoom-in"].aos-animate {
            opacity: 1;
            transform: scale(1);
        }
        
        [data-aos="custom-slide-left"] {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.6s ease;
        }
        
        [data-aos="custom-slide-left"].aos-animate {
            opacity: 1;
            transform: translateX(0);
        }
        
        [data-aos="custom-slide-right"] {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.6s ease;
        }
        
        [data-aos="custom-slide-right"].aos-animate {
            opacity: 1;
            transform: translateX(0);
        }
    </style>
</head>
<body>
    <!-- Dark/Light Mode Toggle Button -->
    <button class="theme-toggle" title="<?php echo $translations['toggle_theme'] ?? 'Toggle Theme'; ?>" aria-label="Tema değiştir">
        <span id="theme-icon">🌙</span>
    </button>

    <script nonce="<?php echo htmlspecialchars($csp_nonce, ENT_QUOTES, 'UTF-8'); ?>">
        // Theme toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🔍 Header.php - Tema toggle başlatılıyor...');
            
            const themeToggle = document.querySelector('.theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            
            console.log('🔘 Tema toggle butonu:', themeToggle);
            console.log('🎯 Tema icon:', themeIcon);
            
            if (themeToggle && themeIcon) {
                console.log('✅ Tema toggle butonu bulundu');
                
                // Initialize theme
                const savedTheme = localStorage.getItem('theme') || 'light';
                console.log('💾 Kaydedilen tema:', savedTheme);
                
                if (savedTheme === 'dark') {
                    document.body.classList.add('dark-mode');
                    themeIcon.textContent = '☀️';
                    console.log('🌙 Dark mode aktif');
                } else {
                    document.body.classList.remove('dark-mode');
                    themeIcon.textContent = '🌙';
                    console.log('☀️ Light mode aktif');
                }

                // Theme toggle event listener
                themeToggle.addEventListener('click', function() {
                    console.log('🖱️ Tema toggle butonuna tıklandı');
                    
                    const isDarkMode = document.body.classList.contains('dark-mode');
                    const newTheme = isDarkMode ? 'light' : 'dark';
                    
                    console.log('🔄 Tema değiştiriliyor:', isDarkMode ? 'dark' : 'light', '->', newTheme);
                    
                    if (newTheme === 'dark') {
                        document.body.classList.add('dark-mode');
                        themeIcon.textContent = '☀️';
                        console.log('🌙 Dark mode açıldı');
                    } else {
                        document.body.classList.remove('dark-mode');
                        themeIcon.textContent = '🌙';
                        console.log('☀️ Light mode açıldı');
                    }
                    
                    localStorage.setItem('theme', newTheme);
                    console.log('💾 Tema kaydedildi:', newTheme);
                });
                
                console.log('✅ Event listener eklendi');
            } else {
                console.error('❌ Tema toggle butonu bulunamadı!');
                console.log('🔍 Theme toggle:', themeToggle);
                console.log('🔍 Theme icon:', themeIcon);
            }
        });
    </script>

    <header class="header">
        <nav class="nav">
            <div class="nav-brand">
                <a href="index.php"><?php echo $translations['site_title'] ?? 'OstWindGroup'; ?></a>
            </div>
            
                            <div class="nav-right">
                    <ul class="nav-menu">
                        <li><a href="index.php"><?php echo $translations['nav_home'] ?? 'Home'; ?></a></li>
                        <li><a href="education-form.php">🎓 Təhsil Formu</a></li>
                        <li><a href="contact.php"><?php echo $translations['nav_contact'] ?? 'Bizimlə əlaqə'; ?></a></li>
                        <?php if (is_logged_in()): ?>
                            <li><a href="profile.php"><?php echo $translations['nav_profile'] ?? 'Profile'; ?></a></li>
                            <li><a href="logout.php"><?php echo $translations['nav_logout'] ?? 'Logout'; ?></a></li>
                        <?php else: ?>
                            <li><a href="login.php"><?php echo $translations['nav_login'] ?? 'Login'; ?></a></li>
                            <li><a href="register.php"><?php echo $translations['nav_register'] ?? 'Register'; ?></a></li>
                        <?php endif; ?>
                    </ul>
                
                <div class="language-selector">
                    <select onchange="changeLanguage(this.value)">
                        <option value="tr" <?php echo $current_lang === 'tr' ? 'selected' : ''; ?>>
                            <span class="flag-icon flag-tr"></span> Türkçe
                        </option>
                        <option value="en" <?php echo $current_lang === 'en' ? 'selected' : ''; ?>>
                            <span class="flag-icon flag-en"></span> English
                        </option>
                        <option value="ua" <?php echo $current_lang === 'ua' ? 'selected' : ''; ?>>
                            <span class="flag-icon flag-ua"></span> Українська
                        </option>
                        <option value="az" <?php echo $current_lang === 'az' ? 'selected' : ''; ?>>
                            <span class="flag-icon flag-az"></span> Azərbaycan
                        </option>
                        <option value="ru" <?php echo $current_lang === 'ru' ? 'selected' : ''; ?>>
                            <span class="flag-icon flag-ru"></span> Русский
                        </option>
                    </select>
                </div>
            </div>
        </nav>
    </header>

    <script nonce="<?php echo htmlspecialchars($csp_nonce, ENT_QUOTES, 'UTF-8'); ?>">
        // Language change function
        function changeLanguage(lang) {
            window.location.href = '?lang=' + lang;
        }
    </script> 