<?php
require 'config.php';
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
$stmt = $pdo->prepare("SELECT mood_text, timestamp FROM mood_logs WHERE user_id = ? ORDER BY timestamp DESC");
$stmt->execute([$_SESSION["user_id"]]);
$moods = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Mood History</title>
  <style>
    body { 
      margin: 0; 
      font-family: 'DM Serif Display', serif;
      background: #f9f5f1; 
      color: #333; 
      } 
    .mood-entry {
      background: #fff;
      margin: 1rem 0;
      color:black;
      padding: 1rem;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
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
  <?php include 'welcome_bar.php'; ?>
  <div style="margin: 20px;">
  <a href="index.php" class="back-button">← Back to Mood Entry</a>
</div>
  <main class="container">
    <h1>Your Mood History</h1>
    <?php if (empty($moods)): ?>
    <p>No moods logged yet.</p>    
    <?php else: ?>
    <?php foreach ($moods as $mood): ?>
    <div class="mood-entry">
      <strong><?= date("d M Y, h:i A", strtotime($mood["timestamp"])) ?>:</strong><br>
      <?= htmlspecialchars($mood["mood_text"]) ?>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
  </main>
</body>
</html>
  