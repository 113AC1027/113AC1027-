// introduce.js
//抓第三頁不同內容用
(function () {
  const params = new URLSearchParams(location.search);
  const key = params.get("game") || "undertale"; // 沒帶參數就預設 undertale

  const db = window.GAMES_DB || {};
  const game = db[key];

  if (!game) {
    console.warn("Game not found:", key);
    return;
  }

  // 1) 文字
  const titleEl = document.getElementById("gameTitle");
  const subEl = document.getElementById("gameSubtitle");
  const descEl = document.getElementById("gameDesc");

  const creatorDescEl = document.getElementById("gamedesc");

  if (titleEl) titleEl.textContent = game.title;
  if (subEl) subEl.textContent = game.subtitle || "";
  if (descEl) descEl.textContent = game.desc || "";

  if (creatorDescEl) creatorDescEl.innerHTML = game.creatorDesc || "";

  // 2) hero 圖
  const heroImg = document.getElementById("gameHeroImg");
  if (heroImg && game.heroImage) {
    heroImg.src = game.heroImage;
    heroImg.alt = `${game.title} hero image`;
  }


  const creatorImg = document.getElementById("gameCreatorImg");
    if (creatorImg && game.creatorImage) {
    creatorImg.src = game.creatorImage;
    creatorImg.alt = game.title + " creator image";
    }

    // 3) 生成輪播卡（塞到 #track）
    const track = document.getElementById("track");
    if (!track) return;

track.innerHTML = "";

const list = game.cards || [];
list.forEach((item) => {
  const card = document.createElement("article");
  card.className = "card intro-card";

  card.innerHTML = `
    <div class="card-inner">
      <h3 class="card-title">${item.title || ""}</h3>

      <div class="card-body">
        <div class="thumb">
          <img src="${item.image || ""}" alt="${item.title || "game card"}" />
        </div>

        <div class="desc">
          <p>${item.text || ""}</p>
        </div>
      </div>
    </div>
  `;

  track.appendChild(card);
});


  }
)();
