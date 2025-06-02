<?php 
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location: login.html");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MoodReads - Mood to Book</title>
  <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
<?php include 'welcome_bar.php' ?>
    <main class="container">
      
        <header>
            <h1>What Are You Feeling Today?</h1>
            <p>Describe your mood and we’ll match it to the perfect books.</p>
        </header>
        <textarea id="moodInput"></textarea>
        <button onclick="submitMood()">Get Recommendations</button>
    </main>
</body>
<script src="script.js"></script>
</html> 
