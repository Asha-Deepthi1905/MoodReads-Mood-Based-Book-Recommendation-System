<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
include "config.php";
include "welcome_bar.php";


$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT b.* FROM favorites f JOIN books b ON f.book_id = b.book_id WHERE f.user_id = ?");
$stmt->execute([$user_id]);
$fav_books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Favorites</title>
  <style>
    body { 
      font-family: 'DM Serif Display', serif;
      background:rgb(233, 217, 202);
    } 
    .book-grid{
       display: grid;
       grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); 
       gap: 20px; 
    }
    .book-card{ 
      position: relative;
      background: #fff;
      color:black; 
      border-radius: 10px; 
      padding: 10px; 
      box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
      text-align: center; 
      cursor: pointer; 
    }
    .book-card img {
      width: 100%;
      height: 280px;
      object-fit: cover;
      border-radius: 10px;
    }
    .back-button {
  text-decoration: none;
  background: #e6c4a8;
  color: #333;
  padding: 0.5rem 1.2rem;
  border-radius: 20px;
  font-weight: bold;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  transition: background 0.3s ease;
}

.back-button:hover {
  background: #d4ae93;
}
  </style>
</head>
<body>
<div style="margin: 20px;">
  <a href="index.php" class="back-button">← Back to Mood Entry</a>
</div>
  <div class="container">
    <h1>❤️ My Favorite Books ❤️</h2>
    <div class="book-grid">
      <?php foreach ($fav_books as $book): ?>
        <div class="book-card">
          <h2><?= htmlspecialchars($book['title']) ?></h2>
          <img src="<?= htmlspecialchars($book['cover_image_url']) ?>" alt="Cover">
        </div>
      <?php endforeach; ?>
      <?php if (empty($fav_books)): ?>
        <p>You haven't added any favorites yet. ❤️</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
