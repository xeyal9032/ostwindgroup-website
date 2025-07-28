<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema Debug Testi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            padding: 100px 20px;
            font-family: Arial, sans-serif;
        }
        .debug-info {
            background: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .debug-info h2 {
            margin-top: 0;
        }
        .debug-info pre {
            background: #fff;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <!-- Dark/Light Mode Toggle Button -->
    <button class="theme-toggle" title="Tema değiştir" aria-label="Tema değiştir">
        <span id="theme-icon">🌙</span>
    </button>

    <div class="debug-info">
        <h2>🔍 Tema Debug Bilgileri</h2>
        <p>Bu sayfa tema toggle butonunun neden çalışmadığını anlamak için oluşturulmuştur.</p>
        
        <h3>📋 Kontrol Listesi:</h3>
        <ul>
            <li>✅ Tema toggle butonu görünüyor mu?</li>
            <li>✅ Butona tıklayınca tepki veriyor mu?</li>
            <li>✅ Console'da hata var mı?</li>
            <li>✅ LocalStorage çalışıyor mu?</li>
        </ul>
        
        <h3>🎯 Test Adımları:</h3>
        <ol>
            <li>Sağ üst köşede tema butonunu arayın</li>
            <li>Butona tıklayın</li>
            <li>Sayfa renginin değişip değişmediğini kontrol edin</li>
            <li>F12 ile console'u açın ve hata var mı bakın</li>
            <li>Sayfayı yenileyin ve temanın korunup korunmadığını kontrol edin</li>
        </ol>
        
        <h3>🔧 Manuel Test:</h3>
        <p>Console'da şu komutları deneyin:</p>
        <pre>
// Tema durumunu kontrol et
localStorage.getItem('theme')

// Dark mode'u manuel olarak aç
document.body.classList.add('dark-mode')
localStorage.setItem('theme', 'dark')

// Light mode'u manuel olarak aç
document.body.classList.remove('dark-mode')
localStorage.setItem('theme', 'light')
        </pre>
    </div>

    <div class="debug-info">
        <h3>🎨 Renk Testi</h3>
        <div style="background: var(--bg-primary); color: var(--text-primary); padding: 20px; border-radius: 8px; margin: 10px 0;">
            <h4>Primary Background & Text</h4>
            <p>Bu kutu tema değişikliğinde renk değiştirmelidir.</p>
        </div>
        
        <div style="background: var(--bg-secondary); color: var(--text-secondary); padding: 20px; border-radius: 8px; margin: 10px 0;">
            <h4>Secondary Background & Text</h4>
            <p>Bu kutu da tema değişikliğinde renk değiştirmelidir.</p>
        </div>
    </div>

    <script>
        // Debug bilgileri
        console.log('🔍 Tema Debug başlatılıyor...');
        
        document.addEventListener('DOMContentLoaded', function() {
            console.log('📄 DOM yüklendi');
            
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
        
        // Sayfa yüklendiğinde debug bilgileri
        window.addEventListener('load', function() {
            console.log('🌐 Sayfa tamamen yüklendi');
            console.log('🎨 Mevcut tema:', localStorage.getItem('theme') || 'light');
            console.log('🌙 Dark mode aktif mi:', document.body.classList.contains('dark-mode'));
        });
    </script>
</body>
</html> 