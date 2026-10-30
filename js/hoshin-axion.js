/* Hoshin — AXION layer helpers.
   Loaded just before site.js: shuffles the product carousel (a random mix
   on every visit) before site.js measures it. */
(function () {
  'use strict';

  /* 1. Random product order */
  Array.prototype.forEach.call(document.querySelectorAll('[data-ax-shuffle]'), function (track) {
    var items = Array.prototype.slice.call(track.children);
    for (var i = items.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var t = items[i]; items[i] = items[j]; items[j] = t;
    }
    items.forEach(function (el) { track.appendChild(el); });
  });

  /* 2. Category cards rise into place as each one scrolls into view */
  var rise = document.querySelector('[data-ax-rise]');
  if (rise) {
    var cards = Array.prototype.slice.call(rise.children);
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce || !('IntersectionObserver' in window)) return;
    rise.classList.add('ax-rise');
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (!en.isIntersecting) return;
        var i = cards.indexOf(en.target);
        en.target.style.transitionDelay = ((i % 3) * 0.12) + 's';
        en.target.classList.add('is-up');
        io.unobserve(en.target);
      });
    }, { rootMargin: '0px 0px -10% 0px' });
    cards.forEach(function (c) { io.observe(c); });
  }

  /* 3. Why choose: GSAP reveal — photo opens and settles, cards rise in order */
  window.addEventListener('load', function () {
    var why = document.querySelector('[data-ax-why]');
    var gsap = window.gsap;
    if (!why || !gsap || !window.ScrollTrigger) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    gsap.registerPlugin(window.ScrollTrigger);
    var box = why.querySelector('.ax-why__img'), img = box && box.querySelector('img');
    var cells = why.querySelectorAll('.v-why__cell');
    var tl = gsap.timeline({ scrollTrigger: { trigger: why, start: 'top 78%', once: true } });
    if (box) {
      tl.fromTo(box, { clipPath: 'inset(12% 12% 12% 12% round 18px)', opacity: 0 },
                     { clipPath: 'inset(0% 0% 0% 0% round 18px)', opacity: 1, duration: 1.3, ease: 'expo.out' }, 0);
      if (img) tl.fromTo(img, { scale: 1.25 }, { scale: 1, duration: 1.8, ease: 'expo.out' }, 0);
    }
    tl.fromTo(cells, { y: 60, opacity: 0 },
              { y: 0, opacity: 1, duration: 1.1, ease: 'expo.out', stagger: { each: 0.1, grid: [2, 2], from: 'start' }, clearProps: 'transform' }, 0.15);
    cells.forEach(function (c) {
      var t = c.querySelector('.v-why__title'), d = c.querySelector('.v-why__desc');
      if (t && d) tl.fromTo([t, d], { y: 14, opacity: 0 }, { y: 0, opacity: 1, duration: .8, ease: 'power3.out', stagger: .06 }, '<0.1');
    });
  });

  /* 4. Home-page GSAP reveals (each plays once as its section scrolls in) */
  window.addEventListener('load', function () {
    var gsap = window.gsap, ST = window.ScrollTrigger;
    if (!gsap || !ST || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    gsap.registerPlugin(ST);
    var E = 'expo.out';
    function on(trigger, start, build) {
      if (!trigger) return;
      var tl = gsap.timeline({ paused: true });
      build(tl);
      ST.create({ trigger: trigger, start: start || 'top 80%', once: true, onEnter: function () { tl.play(); } });
    }
    var $ = function (s, c) { return (c || document).querySelector(s); };
    var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

    // Company overview: photo opens from a smaller rounded window, text rises line by line
    var fig = $('.ax-about__img');
    on($('.ax-about'), 'top 75%', function (tl) {
      if (fig) {
        tl.fromTo(fig, { clipPath: 'inset(14% 14% 14% 14% round 20px)', opacity: 0 }, { clipPath: 'inset(0% 0% 0% 0% round 20px)', opacity: 1, duration: 1.4, ease: E }, 0)
          .fromTo(fig.querySelector('img'), { scale: 1.3 }, { scale: 1, duration: 1.9, ease: E }, 0);
      }
      tl.fromTo($$('[data-ax-up]'), { y: 50, opacity: 0 }, { y: 0, opacity: 1, duration: 1.1, ease: E, stagger: 0.1 }, 0.2);
    });

    // Featured products: heading lifts, cards slide in from the right one after another
    on($('.ax-gallery-head'), 'top 85%', function (tl) {
      tl.fromTo($$('.ax-gallery-head > *'), { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 1, ease: E, stagger: 0.08 }, 0)
        .fromTo($$('.ax-gitem').slice(0, 8), { x: 80, opacity: 0 }, { x: 0, opacity: 1, duration: 1.2, ease: E, stagger: 0.07, clearProps: 'transform' }, 0.1);
    });

    // 6-step cards rise in, row by row
    var steps = $('.v-process[data-ax-grid] .v-process__cards');
    on(steps, 'top 82%', function (tl) {
      tl.fromTo($$('.v-step', steps), { y: 60, opacity: 0 }, { y: 0, opacity: 1, duration: 1.1, ease: E, stagger: { each: 0.09, grid: [2, 3] }, clearProps: 'transform' }, 0);
    });

    // Brands: heading lifts, logo strip fades up
    on($('.ax-brands'), 'top 80%', function (tl) {
      tl.fromTo($$('.ax-brands .ax-head > *'), { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 1, ease: E, stagger: 0.08 }, 0)
        .fromTo($('.ax-marquee'), { y: 40, opacity: 0 }, { y: 0, opacity: 1, duration: 1.2, ease: E }, 0.15);
    });

    // Closing banner: card widens from a smaller window, photo settles
    var cta = $('.v-cta');
    on(cta, 'top 85%', function (tl) {
      tl.fromTo(cta, { clipPath: 'inset(6% 8% 6% 8% round 28px)' }, { clipPath: 'inset(0% 0% 0% 0% round 20px)', duration: 1.4, ease: E }, 0);
      var im = $('.v-cta__bg img', cta);
      if (im) tl.fromTo(im, { scale: 1.2 }, { scale: 1, duration: 1.8, ease: E }, 0);
    });
  });
})();
