<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

$page_title = 'Style Test - Modern Website';
include 'includes/header.php';
?>

<main>
    <!-- Hero Section Test -->
    <section class="hero">
        <div class="container">
            <h1 data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">Style Test Page</h1>
            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">Testing all the new professional styles and components</p>
            <div class="hero-buttons" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                <a href="#buttons" class="btn btn-primary">Primary Button</a>
                <a href="#cards" class="btn btn-secondary">Secondary Button</a>
                <a href="#forms" class="btn btn-outline">Outline Button</a>
            </div>
        </div>
    </section>

    <!-- Buttons Test Section -->
    <section id="buttons" class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">Button Styles Test</h2>
            <div class="features-grid">
                <div class="card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <h3>Button Variants</h3>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <button class="btn btn-primary">Primary Button</button>
                        <button class="btn btn-secondary">Secondary Button</button>
                        <button class="btn btn-outline">Outline Button</button>
                        <button class="btn btn-primary btn-sm">Small Primary</button>
                        <button class="btn btn-primary btn-lg">Large Primary</button>
                    </div>
                </div>
                <div class="card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <h3>Button States</h3>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <button class="btn btn-primary">Normal</button>
                        <button class="btn btn-primary" disabled>Disabled</button>
                        <button class="btn btn-primary loading">Loading</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cards Test Section -->
    <section id="cards" class="section" style="background: var(--bg-secondary);">
        <div class="container">
            <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">Card Styles Test</h2>
            <div class="features-grid">
                <div class="card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="card-header">
                        <h3 class="card-title">Basic Card</h3>
                        <p class="card-subtitle">Card subtitle</p>
                    </div>
                    <div class="card-body">
                        <p>This is a basic card with header, body, and footer sections.</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Action</button>
                    </div>
                </div>
                <div class="card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="card-header">
                        <h3 class="card-title">Feature Card</h3>
                    </div>
                    <div class="card-body">
                        <div class="icon">🚀</div>
                        <p>This card has an icon and demonstrates the feature card styling.</p>
                    </div>
                </div>
                <div class="card glass" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="card-header">
                        <h3 class="card-title">Glass Card</h3>
                    </div>
                    <div class="card-body">
                        <p>This is a glassmorphism card with blur effect.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Forms Test Section -->
    <section id="forms" class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">Form Styles Test</h2>
            <div class="features-grid">
                <div class="card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <h3>Contact Form</h3>
                    <form>
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                            <div class="help-text">Enter your full name</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                            <div class="help-text">Enter a valid email address</div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
                <div class="card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <h3>Messages Test</h3>
                    <div class="message success">
                        This is a success message
                    </div>
                    <div class="message error">
                        This is an error message
                    </div>
                    <div class="message warning">
                        This is a warning message
                    </div>
                    <div class="message info">
                        This is an info message
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Typography Test Section -->
    <section class="section" style="background: var(--bg-secondary);">
        <div class="container">
            <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">Typography Test</h2>
            <div class="features-grid">
                <div class="card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <h1>Heading 1</h1>
                    <h2>Heading 2</h2>
                    <h3>Heading 3</h3>
                    <h4>Heading 4</h4>
                    <h5>Heading 5</h5>
                    <h6>Heading 6</h6>
                </div>
                <div class="card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <h3>Text Styles</h3>
                    <p>This is a regular paragraph with <strong>bold text</strong> and <em>italic text</em>.</p>
                    <p class="text-primary">Primary colored text</p>
                    <p class="text-secondary">Secondary colored text</p>
                    <p class="text-muted">Muted colored text</p>
                    <p class="text-success">Success colored text</p>
                    <p class="text-error">Error colored text</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Utility Classes Test -->
    <section class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-down" data-aos-duration="800">Utility Classes Test</h2>
            <div class="features-grid">
                <div class="card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="200">
                    <h3>Spacing Utilities</h3>
                    <div class="bg-primary p-3 mb-3">Padding 3</div>
                    <div class="bg-secondary p-4 mb-2">Padding 4</div>
                    <div class="bg-card p-5">Padding 5</div>
                </div>
                <div class="card" data-aos="custom-fade-up" data-aos-duration="800" data-aos-delay="400">
                    <h3>Display & Alignment</h3>
                    <div class="text-center mb-3">Centered Text</div>
                    <div class="text-left mb-3">Left Aligned Text</div>
                    <div class="text-right mb-3">Right Aligned Text</div>
                    <div class="flex justify-center">
                        <button class="btn btn-primary">Centered Button</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 