<?php
class Language {
    private static $instance = null;
    private $translations = [];
    private $currentLang = 'tr';
    private $availableLanguages = ['tr', 'en', 'ua', 'az', 'ru'];
    
    private function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->loadLanguage();
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function loadLanguage() {
        // Session'dan dil tercihini al
        if (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $this->availableLanguages)) {
            $this->currentLang = $_SESSION['lang'];
        }
        
        // URL'den dil parametresini kontrol et
        if (isset($_GET['lang']) && in_array($_GET['lang'], $this->availableLanguages)) {
            $this->currentLang = $_GET['lang'];
            $_SESSION['lang'] = $this->currentLang;
        }
        
        // Dil dosyasını yükle
        $langFile = __DIR__ . '/../languages/' . $this->currentLang . '.php';
        
        if (file_exists($langFile)) {
            $this->translations = include $langFile;
        } else {
            // Varsayılan olarak Türkçe yükle
            $defaultFile = __DIR__ . '/../languages/tr.php';
            if (file_exists($defaultFile)) {
                $this->translations = include $defaultFile;
            } else {
                // Hata durumunda boş array
                $this->translations = [];
            }
        }
    }
    
    public function get($key, $params = []) {
        // Translations array'inin boş olup olmadığını kontrol et
        if (empty($this->translations)) {
            return $key;
        }
        
        $text = isset($this->translations[$key]) ? $this->translations[$key] : $key;
        
        // Parametreleri değiştir
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $text = str_replace(':' . $param, $value, $text);
            }
        }
        
        return $text;
    }
    
    public function getCurrentLang() {
        return $this->currentLang;
    }
    
    public function getAvailableLanguages() {
        return $this->availableLanguages;
    }
    
    public function getTranslations() {
        return $this->translations;
    }
    
    public function getLanguageName($code) {
        $names = [
            'tr' => 'Türkçe',
            'en' => 'English',
            'ua' => 'Українська',
            'az' => 'Azərbaycan',
            'ru' => 'Русский'
        ];
        
        return isset($names[$code]) ? $names[$code] : $code;
    }
    
    public function getLanguageFlag($code) {
        $flags = [
            'tr' => '🇹🇷',
            'en' => '🇺🇸',
            'ua' => '🇺🇦',
            'az' => '🇦🇿',
            'ru' => '🇷🇺'
        ];
        
        return isset($flags[$code]) ? $flags[$code] : '';
    }
    
    public function renderLanguageSelector() {
        $html = '<div class="language-selector">';
        $html .= '<div class="language-current">';
        $html .= '<span class="language-flag">' . $this->getLanguageFlag($this->currentLang) . '</span>';
        $html .= '<span class="language-name">' . $this->getLanguageName($this->currentLang) . '</span>';
        $html .= '<span class="language-arrow">▼</span>';
        $html .= '</div>';
        $html .= '<div class="language-dropdown">';
        
        foreach ($this->availableLanguages as $lang) {
            $active = ($lang === $this->currentLang) ? 'active' : '';
            $html .= '<a href="?lang=' . $lang . '" class="language-option ' . $active . '">';
            $html .= '<span class="language-flag">' . $this->getLanguageFlag($lang) . '</span>';
            $html .= '<span class="language-name">' . $this->getLanguageName($lang) . '</span>';
            $html .= '</a>';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
}

// Kısayol fonksiyonu
function __($key, $params = []) {
    return Language::getInstance()->get($key, $params);
}
?> 