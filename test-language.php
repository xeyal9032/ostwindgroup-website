<?php
require_once 'includes/Language.php';

echo "<h1>Language Test</h1>";

try {
    $language = Language::getInstance();
    echo "<p>✅ Language instance created successfully</p>";
    
    $translations = $language->getTranslations();
    echo "<p>✅ getTranslations() method works</p>";
    echo "<p>Current language: " . $language->getCurrentLang() . "</p>";
    echo "<p>Number of translations: " . count($translations) . "</p>";
    
    if (!empty($translations)) {
        echo "<h3>Sample translations:</h3>";
        echo "<ul>";
        $count = 0;
        foreach ($translations as $key => $value) {
            if ($count < 5) {
                echo "<li><strong>$key:</strong> $value</li>";
                $count++;
            } else {
                break;
            }
        }
        echo "</ul>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}
?> 