-- ===== OSTWINDGROUP ÜNİVERSİTE VERİTABANI =====

-- Öğrenciler tablosu
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_number VARCHAR(20) UNIQUE NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    birth_date DATE,
    nationality VARCHAR(50),
    passport_number VARCHAR(50),
    address TEXT,
    country VARCHAR(50),
    city VARCHAR(50),
    program VARCHAR(100),
    university VARCHAR(100),
    enrollment_date DATE,
    status ENUM('active', 'inactive', 'graduated', 'suspended') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Öğretmenler tablosu
CREATE TABLE IF NOT EXISTS teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_code VARCHAR(20) UNIQUE NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    department VARCHAR(100),
    specialization VARCHAR(100),
    university VARCHAR(100),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Dersler tablosu
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(20) UNIQUE NOT NULL,
    course_name VARCHAR(100) NOT NULL,
    description TEXT,
    credits INT DEFAULT 3,
    department VARCHAR(100),
    university VARCHAR(100),
    semester ENUM('Fall', 'Spring', 'Summer') DEFAULT 'Fall',
    academic_year VARCHAR(10),
    teacher_id INT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE SET NULL
);

-- Öğrenci-Ders kayıtları
CREATE TABLE IF NOT EXISTS student_courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_date DATE,
    status ENUM('enrolled', 'completed', 'dropped', 'failed') DEFAULT 'enrolled',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY unique_student_course (student_id, course_id)
);

-- Notlar tablosu
CREATE TABLE IF NOT EXISTS grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    teacher_id INT,
    grade_type ENUM('midterm', 'final', 'assignment', 'quiz', 'project') DEFAULT 'final',
    grade DECIMAL(5,2),
    max_grade DECIMAL(5,2) DEFAULT 100,
    grade_date DATE,
    comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE SET NULL
);

-- Ders programı tablosu
CREATE TABLE IF NOT EXISTS schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    day_of_week ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
    start_time TIME,
    end_time TIME,
    room VARCHAR(50),
    building VARCHAR(50),
    schedule_type ENUM('lecture', 'lab', 'seminar', 'exam') DEFAULT 'lecture',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Üniversiteler tablosu
CREATE TABLE IF NOT EXISTS universities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    country VARCHAR(100) NOT NULL,
    city VARCHAR(100),
    website VARCHAR(200),
    description TEXT,
    logo_url VARCHAR(200),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bölümler tablosu
CREATE TABLE IF NOT EXISTS departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    university_id INT,
    description TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (university_id) REFERENCES universities(id) ON DELETE SET NULL
);

-- Duyurular tablosu
CREATE TABLE IF NOT EXISTS announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    author_id INT,
    target_audience ENUM('all', 'students', 'teachers', 'admins') DEFAULT 'all',
    priority ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Örnek veriler ekleyelim
INSERT INTO universities (name, country, city, description) VALUES
('TIIAME Milli Tədqiqat Universiteti', 'Özbəkistan', 'Tashkent', 'Milli Tədqiqat Universiteti'),
('Milli Qərbi Ukrayna Universiteti', 'Ukrayna', 'Ternopil', 'Qərbi Ukrayna Universiteti'),
('İstanbul Teknik Üniversitesi', 'Türkiye', 'İstanbul', 'Teknik eğitimde öncü üniversite'),
('Berlin Teknik Üniversitesi', 'Almanya', 'Berlin', 'Almanya\'nın önde gelen teknik üniversitesi'),
('Stanford Üniversitesi', 'ABD', 'California', 'Dünya çapında tanınan üniversite');

INSERT INTO departments (name, university_id, description) VALUES
('Mühəndislik', 1, 'Mühəndislik fakültəsi'),
('İqtisadiyyat', 1, 'İqtisadiyyat fakültəsi'),
('Hüquq', 2, 'Hüquq fakültəsi'),
('Tibb', 2, 'Tibb fakültəsi'),
('Kompüter Elmləri', 3, 'Kompüter elmləri fakültəsi'),
('Biznes İdarəetməsi', 4, 'Biznes idarəetməsi fakültəsi'),
('Tibb', 5, 'Tibb fakültəsi');

-- Örnek öğretmenler
INSERT INTO teachers (teacher_code, first_name, last_name, email, department, university) VALUES
('T001', 'Əli', 'Məmmədov', 'ali.mammadov@ostwind.az', 'Mühəndislik', 'TIIAME Milli Tədqiqat Universiteti'),
('T002', 'Aynur', 'Hüseynova', 'aynur.huseynova@ostwind.az', 'İqtisadiyyat', 'TIIAME Milli Tədqiqat Universiteti'),
('T003', 'Viktor', 'Petrenko', 'viktor.petrenko@ostwind.az', 'Hüquq', 'Milli Qərbi Ukrayna Universiteti'),
('T004', 'Mehmet', 'Yılmaz', 'mehmet.yilmaz@ostwind.az', 'Kompüter Elmləri', 'İstanbul Teknik Üniversitesi'),
('T005', 'Hans', 'Müller', 'hans.muller@ostwind.az', 'Biznes İdarəetməsi', 'Berlin Teknik Üniversitesi');

-- Örnek dersler
INSERT INTO courses (course_code, course_name, description, credits, department, university, teacher_id) VALUES
('CS101', 'Kompüter Proqramlaşdırma', 'Əsas proqramlaşdırma dərsləri', 3, 'Kompüter Elmləri', 'İstanbul Teknik Üniversitesi', 4),
('ENG201', 'Mühəndislik Riyaziyyatı', 'Mühəndislik üçün riyaziyyat', 4, 'Mühəndislik', 'TIIAME Milli Tədqiqat Universiteti', 1),
('ECO101', 'Makroiqtisadiyyat', 'Makroiqtisadi nəzəriyyə', 3, 'İqtisadiyyat', 'TIIAME Milli Tədqiqat Universiteti', 2),
('LAW101', 'Konstitusiya Hüququ', 'Konstitusiya hüququ əsasları', 3, 'Hüquq', 'Milli Qərbi Ukrayna Universiteti', 3),
('BUS101', 'Biznes Strategiyası', 'Biznes strategiyası və idarəetmə', 3, 'Biznes İdarəetməsi', 'Berlin Teknik Üniversitesi', 5);

-- Örnek öğrenciler
INSERT INTO students (student_number, first_name, last_name, email, nationality, program, university) VALUES
('S2024001', 'Leyla', 'Əliyeva', 'leyla.aliyeva@student.ostwind.az', 'Azərbaycan', 'Kompüter Mühəndisliyi', 'İstanbul Teknik Üniversitesi'),
('S2024002', 'Rəşad', 'Hüseynov', 'rashad.huseynov@student.ostwind.az', 'Azərbaycan', 'İqtisadiyyat', 'TIIAME Milli Tədqiqat Universiteti'),
('S2024003', 'Mariya', 'Koval', 'mariya.koval@student.ostwind.az', 'Ukrayna', 'Hüquq', 'Milli Qərbi Ukrayna Universiteti'),
('S2024004', 'Ahmed', 'Hassan', 'ahmed.hassan@student.ostwind.az', 'Misir', 'Biznes İdarəetməsi', 'Berlin Teknik Üniversitesi'),
('S2024005', 'Zeynəb', 'Məmmədova', 'zeynab.mammadova@student.ostwind.az', 'Azərbaycan', 'Tibb', 'TIIAME Milli Tədqiqat Universiteti'); 