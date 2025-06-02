<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST["username"]);
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);

  if (empty($username) || empty($email) || empty($password)) {
    echo "<script>alert('All fields are required.'); window.location.href='signup.php';</script>";
    exit;
  }

  $check = $pdo->prepare("SELECT * FROM users WHERE email = ?");
  $check->execute([$email]);
  if ($check->rowCount() > 0) {
    echo "<script>alert('Email already exists. Please use a different email.'); window.location.href='signup.php';</script>";
    exit;
  }

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
  $stmt->execute([$username, $email, $hashedPassword]);

  echo "<script>alert('Signup successful! Please login.'); window.location.href='login.html';</script>";
  exit;
}
?>