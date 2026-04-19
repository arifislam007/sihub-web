const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');
const navAnchors = document.querySelectorAll('.nav-links a[href^="#"]');

if (menuToggle && navLinks) {
  menuToggle.addEventListener('click', () => {
    const isOpen = navLinks.classList.toggle('open');
    menuToggle.setAttribute('aria-expanded', String(isOpen));
  });

  document.addEventListener('click', (event) => {
    if (!navLinks.contains(event.target) && !menuToggle.contains(event.target)) {
      navLinks.classList.remove('open');
      menuToggle.setAttribute('aria-expanded', 'false');
    }
  });
}

navAnchors.forEach((anchor) => {
  anchor.addEventListener('click', () => {
    navLinks?.classList.remove('open');
    menuToggle?.setAttribute('aria-expanded', 'false');
  });
});

const sections = [...document.querySelectorAll('section[id]')];
const setActiveLink = () => {
  const y = window.scrollY + 140;
  sections.forEach((section) => {
    const inRange = y >= section.offsetTop && y < section.offsetTop + section.offsetHeight;
    const navLink = document.querySelector(`.nav-links a[href="#${section.id}"]`);
    navLink?.classList.toggle('active', inRange);
  });
};
window.addEventListener('scroll', setActiveLink);
setActiveLink();

const revealEls = document.querySelectorAll('.reveal');
const revealObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
        revealObserver.unobserve(entry.target);
      }
    });
  },
  { threshold: 0.15 }
);
revealEls.forEach((el) => revealObserver.observe(el));

const counters = document.querySelectorAll('[data-target]');
let countersPlayed = false;
const animateCounters = () => {
  if (countersPlayed) return;
  countersPlayed = true;

  counters.forEach((counter) => {
    const target = Number(counter.dataset.target || '0');
    const duration = 1200;
    const start = performance.now();

    const tick = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const value = Math.floor(progress * target);
      counter.textContent = `${value}+`;
      if (progress < 1) requestAnimationFrame(tick);
    };

    requestAnimationFrame(tick);
  });
};

const counterSection = document.querySelector('.counter-grid');
if (counterSection) {
  const counterObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animateCounters();
          counterObserver.disconnect();
        }
      });
    },
    { threshold: 0.3 }
  );

  counterObserver.observe(counterSection);
}

const faqItems = document.querySelectorAll('.faq-item');
faqItems.forEach((item) => {
  const button = item.querySelector('.faq-question');
  button?.addEventListener('click', () => {
    const isOpen = item.classList.contains('open');
    faqItems.forEach((faq) => {
      faq.classList.remove('open');
      faq.querySelector('.faq-question')?.setAttribute('aria-expanded', 'false');
    });

    if (!isOpen) {
      item.classList.add('open');
      button.setAttribute('aria-expanded', 'true');
    }
  });
});

const form = document.getElementById('contactForm');
const statusEl = document.querySelector('.form-status');
const validators = {
  fullName: (value) => value.trim().length >= 3 || 'Please enter at least 3 characters.',
  email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) || 'Please enter a valid email address.',
  phone: (value) => /^[0-9+\-()\s]{8,20}$/.test(value) || 'Please enter a valid phone number.',
  course: (value) => value.trim() !== '' || 'Please select a course.',
};

const setFieldError = (field, error) => {
  const errorEl = field.closest('.field')?.querySelector('.error');
  if (!errorEl) return;
  errorEl.textContent = typeof error === 'string' ? error : '';
};

const validateField = (field) => {
  const rule = validators[field.name];
  if (!rule) return true;

  const result = rule(field.value);
  if (result !== true) {
    setFieldError(field, result);
    return false;
  }

  setFieldError(field, '');
  return true;
};

form?.querySelectorAll('input, select, textarea').forEach((field) => {
  field.addEventListener('input', () => validateField(field));
  field.addEventListener('blur', () => validateField(field));
});

form?.addEventListener('submit', async (event) => {
  event.preventDefault();

  const fields = form.querySelectorAll('input, select, textarea');
  const allValid = [...fields].every((field) => validateField(field));
  if (!allValid) {
    statusEl.textContent = 'Please fix the highlighted errors and try again.';
    statusEl.className = 'form-status fail';
    statusEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    return;
  }

  const submitBtn = form.querySelector('.submit-btn');
  const label = submitBtn.querySelector('span');
  submitBtn.disabled = true;
  label.textContent = 'Sending...';

  try {
    const response = await fetch(form.action, {
      method: 'POST',
      body: new FormData(form),
      headers: {
        Accept: 'application/json',
      },
    });

    const data = await response.json();
    if (!response.ok || !data.success) {
      throw new Error(data.message || 'Something went wrong while sending your message.');
    }

    statusEl.textContent = 'Message sent successfully. Our team will contact you soon.';
    statusEl.className = 'form-status ok';
    form.reset();
  } catch (error) {
    statusEl.textContent = error.message;
    statusEl.className = 'form-status fail';
  } finally {
    submitBtn.disabled = false;
    label.textContent = 'Send Message';
    statusEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
});

const hero = document.querySelector('.hero');
const orbs = document.querySelectorAll('.orb');
if (hero && orbs.length) {
  hero.addEventListener('mousemove', (event) => {
    const rect = hero.getBoundingClientRect();
    const x = (event.clientX - rect.left) / rect.width - 0.5;
    const y = (event.clientY - rect.top) / rect.height - 0.5;

    orbs.forEach((orb, index) => {
      const factor = (index + 1) * 12;
      orb.style.transform = `translate(${x * factor}px, ${y * factor}px)`;
    });
  });
}
