// Tüm JavaScript kodunu DOMContentLoaded event listener içinde çalıştır
document.addEventListener('DOMContentLoaded', () => {
  // DOM Elements
  const navbar = document.querySelector('.navbar');
  const menuToggle = document.querySelector('.menu-toggle');
  const navMenu = document.querySelector('.nav-menu');
  const scrollProgress = document.querySelector('.scroll-progress');
  const dropdowns = document.querySelectorAll('.dropdown');
  const tabButtons = document.querySelectorAll('.tab-btn');
  const tabContents = document.querySelectorAll('.tab-content');
  const contactForm = document.querySelector('.contact-form');
  const loadingSpinner = document.querySelector('.loading-spinner');

  // Navbar Scroll
  let lastScroll = 0;
  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll <= 0) {
      navbar?.classList.remove('scroll-up');
      return;
    }
    
    if (currentScroll > lastScroll && !navbar?.classList.contains('scroll-down')) {
      navbar?.classList.remove('scroll-up');
      navbar?.classList.add('scroll-down');
    } else if (currentScroll < lastScroll && navbar?.classList.contains('scroll-down')) {
      navbar?.classList.remove('scroll-down');
      navbar?.classList.add('scroll-up');
    }
    
    lastScroll = currentScroll;
  });

  // Scroll Progress
  window.addEventListener('scroll', () => {
    if (scrollProgress) {
      const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrolled = (window.scrollY / windowHeight) * 100;
      scrollProgress.style.transform = `scaleX(${scrolled / 100})`;
    }
  });

  // Mobile Menu Toggle
  if (menuToggle) {
    menuToggle.addEventListener('click', () => {
      navMenu?.classList.toggle('active');
      menuToggle.classList.toggle('active');
    });
  }

  // Close mobile menu when clicking outside
  document.addEventListener('click', (e) => {
    if (!navMenu?.contains(e.target) && !menuToggle?.contains(e.target)) {
      navMenu?.classList.remove('active');
      menuToggle?.classList.remove('active');
    }
  });

  // Dropdowns
  dropdowns.forEach(dropdown => {
    const link = dropdown.querySelector('a');
    const menu = dropdown.querySelector('.dropdown-menu');
    let timeout;

    dropdown.addEventListener('mouseenter', () => {
      clearTimeout(timeout);
      menu.style.opacity = '1';
      menu.style.visibility = 'visible';
      menu.style.transform = 'translateY(0)';
    });

    dropdown.addEventListener('mouseleave', () => {
      timeout = setTimeout(() => {
        menu.style.opacity = '0';
        menu.style.visibility = 'hidden';
        menu.style.transform = 'translateY(10px)';
      }, 200);
    });
  });

  // Tabs
  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      const tab = button.dataset.tab;
      
      tabButtons.forEach(btn => btn.classList.remove('active'));
      tabContents.forEach(content => content.classList.remove('active'));
      
      button.classList.add('active');
      document.getElementById(`${tab}-content`)?.classList.add('active');
    });
  });

  // Smooth Scroll
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      
      if (target) {
        const headerOffset = 100;
        const elementPosition = target.offsetTop;
        const offsetPosition = elementPosition - headerOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
        
        // Close mobile menu after clicking
        navMenu?.classList.remove('active');
        menuToggle?.classList.remove('active');
      }
    });
  });

  // Intersection Observer for Animations
  const animateElements = document.querySelectorAll('.animate-fadeUp');
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  animateElements.forEach(element => {
    element.style.opacity = '0';
    element.style.transform = 'translateY(30px)';
    observer.observe(element);
  });

  // Contact Form
  contactForm?.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(contactForm);
    const data = Object.fromEntries(formData);
    
    // Show loading spinner
    if (loadingSpinner) {
      loadingSpinner.style.display = 'block';
    }
    
    try {
      // Simulate API call
      await new Promise(resolve => setTimeout(resolve, 1000));
      
      // Prepare WhatsApp message
      const message = `Merhaba, ben ${data.name}.\n\n` +
                     `İlgilendiğim Ülke: ${data.country}\n` +
                     `${data.message}\n\n` +
                     `İletişim Bilgilerim:\n` +
                     `Tel: ${data.phone}\n` +
                     `E-posta: ${data.email}`;
      
      // Redirect to WhatsApp
      const whatsappUrl = `https://wa.me/380972580000?text=${encodeURIComponent(message)}`;
      window.open(whatsappUrl, '_blank');
      
      // Reset form
      contactForm.reset();
      
      // Show success message
      showNotification('Mesajınız başarıyla gönderildi!', 'success');
    } catch (error) {
      showNotification('Bir hata oluştu. Lütfen tekrar deneyin.', 'error');
    } finally {
      if (loadingSpinner) {
        loadingSpinner.style.display = 'none';
      }
    }
  });

  // Language Selector
  const langButtons = document.querySelectorAll('.lang-btn');
  langButtons.forEach(button => {
    button.addEventListener('click', () => {
      langButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      // Implement language change logic here
    });
  });
});

// Notification System
function showNotification(message, type = 'success') {
  const notification = document.createElement('div');
  notification.className = `notification ${type}`;
  notification.textContent = message;
  
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.classList.add('show');
  }, 100);
  
  setTimeout(() => {
    notification.classList.remove('show');
    setTimeout(() => notification.remove(), 300);
  }, 3000);
} 