(() => {
  // =============== 抓元素 ===============
  const viewport = document.getElementById('viewport');
  const track    = document.getElementById('track');
  const prev     = document.getElementById('prev');
  const next     = document.getElementById('next');

  // =============== 狀態變數 ===============
  let index = 0;                 // 目前索引（包含 clone）
  let afterMoveTimer = null;     // 後備計時器（確保 normalize 有跑）

  // =============== 工具：一頁顯示幾張 ===============
  const visibleCount = () => {
    const w = viewport.clientWidth;
    return (w >= 768) ? 3 : 1;  // 平板/桌機=3；手機=1
  };

  // =============== 工具：一張卡片寬度（含 gap） ===============
  const cardWidth = () => {
    const first = track.querySelector('.card');
    if (!first) return 0;
    const gap = parseFloat(getComputedStyle(track).gap) || 0;
    return first.getBoundingClientRect().width + gap;
  };

  // =============== 中心卡標記（做出中間放大、左右後退的視覺） ===============
  const markCenterCard = () => {
    const cards = Array.from(track.querySelectorAll('.card'));
    if (!cards.length) return;

    const vpRect   = viewport.getBoundingClientRect();
    const vpCenter = vpRect.left + vpRect.width / 2;

    let best = Infinity, centerIdx = -1;
    cards.forEach((c, i) => {
      const r = c.getBoundingClientRect();
      const cCenter = r.left + r.width / 2;
      const d = Math.abs(cCenter - vpCenter);
      if (d < best) { best = d; centerIdx = i; }
    });

    cards.forEach(c => c.classList.remove('is-center','is-left','is-right'));
    if (centerIdx >= 0) {
      cards[centerIdx].classList.add('is-center');
      if (cards[centerIdx - 1]) cards[centerIdx - 1].classList.add('is-left');
      if (cards[centerIdx + 1]) cards[centerIdx + 1].classList.add('is-right');
    }
  };

  // =============== 實際移動軌道 ===============
  const updateTransform = (animate = true) => {
    track.style.transition = animate ? 'transform .45s ease' : 'none';
    const x = -index * cardWidth();
    track.style.transform = `translateX(${x}px)`;
    // 偵錯可留著：看位移/總數
    // console.log({ index, cardWidth: cardWidth(), visible: visibleCount(), total: track.children.length, x });
    markCenterCard();
  };

  // =============== 無限循環的「環回」 ===============
  const normalize = () => {
    const total = track.children.length; // 含 clone
    const n     = visibleCount();
    const real  = total - 2 * n;         // 真卡數（= originals.length）

    if (real <= 0) return;               // 沒做 clone 就不用環回

    const jump = (newIndex) => {
      requestAnimationFrame(() => {
        track.style.transition = 'none';       // 關動畫 → 瞬移
        index = newIndex;
        track.style.transform = `translateX(${-index * cardWidth()}px)`;
        requestAnimationFrame(() => {
          track.style.transition = 'transform .45s ease'; // 再開回動畫
        });
      });
    };

    // 尾端越界 → 跳回第一個真卡
    if (index >= total - n) {
      jump(n);
    }
    // 前端越界 → 跳到最後一個真卡
    else if (index < n) {
      jump(n + real - 1);
    }
  };

  // =============== 後備保險：每次移動後 500ms 再 normalize 一次 ===============
  const afterMove = () => {
    if (afterMoveTimer) clearTimeout(afterMoveTimer);
    afterMoveTimer = setTimeout(() => {
      normalize();
      markCenterCard();
      // console.log('[fallback] normalize called');
    }, 500);
  };

  // =============== 建立首尾 clones（讓它可無限循環） ===============
  const setupClones = () => {
    // 先刪舊 clone
    Array.from(track.children).forEach(el => { if (el.dataset.clone) el.remove(); });

    const originals = Array.from(track.querySelectorAll('.card:not([data-clone])'));
    const n = visibleCount();

    // 重點：當「原始張數 < 可見張數」才不做循環；其餘（含 = ）都做
    if (originals.length < n) {
      index = 0;
      updateTransform(false);
      return;
    }

    // 在尾端加前 n 張的複製，在前端加後 n 張的複製
    const head = originals.slice(0, n).map(el => el.cloneNode(true));
    const tail = originals.slice(-n).map(el => el.cloneNode(true));
    head.forEach(cl => { cl.dataset.clone = '1'; track.appendChild(cl); });
    tail.forEach(cl => { cl.dataset.clone = '1'; track.insertBefore(cl, track.firstChild); });

    index = n;                // 從第一張「真卡」開始
    updateTransform(false);   // 初始化定位
  };

  // =============== 左右按鈕 ===============
  const nextSlide = () => { index++; updateTransform(true); afterMove(); };
  const prevSlide = () => { index--; updateTransform(true); afterMove(); };

  next.addEventListener('click', nextSlide);
  prev.addEventListener('click', prevSlide);

  // 動畫結束後做環回（並清掉後備計時器）
  track.addEventListener('transitionend', (e) => {
    if (e.target !== track) return;
    if (afterMoveTimer) clearTimeout(afterMoveTimer);
    normalize();
    markCenterCard();
    // console.log('[event] transitionend normalize');
  });

  // 視窗尺寸變更 → 重新建 clone 與定位
  window.addEventListener('resize', () => {
    setupClones();
    markCenterCard();
  });

  // =============== 初始化 ===============
  setupClones();
  markCenterCard();
})();






