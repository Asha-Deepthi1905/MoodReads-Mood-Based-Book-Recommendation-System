<?php
require 'config.php';
if (!isset($_GET['book_id'])) {
  echo "<p>Invalid book ID.</p>";
  exit;
}

$book_id = $_GET['book_id'];
$stmt = $pdo->prepare("SELECT title, author, description, published_year, cover_image_url FROM books WHERE book_id = ?");
$stmt->execute([$book_id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
  echo "<p>Book not found.</p>";
  exit;
}
?>

<div style="text-align:center;">
  <button onclick="document.getElementById('modal').style.display='none'" style="float:right; background:#e74c3c; color:#fff; border:none; padding:6px 12px; border-radius:6px; cursor:pointer;">Close</button>
  <img src="<?= htmlspecialchars($book['cover_image_url']) ?>" alt="Cover" style="width:150px; height:auto; border-radius:8px;">
  <h2><?= htmlspecialchars($book['title']) ?></h2>
  <p><strong>Author:</strong> <?= htmlspecialchars($book['author']) ?></p>
  <p><strong>Published:</strong> <?= htmlspecialchars($book['published_year']) ?></p>
  <p style="text-align:left; margin-top:10px;"> <?= nl2br(htmlspecialchars($book['description'])) ?> </p>
</div>