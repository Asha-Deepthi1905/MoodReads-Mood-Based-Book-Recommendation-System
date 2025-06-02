<?php
require 'config.php';
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
$stmt = $pdo->prepare("SELECT COUNT(*) FROM mood_logs WHERE user_id = ?");
$stmt->execute([$_SESSION["user_id"]]);

$total_moods = $stmt->fetchColumn();
$stmt = $pdo->prepare("SELECT mood_text, timestamp FROM mood_logs WHERE user_id = ? ORDER BY timestamp DESC LIMIT 1");
$stmt->execute([$_SESSION["user_id"]]);

$recent = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = $pdo->prepare("SELECT mood_text, COUNT(*) as count FROM mood_logs WHERE user_id = ? GROUP BY mood_text ORDER BY count DESC LIMIT 1");
$stmt->execute([$_SESSION["user_id"]]);

$top_mood = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mood Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .stat-box{
      background: #fff;
      color:black;
      padding: 1rem;
      margin: 1rem 0;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    body{ 
      margin: 0; 
      font-family: 'DM Serif Display', serif;
      background: #f9f5f1; 
      color: #333; 
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
  <h1>Mood Insights Dashboard</h1>
  <div class="stat-box">
    <h2>Total Moods Submitted: <?= $total_moods ?></h2>
  </div>
  <div class="stat-box">
    <h2>Most Recent Mood</h2>
    <?php if ($recent): ?>

      <p><strong><?= date("d M Y, h:i A", strtotime($recent["timestamp"]))?> 
      </strong><br>
      <?= htmlspecialchars($recent["mood_text"]) ?>
      </p>

    <?php else: ?>
      <p>No moods logged yet.</p>
    <?php endif; ?>
  </div>
  <div class="stat-box">
    <h2>Most Frequent Mood</h2>
    <?php if ($top_mood): ?>
      <p><?= htmlspecialchars($top_mood["mood_text"]) ?> (<?= $top_mood["count"] ?> times)</p>
    <?php else: ?>
      <p>No mood data yet.</p>
    <?php endif; ?>
  </div>
</main>
</body>
</html>


