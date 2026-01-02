<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Kullanıcı zaten giriş yapmışsa ana sayfaya yönlendir
if (is_logged_in()) {
    redirect_to_home();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!require_valid_csrf_post()) {
        $error = $translations['csrf_invalid'] ?? 'Security check failed. Please refresh the page and try again.';
    } else {
    $student_number = clean_input($_POST['student_number'] ?? '');
    $first_name = clean_input($_POST['first_name'] ?? '');
    $last_name = clean_input($_POST['last_name'] ?? '');
    $email = clean_input($_POST['email'] ?? '');
    $phone = clean_input($_POST['phone'] ?? '');
    $birth_date = clean_input($_POST['birth_date'] ?? '');
    $nationality = clean_input($_POST['nationality'] ?? '');
    $passport_number = clean_input($_POST['passport_number'] ?? '');
    $address = clean_input($_POST['address'] ?? '');
    $country = clean_input($_POST['country'] ?? '');
    $city = clean_input($_POST['city'] ?? '');
    $program = clean_input($_POST['program'] ?? '');
    $university = clean_input($_POST['university'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validasyon
    if (empty($student_number) || empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $error = $translations['validation_required'] ?? 'Bu sahə məcburidir.';
    } elseif (!is_valid_email($email)) {
        $error = $translations['validation_email'] ?? 'Zəhmət olmasa düzgün email ünvanı daxil edin.';
    } elseif (!is_strong_password($password)) {
        $error = $translations['validation_weak_password'] ?? 'Şifrə ən azı 8 simvol olmalı və böyük hərf, kiçik hərf və rəqəmlər tərkibində olmalıdır.';
    } elseif ($password !== $confirm_password) {
        $error = $translations['validation_password_match'] ?? 'Şifrələr uyğun gəlmir.';
    } else {
        try {
            // Öğrenci numarası kontrolü
            $stmt = $conn->prepare("SELECT id FROM students WHERE student_number = ?");
            $stmt->execute([$student_number]);
            if ($stmt->fetch()) {
                $error = $translations['validation_student_number_exists'] ?? 'Bu tələbə nömrəsi artıq mövcuddur.';
            } else {
                // Email kontrolü
                $stmt = $conn->prepare("SELECT id FROM students WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $error = $translations['validation_email_exists'] ?? 'Bu email ünvanı artıq mövcuddur.';
                } else {
                    // Öğrenciyi kaydet
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO students (student_number, first_name, last_name, email, phone, birth_date, nationality, passport_number, address, country, city, program, university, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$student_number, $first_name, $last_name, $email, $phone, $birth_date, $nationality, $passport_number, $address, $country, $city, $program, $university, $hashed_password]);
                    
                    $success = $translations['student_register_success'] ?? 'Qeydiyyat uğurla tamamlandı! İndi giriş edə bilərsiniz.';
                }
            }
        } catch (PDOException $e) {
            $error = $translations['student_register_error'] ?? 'Qeydiyyat zamanı xəta baş verdi.';
        }
    }
    }
}

$page_title = $translations['student_register_title'] ?? 'Tələbə Qeydiyyatı';
include 'includes/header.php';
?>

<main class="container" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="card" style="max-width: 600px; width: 100%;" data-aos="fade-up" data-aos-duration="800">
        <h2 style="text-align: center; margin-bottom: 2rem;"><?php echo $translations['student_register_title'] ?? 'Tələbə Qeydiyyatı'; ?></h2>
        
        <?php if ($error): ?>
            <div class="message error" data-aos="fade-down" data-aos-duration="600"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="message success" data-aos="fade-down" data-aos-duration="600"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <?php echo csrf_input_field(); ?>
            <div class="form-row">
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <label for="student_number"><?php echo $translations['student_number'] ?? 'Tələbə Nömrəsi'; ?> *</label>
                    <input type="text" id="student_number" name="student_number" required value="<?php echo htmlspecialchars($_POST['student_number'] ?? ''); ?>">
                </div>
                
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="250">
                    <label for="first_name"><?php echo $translations['first_name'] ?? 'Ad'; ?> *</label>
                    <input type="text" id="first_name" name="first_name" required value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <label for="last_name"><?php echo $translations['last_name'] ?? 'Soyad'; ?> *</label>
                    <input type="text" id="last_name" name="last_name" required value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>">
                </div>
                
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="350">
                    <label for="email"><?php echo $translations['email'] ?? 'Email'; ?> *</label>
                    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <label for="phone"><?php echo $translations['phone'] ?? 'Telefon'; ?></label>
                    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                </div>
                
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="450">
                    <label for="birth_date"><?php echo $translations['birth_date'] ?? 'Doğum Tarixi'; ?></label>
                    <input type="date" id="birth_date" name="birth_date" value="<?php echo htmlspecialchars($_POST['birth_date'] ?? ''); ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                    <label for="nationality"><?php echo $translations['nationality'] ?? 'Milliyyət'; ?></label>
                    <input type="text" id="nationality" name="nationality" value="<?php echo htmlspecialchars($_POST['nationality'] ?? ''); ?>">
                </div>
                
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="550">
                    <label for="passport_number"><?php echo $translations['passport_number'] ?? 'Pasport Nömrəsi'; ?></label>
                    <input type="text" id="passport_number" name="passport_number" value="<?php echo htmlspecialchars($_POST['passport_number'] ?? ''); ?>">
                </div>
            </div>
            
            <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                <label for="address"><?php echo $translations['address'] ?? 'Ünvan'; ?></label>
                <textarea id="address" name="address" rows="3"><?php echo htmlspecialchars($_POST['address'] ?? ''); ?></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="650">
                    <label for="country"><?php echo $translations['country'] ?? 'Ölkə'; ?></label>
                    <select id="country" name="country">
                        <option value=""><?php echo $translations['select_country'] ?? 'Ölkə seçin'; ?></option>
                        <option value="Azərbaycan" <?php echo ($_POST['country'] ?? '') === 'Azərbaycan' ? 'selected' : ''; ?>>Azərbaycan</option>
                        <option value="Türkiyə" <?php echo ($_POST['country'] ?? '') === 'Türkiyə' ? 'selected' : ''; ?>>Türkiyə</option>
                        <option value="Almaniya" <?php echo ($_POST['country'] ?? '') === 'Almaniya' ? 'selected' : ''; ?>>Almaniya</option>
                        <option value="ABŞ" <?php echo ($_POST['country'] ?? '') === 'ABŞ' ? 'selected' : ''; ?>>ABŞ</option>
                        <option value="Polşa" <?php echo ($_POST['country'] ?? '') === 'Polşa' ? 'selected' : ''; ?>>Polşa</option>
                        <option value="Ukrayna" <?php echo ($_POST['country'] ?? '') === 'Ukrayna' ? 'selected' : ''; ?>>Ukrayna</option>
                        <option value="Özbəkistan" <?php echo ($_POST['country'] ?? '') === 'Özbəkistan' ? 'selected' : ''; ?>>Özbəkistan</option>
                    </select>
                </div>
                
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="700">
                    <label for="city"><?php echo $translations['city'] ?? 'Şəhər'; ?></label>
                    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($_POST['city'] ?? ''); ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="750">
                    <label for="program"><?php echo $translations['program'] ?? 'Təhsil Proqramı'; ?></label>
                    <select id="program" name="program">
                        <option value=""><?php echo $translations['select_program'] ?? 'Proqram seçin'; ?></option>
                        <option value="Kompüter Mühəndisliyi" <?php echo ($_POST['program'] ?? '') === 'Kompüter Mühəndisliyi' ? 'selected' : ''; ?>>Kompüter Mühəndisliyi</option>
                        <option value="İqtisadiyyat" <?php echo ($_POST['program'] ?? '') === 'İqtisadiyyat' ? 'selected' : ''; ?>>İqtisadiyyat</option>
                        <option value="Hüquq" <?php echo ($_POST['program'] ?? '') === 'Hüquq' ? 'selected' : ''; ?>>Hüquq</option>
                        <option value="Tibb" <?php echo ($_POST['program'] ?? '') === 'Tibb' ? 'selected' : ''; ?>>Tibb</option>
                        <option value="Biznes İdarəetməsi" <?php echo ($_POST['program'] ?? '') === 'Biznes İdarəetməsi' ? 'selected' : ''; ?>>Biznes İdarəetməsi</option>
                        <option value="Mühəndislik" <?php echo ($_POST['program'] ?? '') === 'Mühəndislik' ? 'selected' : ''; ?>>Mühəndislik</option>
                    </select>
                </div>
                
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
                    <label for="university"><?php echo $translations['university'] ?? 'Universitet'; ?></label>
                    <select id="university" name="university">
                        <option value=""><?php echo $translations['select_university'] ?? 'Universitet seçin'; ?></option>
                        <option value="TIIAME Milli Tədqiqat Universiteti" <?php echo ($_POST['university'] ?? '') === 'TIIAME Milli Tədqiqat Universiteti' ? 'selected' : ''; ?>>TIIAME Milli Tədqiqat Universiteti</option>
                        <option value="Milli Qərbi Ukrayna Universiteti" <?php echo ($_POST['university'] ?? '') === 'Milli Qərbi Ukrayna Universiteti' ? 'selected' : ''; ?>>Milli Qərbi Ukrayna Universiteti</option>
                        <option value="İstanbul Teknik Üniversitesi" <?php echo ($_POST['university'] ?? '') === 'İstanbul Teknik Üniversitesi' ? 'selected' : ''; ?>>İstanbul Teknik Üniversitesi</option>
                        <option value="Berlin Teknik Üniversitesi" <?php echo ($_POST['university'] ?? '') === 'Berlin Teknik Üniversitesi' ? 'selected' : ''; ?>>Berlin Teknik Üniversitesi</option>
                        <option value="Stanford Üniversitesi" <?php echo ($_POST['university'] ?? '') === 'Stanford Üniversitesi' ? 'selected' : ''; ?>>Stanford Üniversitesi</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="850">
                    <label for="password"><?php echo $translations['password'] ?? 'Şifrə'; ?> *</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group" data-aos="fade-up" data-aos-duration="800" data-aos-delay="900">
                    <label for="confirm_password"><?php echo $translations['confirm_password'] ?? 'Şifrəni təsdiqlə'; ?> *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;" data-aos="fade-up" data-aos-duration="800" data-aos-delay="950">
                <?php echo $translations['student_register_submit'] ?? 'Qeydiyyatdan keç'; ?>
            </button>
        </form>
        
        <div style="text-align: center; margin-top: 2rem;">
            <p><?php echo $translations['already_have_account'] ?? 'Artıq hesabınız var?'; ?> 
                <a href="login.php"><?php echo $translations['login_here'] ?? 'Burada giriş edin'; ?></a>
            </p>
        </div>
    </div>
</main>

<style>
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include 'includes/footer.php'; ?> 