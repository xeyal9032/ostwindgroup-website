<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Tema Testi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            padding: 100px 20px;
            font-family: Arial, sans-serif;
            transition: all 0.3s ease;
        }
        .test-box {
            background: var(--bg-primary);
            color: var(--text-primary);
            border: 2px solid var(--border-light);
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .status {
            position: fixed;
            top: 80px;
            right: 20px;
            background: #333;
            color: white;
            padding: 10px;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <!-- Dark/Light Mode Toggle Button -->
    <button class="theme-toggle" title="Tema değiştir" aria-label="Tema değiştir">
        <span id="theme-icon">🌙</span>
    </button>

    <div class="status" id="status">Tema: Light</div>

    <h1>Tema Testi - Final</h1>
    <p>Bu sayfa tema toggle butonunun gerçekten çalışıp çalışmadığını test eder.</p>

    <div class="test-box">
        <h2>Test Kutusu 1</h2>
        <p>Bu kutu tema değişikliğinde renk değiştirmelidir.</p>
    </div>

    <div class="test-box">
        <h2>Test Kutusu 2</h2>
        <p>Bu kutu da tema değişikliğinde renk değiştirmelidir.</p>
    </div>

    <div class="test-box">
        <h2>Test Kutusu 3</h2>
        <p>Bu kutu da tema değişikliğinde renk değiştirmelidir.</p>
    </div>

    <script>
        // Basit tema toggle
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.querySelector('.theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const status = document.getElementById('status');
            
            // Initialize
            const savedTheme = localStorage.getItem('theme') || 'light';
            updateTheme(savedTheme);
            
            // Event listener
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    const currentTheme = localStorage.getItem('theme') || 'light';
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    updateTheme(newTheme);
                });
            }
            
            function updateTheme(theme) {
                if (theme === 'dark') {
                    document.body.classList.add('dark-mode');
                    themeIcon.textContent = '☀️';
                    status.textContent = 'Tema: Dark';
                } else {
                    document.body.classList.remove('dark-mode');
                    themeIcon.textContent = '🌙';
                    status.textContent = 'Tema: Light';
                }
                localStorage.setItem('theme', theme);
            }
        });
    </script>
</body>
</html> 