<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basit Tema Testi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .test-container {
            max-width: 800px;
            margin: 120px auto 40px;
            padding: 40px;
            background: var(--bg-primary);
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            color: var(--text-primary);
        }
        .test-section {
            margin-bottom: 30px;
            padding: 20px;
            background: var(--bg-secondary);
            border-radius: 12px;
            border: 1px solid var(--border-light);
        }
        .test-section h2 {
            color: var(--text-primary);
            margin-bottom: 15px;
        }
        .test-section p {
            color: var(--text-secondary);
            line-height: 1.6;
        }
        .color-test {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .color-box {
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            color: white;
        }
        .bg-primary { background: var(--bg-primary); }
        .bg-secondary { background: var(--bg-secondary); }
        .bg-tertiary { background: var(--bg-tertiary); }
        .text-primary { color: var(--text-primary); }
        .text-secondary { color: var(--text-secondary); }
        .border-light { border: 2px solid var(--border-light); }
    </style>
</head>
<body>
    <!-- Dark/Light Mode Toggle Button -->
    <button class="theme-toggle" title="Tema değiştir" aria-label="Tema değiştir">
        <span id="theme-icon">🌙</span>
    </button>

    <div class="test-container">
        <h1>Tema Değiştirme Test Sayfası</h1>
        <p>Bu sayfa tema değiştirme butonunun çalışıp çalışmadığını test etmek için oluşturulmuştur.</p>
        
        <div class="test-section">
            <h2>🎨 Renk Testi</h2>
            <p>Aşağıdaki renk kutuları tema değişikliğini göstermektedir:</p>
            <div class="color-test">
                <div class="color-box bg-primary">Primary Background</div>
                <div class="color-box bg-secondary">Secondary Background</div>
                <div class="color-box bg-tertiary">Tertiary Background</div>
                <div class="color-box text-primary border-light">Primary Text</div>
                <div class="color-box text-secondary border-light">Secondary Text</div>
            </div>
        </div>
        
        <div class="test-section">
            <h2>📝 İçerik Testi</h2>
            <p>Bu bölüm tema değişikliğinde nasıl göründüğünü test etmek için oluşturulmuştur. Tema değiştirme butonuna tıklayarak farklılıkları görebilirsiniz.</p>
        </div>
        
        <div class="test-section">
            <h2>🔧 Özellikler</h2>
            <ul>
                <li>✅ Tema değiştirme butonu sağ üst köşede</li>
                <li>✅ LocalStorage ile tema tercihi kaydediliyor</li>
                <li>✅ Sayfa yenilendiğinde tema korunuyor</li>
                <li>✅ Responsive tasarım</li>
                <li>✅ Smooth geçiş animasyonları</li>
            </ul>
        </div>
        
        <div class="test-section">
            <h2>🎯 Test Talimatları</h2>
            <ol>
                <li>Sağ üst köşedeki tema butonuna tıklayın</li>
                <li>Renk değişikliklerini gözlemleyin</li>
                <li>Sayfayı yenileyin ve temanın korunduğunu kontrol edin</li>
                <li>Farklı cihazlarda test edin</li>
            </ol>
        </div>
    </div>

    <script>
        // Dark/Light Mode Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.querySelector('.theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            
            if (themeToggle && themeIcon) {
                // Initialize theme
                const savedTheme = localStorage.getItem('theme') || 'light';
                if (savedTheme === 'dark') {
                    document.body.classList.add('dark-mode');
                    themeIcon.textContent = '☀️';
                } else {
                    document.body.classList.remove('dark-mode');
                    themeIcon.textContent = '🌙';
                }

                // Theme toggle event listener
                themeToggle.addEventListener('click', function() {
                    const isDarkMode = document.body.classList.contains('dark-mode');
                    const newTheme = isDarkMode ? 'light' : 'dark';
                    
                    if (newTheme === 'dark') {
                        document.body.classList.add('dark-mode');
                        themeIcon.textContent = '☀️';
                    } else {
                        document.body.classList.remove('dark-mode');
                        themeIcon.textContent = '🌙';
                    }
                    
                    localStorage.setItem('theme', newTheme);
                });
            }
        });
    </script>
</body>
</html> 