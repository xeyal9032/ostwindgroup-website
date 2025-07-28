<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema Butonu Test</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            padding: 100px 20px;
            font-family: Arial, sans-serif;
        }
        .test-content {
            max-width: 800px;
            margin: 0 auto;
            background: var(--bg-primary);
            padding: 40px;
            border-radius: 10px;
            box-shadow: var(--shadow-lg);
            color: var(--text-primary);
        }
        .test-content h1 {
            color: var(--text-primary);
            margin-bottom: 20px;
        }
        .test-content p {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .status {
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            font-weight: bold;
        }
        .status.light {
            background: #e3f2fd;
            color: #1976d2;
            border: 1px solid #2196f3;
        }
        .status.dark {
            background: #424242;
            color: #ffffff;
            border: 1px solid #616161;
        }
    </style>
</head>
<body>
    <!-- Dark/Light Mode Toggle Button -->
    <button class="theme-toggle" title="Tema değiştir" aria-label="Tema değiştir">
        <span id="theme-icon">🌙</span>
    </button>

    <div class="test-content">
        <h1>Tema Değiştirme Butonu Test Sayfası</h1>
        <p>Bu sayfa tema değiştirme butonunun çalışıp çalışmadığını test etmek için oluşturulmuştur.</p>
        
        <div id="status-display" class="status light">
            Mevcut Tema: Açık Mod
        </div>
        
        <p><strong>Test Adımları:</strong></p>
        <ol>
            <li>Sağ üst köşedeki tema butonuna tıklayın</li>
            <li>Sayfanın arka plan renginin değiştiğini gözlemleyin</li>
            <li>Buton ikonunun değiştiğini kontrol edin</li>
            <li>Sayfayı yenileyin ve tercihinizin kaydedildiğini kontrol edin</li>
        </ol>
        
        <p><strong>Beklenen Davranış:</strong></p>
        <ul>
            <li>Buton tıklandığında sayfa renkleri değişmeli</li>
            <li>Buton ikonu 🌙 ↔ ☀️ arasında değişmeli</li>
            <li>Tercih localStorage'da kaydedilmeli</li>
            <li>Sayfa yenilendiğinde tercih korunmalı</li>
        </ul>
    </div>

    <script>
        // Dark/Light Mode Toggle
        function initTheme() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const themeIcon = document.getElementById('theme-icon');
            const statusDisplay = document.getElementById('status-display');
            
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                document.body.classList.remove('light-mode');
                if (themeIcon) themeIcon.textContent = '☀️';
                if (statusDisplay) {
                    statusDisplay.textContent = 'Mevcut Tema: Koyu Mod';
                    statusDisplay.className = 'status dark';
                }
            } else {
                document.body.classList.add('light-mode');
                document.body.classList.remove('dark-mode');
                if (themeIcon) themeIcon.textContent = '🌙';
                if (statusDisplay) {
                    statusDisplay.textContent = 'Mevcut Tema: Açık Mod';
                    statusDisplay.className = 'status light';
                }
            }
        }

        // Theme toggle event listener
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.querySelector('.theme-toggle');
            const statusDisplay = document.getElementById('status-display');
            
            initTheme();
            
            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const currentTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    const themeIcon = document.getElementById('theme-icon');
                    
                    if (newTheme === 'dark') {
                        document.body.classList.add('dark-mode');
                        document.body.classList.remove('light-mode');
                        if (themeIcon) themeIcon.textContent = '☀️';
                        if (statusDisplay) {
                            statusDisplay.textContent = 'Mevcut Tema: Koyu Mod';
                            statusDisplay.className = 'status dark';
                        }
                    } else {
                        document.body.classList.add('light-mode');
                        document.body.classList.remove('dark-mode');
                        if (themeIcon) themeIcon.textContent = '🌙';
                        if (statusDisplay) {
                            statusDisplay.textContent = 'Mevcut Tema: Açık Mod';
                            statusDisplay.className = 'status light';
                        }
                    }
                    
                    localStorage.setItem('theme', newTheme);
                    
                    // Add visual feedback
                    themeToggle.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        themeToggle.style.transform = 'scale(1)';
                    }, 200);
                });
            }
        });
    </script>
</body>
</html> 