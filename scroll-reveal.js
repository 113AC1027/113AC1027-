// Scroll reveal for game cards - 從下方淡入向上
const cards = document.querySelectorAll('.game-card');


const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target); // 出現一次就好
      }
    });
  },
  {
    threshold: 0.2 // 卡片出現 20% 時觸發
  }
);

cards.forEach(card => {
  observer.observe(card);
});

window.addEventListener('load', () => {
  cards.forEach(card => {
    const rect = card.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom > 0) {
      card.classList.add('is-visible');
      observer.unobserve(card);
    }
  });
});
