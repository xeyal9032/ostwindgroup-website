<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Sayfa başlığı
$page_title = $translations['testimonials_title'] ?? 'Tələbə Rəyləri - OstWindGroup';

include 'includes/header.php';
?>

<main class="main-content">
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title"><?php echo $translations['testimonials_title'] ?? 'Tələbə Rəyləri'; ?></h1>
            <p class="page-subtitle"><?php echo $translations['testimonials_subtitle'] ?? 'Uğurlu tələbələrimizin təcrübələrini və hekayələrini oxuyun'; ?></p>
        </div>
    </section>

    <!-- Testimonials Stats -->
    <section class="testimonials-stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">2500+</div>
                    <div class="stat-label"><?php echo $translations['successful_students'] ?? 'Uğurlu Tələbə'; ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label"><?php echo $translations['satisfaction_rate'] ?? 'Məmnuniyyət Dərəcəsi'; ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">11</div>
                    <div class="stat-label"><?php echo $translations['years_experience'] ?? 'İllik Təcrübə'; ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15</div>
                    <div class="stat-label"><?php echo $translations['partner_universities'] ?? 'Tərəfdaş Universitet'; ?></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Testimonials -->
    <section class="featured-testimonials">
        <div class="container">
            <h2 class="section-title"><?php echo $translations['featured_testimonials'] ?? 'Seçilmiş Rəylər'; ?></h2>
            <div class="testimonials-grid">
                <div class="testimonial-card featured">
                    <div class="testimonial-content">
                        <div class="quote-icon">"</div>
                        <p class="testimonial-text">
                            OstWindGroup sayəsində Ukraynada təhsil almaq mənim üçün çox asan oldu. 
                            Komanda hər addımda mənə kömək etdi və indi mən Kiyev Milli Universitetində 
                            kompüter elmləri sahəsində təhsil alıram. Həqiqətən minnətdaram!
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <img src="assets/images/student-1.jpg" alt="Aysu Məmmədova">
                            </div>
                            <div class="author-info">
                                <h4 class="author-name">Aysu Məmmədova</h4>
                                <p class="author-university">Kiyev Milli Universiteti</p>
                                <p class="author-program">Kompüter Elmləri</p>
                                <div class="author-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card featured">
                    <div class="testimonial-content">
                        <div class="quote-icon">"</div>
                        <p class="testimonial-text">
                            Tibb sahəsində təhsil almaq həmişə arzularım arasında idi. 
                            OstWindGroup komandası mənə Ukraynanın ən yaxşı tibb universitetlərində 
                            təhsil almaq imkanı verdi. İndi mən Xarkov Tibb Universitetində təhsil alıram.
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <img src="assets/images/student-2.jpg" alt="Elvin Hüseynov">
                            </div>
                            <div class="author-info">
                                <h4 class="author-name">Elvin Hüseynov</h4>
                                <p class="author-university">Xarkov Tibb Universiteti</p>
                                <p class="author-program">Tibb</p>
                                <div class="author-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card featured">
                    <div class="testimonial-content">
                        <div class="quote-icon">"</div>
                        <p class="testimonial-text">
                            İqtisadiyyat sahəsində magistr təhsili almaq üçün OstWindGroup-a müraciət etdim. 
                            Onlar mənə Ukraynanın ən yaxşı iqtisad universitetlərində təhsil almaq 
                            imkanı verdilər. İndi mən Lvov İqtisad Universitetində təhsil alıram.
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <img src="images/student-3.jpg" alt="Leyla Əliyeva">
                            </div>
                            <div class="author-info">
                                <h4 class="author-name">Leyla Əliyeva</h4>
                                <p class="author-university">Lvov İqtisad Universiteti</p>
                                <p class="author-program">İqtisadiyyat</p>
                                <div class="author-rating">
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="success-stories">
        <div class="container">
            <h2 class="section-title"><?php echo $lang->get('success_stories'); ?></h2>
            <div class="stories-grid">
                <div class="story-card">
                    <div class="story-image">
                        <img src="images/success-story-1.jpg" alt="Success Story">
                    </div>
                    <div class="story-content">
                        <h3 class="story-title"><?php echo $lang->get('from_baku_to_kyiv'); ?></h3>
                        <p class="story-excerpt">
                            Bakıdan Kiyevə - Əhməd Məmmədovun uğur hekayəsi. 
                            OstWindGroup sayəsində Ukraynanın ən yaxşı universitetlərindən birində 
                            təhsil almaq imkanı əldə etdi.
                        </p>
                        <div class="story-meta">
                            <span class="story-date">2023</span>
                            <span class="story-university">Kiyev Politexnik İnstitutu</span>
                        </div>
                        <a href="#" class="read-more"><?php echo $lang->get('read_full_story'); ?></a>
                    </div>
                </div>

                <div class="story-card">
                    <div class="story-image">
                        <img src="images/success-story-2.jpg" alt="Success Story">
                    </div>
                    <div class="story-content">
                        <h3 class="story-title"><?php echo $lang->get('medical_dream'); ?></h3>
                        <p class="story-excerpt">
                            Tibb sahəsində təhsil almaq arzusu olan Aynurə Kərimovanın 
                            Xarkov Tibb Universitetində təhsil almaq hekayəsi.
                        </p>
                        <div class="story-meta">
                            <span class="story-date">2023</span>
                            <span class="story-university">Xarkov Tibb Universiteti</span>
                        </div>
                        <a href="#" class="read-more"><?php echo $lang->get('read_full_story'); ?></a>
                    </div>
                </div>

                <div class="story-card">
                    <div class="story-image">
                        <img src="images/success-story-3.jpg" alt="Success Story">
                    </div>
                    <div class="story-content">
                        <h3 class="story-title"><?php echo $lang->get('engineering_future'); ?></h3>
                        <p class="story-excerpt">
                            Mühəndislik sahəsində təhsil almaq istəyən Rəşad Əliyevin 
                            Lvov Politexnik Universitetində təhsil almaq hekayəsi.
                        </p>
                        <div class="story-meta">
                            <span class="story-date">2023</span>
                            <span class="story-university">Lvov Politexnik Universiteti</span>
                        </div>
                        <a href="#" class="read-more"><?php echo $lang->get('read_full_story'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Testimonials -->
    <section class="video-testimonials">
        <div class="container">
            <h2 class="section-title"><?php echo $lang->get('video_testimonials'); ?></h2>
            <div class="video-grid">
                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="images/video-thumb-1.jpg" alt="Video Testimonial">
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="video-info">
                        <h4 class="video-title">Aysu Məmmədova - Kiyev Milli Universiteti</h4>
                        <p class="video-duration">3:45</p>
                    </div>
                </div>

                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="images/video-thumb-2.jpg" alt="Video Testimonial">
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="video-info">
                        <h4 class="video-title">Elvin Hüseynov - Xarkov Tibb Universiteti</h4>
                        <p class="video-duration">4:12</p>
                    </div>
                </div>

                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="images/video-thumb-3.jpg" alt="Video Testimonial">
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="video-info">
                        <h4 class="video-title">Leyla Əliyeva - Lvov İqtisad Universiteti</h4>
                        <p class="video-duration">3:28</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials by University -->
    <section class="university-testimonials">
        <div class="container">
            <h2 class="section-title"><?php echo $lang->get('testimonials_by_university'); ?></h2>
            <div class="university-tabs">
                <button class="tab-btn active" data-university="kyiv">Kiyev Universitetləri</button>
                <button class="tab-btn" data-university="kharkiv">Xarkov Universitetləri</button>
                <button class="tab-btn" data-university="lviv">Lvov Universitetləri</button>
                <button class="tab-btn" data-university="odessa">Odessa Universitetləri</button>
            </div>
            
            <div class="university-content active" id="kyiv">
                <div class="testimonials-grid">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <p class="testimonial-text">
                                Kiyev Milli Universitetində təhsil almaq mənim üçün çox xoş təcrübə oldu. 
                                OstWindGroup komandası hər addımda mənə kömək etdi.
                            </p>
                            <div class="testimonial-author">
                                <div class="author-info">
                                    <h4 class="author-name">Nigar Əhmədova</h4>
                                    <p class="author-university">Kiyev Milli Universiteti</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- More testimonials for Kyiv universities -->
                </div>
            </div>
        </div>
    </section>

    <!-- Leave a Review -->
    <section class="leave-review">
        <div class="container">
            <div class="review-content">
                <h2 class="section-title"><?php echo $lang->get('share_your_experience'); ?></h2>
                <p class="section-subtitle"><?php echo $lang->get('help_others_choose'); ?></p>
                
                <form class="review-form" method="POST" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="review_name"><?php echo $lang->get('full_name'); ?></label>
                            <input type="text" id="review_name" name="review_name" required>
                        </div>
                        <div class="form-group">
                            <label for="review_university"><?php echo $lang->get('university'); ?></label>
                            <input type="text" id="review_university" name="review_university" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="review_program"><?php echo $lang->get('program'); ?></label>
                            <input type="text" id="review_program" name="review_program" required>
                        </div>
                        <div class="form-group">
                            <label for="review_rating"><?php echo $lang->get('rating'); ?></label>
                            <select id="review_rating" name="review_rating" required>
                                <option value=""><?php echo $lang->get('select_rating'); ?></option>
                                <option value="5">5 <?php echo $lang->get('stars'); ?></option>
                                <option value="4">4 <?php echo $lang->get('stars'); ?></option>
                                <option value="3">3 <?php echo $lang->get('stars'); ?></option>
                                <option value="2">2 <?php echo $lang->get('stars'); ?></option>
                                <option value="1">1 <?php echo $lang->get('star'); ?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="review_text"><?php echo $lang->get('your_review'); ?></label>
                        <textarea id="review_text" name="review_text" rows="5" required 
                                  placeholder="<?php echo $lang->get('review_placeholder'); ?>"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <?php echo $lang->get('submit_review'); ?>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title"><?php echo $lang->get('start_your_journey'); ?></h2>
                <p class="cta-subtitle"><?php echo $lang->get('join_successful_students'); ?></p>
                <div class="cta-buttons">
                    <a href="consultation.php" class="btn btn-primary">
                        <?php echo $lang->get('free_consultation'); ?>
                    </a>
                    <a href="universities.php" class="btn btn-secondary">
                        <?php echo $lang->get('view_universities'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
// University tabs functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const universityContents = document.querySelectorAll('.university-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const university = this.getAttribute('data-university');
            
            // Remove active class from all buttons and contents
            tabBtns.forEach(b => b.classList.remove('active'));
            universityContents.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked button and corresponding content
            this.classList.add('active');
            document.getElementById(university).classList.add('active');
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?> 