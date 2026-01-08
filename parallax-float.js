// 視差漂浮效果 - 不同圖片有不同移動速度
const floatImages = document.querySelectorAll('.what-float');

// 為每張圖片設定不同的速度係數
const speeds = [0.3, 0.5, 0.2, 0.6, 0.4, 0.35];

function updateParallax() {
  const scrolled = window.pageYOffset;
  
  floatImages.forEach((img, index) => {
    // 檢查圖片是否在視窗附近
    const rect = img.getBoundingClientRect();
    const isNearViewport = rect.top < window.innerHeight + 200 && rect.bottom > -200;
    
    if (isNearViewport) {
      const speed = speeds[index] || 0.3;
      const yPos = -(scrolled * speed);
      
      // 應用視差效果
      img.style.transform = `translateY(${yPos}px) rotate(${img.dataset.rotation || 0}deg)`;
    }
  });
}

// 使用 requestAnimationFrame 優化性能
let ticking = false;

window.addEventListener('scroll', () => {
  if (!ticking) {
    window.requestAnimationFrame(() => {
      updateParallax();
      ticking = false;
    });
    ticking = true;
  }
});

// 頁面載入時執行一次
window.addEventListener('load', updateParallax);

// 額外的漂浮動畫(可選)
floatImages.forEach((img, index) => {
  // 為每張圖片添加不同的動畫延遲
  img.style.animationDelay = `${index * 0.2}s`;
});