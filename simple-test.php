<?php
echo "Hello World!";
echo "<br>";
echo "PHP Version: " . phpversion();
echo "<br>";
echo "Current Directory: " . getcwd();
echo "<br>";
echo "Files in directory:";
echo "<ul>";
$files = scandir('.');
foreach($files as $file) {
    if($file != '.' && $file != '..') {
        echo "<li>$file</li>";
    }
}
echo "</ul>";
?> 