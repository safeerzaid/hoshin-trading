/**
 * HOSHIN TRADING — V3 SITE SCRIPT
 * Smooth scroll, header, mega menu, mobile menu, scroll reveals, parallax,
 * pillar hover images, process steps, and shared form validation.
 */
(function () {
  'use strict';

  var root = document.documentElement;
  root.classList.remove('no-js');
  root.classList.add('js');

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  // ?noanim renders the final state instantly (used for screenshots / QA).
  if (/[?&]noanim\b/.test(location.search)) {
    reduceMotion = true; root.classList.add('is-static');
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('img[loading="lazy"]').forEach(function (i) { i.loading = 'eager'; });
    });
  }
  var finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  var hasGSAP = typeof window.gsap !== 'undefined' && typeof window.ScrollTrigger !== 'undefined';
  var lenis = null;

  function $(sel, ctx) { return (ctx || document).querySelector(sel); }
  function $$(sel, ctx) { return Array.prototype.slice.call((ctx || document).querySelectorAll(sel)); }

  /* ------------------------------------------------------------------ */
  /* Smooth scroll                                                       */
  /* ------------------------------------------------------------------ */
  function initSmoothScroll() {
    if (reduceMotion || typeof window.Lenis === 'undefined') return;
    lenis = new window.Lenis({
      duration: 1.15,
      easing: function (t) { return Math.min(1, 1.001 - Math.pow(2, -10 * t)); },
      smoothWheel: true,
      touchMultiplier: 1.4
    });
    window.lenis = lenis;
    if (hasGSAP) {
      gsap.registerPlugin(ScrollTrigger);
      lenis.on('scroll', ScrollTrigger.update);
      gsap.ticker.add(function (time) { lenis.raf(time * 1000); });
      gsap.ticker.lagSmoothing(0);
    } else {
      (function raf(time) { lenis.raf(time); requestAnimationFrame(raf); })();
    }

    $$('a[href^="#"]').forEach(function (a) {
      a.addEventListener('click', function (e) {
        var id = a.getAttribute('href');
        if (id.length > 1 && document.querySelector(id)) {
          e.preventDefault();
          lenis.scrollTo(id, { offset: -80 });
        }
      });
    });
  }

  function lockScroll(lock) {
    document.body.classList.toggle('is-locked', lock);
    if (lenis) { lock ? lenis.stop() : lenis.start(); }
  }

  /* ------------------------------------------------------------------ */
  /* Header: scrolled / hide-on-scroll                                    */
  /* ------------------------------------------------------------------ */
  function initHeader() {
    var header = $('.h-header');
    if (!header) return;
    var lastY = window.scrollY;
    var ticking = false;

    function update() {
      var y = window.scrollY;
      header.classList.toggle('is-scrolled', y > 8);
      if (!header.classList.contains('is-open') && !header.classList.contains('is-mobile-open')) {
        header.classList.toggle('is-hidden', y > lastY && y > 320);
      }
      lastY = y;
      ticking = false;
    }
    window.addEventListener('scroll', function () {
      if (!ticking) { requestAnimationFrame(update); ticking = true; }
    }, { passive: true });
    update();

    // Active link
    var page = (location.pathname.split('/').pop() || 'index.html').toLowerCase();
    $$('.h-nav__link[data-page]').forEach(function (l) {
      var pages = l.getAttribute('data-page').split(' ');
      if (pages.indexOf(page) > -1) l.classList.add('is-active');
    });
  }

  /* ------------------------------------------------------------------ */
  /* Mega menu                                                           */
  /* ------------------------------------------------------------------ */
  function initMega() {
    var item = $('.h-nav__item--mega');
    if (!item) return;
    var header = $('.h-header');
    var trigger = $('.h-nav__link', item);
    var mega = $('.h-mega', item);
    var scrim = $('.h-scrim');
    var cats = $$('.h-mega__cat', mega);
    var panels = $$('.h-mega__panel', mega);
    var imgs = $$('.h-mega__img img', mega);
    var desc = $('.h-mega__desc', mega);
    var closeTimer = null;

    function setActive(slug) {
      cats.forEach(function (c) { c.classList.toggle('is-active', c.dataset.cat === slug); });
      panels.forEach(function (p) { p.classList.toggle('is-active', p.dataset.cat === slug); });
      imgs.forEach(function (i) { i.classList.toggle('is-active', i.dataset.cat === slug); });
      var active = cats.filter(function (c) { return c.dataset.cat === slug; })[0];
      if (desc && active) desc.textContent = active.dataset.desc || '';
    }
    function open() {
      clearTimeout(closeTimer);
      item.classList.add('is-open');
      header.classList.add('is-open');
      trigger.setAttribute('aria-expanded', 'true');
      if (scrim) scrim.classList.add('is-on');
    }
    function close(now) {
      clearTimeout(closeTimer);
      var run = function () {
        item.classList.remove('is-open');
        header.classList.remove('is-open');
        trigger.setAttribute('aria-expanded', 'false');
        if (scrim) scrim.classList.remove('is-on');
      };
      now ? run() : (closeTimer = setTimeout(run, 180));
    }

    if (cats.length) setActive(cats[0].dataset.cat);
    // QA: index.html?noanim#mega-<slug> opens the menu on load.
    var qa = /^#mega(?:-(\w+))?$/.exec(location.hash);
    if (qa && root.classList.contains('is-static')) { open(); if (qa[1]) setActive(qa[1]); }

    // Opens only from the Products link: hover it (mouse) or tap it (touch).
    // It stays open while the pointer is on the link or inside the panel.
    var isOpen = function () { return item.classList.contains('is-open'); };
    var desktop = function () { return window.innerWidth > 991; };
    trigger.addEventListener('pointerenter', function (e) {
      if (desktop() && e.pointerType === 'mouse') open();
    });
    // The menu sits inside the Products item and touches the header, so the
    // item only "leaves" when the pointer is off both the link and the menu.
    item.addEventListener('pointerenter', function (e) {
      if (e.pointerType === 'mouse' && isOpen()) clearTimeout(closeTimer);
    });
    item.addEventListener('pointerleave', function (e) {
      if (e.pointerType === 'mouse') close();
    });
    trigger.addEventListener('click', function (e) {
      if (!desktop()) return;
      // Mouse users already opened it by hovering, so a click follows the link.
      if (e.pointerType === 'mouse' || (e.detail && !('ontouchstart' in window))) return;
      e.preventDefault();
      isOpen() ? close(true) : open();
    });
    document.addEventListener('pointerdown', function (e) {
      if (isOpen() && !item.contains(e.target)) close(true);
    });
    trigger.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowDown') { e.preventDefault(); open(); if (cats[0]) cats[0].focus(); }
    });
    cats.forEach(function (c) {
      c.addEventListener('mouseenter', function () { setActive(c.dataset.cat); });
      c.addEventListener('focus', function () { if (isOpen()) setActive(c.dataset.cat); });
    });
    item.addEventListener('focusout', function (e) {
      if (isOpen() && !item.contains(e.relatedTarget)) close(true);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && item.classList.contains('is-open')) { close(true); trigger.focus(); }
    });
    if (scrim) scrim.addEventListener('click', function () { close(true); });
  }

  /* ------------------------------------------------------------------ */
  /* Mobile menu                                                         */
  /* ------------------------------------------------------------------ */
  function initMobile() {
    var btn = $('.h-burger');
    var panel = $('.h-mobile');
    var header = $('.h-header');
    if (!btn || !panel) return;
    function set(open) {
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      panel.classList.toggle('is-open', open);
      header.classList.toggle('is-mobile-open', open);
      header.classList.remove('is-hidden');
      lockScroll(open);
    }
    btn.addEventListener('click', function () { set(btn.getAttribute('aria-expanded') !== 'true'); });
    $$('.h-mobile__toggle', panel).forEach(function (t) {
      t.addEventListener('click', function () {
        var sub = document.getElementById(t.getAttribute('aria-controls'));
        var open = t.getAttribute('aria-expanded') !== 'true';
        t.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (sub) sub.classList.toggle('is-open', open);
      });
    });
    window.addEventListener('resize', function () { if (window.innerWidth > 991 && panel.classList.contains('is-open')) set(false); });
    if (location.hash === '#menu' && root.classList.contains('is-static')) {
      set(true);
      var first = $('.h-mobile__toggle', panel); if (first) first.click();
    }
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && panel.classList.contains('is-open')) set(false); });
  }

  /* ------------------------------------------------------------------ */
  /* Split text into words for reveal                                    */
  /* ------------------------------------------------------------------ */
  function splitWords(el) {
    if (el.dataset.splitDone) return;
    el.dataset.splitDone = '1';
    var chars = el.getAttribute('data-split') === 'chars';
    var walk = function (node) {
      Array.prototype.slice.call(node.childNodes).forEach(function (child) {
        if (child.nodeType === 3) {
          var parts = child.textContent.split(/(\s+)/);
          var frag = document.createDocumentFragment();
          parts.forEach(function (part) {
            if (!part) return;
            if (/^\s+$/.test(part)) { frag.appendChild(document.createTextNode(part)); return; }
            var w = document.createElement('span');
            w.className = 'w';
            if (chars) {
              Array.prototype.forEach.call(part, function (ch) {
                var c = document.createElement('span'); c.className = 'c';
                var ci = document.createElement('span'); ci.textContent = ch;
                c.appendChild(ci); w.appendChild(c);
              });
            } else {
              var inner = document.createElement('span');
              inner.textContent = part;
              w.appendChild(inner);
            }
            frag.appendChild(w);
          });
          node.replaceChild(frag, child);
        } else if (child.nodeType === 1 && !child.classList.contains('w')) {
          walk(child);
        }
      });
    };
    walk(el);
    el.classList.add('h-split');
  }

  function initSplits() {
    var els = $$('[data-split]');
    if (reduceMotion || !els.length) return;
    els.forEach(function (el) {
      splitWords(el);
      var chars = el.getAttribute('data-split') === 'chars';
      var words = chars ? $$('.c > span', el) : $$('.w > span', el);
      if (hasGSAP) {
        gsap.set(words, { yPercent: chars ? 115 : 110 });
        // Inline images inside the heading (e.g. the pill photo) join the reveal
        // at their place in the sentence instead of showing from the start.
        var pills = $$('.v-pill-img', el);
        if (pills.length) {
          gsap.set(pills, { scale: 0, opacity: 0 });
          words = $$(chars ? '.c > span, .v-pill-img' : '.w > span, .v-pill-img', el);
        }
        var immediate = el.hasAttribute('data-split-now');
        var extra = parseFloat(el.getAttribute('data-split-delay') || '0');
        if (immediate && el.closest('.h-banner')) extra += 0.55; // wait for the banner curtain
        var anim = function () {
          gsap.to(words, { yPercent: 0, scale: 1, opacity: 1, duration: chars ? 1.1 : 1.15, ease: 'expo.out', stagger: chars ? 0.028 : 0.045, delay: (immediate ? 0.15 : 0) + extra });
        };
        if (immediate) { anim(); }
        else {
          ScrollTrigger.create({ trigger: el, start: 'top 88%', once: true, onEnter: anim });
        }
      } else {
        words.forEach(function (w) { w.style.transform = 'none'; });
      }
    });
  }

  /* ------------------------------------------------------------------ */
  /* Reveal on scroll                                                    */
  /* ------------------------------------------------------------------ */
  function initReveals() {
    var els = $$('[data-reveal]');
    if (!els.length) return;
    if (reduceMotion || !('IntersectionObserver' in window)) {
      els.forEach(function (el) { el.classList.add('is-in'); });
      return;
    }
    // Clipped elements report as invisible to IntersectionObserver, so watch their parent instead.
    var targets = new Map();
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var list = targets.get(entry.target) || [];
        list.forEach(function (el) {
          var delay = parseFloat(el.getAttribute('data-delay') || '0');
          setTimeout(function () { el.classList.add('is-in'); }, delay * 1000);
        });
        io.unobserve(entry.target);
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0 });
    els.forEach(function (el) {
      var t = el.getAttribute('data-reveal') === 'clip' && el.parentElement ? el.parentElement : el;
      if (!targets.has(t)) { targets.set(t, []); io.observe(t); }
      targets.get(t).push(el);
    });
  }

  /* ------------------------------------------------------------------ */
  /* Parallax                                                            */
  /* ------------------------------------------------------------------ */
  function initParallax() {
    if (reduceMotion || !hasGSAP) return;
    $$('[data-parallax]').forEach(function (el) {
      var amount = parseFloat(el.getAttribute('data-parallax')) || 10;
      var target = el.querySelector('img') || el;
      gsap.fromTo(target, { yPercent: -amount / 2 }, {
        yPercent: amount / 2, ease: 'none',
        scrollTrigger: { trigger: el, start: 'top bottom', end: 'bottom top', scrub: true }
      });
    });
    $$('[data-drift]').forEach(function (el) {
      var amount = parseFloat(el.getAttribute('data-drift')) || 40;
      gsap.to(el, { y: -amount, ease: 'none', scrollTrigger: { trigger: el, start: 'top bottom', end: 'bottom top', scrub: true } });
    });
    $$('[data-rotate]').forEach(function (el) {
      gsap.to(el, { rotate: parseFloat(el.getAttribute('data-rotate')) || 90, ease: 'none', scrollTrigger: { trigger: el, start: 'top bottom', end: 'bottom top', scrub: true } });
    });
    $$('[data-fill]').forEach(function (el) {
      gsap.to(el, { scaleX: 1, ease: 'none', scrollTrigger: { trigger: el.parentElement.parentElement, start: 'top 75%', end: 'bottom 60%', scrub: true } });
    });
  }

  /* ------------------------------------------------------------------ */
  /* Pillars: cursor-follow image                                        */
  /* ------------------------------------------------------------------ */
  function initPillars() {
    var list = $('.h-pillars');
    var box = $('.h-cursor-img');
    if (!list || !box || !finePointer) return;
    var imgs = $$('img', box);
    var x = 0, y = 0, cx = 0, cy = 0, raf = null, on = false;
    function loop() {
      cx += (x - cx) * 0.14; cy += (y - cy) * 0.14;
      box.style.left = cx + 'px'; box.style.top = cy + 'px';
      raf = on || Math.abs(x - cx) > 0.5 ? requestAnimationFrame(loop) : null;
    }
    list.addEventListener('mousemove', function (e) {
      x = e.clientX; y = e.clientY;
      if (!raf) raf = requestAnimationFrame(loop);
    });
    $$('.h-pillar', list).forEach(function (row, i) {
      row.addEventListener('mouseenter', function (e) {
        if (!on) { cx = x = e.clientX; cy = y = e.clientY; }
        on = true; box.classList.add('is-on');
        imgs.forEach(function (im, j) { im.classList.toggle('is-active', j === i); });
        if (!raf) raf = requestAnimationFrame(loop);
      });
    });
    list.addEventListener('mouseleave', function () { on = false; box.classList.remove('is-on'); });
  }

  /* ------------------------------------------------------------------ */
  /* Process: active step + sticky image                                 */
  /* ------------------------------------------------------------------ */
  function initProcess() {
    var section = $('.h-process');
    if (!section) return;
    var steps = $$('.h-step', section);
    var imgs = $$('.h-process__media img', section);
    var counter = $('.h-process__counter b', section);
    var bar = $('.h-process__bar i', section);
    function activate(i) {
      steps.forEach(function (s, j) { s.classList.toggle('is-active', j === i); });
      imgs.forEach(function (im, j) { im.classList.toggle('is-active', j === i); });
      if (counter) counter.textContent = String(i + 1).padStart(2, '0');
      if (bar) bar.style.transform = 'scaleX(' + ((i + 1) / steps.length) + ')';
    }
    activate(0);
    if (!('IntersectionObserver' in window)) return;
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) activate(steps.indexOf(entry.target));
      });
    }, { rootMargin: '-45% 0px -45% 0px', threshold: 0 });
    steps.forEach(function (s) { io.observe(s); });
  }

  /* ------------------------------------------------------------------ */
  /* Hero banner: as it scrolls away the photo drifts slower and zooms   */
  /* in slightly, the copy lifts and fades, and the shade deepens.       */
  /* ------------------------------------------------------------------ */
  function initBanner() {
    var banner = $('.h-banner');
    if (!banner) return;
    var badge = $('.h-badge', banner);
    initMagnetic(badge);
    if (reduceMotion || !hasGSAP) return;

    var media = $('.h-banner__media', banner);
    var img = $('img', media);
    var shade = $('.h-banner__shade', banner);
    var lines = $$('.h-banner__grid i', banner);
    var l1 = $('.line--1', banner);
    var l2 = $('.line--2', banner);
    var top = $('.h-banner__top', banner);
    var side = $('.h-banner__side', banner);
    var bar = $('.h-banner__bar', banner);

    // Load: photo rises in like a curtain, grid lines draw, then the details settle.
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .fromTo(media, { clipPath: 'inset(100% 0% 0% 0%)', scale: 1.18 }, { clipPath: 'inset(0% 0% 0% 0%)', scale: 1, duration: 1.6, ease: 'expo.inOut' }, 0)
      .fromTo(lines, { scaleY: 0 }, { scaleY: 1, duration: 1.4, stagger: 0.08 }, 0.6)
      .from(top.children, { y: 16, opacity: 0, duration: 1, stagger: 0.1 }, 0.9)
      .from(side.children, { y: 24, opacity: 0, duration: 1.1, stagger: 0.1 }, 1.05)
      .from(bar.children, { y: 18, opacity: 0, duration: 0.9, stagger: 0.06 }, 1.15);

    // Scroll away: headline lines part ways, photo drifts, details lift off.
    gsap.timeline({ defaults: { ease: 'none' }, scrollTrigger: { trigger: banner, start: 'top top', end: 'bottom top', scrub: 0.6 } })
      .to(img, { yPercent: 16, scale: 1.08 }, 0)
      .to(shade, { backgroundColor: 'rgba(4, 30, 62, 0.45)' }, 0)
      .to(l1, { xPercent: -8, opacity: 0.2 }, 0)
      .to(l2, { xPercent: 8, opacity: 0.2 }, 0)
      .to(top, { y: -40, opacity: 0 }, 0)
      .to(side, { y: -80, opacity: 0 }, 0)
      .to(bar, { y: 40, opacity: 0 }, 0);
  }

  // Element leans toward the cursor while hovered.
  function initMagnetic(el) {
    if (!el || !finePointer || reduceMotion) return;
    var strength = 0.35;
    el.addEventListener('mousemove', function (e) {
      var r = el.getBoundingClientRect();
      var x = (e.clientX - (r.left + r.width / 2)) * strength;
      var y = (e.clientY - (r.top + r.height / 2)) * strength;
      el.style.transform = 'translate(' + x + 'px,' + y + 'px)';
    });
    el.addEventListener('mouseleave', function () {
      el.style.transition = 'transform 0.7s cubic-bezier(0.22, 1, 0.36, 1)';
      el.style.transform = '';
      setTimeout(function () { el.style.transition = ''; }, 700);
    });
  }

  /* ------------------------------------------------------------------ */
  /* Home hero background: slow push-in on load, parallax on scroll      */
  /* ------------------------------------------------------------------ */
  function initHeroBg() {
    var hero = $('.h-hero--banner');
    if (!hero || reduceMotion || !hasGSAP) return;
    var img = $('.h-hero__bg img', hero);
    var inner = $('.h-hero__inner', hero);
    gsap.fromTo(img, { scale: 1.14 }, { scale: 1, duration: 2.4, ease: 'power3.out' });
    gsap.timeline({ defaults: { ease: 'none' }, scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: 0.6 } })
      .to(img, { yPercent: 16 }, 0)
      .to(inner, { y: -80, opacity: 0.1 }, 0);
  }

  /* ------------------------------------------------------------------ */
  /* Core Specializations: pinned horizontal gallery (desktop),          */
  /* native swipe with snap (tablet / mobile).                           */
  /* ------------------------------------------------------------------ */
  function initSpecs() {
    var sec = $('.h-specs-sec');
    if (!sec) return;
    var pin = $('.h-specs__pin', sec);
    var viewport = $('.h-specs__viewport', sec);
    var track = $('.h-specs__track', sec);
    var cards = $$('.h-spec', sec);
    var bar = $('.h-specs__progress i', sec);
    var count = $('.h-specs__count', sec);
    var n = cards.length;

    function setProgress(p) {
      if (bar) bar.style.transform = 'scaleX(' + Math.max(1 / n, Math.min(1, p)) + ')';
      if (count) count.textContent = String(Math.min(n, Math.floor(p * n * 0.999) + 1)).padStart(2, '0');
    }

    // Swipe mode progress
    viewport.addEventListener('scroll', function () {
      var max = viewport.scrollWidth - viewport.clientWidth;
      if (max > 0) setProgress(viewport.scrollLeft / max);
    }, { passive: true });

    if (!hasGSAP || reduceMotion) return;
    var mm = gsap.matchMedia();
    mm.add('(min-width: 992px)', function () {
      sec.classList.add('is-pinned');
      var dist = function () { return Math.max(0, track.scrollWidth - viewport.clientWidth); };
      var move = gsap.to(track, {
        x: function () { return -dist(); },
        ease: 'none',
        scrollTrigger: {
          trigger: sec, start: 'top top', end: function () { return '+=' + dist(); },
          pin: pin, scrub: 0.8, invalidateOnRefresh: true, anticipatePin: 1,
          onUpdate: function (self) { setProgress(self.progress); }
        }
      });
      // Each photo drifts inside its card as the row slides.
      cards.forEach(function (card) {
        var img = $('.h-spec__img img', card);
        gsap.fromTo(img, { xPercent: 6 }, {
          xPercent: -6, ease: 'none',
          scrollTrigger: { trigger: card, containerAnimation: move, start: 'left right', end: 'right left', scrub: true }
        });
      });
      // Cards rise in when the section arrives.
      gsap.from(cards, {
        y: 70, opacity: 0, duration: 1.1, ease: 'expo.out', stagger: 0.08,
        scrollTrigger: { trigger: sec, start: 'top 75%', once: true }
      });
      return function () { sec.classList.remove('is-pinned'); };
    });
  }

  /* ------------------------------------------------------------------ */
  /* Core Specializations index: the item at the centre of the screen    */
  /* (or the one hovered) opens and its photo wipes into the frame.      */
  /* ------------------------------------------------------------------ */
  function initIndexList() {
    var sec = $('.h-idx-sec');
    if (!sec) return;
    var items = $$('.h-idx__item', sec);
    var imgs = $$('.h-idx__frame img', sec);
    var caps = $$('.h-idx__caps span', sec);
    var count = $('.h-idx__count b', sec);
    var current = 0;

    function activate(i) {
      if (i === current || i < 0) return;
      items.forEach(function (el, j) { el.classList.toggle('is-active', j === i); });
      imgs.forEach(function (img, j) {
        img.classList.toggle('was-active', j === current);
        img.classList.toggle('is-active', j === i);
      });
      caps.forEach(function (c, j) { c.classList.toggle('is-active', j === i); });
      if (count) count.textContent = String(i + 1).padStart(2, '0');
      current = i;
      if (hasGSAP) setTimeout(function () { ScrollTrigger.refresh(); }, 750); // list height changed
    }

    items.forEach(function (el, i) {
      $('.h-idx__link', el).addEventListener('mouseenter', function () { if (finePointer) activate(i); });
    });
    if ('IntersectionObserver' in window) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) activate(items.indexOf(entry.target));
        });
      }, { rootMargin: '-46% 0px -46% 0px', threshold: 0 });
      items.forEach(function (el) { io.observe(el); });
    }
  }

  /* ------------------------------------------------------------------ */
  /* Core Specializations icon cards: icons draw in, cards rise with a   */
  /* slight 3D tilt, middle column drifts, hover tilt + spotlight.       */
  /* ------------------------------------------------------------------ */
  function initSpecCards() {
    var grid = $('.h-sc-grid');
    if (!grid) return;
    var cards = $$('.h-sc', grid);

    // Prepare icon strokes for the draw-on effect.
    cards.forEach(function (card) {
      $$('.h-sc__icon svg path, .h-sc__icon svg rect, .h-sc__icon svg circle', card).forEach(function (el) {
        el.setAttribute('pathLength', '1');
      });
    });

    function draw(card, i) {
      $$('.h-sc__icon svg [pathLength]', card).forEach(function (el, k) {
        el.style.transitionDelay = (0.25 + (i % 3) * 0.12 + k * 0.08) + 's';
      });
      card.classList.add('is-drawn');
    }
    if (reduceMotion || !('IntersectionObserver' in window)) {
      cards.forEach(function (c) { c.classList.add('is-drawn'); });
    } else {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          draw(entry.target, cards.indexOf(entry.target));
          io.unobserve(entry.target);
        });
      }, { rootMargin: '0px 0px -12% 0px' });
      cards.forEach(function (c) { io.observe(c); });
    }

    if (!hasGSAP || reduceMotion) return;

    // Entrance: rows rise in with a soft 3D flip.
    gsap.from(cards, {
      yPercent: 28, rotationX: -16, opacity: 0, transformOrigin: '50% 100%',
      duration: 1.2, ease: 'expo.out', stagger: { each: 0.09, grid: [2, 3], from: 'start' },
      scrollTrigger: { trigger: grid, start: 'top 82%', once: true }
    });

    var mm = gsap.matchMedia();
    mm.add('(min-width: 992px)', function () {
      // Middle column drifts against the scroll; aligned when the grid is centred.
      cards.forEach(function (card, i) {
        if (i % 3 !== 1) return;
        gsap.fromTo(card, { y: 36 }, { y: -36, ease: 'none', scrollTrigger: { trigger: grid, start: 'top bottom', end: 'bottom top', scrub: 1 } });
      });
      if (!finePointer) return;
      // Hover tilt + spotlight following the cursor.
      cards.forEach(function (card) {
        var rx = gsap.quickTo(card, 'rotationX', { duration: 0.6, ease: 'power3.out' });
        var ry = gsap.quickTo(card, 'rotationY', { duration: 0.6, ease: 'power3.out' });
        card.addEventListener('mousemove', function (e) {
          var r = card.getBoundingClientRect();
          var px = (e.clientX - r.left) / r.width, py = (e.clientY - r.top) / r.height;
          card.style.setProperty('--mx', (px * 100) + '%');
          card.style.setProperty('--my', (py * 100) + '%');
          ry((px - 0.5) * 7);
          rx(-(py - 0.5) * 7);
        });
        card.addEventListener('mouseleave', function () { rx(0); ry(0); });
      });
    });
  }

  /* ------------------------------------------------------------------ */
  /* Process timeline: a gold line runs step to step as you scroll;      */
  /* each step lights up when the line reaches it. Pinned on desktop.    */
  /* ------------------------------------------------------------------ */
  function initFlow() {
    var sec = $('.h-flow-sec');
    if (!sec) return;
    var flow = $('.h-flow', sec);
    var steps = $$('.h-flow__step', sec);
    var n = steps.length;

    function setP(p) {
      flow.style.setProperty('--p', p.toFixed(4));
      steps.forEach(function (s, i) { s.classList.toggle('is-active', p >= (i / (n - 1)) - 0.002); });
    }
    if (!hasGSAP || reduceMotion) { setP(1); return; }
    setP(0);

    var mm = gsap.matchMedia();
    mm.add('(min-width: 992px)', function () {
      sec.classList.add('is-pinned');
      ScrollTrigger.create({
        trigger: sec, start: 'top top', end: '+=' + (n * 32) + '%', pin: $('.h-flow__pin', sec), scrub: 0.6, anticipatePin: 1,
        onUpdate: function (self) { setP(self.progress); }
      });
      return function () { sec.classList.remove('is-pinned'); };
    });
    mm.add('(max-width: 991px)', function () {
      ScrollTrigger.create({
        trigger: flow, start: 'top 65%', end: 'bottom 55%', scrub: 0.4,
        onUpdate: function (self) { setP(self.progress); }
      });
    });
  }

  /* ------------------------------------------------------------------ */
  /* Vertical timeline: the gold-to-navy beam grows down the rail as you */
  /* scroll; the step whose title is pinned lights up.                   */
  /* ------------------------------------------------------------------ */
  function initTimeline() {
    var tl = $('.h-tl');
    if (!tl) return;
    var fill = $('.h-tl__line i', tl);
    var items = $$('.h-tl__item', tl);

    function setP(p) {
      fill.style.height = (p * 100).toFixed(2) + '%';
      fill.style.opacity = Math.min(1, p / 0.1).toFixed(3);
    }
    if (!hasGSAP || reduceMotion) { setP(1); items.forEach(function (it) { it.classList.add('is-active'); }); return; }
    setP(0);
    ScrollTrigger.create({
      trigger: tl, start: 'top 10%', end: 'bottom 50%', scrub: 0.4,
      onUpdate: function (self) { setP(self.progress); }
    });
    // A step is active while its row crosses the upper-middle of the screen.
    items.forEach(function (it) {
      ScrollTrigger.create({
        trigger: $('.h-tl__body', it), start: 'top 62%', end: 'bottom 38%',
        onToggle: function (self) { it.classList.toggle('is-active', self.isActive); }
      });
    });
  }

  /* ------------------------------------------------------------------ */
  /* V4: gallery strip drifts sideways as the page scrolls               */
  /* ------------------------------------------------------------------ */
  function initGalleries() {
    if (!hasGSAP || reduceMotion) return;
    $$('.v-gallery').forEach(function (g) {
      var track = $('.v-gallery__track', g);
      gsap.fromTo(track, { x: 0 }, {
        x: function () { return -Math.max(0, track.scrollWidth - g.clientWidth) * 0.28; },
        ease: 'none',
        scrollTrigger: { trigger: g, start: 'top bottom', end: 'bottom top', scrub: 1.8, invalidateOnRefresh: true }
      });
    });
  }

  /* V4: specializations accordion — hover / focus / tap opens a column */
  function initAccordion() {
    var acc = $('.v-acc');
    if (!acc) return;
    var panels = $$('.v-acc__panel', acc);
    function open(p) { panels.forEach(function (x) { x.classList.toggle('is-active', x === p); }); }
    panels.forEach(function (p) {
      p.addEventListener('mouseenter', function () { if (finePointer) open(p); });
      $('a', p).addEventListener('focus', function () { open(p); });
      $('a', p).addEventListener('click', function (e) {
        if (!p.classList.contains('is-active')) { e.preventDefault(); open(p); } // first tap opens, second follows
      });
    });
    if (hasGSAP && !reduceMotion) {
      gsap.from(panels, { y: 50, opacity: 0, duration: 1, ease: 'expo.out', stagger: 0.07, scrollTrigger: { trigger: acc, start: 'top 82%', once: true } });
    }
  }

  /* Core Specializations: hovering a row wipes its photo into the sticky card */
  function initSpec() {
    var grid = $('.v-scards');
    if (grid && !grid.hasAttribute('data-ax-rise') && hasGSAP && !reduceMotion) {
      gsap.from($$('.v-scard', grid), { y: 60, opacity: 0, duration: 1.1, ease: 'expo.out', stagger: 0.08, clearProps: 'transform,opacity', scrollTrigger: { trigger: grid, start: 'top 82%', once: true } });
    }
    var root = $('[data-spec]');
    if (!root) return;
    var rows = $$('.v-spec__row', root);
    var imgs = $$('.v-spec__img', root);
    var caps = $$('.v-spec__caps span', root);
    var count = $('.v-spec__count b', root);
    var cur = 0, leaveTimer;
    function open(i) {
      if (i === cur) return;
      var prev = cur; cur = i;
      rows.forEach(function (r, j) { r.classList.toggle('is-active', j === i); });
      imgs.forEach(function (im) { im.classList.remove('is-leaving'); });
      if (imgs[prev]) { imgs[prev].classList.remove('is-active'); imgs[prev].classList.add('is-leaving'); }
      if (imgs[i]) imgs[i].classList.add('is-active');
      clearTimeout(leaveTimer);
      leaveTimer = setTimeout(function () { if (imgs[prev]) imgs[prev].classList.remove('is-leaving'); }, 950);
      caps.forEach(function (c, j) {
        c.classList.toggle('is-active', j === i);
        c.classList.toggle('is-up', j !== i && (j < i));
      });
      if (count) count.textContent = (i + 1 < 10 ? '0' : '') + (i + 1);
    }
    rows.forEach(function (r, i) {
      var a = $('a', r);
      r.addEventListener('mouseenter', function () { if (finePointer) open(i); });
      a.addEventListener('focus', function () { open(i); });
      a.addEventListener('click', function (e) {
        if (!finePointer && !r.classList.contains('is-active')) { e.preventDefault(); open(i); } // first tap opens, second follows
      });
    });
    if (hasGSAP && !reduceMotion) {
      gsap.from(rows, { y: 40, opacity: 0, duration: 1, ease: 'expo.out', stagger: 0.07, scrollTrigger: { trigger: root, start: 'top 80%', once: true } });
      var frame = $('.v-spec__frame', root);
      if (frame && getComputedStyle(frame.parentNode).display !== 'none') {
        gsap.fromTo(frame, { clipPath: 'inset(18% 12% 18% 12% round 14px)' }, { clipPath: 'inset(0% 0% 0% 0% round 14px)', duration: 1.4, ease: 'expo.out', scrollTrigger: { trigger: root, start: 'top 80%', once: true } });
      }
    }
  }

  /* V4: stacking step cards — earlier cards ease back as the next lands */
  function initStackCards() {
    var cards = $$('.v-step');
    if (!cards.length || !hasGSAP || reduceMotion || document.querySelector('.v-process[data-ax-grid]')) return;
    cards.forEach(function (card, i) {
      var next = cards[i + 1];
      if (!next) return;
      // As the next card lands, the old one shrinks a little and tilts to one side
      // (alternating), so the edges of earlier steps peek out behind the stack.
      var tilt = 0; // straight stack, no side tilt
      gsap.to(card, {
        scale: 0.94, rotation: tilt, ease: 'none',
        scrollTrigger: {
          trigger: next, scrub: true, invalidateOnRefresh: true,
          start: function () { return 'top ' + (parseFloat(getComputedStyle(next).top) + card.offsetHeight * 0.6) + 'px'; },
          end: function () { return 'top ' + (parseFloat(getComputedStyle(next).top) + 2) + 'px'; }
        }
      });
    });
  }

  /* V4: world map arcs draw in when the map arrives */
  function initMap() {
    var map = $('.v-map');
    if (!map) return;
    if (reduceMotion || !('IntersectionObserver' in window)) { map.classList.add('is-on'); return; }
    var io = new IntersectionObserver(function (entries) {
      if (entries[0].isIntersecting) { map.classList.add('is-on'); io.disconnect(); }
    }, { rootMargin: '0px 0px -20% 0px' });
    io.observe(map);
  }

  /* V4: About tabs (Direction & Method) */
  function initTabs() {
    $$('[data-tabs]').forEach(function (root) {
      var btns = $$('.v-tabs__btn', root);
      var tabs = $$('.v-tab', root);
      function show(i) {
        btns.forEach(function (b, j) { b.classList.toggle('is-active', j === i); b.setAttribute('aria-selected', j === i ? 'true' : 'false'); });
        tabs.forEach(function (t, j) { t.classList.toggle('is-active', j === i); });
      }
      var cur = 0;
      function go(i) { if (i !== cur) { cur = i; show(i); } }
      // Pinned mode (desktop): the section stays in place and the steps advance
      // one by one as you scroll; clicking a step jumps the scroll to it.
      var pinWrap = root.closest('[data-tabs-pin]');
      var desktop = window.matchMedia('(min-width: 992px)').matches;
      if (pinWrap && desktop && !reduceMotion) {
        pinWrap.classList.add('is-pinned');
        pinWrap.style.setProperty('--steps', btns.length);
        var onScroll = function () {
          var r = pinWrap.getBoundingClientRect(), span = r.height - window.innerHeight;
          var p = span > 0 ? Math.min(0.9999, Math.max(0, -r.top / span)) : 0;
          go(Math.floor(p * btns.length));
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll);
        btns.forEach(function (b, i) {
          b.addEventListener('click', function () {
            var top = pinWrap.getBoundingClientRect().top + window.pageYOffset;
            var span = pinWrap.offsetHeight - window.innerHeight;
            var y = top + span * (i + 0.5) / btns.length;
            if (lenis) lenis.scrollTo(y, { duration: 0.9 }); else window.scrollTo({ top: y, behavior: 'smooth' });
          });
        });
        onScroll();
        return;
      }
      btns.forEach(function (b, i) {
        b.addEventListener('click', function () { go(i); });
      });
    });
  }

  /* ------------------------------------------------------------------ */
  /* Hand-drawn underline under key heading words                        */
  /* ------------------------------------------------------------------ */
  function initUnderlines() {
    var els = $$('.h-ul');
    if (!els.length) return;
    var svg = '<svg class="h-ul__svg" viewBox="0 0 400 24" preserveAspectRatio="none" aria-hidden="true">' +
      '<path class="a" pathLength="1" d="M3 14 C 60 8, 120 17, 190 12 S 320 8, 397 12"/>' +
      '<path class="b" pathLength="1" d="M22 19 C 110 14, 200 21, 280 16 S 360 14, 388 17"/></svg>';
    els.forEach(function (el) { el.insertAdjacentHTML('beforeend', svg); });
    if (reduceMotion || !('IntersectionObserver' in window)) {
      els.forEach(function (el) { el.classList.add('is-drawn'); });
      return;
    }
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el = entry.target;
        setTimeout(function () { el.classList.add('is-drawn'); }, 650); // after the words rise in
        io.unobserve(el);
      });
    }, { rootMargin: '0px 0px -15% 0px' });
    els.forEach(function (el) { io.observe(el); });
  }

  /* ------------------------------------------------------------------ */
  /* Count-up numbers                                                    */
  /* ------------------------------------------------------------------ */
  function initCounters() {
    var els = $$('[data-count]');
    if (!els.length || reduceMotion || !hasGSAP) return;
    els.forEach(function (el) {
      var end = parseFloat(el.getAttribute('data-count'));
      var obj = { v: 0 };
      el.textContent = '0';
      ScrollTrigger.create({
        trigger: el, start: 'top 90%', once: true,
        onEnter: function () {
          gsap.to(obj, { v: end, duration: 1.6, ease: 'power3.out', onUpdate: function () { el.textContent = Math.round(obj.v); } });
        }
      });
    });
  }

  /* ------------------------------------------------------------------ */
  /* Footer year                                                         */
  /* ------------------------------------------------------------------ */
  function initYear() {
    $$('[data-year]').forEach(function (el) { el.textContent = new Date().getFullYear(); });
  }

  /* ------------------------------------------------------------------ */
  /* Shared form validation (used by contact + RFQ pages)                */
  /* ------------------------------------------------------------------ */
  window.validateEmail = function (email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  };

  window.handleFormSubmit = function (formElement, redirectUrl, customDataHandler) {
    if (!formElement) return;
    redirectUrl = redirectUrl || 'thank-you.html';
    formElement.addEventListener('submit', function (e) {
      e.preventDefault();
      var honeypot = formElement.querySelector('[name="website_hp"]');
      if (honeypot && honeypot.value.trim() !== '') return;

      var isValid = true;
      $$('[required]', formElement).forEach(function (input) {
        var err = input.parentElement.querySelector('.form-error');
        var ok = !!input.value.trim();
        if (ok && input.type === 'email' && !window.validateEmail(input.value)) {
          ok = false;
          if (err) err.textContent = 'Please enter a valid email address.';
        }
        input.classList.toggle('has-error', !ok);
        input.setAttribute('aria-invalid', ok ? 'false' : 'true');
        if (err) err.style.display = ok ? 'none' : 'block';
        if (!ok) isValid = false;
      });

      if (!isValid) {
        var first = formElement.querySelector('.has-error');
        if (first) first.focus();
        return;
      }
      if (typeof customDataHandler === 'function') customDataHandler(new FormData(formElement));
      window.location.href = redirectUrl;
    });
  };

  /* Dropzone filename feedback */
  function initDropzones() {
    $$('.dropzone').forEach(function (zone) {
      var input = $('.dropzone-input', zone);
      var label = $('.dropzone-text', zone);
      if (!input || !label) return;
      var original = label.textContent;
      input.addEventListener('change', function () {
        if (input.files && input.files.length) {
          label.textContent = 'Attached: ' + input.files[0].name + ' (' + (input.files[0].size / 1024 / 1024).toFixed(2) + ' MB)';
        } else {
          label.textContent = original;
        }
      });
    });
  }

  /* ------------------------------------------------------------------ */
  /* Products page: highlight the category in view in the sticky bar      */
  /* ------------------------------------------------------------------ */
  function initCatNav() {
    var nav = $('.v-catnav');
    if (!nav || !('IntersectionObserver' in window)) return;
    var links = $$('.v-catnav__link', nav);
    var byId = {};
    links.forEach(function (a) { byId[a.getAttribute('href').slice(1)] = a; });
    function setActive(id) {
      links.forEach(function (a) { a.classList.toggle('is-active', a === byId[id]); });
      var a = byId[id];
      if (a && nav.scrollWidth > nav.clientWidth) {
        nav.scrollTo({ left: a.offsetLeft - nav.clientWidth / 2 + a.offsetWidth / 2, behavior: 'smooth' });
      }
    }
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) setActive(e.target.id); });
    }, { rootMargin: '-40% 0px -55% 0px' });
    Object.keys(byId).forEach(function (id) { var el = document.getElementById(id); if (el) io.observe(el); });
    if (links[0]) links[0].classList.add('is-active');
  }

  /* ------------------------------------------------------------------ */
  function init() {
    initSmoothScroll();
    initHeader();
    initMega();
    initCatNav();
    initMobile();
    initBanner();
    initHeroBg();
    initSplits();
    initUnderlines();
    initCounters();
    initSpecs();
    initIndexList();
    initSpecCards();
    initFlow();
    initTimeline();
    initGalleries();
    initAccordion();
    initSpec();
    initStackCards();
    initMap();
    initTabs();
    initReveals();
    initParallax();
    initPillars();
    initProcess();
    initDropzones();
    initYear();
    if (hasGSAP) {
      window.addEventListener('load', function () { ScrollTrigger.refresh(); });
      if (document.fonts && document.fonts.ready) document.fonts.ready.then(function () { ScrollTrigger.refresh(); });
    }
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
