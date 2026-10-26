/**
 * HOSHIN TRADING — MAIN JAVASCRIPT
 * 
 * Global site behaviors: Header navigation, mobile drawer, scroll animations,
 * active link highlighting, forms, and floating shortcuts.
 */

let lenisInstance = null;

document.addEventListener('DOMContentLoaded', () => {
  initLenis();
  initGSAPAnimations();
  initHeader();
  initActiveNavLink();
  initScrollAnimations();
  initAccordions();
  initBackToTop();
  initTimelineScroll();
});

/**
 * Initialize Lenis Smooth Scrolling & Sync with GSAP ScrollTrigger
 */
function initLenis() {
  if (typeof Lenis === 'undefined') return;

  lenisInstance = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // standard exponential ease-out
    orientation: 'vertical',
    gestureOrientation: 'vertical',
    smoothWheel: true,
    wheelMultiplier: 1.0,
    touchMultiplier: 1.5,
    infinite: false,
  });

  // Expose globally so GSAP and other scripts can access lenisInstance
  window.lenis = lenisInstance;

  // Sync Lenis with GSAP ScrollTrigger if GSAP is loaded
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    lenisInstance.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
      lenisInstance.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);
  } else {
    function raf(time) {
      lenisInstance.raf(time);
      requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);
  }

  // Handle anchor links smoothly via Lenis
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId && targetId !== '#' && document.querySelector(targetId)) {
        e.preventDefault();
        lenisInstance.scrollTo(targetId, {
          offset: -80, // account for fixed header
          duration: 1.4,
        });
      }
    });
  });
}

/**
 * Premium GSAP & ScrollTrigger Animations
 */
function initGSAPAnimations() {
  if (typeof gsap === 'undefined') return;
  if (typeof ScrollTrigger === 'undefined') return;

  // Respect prefers-reduced-motion
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  // 1. Denmar Reference Architectural GSAP Entrance & Parallax
  const denmarHero = document.querySelector('.denmar-hero-section');
  const siteHeader = document.querySelector('.site-header');

  if (denmarHero) {
    const heroCanvas = denmarHero.querySelector('.denmar-hero-canvas');
    const heroImg = denmarHero.querySelector('.denmar-hero-img');
    const heroHeadline = denmarHero.querySelector('.denmar-hero-headline');
    const insetCard = denmarHero.querySelector('.denmar-inset-card');
    const scrollDown = denmarHero.querySelector('.denmar-scroll-down');

    const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    // Header reveal
    if (siteHeader) {
      heroTl.fromTo(siteHeader,
        { opacity: 0, y: -20 },
        { opacity: 1, y: 0, duration: 0.8, ease: 'power2.out' },
        0
      );
    }

    // Hero canvas smooth zoom & un-clip reveal
    if (heroCanvas) {
      heroTl.fromTo(heroCanvas,
        { opacity: 0, scale: 0.96, y: 30 },
        { opacity: 1, scale: 1, y: 0, duration: 1.1, ease: 'power3.out' },
        0.15
      );
    }

    if (heroImg) {
      heroTl.fromTo(heroImg,
        { scale: 1.12, opacity: 0.8 },
        { scale: 1.0, opacity: 1, duration: 1.6, ease: 'power2.out' },
        0.15
      );

      // Smooth GSAP scroll zoom-out parallax strictly on the hero image
      gsap.to(heroImg, {
        scale: 0.94,
        yPercent: 8,
        ease: 'power1.out',
        scrollTrigger: {
          trigger: denmarHero,
          start: 'top top',
          end: 'bottom top',
          scrub: 1.2
        }
      });
    }

    // Headline entrance
    if (heroHeadline) {
      heroTl.fromTo(heroHeadline,
        { opacity: 0, y: 40 },
        { opacity: 1, y: 0, duration: 1.0, ease: 'power3.out' },
        0.4
      );
    }

    // Inset Blue Card slide-in
    if (insetCard) {
      heroTl.fromTo(insetCard,
        { opacity: 0, x: 50, y: 30 },
        { opacity: 1, x: 0, y: 0, duration: 1.0, ease: 'power3.out' },
        0.6
      );
    }

    // Scroll Down Cue
    if (scrollDown) {
      heroTl.fromTo(scrollDown,
        { opacity: 0, y: 15 },
        { opacity: 1, y: 0, duration: 0.7, ease: 'power2.out' },
        0.8
      );
    }
  }

  // 2. Company Overview Animation (Home Page - supports .about-overview-grid & .overview-cols-3)
  const overviewGrid = document.querySelector('.about-overview-section .about-overview-grid');
  if (overviewGrid) {
    const labelCol = overviewGrid.querySelector('.about-label-col');
    const statementCol = overviewGrid.querySelector('.about-statement-col');

    if (labelCol) {
      gsap.fromTo(labelCol,
        { opacity: 0, x: -35 },
        {
          opacity: 1,
          x: 0,
          duration: 0.9,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: overviewGrid,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }

    if (statementCol) {
      gsap.fromTo(statementCol,
        { opacity: 0, y: 35 },
        {
          opacity: 1,
          y: 0,
          duration: 0.9,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: overviewGrid,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }
  }

  const overviewCols = document.querySelectorAll('.overview-cols-3 .col-block');
  if (overviewCols.length) {
    gsap.fromTo(overviewCols, 
      { opacity: 0, y: 50, scale: 0.97 },
      {
        opacity: 1,
        y: 0,
        scale: 1,
        duration: 0.9,
        stagger: 0.18,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: '.overview-cols-3',
          start: 'top 85%',
          toggleActions: 'play none none none'
        }
      }
    );
  }

  // 3. Specialization Cards Stagger Reveal (Home Page - supports .spec-ref-card & .spec-card)
  const specCards = document.querySelectorAll('.spec-cards-container .spec-ref-card, .spec-cards-grid .spec-card');
  if (specCards.length) {
    gsap.fromTo(specCards,
      { opacity: 0, y: 45, scale: 0.97 },
      {
        opacity: 1,
        y: 0,
        scale: 1,
        duration: 0.85,
        stagger: 0.1,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: specCards[0].parentElement,
          start: 'top 85%',
          toggleActions: 'play none none none'
        }
      }
    );
  }

  // 4. How We Work Process Section (Home Page)
  const processSection = document.querySelector('.process-ref-section');
  if (processSection) {
    const processLeft = processSection.querySelector('.process-ref-left');
    const processSteps = processSection.querySelectorAll('.process-ref-item');

    if (processLeft) {
      gsap.fromTo(processLeft,
        { opacity: 0, x: -35 },
        {
          opacity: 1,
          x: 0,
          duration: 0.9,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: processSection,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }

    if (processSteps.length) {
      gsap.fromTo(processSteps,
        { opacity: 0, y: 35, x: 25 },
        {
          opacity: 1,
          y: 0,
          x: 0,
          duration: 0.8,
          stagger: 0.12,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: '.process-ref-right',
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }
  }

  // 5. Why Choose Us Section (Home Page - supports both .why-choose-section & .why-ref-section)
  const whySection = document.querySelector('.why-choose-section, .why-ref-section');
  if (whySection) {
    const whyCards = whySection.querySelectorAll('.why-feature-card, .why-ref-feature-item');
    const whyImg = whySection.querySelector('.why-center-photo-card, .why-specialist-img, .why-ref-image-card');

    if (whyCards.length) {
      gsap.fromTo(whyCards,
        { opacity: 0, y: 35, scale: 0.97 },
        {
          opacity: 1,
          y: 0,
          scale: 1,
          duration: 0.85,
          stagger: 0.14,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: whySection,
            start: 'top 80%',
            toggleActions: 'play none none none'
          }
        }
      );
    }

    if (whyImg) {
      gsap.fromTo(whyImg,
        { opacity: 0, scale: 0.92, y: 30 },
        {
          opacity: 1,
          scale: 1,
          y: 0,
          duration: 1.1,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: whySection,
            start: 'top 80%',
            toggleActions: 'play none none none'
          }
        }
      );
    }
  }

  // 6. CTA Banner Entrance (Home Page & All Pages - supports .cta-primary-card & .cta-route-card)
  const ctaCard = document.querySelector('.cta-primary-card, .cta-route-card');
  if (ctaCard) {
    gsap.fromTo(ctaCard,
      { opacity: 0, y: 50, scale: 0.97 },
      {
        opacity: 1,
        y: 0,
        scale: 1,
        duration: 1.05,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: ctaCard,
          start: 'top 85%',
          toggleActions: 'play none none none'
        }
      }
    );
  }

  // 7. Section Headers Reveal (Eyebrow + Titles)
  const sectionHeaders = document.querySelectorAll('.spec-header-row, .spec-header-grid, .why-choose-header, .why-ref-header, .core-values-header-row, .service-model-header-grid');
  sectionHeaders.forEach((hdr) => {
    gsap.fromTo(hdr,
      { opacity: 0, y: 30 },
      {
        opacity: 1,
        y: 0,
        duration: 0.85,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: hdr,
          start: 'top 88%',
          toggleActions: 'play none none none'
        }
      }
    );
  });

  // =========================================================================
  // ABOUT PAGE SPECIFIC SECTIONS
  // =========================================================================

  // 8. About Page: Company Profile Editorial Overview
  const aboutOverview = document.querySelector('.about-editorial-section');
  if (aboutOverview) {
    const labelCol = aboutOverview.querySelector('.about-label-col');
    const statementCol = aboutOverview.querySelector('.about-statement-col');

    if (labelCol) {
      gsap.fromTo(labelCol,
        { opacity: 0, x: -30 },
        {
          opacity: 1,
          x: 0,
          duration: 0.9,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: aboutOverview,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }

    if (statementCol) {
      const pElements = statementCol.querySelectorAll('p');
      gsap.fromTo(pElements,
        { opacity: 0, y: 35 },
        {
          opacity: 1,
          y: 0,
          duration: 0.9,
          stagger: 0.18,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: aboutOverview,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }
  }

  // 9. About Page: Vision & Mission Dual Cards (Dark Blue Theme)
  const vmSection = document.querySelector('.vision-mission-section');
  if (vmSection) {
    const vmCards = vmSection.querySelectorAll('.vm-card');
    if (vmCards.length) {
      gsap.fromTo(vmCards,
        { opacity: 0, y: 50, scale: 0.96 },
        {
          opacity: 1,
          y: 0,
          scale: 1,
          duration: 1.0,
          stagger: 0.22,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: vmSection,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }
  }

  // 10. About Page: Direction & Method Sticky Timeline Section
  const timelineSection = document.querySelector('.timeline-ref-section');
  if (timelineSection) {
    const stickyLeft = timelineSection.querySelector('.timeline-sticky-left');
    const timelineSteps = timelineSection.querySelectorAll('.timeline-step-item');

    if (stickyLeft) {
      gsap.fromTo(stickyLeft,
        { opacity: 0, x: -35 },
        {
          opacity: 1,
          x: 0,
          duration: 0.9,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: timelineSection,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }

    if (timelineSteps.length) {
      timelineSteps.forEach((step) => {
        gsap.fromTo(step,
          { opacity: 0, y: 35, x: 20 },
          {
            opacity: 1,
            y: 0,
            x: 0,
            duration: 0.8,
            ease: 'power2.out',
            scrollTrigger: {
              trigger: step,
              start: 'top 85%',
              toggleActions: 'play none none none'
            }
          }
        );
      });
    }
  }

  // 11. About Page: Core Values 6 Cards Grid
  const coreValuesSection = document.querySelector('.core-values-section');
  if (coreValuesSection) {
    const valCards = coreValuesSection.querySelectorAll('.core-value-card');
    if (valCards.length) {
      gsap.fromTo(valCards,
        { opacity: 0, y: 45, scale: 0.97 },
        {
          opacity: 1,
          y: 0,
          scale: 1,
          duration: 0.85,
          stagger: 0.12,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: '.core-values-grid',
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }
  }

  // 12. Products Page: Service Model Feature Boxes Stagger
  const serviceBoxes = document.querySelectorAll('.service-boxes-grid .service-box-card');
  if (serviceBoxes.length) {
    gsap.fromTo(serviceBoxes,
      { opacity: 0, y: 40, scale: 0.96 },
      {
        opacity: 1,
        y: 0,
        scale: 1,
        duration: 0.8,
        stagger: 0.12,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: '.service-boxes-grid',
          start: 'top 85%',
          toggleActions: 'play none none none'
        }
      }
    );
  }

  // 13. Products Catalog Grid Items
  const productCards = document.querySelectorAll('.products-catalog-grid .product-card, .products-grid .product-card');
  if (productCards.length) {
    gsap.fromTo(productCards,
      { opacity: 0, y: 35 },
      {
        opacity: 1,
        y: 0,
        duration: 0.7,
        stagger: 0.08,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: productCards[0].parentElement,
          start: 'top 85%',
          toggleActions: 'play none none none'
        }
      }
    );
  }

  // 14. Contact & RFQ Page: Contact Info Cards & Form Container
  const contactInfoCol = document.querySelector('.contact-info-col, .contact-details-col');
  const contactFormCol = document.querySelector('.contact-form-col, .rfq-form-container');
  if (contactInfoCol || contactFormCol) {
    if (contactInfoCol) {
      gsap.fromTo(contactInfoCol,
        { opacity: 0, x: -30 },
        {
          opacity: 1,
          x: 0,
          duration: 0.9,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: contactInfoCol,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }
    if (contactFormCol) {
      gsap.fromTo(contactFormCol,
        { opacity: 0, x: 30, y: 15 },
        {
          opacity: 1,
          x: 0,
          y: 0,
          duration: 0.9,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: contactFormCol,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    }
  }

  // 15. Site Footer Reveal
  const footer = document.querySelector('.site-footer');
  if (footer) {
    const footerCols = footer.querySelectorAll('.footer-col, .footer-bottom');
    if (footerCols.length) {
      gsap.fromTo(footerCols,
        { opacity: 0, y: 30 },
        {
          opacity: 1,
          y: 0,
          duration: 0.8,
          stagger: 0.12,
          ease: 'power2.out',
          scrollTrigger: {
            trigger: footer,
            start: 'top 90%',
            toggleActions: 'play none none none'
          }
        }
      );
    }
  }
}

/**
 * Sticky Header and Mobile Navigation Drawer
 */
function initHeader() {
  const header = document.querySelector('.site-header');
  const toggleBtn = document.querySelector('.menu-toggle, .mobile-menu-toggle');
  const navMenu = document.querySelector('.mobile-nav, .site-nav');
  const body = document.body;

  // Add scroll class to header for shadow/glassmorphism
  function onScroll() {
    if (window.scrollY > 20) {
      header?.classList.add('header-scrolled');
    } else {
      header?.classList.remove('header-scrolled');
    }
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // Mobile menu toggle
  if (toggleBtn && navMenu) {
    toggleBtn.addEventListener('click', () => {
      const isExpanded = navMenu.classList.toggle('nav-open');
      toggleBtn.setAttribute('aria-expanded', isExpanded);
      toggleBtn.classList.toggle('is-active', isExpanded);
      body.classList.toggle('no-scroll', isExpanded);
    });

    // Close on escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && navMenu.classList.contains('nav-open')) {
        toggleBtn.setAttribute('aria-expanded', 'false');
        navMenu.classList.remove('nav-open');
        toggleBtn.classList.remove('is-active');
        body.classList.remove('no-scroll');
      }
    });

    // Close when clicking outside on mobile
    document.addEventListener('click', (e) => {
      if (navMenu.classList.contains('nav-open') &&
          !navMenu.contains(e.target) &&
          !toggleBtn.contains(e.target)) {
        toggleBtn.setAttribute('aria-expanded', 'false');
        navMenu.classList.remove('nav-open');
        toggleBtn.classList.remove('is-active');
        body.classList.remove('no-scroll');
      }
    });
  }
}

/**
 * Highlights the current active navigation link based on current filename
 */
function initActiveNavLink() {
  const path = window.location.pathname;
  let filename = path.split('/').pop() || 'index.html';
  if (filename === '' || filename === '/') filename = 'index.html';

  const navLinks = document.querySelectorAll('.desktop-nav a, .nav-link, .mobile-nav a');
  navLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (!href) return;

    // Check exact match or category/product sub-pages matching products
    if (href === filename) {
      link.classList.add('active');
      link.setAttribute('aria-current', 'page');
    } else if ((filename === 'category.html' || filename === 'product.html') && href === 'products.html') {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
      link.removeAttribute('aria-current');
    }
  });
}

/**
 * Scroll Animations using IntersectionObserver
 * Respects prefers-reduced-motion media query
 */
function initScrollAnimations() {
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const animElements = document.querySelectorAll('.fade-up, .fade-in');

  if (prefersReducedMotion || !('IntersectionObserver' in window)) {
    animElements.forEach(el => el.classList.add('in-view'));
    return;
  }

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
        obs.unobserve(entry.target);
      }
    });
  }, {
    root: null,
    rootMargin: '0px 0px -40px 0px',
    threshold: 0.1
  });

  animElements.forEach(el => observer.observe(el));
}

/**
 * Accordion Components
 */
function initAccordions() {
  const accordions = document.querySelectorAll('.accordion');
  accordions.forEach(acc => {
    const trigger = acc.querySelector('.accordion-trigger');
    const content = acc.querySelector('.accordion-content');
    if (!trigger || !content) return;

    trigger.addEventListener('click', () => {
      const isOpen = acc.classList.contains('is-open');
      acc.classList.toggle('is-open', !isOpen);
      trigger.setAttribute('aria-expanded', !isOpen);
    });
  });
}

/**
 * Back to top or subtle utility
 */
function initBackToTop() {
  // If an element with .js-back-to-top exists
  const btn = document.querySelector('.js-back-to-top');
  if (btn) {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
}

/**
 * Form Validation and Feedback Helper
 */
function handleFormSubmit(formElement, redirectUrl = 'thank-you.html', customDataHandler) {
  if (!formElement) return;

  formElement.addEventListener('submit', (e) => {
    e.preventDefault();

    // Check honeypot for anti-spam
    const honeypot = formElement.querySelector('[name="website_hp"]');
    if (honeypot && honeypot.value.trim() !== '') {
      console.warn('Spam detected via honeypot.');
      return;
    }

    let isValid = true;
    const requiredInputs = formElement.querySelectorAll('[required]');

    requiredInputs.forEach(input => {
      const errorMsg = input.parentElement.querySelector('.form-error');
      if (!input.value.trim()) {
        isValid = false;
        input.classList.add('has-error');
        if (errorMsg) errorMsg.style.display = 'block';
      } else {
        input.classList.remove('has-error');
        if (errorMsg) errorMsg.style.display = 'none';

        // Email check
        if (input.type === 'email' && !validateEmail(input.value)) {
          isValid = false;
          input.classList.add('has-error');
          if (errorMsg) {
            errorMsg.textContent = 'Please enter a valid email address.';
            errorMsg.style.display = 'block';
          }
        }
      }
    });

    if (!isValid) {
      const firstError = formElement.querySelector('.has-error');
      if (firstError) firstError.focus();
      return;
    }

    // Execute custom callback (e.g., save quote details)
    if (typeof customDataHandler === 'function') {
      customDataHandler(new FormData(formElement));
    }

    // Redirect to confirmation page
    window.location.href = redirectUrl;
  });
}

function validateEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

/**
 * About Page: Interactive Sticky Timeline Scroll
 * Dynamically highlights active step icons, cards, and fills the connecting vertical track
 */
function initTimelineScroll() {
  const timelineSection = document.querySelector('.timeline-ref-section');
  const stepItems = document.querySelectorAll('.timeline-step-item');
  const progressFill = document.getElementById('timelineProgressFill');

  if (!timelineSection || !stepItems.length) return;

  function updateTimelineOnScroll() {
    const triggerPoint = window.innerHeight * 0.55;
    let lastActiveIndex = 0;

    stepItems.forEach((step, index) => {
      const rect = step.getBoundingClientRect();
      if (rect.top <= triggerPoint) {
        step.classList.add('active');
        lastActiveIndex = index;
      } else {
        // Keep step 0 active at least once the section is in view
        if (index > 0) {
          step.classList.remove('active');
        }
      }
    });

    // Update connecting progress fill line height
    if (progressFill && stepItems.length > 1) {
      const firstStepRect = stepItems[0].getBoundingClientRect();
      const lastStepRect = stepItems[stepItems.length - 1].getBoundingClientRect();
      const totalTrackHeight = lastStepRect.top - firstStepRect.top;

      if (totalTrackHeight > 0) {
        const scrolledIntoTrack = triggerPoint - firstStepRect.top;
        const progressPercentage = Math.min(Math.max((scrolledIntoTrack / totalTrackHeight) * 100, 0), 100);
        progressFill.style.height = `${progressPercentage}%`;
      }
    }
  }

  window.addEventListener('scroll', updateTimelineOnScroll, { passive: true });
  window.addEventListener('resize', updateTimelineOnScroll, { passive: true });
  updateTimelineOnScroll();
}


/**
 * Interactive Vertical Process Timeline Scroll (Dark Blue Progress Bar)
 */

/**
 * Interactive Vertical Process Timeline Scroll (Dark Blue Progress Bar)
 * Smoothly calculates scroll position across mobile and desktop viewports
 */
function initProcessProgressScroll() {
  const processSection = document.querySelector('.process-ref-section');
  const processItems = document.querySelectorAll('.process-ref-section .process-ref-item');
  const fillBar = document.getElementById('processTimelineFill');

  if (!processSection || !processItems.length || !fillBar) return;

  function updateProcessScroll() {
    const windowH = window.innerHeight;
    const triggerPoint = windowH * 0.6;
    const firstRect = processItems[0].getBoundingClientRect();
    const lastRect = processItems[processItems.length - 1].getBoundingClientRect();
    const totalHeight = lastRect.top - firstRect.top + 30;

    if (totalHeight > 0) {
      const scrolled = triggerPoint - firstRect.top;
      const pct = Math.min(Math.max((scrolled / totalHeight) * 100, 0), 100);
      fillBar.style.height = pct + '%';
    }

    processItems.forEach((item, index) => {
      const r = item.getBoundingClientRect();
      if (r.top <= triggerPoint || (index === 0 && firstRect.top <= windowH * 0.8)) {
        item.classList.add('is-active');
      } else {
        item.classList.remove('is-active');
      }
    });
  }

  window.addEventListener('scroll', updateProcessScroll, { passive: true });
  window.addEventListener('resize', updateProcessScroll, { passive: true });
  updateProcessScroll();
}

/**
 * Universal Mobile Navigation Drawer Handler
 */
function initMobileNavToggle() {
  const toggleBtn = document.querySelector('.menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu') || document.querySelector('.mobile-nav');

  if (!toggleBtn || !mobileMenu) return;

  toggleBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const isOpen = mobileMenu.classList.toggle('nav-open');
    toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });

  document.addEventListener('click', (e) => {
    if (mobileMenu.classList.contains('nav-open') && !mobileMenu.contains(e.target) && !toggleBtn.contains(e.target)) {
      mobileMenu.classList.remove('nav-open');
      toggleBtn.setAttribute('aria-expanded', 'false');
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && mobileMenu.classList.contains('nav-open')) {
      mobileMenu.classList.remove('nav-open');
      toggleBtn.setAttribute('aria-expanded', 'false');
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initProcessProgressScroll();
  initMobileNavToggle();
});


// ==========================================================================
// GSAP SCROLL ANIMATIONS FOR POLISHED CARDS & WATERMARKS
// ==========================================================================
document.addEventListener('DOMContentLoaded', () => {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

  // 1. Watermark subtle parallax
  const heroWatermark = document.querySelector('.denmar-hero-watermark');
  const heroSection = document.querySelector('.denmar-hero-section');
  if (heroWatermark && heroSection) {
    gsap.fromTo(heroWatermark,
      { opacity: 0, y: 30 },
      { opacity: 1, y: 0, duration: 1.2, ease: 'power2.out', delay: 0.3 }
    );

    gsap.to(heroWatermark, {
      yPercent: -20,
      opacity: 0.02,
      ease: 'none',
      scrollTrigger: {
        trigger: heroSection,
        start: 'top top',
        end: 'bottom top',
        scrub: 1
      }
    });
  }

  // 2. Overview Bento Grid Entrance
  const overviewGrid = document.querySelector('.about-overview-grid');
  if (overviewGrid) {
    gsap.fromTo(overviewGrid,
      { opacity: 0, y: 40, scale: 0.98 },
      {
        opacity: 1,
        y: 0,
        scale: 1,
        duration: 1.0,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: overviewGrid,
          start: 'top 85%'
        }
      }
    );
  }

  // 3. Core Specializations Cards Stagger Reveal
  const specCards = document.querySelectorAll('.spec-ref-card');
  if (specCards.length) {
    gsap.fromTo(specCards,
      { opacity: 0, y: 40 },
      {
        opacity: 1,
        y: 0,
        duration: 0.8,
        stagger: 0.12,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: '.spec-cards-container',
          start: 'top 82%'
        }
      }
    );
  }

  // 4. Why Choose Us Feature Cards Stagger Reveal
  const whyCards = document.querySelectorAll('.why-feature-card');
  if (whyCards.length) {
    gsap.fromTo(whyCards,
      { opacity: 0, y: 30 },
      {
        opacity: 1,
        y: 0,
        duration: 0.75,
        stagger: 0.1,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: '.why-choose-container',
          start: 'top 80%'
        }
      }
    );
  }
});
