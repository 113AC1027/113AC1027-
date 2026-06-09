<?php
session_start();

$isLogin = isset($_SESSION["username"]);
$_likedGames= [];
if (isset($_SESSION['username']) && file_exists('likes.txt')) {
    foreach (file('likes.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $parts = explode('|', $line, 2);
        if (($parts[0] ?? '') === $_SESSION['username']) {
            $_likedGames[] = $parts[1];
        }
    }
}
?>


<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Page | TUNA Company</title>

  <link rel="stylesheet" href="./css/base.css?v=1" />
  <link rel="stylesheet" href="./css/header.css?v=1" />
  <link rel="stylesheet" href="./css/profile.css?v=1" />
  <link rel="stylesheet" href="./css/footer.css?v=1" />
</head>

<body>
  <!-- ========== Header / Nav ========== -->
  <header>
    <div class="topbar container">
      <div class="brand">TUNA Company</div>

      <nav aria-label="主導覽" class="main-nav">
        <ul>
          <li><a href="index.html" class="nav-link">Home</a></li>
          <li><a href="all games.php" class="nav-link">Games</a></li>

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

          <li><a href="profile.php" class="nav-link active">My Page</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <?php if (!$isLogin): ?>

      <!-- ========== 未登入畫面 ========== -->
      <section class="profile-page">
        <div class="profile-card">
            <p class="profile-label">VIP Member</p>

            <h1>Log in Your Indie Game Profile</h1>

            <p class="profile-intro">
              Log in to collect your favorite games, leave comments,
              and track your reactions across different indie worlds.
            </p>

            <?php if (isset($_GET["error"])): ?>
              <p class="login-error">Username or password is incorrect.</p>
            <?php endif; ?>

            <div class="profile-actions">
              <button class="btn" id="openLogin" type="button">Login</button>
              <button class="btn profile-secondary-btn" id="openRegister" type="button">Create Account</button>
            </div>

        </div>
      </section>

      <!-- ========== 登入彈窗 ========== -->
      <div class="modal-overlay" id="loginModal">
      <div class="login-modal">
        <button class="modal-close" id="closeLogin" type="button">×</button>

        <!-- 登入視窗 -->
        <form class="modal-page" id="pageLogin" action="login.php" method="post">
          <p class="profile-label">Welcome back</p>
          <h2>Login to profile</h2>
          <p class="login-desc">Continue your indie game journey.</p>

          <label>
            Username
            <input type="text" name="username" required>
          </label>

          <label>
            Password
            <input type="password" name="password" required>
          </label>

          <button type="submit" class="btn">Login</button>
        </form>

        <!-- 註冊視窗 -->
        <form class="modal-page hidden" id="pageRegister" action="register.php" method="post">
          <p class="profile-label">Welcome</p>
          <h2>Register your profile</h2>
          <p class="login-desc">Start your indie game journey.</p>

          <label>
            Username
            <input type="text" name="username" required>
          </label>

          <label>
            Password
            <input type="password" name="password" required>
          </label>

          <label>
            Confirm Password
            <input type="password" name="password_confirm" required>
          </label>

          <button type="submit" class="btn">Create Account</button>
        </form>
      </div>
    </div>

    <?php else: ?>

      <!-- ========== 已登入畫面 ========== -->
      <!-- 已登入畫面 -->
      <section class="profile-page">
        <div class="member-layout">

          <!-- 左側：個人資料欄 -->
          <aside class="member-sidebar">
            <div class="member-avatar">
              <?php echo strtoupper(substr($_SESSION["username"], 0, 1)); ?>
            </div>

            <h1 class="member-name">
              <?php echo htmlspecialchars($_SESSION["username"]); ?>
            </h1>

            <p class="member-label">TUNA Member</p>

            <a href="logout.php" class="btn member-logout">Logout</a>
          </aside>

          <!-- 右側：內容區 -->
          <section class="member-content">
            <div class="profile-tabs-layout">

              <div class="profile-tabs">
                <button class="profile-tab active" type="button" data-tab="comments">
                  My Comments
                </button>

                <button class="profile-tab" type="button" data-tab="favorites">
                  Favorite Games
                </button>
              </div>

              <div class="profile-tab-content">

                <section class="tab-panel active" id="comments">
                  <h2>My Comments</h2>
                  <?php
                  $commentFile = "comments.txt";
                  $hasComments = false;

                  if(file_exists($commentFile))
                    {
                      $lines = file($commentFile, FILE_IGNORE_NEW_LINES |FILE_SKIP_EMPTY_LINES);
                      foreach ($lines as $line)
                        {
                          $parts = explode("|", $line);
                          $savedUsername = $parts[0] ?? "";
                          $savedGame = $parts[1] ?? "";
                          $savedComment = $parts[2] ?? "";
                          $savedTime = $parts[3] ?? "";

                          if($savedUsername === $_SESSION["username"])
                            {
                              $hasComments = true;
                              echo '<div class="comment-item">';
                              echo '<p class="comment-user">' . htmlspecialchars($savedGame) . '</p>';
                              echo '<p class="comment-text">' . htmlspecialchars($savedComment) . '</p>';
                              echo '<p class="comment-time">' . htmlspecialchars($savedTime) . '</p>';
                              echo '</div>';
                            }
                        }
                    }

                    if (!$hasComments)
                      {
                        echo '<p>No comments yet.</p>';
                      }
                  ?>
                </section>

                <section class="tab-panel" id="favorites">
                  <h2>Favorite Games</h2>
                  <div class="favorites-list">
                    <?php
                    $gameUrlMap = [
                      'undertale'         => 'undertale',
                      'Hollow_Knight'     => 'hollowknight',
                      'Hades'             => 'Hades',
                      'Detention'         => 'Detention',
                      'celeste'           => 'celeste',
                      'TheBindingOfIsaac' => 'TheBindingOfIsaac',
                    ];

                    $hasFavorites = false;
                    if (file_exists('likes.txt')) {
                      foreach (file('likes.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                        $parts = explode('|', $line, 2);
                        if (($parts[0] ?? '') === $_SESSION['username']) {
                          $hasFavorites = true;
                          $key = $parts[1];
                          $url = $gameUrlMap[$key] ?? $key;
                          echo '<a class="btn" href="introduce.html?game=' . urlencode($url) . '">'
                             . htmlspecialchars($key) . '</a>';
                        }
                      }
                    }
                    if (!$hasFavorites) echo '<p>No favorite games yet.</p>';
                    ?>
                  </div>
                </section>

              </div>

            </div>
          </section>

        </div>
      </section>

    <?php endif; ?>
  </main>

  <footer>
    <div class="container">© 2025 TUNA Company. All rights reserved.</div>
  </footer>

  <script src="js/dropDownList.js"></script>
  <script src="js/header-auto-hide.js"></script>
  <script src="js/login-modal.js"></script>
  <script src="js/profile-tabs.js"></script>
</body>
</html>