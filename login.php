<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields.'); window.location.href='login.php';</script>";
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password_hash"])) {
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["username"] = $user["username"];
        echo "<script>alert('Login successful!'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Invalid email or password.'); window.location.href='login.html';</script>";
        exit;
    }
}
?>

