<?php
require 'config.php';
session_start();
if (!isset($_SESSION['user_id'])){ 
  header('Location: login.php'); 
  exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Book Recommendations</title>
  <link rel="stylesheet" href="css/style_results.css">
  <script src="script_results.js"></script>
</head>

<body>
<?php include 'welcome_bar.php'; ?>

<main class="container">
  <h1 style="color:black">Books that match your mood</h1>
  <div class="book-grid" id="bookResults"></div>
</main>
<div id="modal">
  <div id="modalContent" class="modal-box"></div>
</div>
</body>
</html>
