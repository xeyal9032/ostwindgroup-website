// Scroll to Top Butonu
const scrollBtn = document.getElementById('scrollTopBtn');
window.onscroll = function() {
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    scrollBtn.style.display = 'block';
  } else {
    scrollBtn.style.display = 'none';
  }
};
scrollBtn.onclick = function() {
  window.scrollTo({top: 0, behavior: 'smooth'});
};

// Galeri Lightbox
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');
const lightboxCaption = document.getElementById('lightbox-caption');
document.getElementById('gallery-images').addEventListener('click', function(e) {
  if (e.target.tagName === 'IMG') {
    lightbox.style.display = 'flex';
    lightboxImg.src = e.target.src;
    lightboxCaption.textContent = e.target.alt;
  }
});
document.querySelector('.lightbox .close').onclick = function() {
  lightbox.style.display = 'none';
};
lightbox.onclick = function(e) {
  if (e.target === lightbox) lightbox.style.display = 'none';
};

// Testimonial Slider
const testimonials = document.querySelectorAll('.testimonial');
let currentTestimonial = 0;
const showTestimonial = idx => {
  testimonials.forEach((el, i) => {
    el.classList.toggle('active', i === idx);
  });
};
document.querySelector('.testimonial-controls .prev').onclick = () => {
  currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length;
  showTestimonial(currentTestimonial);
};
document.querySelector('.testimonial-controls .next').onclick = () => {
  currentTestimonial = (currentTestimonial + 1) % testimonials.length;
  showTestimonial(currentTestimonial);
};
showTestimonial(currentTestimonial);

// FAQ Accordion
const faqItems = document.querySelectorAll('.faq-item');
faqItems.forEach(item => {
  item.querySelector('.faq-question').onclick = () => {
    item.classList.toggle('open');
  };
}); 