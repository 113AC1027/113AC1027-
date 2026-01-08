// 等待 DOM 完全載入後再執行
document.addEventListener('DOMContentLoaded', function() {
  const dropdownToggle = document.querySelector('.dropdown-toggle');
  const dropdown = document.querySelector('.dropdown');

  // 確認元素存在
  if (!dropdownToggle || !dropdown) {
    console.error('找不到下拉選單元素');
    return;
  }

  // 點擊按鈕切換選單
  dropdownToggle.addEventListener('click', function(e) {
    e.preventDefault(); // 防止按鈕預設行為
    e.stopPropagation(); // 防止事件冒泡
    
    const isOpen = dropdown.classList.toggle('open');
    dropdownToggle.setAttribute('aria-expanded', isOpen);
    
    console.log('選單狀態:', isOpen ? '打開' : '關閉'); // 除錯用
  });

  // 點擊畫面其他地方時自動關閉
  document.addEventListener('click', function(e) {
    if (!dropdown.contains(e.target)) {
      dropdown.classList.remove('open');
      dropdownToggle.setAttribute('aria-expanded', 'false');
    }
  });
});