<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basit Tema Testi</title>
    <style>
        :root {
            --bg-primary: #ffffff;
            --text-primary: #000000;
            --bg-secondary: #f0f0f0;
            --border-light: #cccccc;
        }
        
        .dark-mode {
            --bg-primary: #1a1a1a;
            --text-primary: #ffffff;
            --bg-secondary: #2d2d2d;
            --border-light: #444444;
        }
        
        body {
            background: var(--bg-primary);
            color: var(--text-primary);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 100px 20px;
            transition: all 0.3s ease;
        }
        
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--bg-secondary);
            border: 2px solid var(--border-light);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            z-index: 9999;
        }
        
        .test-box {
            background: var(--bg-secondary);
            border: 2px solid var(--border-light);
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
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
    <button class="theme-toggle" onclick="toggleTheme()">
        <span id="theme-icon">🌙</span>
    </button>
    
    <div class="status" id="status">Tema: Light</div>
    
    <h1>Basit Tema Testi</h1>
    <p>Bu sayfa çok basit bir tema toggle testidir.</p>
    
    <div class="test-box">
        <h2>Test Kutusu</h2>
        <p>Bu kutu tema değişikliğinde renk değiştirmelidir.</p>
    </div>
    
    <script>
        // Basit tema toggle
        function toggleTheme() {
            const body = document.body;
            const themeIcon = document.getElementById('theme-icon');
            const status = document.getElementById('status');
            
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                themeIcon.textContent = '🌙';
                status.textContent = 'Tema: Light';
                localStorage.setItem('theme', 'light');
            } else {
                body.classList.add('dark-mode');
                themeIcon.textContent = '☀️';
                status.textContent = 'Tema: Dark';
                localStorage.setItem('theme', 'dark');
            }
        }
        
        // Sayfa yüklendiğinde tema durumunu kontrol et
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                document.getElementById('theme-icon').textContent = '☀️';
                document.getElementById('status').textContent = 'Tema: Dark';
            }
        });
    </script>
</body>
</html> 