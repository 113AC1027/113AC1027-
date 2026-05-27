<?php
session_start();

$isLogin = isset($_SESSION["username"]);
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
          <li><a href="all games.html" class="nav-link">Games</a></li>

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
          <p class="profile-label">TUNA Member</p>

          <h1>Build Your Indie Game Profile</h1>

          <p class="profile-intro">
            Log in to collect your favorite games, leave comments,
            and track your reactions across different indie worlds.
          </p>

          <?php if (isset($_GET["error"])): ?>
            <p class="login-error">Username or password is incorrect.</p>
          <?php endif; ?>

          <div class="profile-actions">
            <button class="btn" id="openLogin" type="button">Login</button>
            <button class="btn profile-secondary-btn" type="button">Create Account</button>
          </div>

          <p class="profile-note">Test account: tuna / 1234</p>
        </div>
      </section>

      <!-- ========== 登入彈窗 ========== -->
      <div class="modal-overlay" id="loginModal">
        <div class="login-modal">
          <button class="modal-close" id="closeLogin" type="button">×</button>

          <p class="profile-label">Welcome back</p>
          <h2>Login to TUNA</h2>

          <p class="login-desc">Continue your indie game journey.</p>

          <form action="login.php" method="post">
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

          <p class="login-hint">Test account: tuna / 1234</p>
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
            <p class="profile-label">Member Profile</p>
            <h2>My Indie Game Space</h2>

            <div class="member-grid">
              <div class="profile-block">
                <h3>My Comments</h3>
                <p>No comments yet.</p>
              </div>

              <div class="profile-block">
                <h3>My Reactions</h3>
                <p>No reactions yet.</p>
              </div>

              <div class="profile-block">
                <h3>Favorite Games</h3>
                <p>No favorite games yet.</p>
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
  <script src="js/login-modal.js?v=1"></script>
</body>
</html>