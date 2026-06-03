const commentButtons = document.querySelectorAll(".comment-toggle");

commentButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    const gameItem = button.closest(".game-item");

    if (gameItem) {
      gameItem.classList.toggle("is-open");
    }
  });
});