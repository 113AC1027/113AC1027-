(() => {
  // ========= 0) Grab elements =========
  const viewport = document.getElementById('viewport');
  const track = document.getElementById('track');
  const prevBtn = document.getElementById('prev');
  const nextBtn = document.getElementById('next');

  if (!viewport || !track || !prevBtn || !nextBtn) return;

  // ========= 1) Config =========
  const AUTOPLAY_MS = 3200;

  // ========= 2) Helpers =========
  const getVisibleCount = () => {
    const w = viewport.clientWidth;
    if (w >= 1024) return 3;
    if (w >= 768) return 2;
    return 1;
  };

  // 用 offsetWidth（不受 transform scale 影響）
  const getCardWidth = () => {
    const firstCard = track.querySelector('.card');
    if (!firstCard) return 0;

    const gap = parseFloat(getComputedStyle(track).gap) || 0;
    return firstCard.offsetWidth + gap;
  };

  const setTransform = (i, animate = true) => {
    track.style.transition = animate ? 'transform .45s ease' : 'none';
    track.style.transform = `translateX(${-i * getCardWidth()}px)`;
  };

  const removeOldClones = () => {
    track.querySelectorAll('[data-clone="1"]').forEach(el => el.remove());
  };

  const getOriginalCards = () => {
    return Array.from(track.querySelectorAll('.card:not([data-clone="1"])'));
  };

  const clearCenterClasses = () => {
    track.querySelectorAll('.card').forEach(card => {
      card.classList.remove('is-center', 'is-left', 'is-right');
    });
  };

  const applyCenterClasses = () => {
    const n = getVisibleCount();
    const cards = Array.from(track.children);

    clearCenterClasses();

    // index 是目前「左邊第一張可見卡」的位置
    // 桌機 n=3 → 中間是 index+1
    // 平板 n=2/手機 n=1 → 我們讓 index 當作 center（避免難判斷）
    const centerIndex = (n >= 3) ? (index + 1) : index;

    const center = cards[centerIndex];
    const left = cards[centerIndex - 1];
    const right = cards[centerIndex + 1];

    if (center) center.classList.add('is-center');
    if (left) left.classList.add('is-left');
    if (right) right.classList.add('is-right');
  };

  // ========= 3) State =========
  let index = 0;
  let autoplayTimer = null;

  // ========= 4) Core =========
  const setupClones = () => {
    removeOldClones();

    const originals = getOriginalCards();
    const n = getVisibleCount();
    if (originals.length === 0) return;

    const headClones = originals.slice(0, n).map(el => el.cloneNode(true));
    const tailClones = originals.slice(-n).map(el => el.cloneNode(true));

    tailClones.forEach(clone => {
      clone.dataset.clone = '1';
      track.insertBefore(clone, track.firstChild);
    });

    headClones.forEach(clone => {
      clone.dataset.clone = '1';
      track.appendChild(clone);
    });

    index = n;                 // 從第一張真卡開始
    setTransform(index, false);
    applyCenterClasses();
  };

  const normalizeIndexIfNeeded = () => {
    const n = getVisibleCount();
    const total = track.children.length;
    const realCount = total - 2 * n;

    // 到尾端 clone → 瞬移回真卡起點
    if (index >= total - n) {
      index = n;
      setTransform(index, false);
    }

    // 到前端 clone → 瞬移回真卡終點
    if (index < n) {
      index = n + realCount - 1;
      setTransform(index, false);
    }

    applyCenterClasses();
  };

  const goNext = () => {
    index += 1;
    setTransform(index, true);
    applyCenterClasses();
  };

  const goPrev = () => {
    index -= 1;
    setTransform(index, true);
    applyCenterClasses();
  };

  // ========= 5) Autoplay =========
  const stopAutoplay = () => {
    if (autoplayTimer) clearInterval(autoplayTimer);
    autoplayTimer = null;
  };

  const startAutoplay = () => {
    stopAutoplay();
    autoplayTimer = setInterval(goNext, AUTOPLAY_MS);
  };

  // ========= 6) Events =========
  nextBtn.addEventListener('click', goNext);
  prevBtn.addEventListener('click', goPrev);

  track.addEventListener('transitionend', normalizeIndexIfNeeded);

  window.addEventListener('resize', () => {
    setupClones();
  });

  viewport.addEventListener('mouseenter', stopAutoplay);
  viewport.addEventListener('mouseleave', startAutoplay);
  viewport.addEventListener('touchstart', stopAutoplay, { passive: true });
  viewport.addEventListener('touchend', startAutoplay, { passive: true });

  // ========= 7) Init =========
  setupClones();
  startAutoplay();
})();








