(() => {
  // ========= 0) Grab elements =========
  const viewport = document.getElementById('viewport');
  const track = document.getElementById('track');
  const prevBtn = document.getElementById('prev');
  const nextBtn = document.getElementById('next');

  // 如果頁面沒有輪播（或 id 不存在），就直接退出，避免報錯
  if (!viewport || !track || !prevBtn || !nextBtn) return;

  // ========= 1) Config =========
  const AUTOPLAY_MS = 3000;

  // ========= 2) Helpers =========
  const getVisibleCount = () => {
    const w = viewport.clientWidth;
    if (w >= 1024) return 3;
    if (w >= 768) return 2;
    return 1;
  };

  const getCardWidth = () => {
    const firstCard = track.querySelector('.card');
    if (!firstCard) return 0;

    const gap = parseFloat(getComputedStyle(track).gap) || 0;
    return firstCard.getBoundingClientRect().width + gap;
  };

  const setTransform = (index, animate = true) => {
    track.style.transition = animate ? 'transform .45s ease' : 'none';
    const x = -index * getCardWidth();
    track.style.transform = `translateX(${x}px)`;
  };

  const removeOldClones = () => {
    track.querySelectorAll('[data-clone="1"]').forEach(el => el.remove());
  };

  const getOriginalCards = () => {
    return Array.from(track.querySelectorAll('.card:not([data-clone="1"])'));
  };

  // ========= 3) State =========
  let index = 0; // 包含 clone 的索引
  let autoplayTimer = null;

  // ========= 4) Core =========
  const setupClones = () => {
    removeOldClones();

    const originals = getOriginalCards();
    const n = getVisibleCount();

    if (originals.length === 0) return;

    // 頭尾複製 n 張：做無限循環
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

    // 從「第一張真卡」開始
    index = n;
    setTransform(index, false);
  };

  const normalizeIndexIfNeeded = () => {
    const n = getVisibleCount();
    const total = track.children.length;
    const realCount = total - 2 * n;

    // 到尾端 clone：跳回真卡起點
    if (index >= total - n) {
      index = n;
      setTransform(index, false);
    }

    // 到前端 clone：跳回真卡終點
    if (index < n) {
      index = n + realCount - 1;
      setTransform(index, false);
    }
  };

  const goNext = () => {
    index += 1;
    setTransform(index, true);
  };

  const goPrev = () => {
    index -= 1;
    setTransform(index, true);
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

  // 動畫結束後，判斷是否落在 clone 區，需要瞬移回真卡
  track.addEventListener('transitionend', normalizeIndexIfNeeded);

  // RWD：尺寸改變要重建 clone + 重新定位
  window.addEventListener('resize', () => {
    setupClones();
  });

  // Hover / Touch：暫停自動播放
  viewport.addEventListener('mouseenter', stopAutoplay);
  viewport.addEventListener('mouseleave', startAutoplay);
  viewport.addEventListener('touchstart', stopAutoplay, { passive: true });
  viewport.addEventListener('touchend', startAutoplay, { passive: true });

  // ========= 7) Init =========
  setupClones();
  startAutoplay();
})();







