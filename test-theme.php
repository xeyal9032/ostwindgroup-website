<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema Test Sayfası</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .test-content {
            padding: 2rem;
            margin-top: 100px;
        }
        .test-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-xl);
            padding: 2rem;
            margin: 1rem 0;
            transition: all var(--transition-normal);
        }
        .test-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--border-medium);
        }
        .test-form {
            max-width: 500px;
            margin: 2rem 0;
        }
        .test-buttons {
            display: flex;
            gap: 1rem;
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <!-- Dark/Light Mode Toggle Button -->
    <button class="theme-toggle" onclick="toggleTheme()" title="Tema değiştir" aria-label="Tema değiştir">
        <span id="theme-icon">🌙</span>
    </button>

    <div class="test-content">
        <h1>Tema Test Sayfası</h1>
        <p>Bu sayfa tema değişikliklerini test etmek için oluşturulmuştur.</p>
        
        <div class="test-card">
            <h2>Test Kartı</h2>
            <p>Bu kart tema değişikliklerinde nasıl göründüğünü test eder.</p>
        </div>
        
        <div class="test-buttons">
            <button class="btn btn-primary">Birincil Buton</button>
            <button class="btn btn-secondary">İkincil Buton</button>
        </div>
        
        <div class="test-form">
            <h3>Form Testi</h3>
            <div class="form-group">
                <label for="test-input">Test Girişi:</label>
                <input type="text" id="test-input" placeholder="Bir şeyler yazın...">
            </div>
            <div class="form-group">
                <label for="test-select">Test Seçimi:</label>
                <select id="test-select">
                    <option value="">Seçiniz...</option>
                    <option value="1">Seçenek 1</option>
                    <option value="2">Seçenek 2</option>
                    <option value="3">Seçenek 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="test-textarea">Test Metin Alanı:</label>
                <textarea id="test-textarea" rows="4" placeholder="Uzun metin yazın..."></textarea>
            </div>
        </div>
    </div>

    <script>
        // Tema toggle fonksiyonu
        function toggleTheme() {
            const isDarkMode = document.body.classList.contains('dark-mode');
            const newTheme = isDarkMode ? 'light' : 'dark';
            
            if (newTheme === 'dark') {
                document.body.classList.add('dark-mode');
                document.getElementById('theme-icon').textContent = '☀️';
            } else {
                document.body.classList.remove('dark-mode');
                document.getElementById('theme-icon').textContent = '🌙';
            }
            
            localStorage.setItem('theme', newTheme);
        }

        // Sayfa yüklendiğinde tema durumunu kontrol et
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                document.getElementById('theme-icon').textContent = '☀️';
            } else {
                document.body.classList.remove('dark-mode');
                document.getElementById('theme-icon').textContent = '🌙';
            }
        });
    </script>
</body>
</html> 