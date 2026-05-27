// Header 自動隱藏/顯示
const header = document.querySelector('header');

if (header) {
  let lastScroll = 0;
  
  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    // 在頁面最頂端,總是顯示
    if (currentScroll <= 0) {
      header.classList.remove('header-hidden');
      header.classList.add('header-visible');
      return;
    }
    
    // 向下滾動 - 隱藏 header
    if (currentScroll > lastScroll && currentScroll > 80) {
      header.classList.add('header-hidden');
      header.classList.remove('header-visible');
    } 
    // 向上滾動 - 顯示 header
    else if (currentScroll < lastScroll) {
      header.classList.remove('header-hidden');
      header.classList.add('header-visible');
    }
    
    lastScroll = currentScroll;
  });
  
  // 初始狀態
  header.classList.add('header-visible');
}

console.log('Header auto-hide script loaded!');