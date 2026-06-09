const commentButtons = document.querySelectorAll(".comment-toggle");

commentButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    const gameItem = button.closest(".game-item");

    if (gameItem) {
      gameItem.classList.toggle("is-open");
    }
  });
});

// 頁面載入時還原已 liked 狀態
const _liked = (typeof likedGames !== 'undefined') ? likedGames : [];
document.querySelectorAll('.btn.like').forEach(btn => {
  const game = btn.closest('.game-item')?.dataset.game;
  if (game && _liked.includes(game)) {
    btn.classList.add('liked');
  }
});

// 點擊 like 按鈕
document.querySelectorAll('.btn.like').forEach(btn => {
  btn.addEventListener('click', () => {
    const game = btn.closest('.game-item')?.dataset.game;
    if (!game) return;

    const isLiked = btn.classList.toggle('liked');

    fetch('like.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ game, action: isLiked ? 'like' : 'unlike' })
    });
  });
});
