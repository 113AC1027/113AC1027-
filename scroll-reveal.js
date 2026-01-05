// Scroll reveal for game cards
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
