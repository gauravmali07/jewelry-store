/* Jewelry UI Enhancements - Animations & Interactivity */

// Smooth Scrolling
document.querySelectorAll('a[href^=\"#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector(this.getAttribute('href')).scrollIntoView({
      behavior: 'smooth'
    });
  });
});

// Navbar Scroll Effect
window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.main-header, .navbar');
  if (window.scrollY > 50) {
    navbar.style.background = 'rgba(26, 26, 26, 0.95)';
    navbar.style.backdropFilter = 'blur(20px)';
  } else {
    navbar.style.background = 'rgba(255, 255, 255, 0.1)';
  }
});

// Sparkle Particles (Canvas)
function initSparkles() {
  const canvas = document.createElement('canvas');
  canvas.id = 'sparkle-canvas';
  canvas.style.position = 'fixed';
  canvas.style.top = '0';
  canvas.style.left = '0';
  canvas.style.pointerEvents = 'none';
  canvas.style.zIndex = '9998';
  document.body.appendChild(canvas);

  const ctx = canvas.getContext('2d');
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  const particles = [];
  const particleCount = 50;

  class Particle {
    constructor() {
      this.x = Math.random() * canvas.width;
      this.y = Math.random() * canvas.height;
      this.size = Math.random() * 3 + 1;
      this.speedX = Math.random() * 0.5 - 0.25;
      this.speedY = Math.random() * 0.5 - 0.25;
      this.glow = Math.random() * 0.5 + 0.5;
    }
    update() {
      this.x += this.speedX;
      this.y += this.speedY;
      if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
      if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
    }
    draw() {
      ctx.save();
      ctx.globalAlpha = this.glow;
      ctx.fillStyle = '#D4AF37';
      ctx.shadowColor = '#D4AF37';
      ctx.shadowBlur = 10;
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fill();
      ctx.restore();
    }
  }

  for (let i = 0; i < particleCount; i++) {
    particles.push(new Particle());
  }

  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(p => {
      p.update();
      p.draw();
    });
    requestAnimationFrame(animate);
  }
  animate();

  window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  });
}

// Cart Counter Animation
function animateCartCounter() {
  const cartCount = document.querySelector('.cart-count');
  if (cartCount && parseInt(cartCount.textContent) > 0) {
    cartCount.style.animation = 'pulse 1.5s infinite';
  }
}

// Intersection Observer for Animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0)';
    }
  });
}, observerOptions);

// Initialize on DOM Load
document.addEventListener('DOMContentLoaded', () => {
  initSparkles();
  
  // Animate elements on scroll
  document.querySelectorAll('.card, .hero, section').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(50px)';
    el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
    observer.observe(el);
  });

  animateCartCounter();
  
  // Form Enhancements
  document.querySelectorAll('.form-control, input, textarea').forEach(input => {
    input.addEventListener('focus', function() {
      this.parentElement.style.transform = 'scale(1.02)';
    });
    input.addEventListener('blur', function() {
      this.parentElement.style.transform = 'scale(1)';
    });
  });
});

// Load Cart Enhancement (integrate with existing)
function load_cart() {
  // Existing AJAX + sparkle on update
  $.ajax({
    url: 'admin/ajax.php?action=get_cart_count',
    success: function(resp) {
      if (resp) {
        const data = JSON.parse(resp);
        $('.cart-count').text(data.count).addClass('animate__animated animate__pulse');
        setTimeout(() => $('.cart-count').removeClass('animate__animated animate__pulse'), 500);
        // Update cart dropdown...
      }
    }
  });
}

// Auto-init cart every 10s
setInterval(load_cart, 10000);

// Parallax for Hero (if present)
window.addEventListener('scroll', () => {
  const scrolled = window.pageYOffset;
  const hero = document.querySelector('.hero');
  if (hero) {
    hero.style.transform = `translateY(${scrolled * 0.5}px)`;
  }
});

