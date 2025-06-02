<?php if (isset($_SESSION['username'])): ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MoodReads - Mood to Book</title>
  <link rel="stylesheet" href="css/style_bar.css">
</head>
<body>
<div class="topbar">
  <div class="left-section">
    <img src="logo.png" alt="MoodReads Logo" class="logo">
    <span class="app-name">MoodReads</span>
  </div>

  <div class="right-section">
    <div class="user-menu">
      <span class="user-label">Hi, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
      <div class="user-dropdown">
        <a href="dashboard.php">📚 My Dashboard</a>
        <a href="favorites.php">❤️ My Favorites</a>
        <a href="history.php">🕒 My Mood History</a>
      </div>
    </div>
    <a class="logout-btn" href="logout.php">Log Out</a>
  </div>
</div>
</body>
</html>
<?php endif; ?>