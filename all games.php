<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Indie Game — Wireframe 起手式</title>
  <!-- <link rel="stylesheet" href="style.css" /> -->
  <link rel="stylesheet" href="css/base.css" />
  <link rel="stylesheet" href="css/header.css" />
  <link rel="stylesheet" href="css/games.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/responsive.css" />

  <?php require_once "comment-functions.php"; ?>
</head>

<body>
  <!-- ========== Header / Nav ========== -->
  <header>
    <div class="topbar container">
      <div class="brand">TUNA Company</div>

      <nav aria-label="主導覽" class="main-nav">
        <ul>
          <li><a href="index.html" class="nav-link">Home</a></li>
          <li><a href="all games.php" aria-current="page" class="nav-link active">Games</a></li>
          
          <li class="dropdown">
            <button class="nav-link dropdown-toggle" aria-haspopup="true" aria-expanded="false">
              Introduce
            </button>
            <ul class="dropdown-menu" aria-label="Introduce 子選單">
              <li><a href="introduce.html?game=undertale">UNDERTALE</a></li>
              <li><a href="introduce.html?game=hollowknight">Hollow Knight</a></li>
              <li><a href="introduce.html?game=Hades">Hades</a></li>
              <li><a href="introduce.html?game=Detention">Detention</a></li>
              <li><a href="introduce.html?game=celeste">Celeste</a></li>
              <li><a href="introduce.html?game=TheBindingOfIsaac">The Binding of Isaac</a></li>
            </ul>
          </li>

          <li><a href="profile.php" class="nav-link">My Page</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- ========== Hero ========== -->
  <!-- <section class="hero">
    <img class="hero-img" src="images/封面.jpg" alt="Hero image" />
    <div class="hero-text">
      <h1>Title</h1>
      <p>introduce this website</p>
    </div>

    <div class="scroll-hint">
      <p class="scroll-text">Scroll down</p>
      <span class="scroll-arrow">≫</span>
    </div>
  </section> -->

  <!-- ========== Main Content ========== -->
  <main>
    <section class="GameCard">
      <h3 class="tag">Games</h3>

      <div class="cards">
        <!-- ========== Game 1: UNDERTALE ========== -->
        <div class="game-item" data-game="undertale">

          <article class="card game-card card-media">

            <div class="card-left">
              <div class="thumb">
                <picture>
                  <source media="(max-width: 768px)" srcset="images/undertale-2.jpg" />
                  <img src="images/undertale.jpg" alt="UNDERTALE cover" />
                </picture>
              </div>

              <div class="tags">
                <span class="tag-frame tag-c1">
                  <span class="tag-text"># ChoiceBasedStory</span>
                </span>

                <span class="tag-frame tag-c2">
                  <span class="tag-text"># PixelArt</span>
                </span>

                <span class="tag-frame tag-c3">
                  <span class="tag-text"># Emotional</span>
                </span>
              </div>
            </div>

            <div class="card-right">
              <h3>UNDERTALE</h3>

              <p>
                The player accidentally falls into the Underground, a world inhabited by monsters.
                You can choose to fight or show mercy — every decision changes the story and leads to a different ending.
              </p>

              <div class="card-actions">
                <button class="btn comment-toggle" type="button">
                  Comments
                </button>
                <a href="introduce.html?game=undertale" class="btn">Learn more</a>
              </div>
            </div>

          </article>

          <section class="comment-panel">
            <form class="comment-form" action="comment.php" method="post">
              <!-- 不同遊戲要記得改 value -->
              <input type="hidden" name="game" value="undertale">     

              <label>
                Leave a comment
                <textarea name="comment" required></textarea>
              </label>

              <button type="submit" class="btn">Submit</button>
            </form>

            <!-- ========== 歷史留言抓取 ========== -->
            <div class="comment-list">
              <?php showGameComments("undertale"); ?>
            </div>
          </section>

        </div>

        <!-- ========== Game 2: Hollow Knight ========== -->
        <div class="game-item" data-game="Hollow_Knight">

          <article class="card game-card card-media">

            <div class="card-left">
              <div class="thumb">
                <picture>
                  <source media="(max-width: 768px)" srcset="images/Hollow_Knight-2.png" />
                  <img src="images/Hollow_Knight.png" alt="Hollow Knight cover" />
                </picture>
              </div>

              <div class="tags">
                <span class="tag-frame tag-c1">
                  <span class="tag-text"># Adventure</span>
                </span>

                <span class="tag-frame tag-c2">
                  <span class="tag-text"># Exploration</span>
                </span>

                <span class="tag-frame tag-c3">
                  <span class="tag-text"># HandDrawnArt</span>
                </span>
              </div>
            </div>

            <div class="card-right">
              <h3>Hollow Knight</h3>

              <p>
                The player takes the role of a silent knight exploring Hallownest, a ruined kingdom ruled by insects.
                As you journey deeper, you uncover the world’s hidden history and forgotten secrets.
              </p>

              <div class="card-actions">
                <button class="btn comment-toggle" type="button">
                  Comments
                </button>
                <a href="introduce.html?game=hollowknight" class="btn">Learn more</a>
              </div>
            </div>

          </article>

          <section class="comment-panel">
            <form class="comment-form" action="comment.php" method="post">
              <!-- 不同遊戲要記得改 value -->
              <input type="hidden" name="game" value="hollowknight">     

              <label>
                Leave a comment
                <textarea name="comment" required></textarea>
              </label>

              <button type="submit" class="btn">Submit</button>
            </form>

            <!-- ========== 歷史留言抓取 ========== -->
            <div class="comment-list">
              <?php showGameComments("hollowknight"); ?>
            </div>
          </section>

        </div>

        <!-- ========== Game 3: Hades ========== -->
          <div class="game-item" data-game="Hades">
            <article class="card game-card card-media">

              <div class="card-left">
                <div class="thumb">
                  <picture>
                    <source media="(max-width: 768px)" srcset="images/hades-2.jpg" />
                    <img src="images/hades.jpg" alt="Hades cover" />
                  </picture>
                </div>

                <div class="tags">
                  <span class="tag-frame tag-c1">
                    <span class="tag-text"># Action</span>
                  </span>

                  <span class="tag-frame tag-c2">
                    <span class="tag-text"># Mythology</span>
                  </span>

                  <span class="tag-frame tag-c3">
                    <span class="tag-text"># Rebirth</span>
                  </span>
                </div>
              </div>

              <div class="card-right">
                <h3>Hades</h3>

                <p>
                  The player takes the role of Zagreus, the son of Hades, who attempts to escape the Underworld.
                  Through countless deaths and rebirths, he meets and interacts with various gods of Greek mythology.
                </p>

                <div class="card-actions">
                  <button class="btn comment-toggle" type="button">
                    Comments
                  </button>
                  <a href="introduce.html?game=Hades" class="btn">Learn more</a>
                </div>
              </div>

            </article>

            <section class="comment-panel">
              <form class="comment-form" action="comment.php" method="post">
                <!-- 不同遊戲要記得改 value -->
                <input type="hidden" name="game" value="Hades">     

                <label>
                  Leave a comment
                  <textarea name="comment" required></textarea>
                </label>

                <button type="submit" class="btn">Submit</button>
              </form>

              <!-- ========== 歷史留言抓取 ========== -->
              <div class="comment-list">
                <?php showGameComments("Hades"); ?>
              </div>
            </section>

          </div>

          <!-- ========== Game 4: Detention ========== -->
          <div class="game-item" data-game="Detention">
            <article class="card game-card card-media">

              <div class="card-left">
                <div class="thumb">
                  <picture>
                    <source media="(max-width: 768px)" srcset="images/返校-2.jpg" />
                    <img src="images/返校.jpg" alt="返校 cover" />
                  </picture>
                </div>

                <div class="tags">
                  <span class="tag-frame tag-c1">
                    <span class="tag-text"># Horror</span>
                  </span>

                  <span class="tag-frame tag-c2">
                    <span class="tag-text"># StoryDriven</span>
                  </span>

                  <span class="tag-frame tag-c3">
                    <span class="tag-text"># Taiwan</span>
                  </span>
                </div>
              </div>

              <div class="card-right">
                <h3>Detention</h3>

                <p>
                  Set in 1960s Taiwan under martial law, Detention follows two students trapped in a haunted school.
                  As they explore the dark environment, hidden memories and political fears slowly emerge.
                </p>

                <div class="card-actions">
                  <button class="btn comment-toggle" type="button">
                    Comments
                  </button>
                  <a href="introduce.html?game=Detention" class="btn">Learn more</a>
                </div>
              </div>

            </article>

            <section class="comment-panel">
              <form class="comment-form" action="comment.php" method="post">
                <!-- 不同遊戲要記得改 value -->
                <input type="hidden" name="game" value="Detention">     

                <label>
                  Leave a comment
                  <textarea name="comment" required></textarea>
                </label>

                <button type="submit" class="btn">Submit</button>
              </form>

              <!-- ========== 歷史留言抓取 ========== -->
              <div class="comment-list">
                <?php showGameComments("Detention"); ?>
              </div>
            </section>

          </div>

          <!-- ========== Game 5: celeste ========== -->
          <div class="game-item" data-game="celeste">
            <article class="card game-card card-media">

              <div class="card-left">
                <div class="thumb">
                  <picture>
                    <source media="(max-width: 768px)" srcset="images/celeste-2.jpg" />
                    <img src="images/celeste.jpg" alt="celeste cover" />
                  </picture>
                </div>

                <div class="tags">
                  <span class="tag-frame tag-c1">
                    <span class="tag-text"># Platformer</span>
                  </span>

                  <span class="tag-frame tag-c2">
                    <span class="tag-text"># SelfGrowth</span>
                  </span>

                  <span class="tag-frame tag-c3">
                    <span class="tag-text"># PixelArt</span>
                  </span>
                </div>
              </div>

              <div class="card-right">
                <h3>Celeste</h3>

                <p>
                  The game follows Madeline as she climbs Celeste Mountain.
                  Along the journey, she faces difficult challenges that reflect her inner struggles and anxiety.
                </p>

                <div class="card-actions">
                  <button class="btn comment-toggle" type="button">
                    Comments
                  </button>
                  <a href="introduce.html?game=Celeste" class="btn">Learn more</a>
                </div>
              </div>

            </article>

            <section class="comment-panel">
              <form class="comment-form" action="comment.php" method="post">
                <!-- 不同遊戲要記得改 value -->
                <input type="hidden" name="game" value="Celeste">     

                <label>
                  Leave a comment
                  <textarea name="comment" required></textarea>
                </label>

                <button type="submit" class="btn">Submit</button>
              </form>

              <!-- ========== 歷史留言抓取 ========== -->
              <div class="comment-list">
                <?php showGameComments("Celeste"); ?>
              </div>
            </section>

          </div>

          <!-- ========== Game 6: TheBindingOfIsaac ========== -->
          <div class="game-item" data-game="celeste">
            <article class="card game-card card-media">

              <div class="card-left">
                <div class="thumb">
                  <picture>
                    <source media="(max-width: 768px)" srcset="images/TheBindingOfIsaac-2.jpg" />
                    <img src="images/TheBindingOfIsaac.jpg" alt="TheBindingOfIsaac cover" />
                  </picture>
                </div>

                <div class="tags">
                  <span class="tag-frame tag-c1">
                    <span class="tag-text"># Roguelike</span>
                  </span>

                  <span class="tag-frame tag-c2">
                    <span class="tag-text"># DarkTheme</span>
                  </span>

                  <span class="tag-frame tag-c3">
                    <span class="tag-text"># Replayable</span>
                  </span>
                </div>
              </div>

              <div class="card-right">
                <h3>The Binding of Isaac</h3>

                <p>
                  The player controls Isaac, a young boy who escapes into a dungeon filled with monsters.
                  Each run is randomly generated, creating a different experience every time.
                </p>

                <div class="card-actions">
                  <button class="btn comment-toggle" type="button">
                    Comments
                  </button>
                  <a href="introduce.html?game=TheBindingOfIsaac" class="btn">Learn more</a>
                </div>
              </div>

            </article>

            <section class="comment-panel">
              <form class="comment-form" action="comment.php" method="post">
                <!-- 不同遊戲要記得改 value -->
                <input type="hidden" name="game" value="TheBindingOfIsaac">     

                <label>
                  Leave a comment
                  <textarea name="comment" required></textarea>
                </label>

                <button type="submit" class="btn">Submit</button>
              </form>

              <!-- ========== 歷史留言抓取 ========== -->
              <div class="comment-list">
                <?php showGameComments("TheBindingOfIsaac"); ?>
              </div>
            </section>

          </div>

      </div>
    </section>
    
    <!-- ========== CTA / Support ========== -->
    <section id="support" class="section cta">
      <div class="container">
        <p>You see these game are so amazing</p>
        <h2>So how can we suppport these creator?</h2>
        <p>Go buy the game you stupid don't download the pirated version</p>
      </div>
    </section>
  </main>

  <!-- ========== Footer ========== -->
  <footer>
    <div class="container">© 2025 TUNA Company. All rights reserved.</div>
  </footer>

  <script src="js/dropDownList.js"></script>
  <script src="js/header-auto-hide.js"></script>
  <script src="js/scroll-reveal.js"></script>
  <script src="js/comments-toggle.js"></script>
</body>
</html>



