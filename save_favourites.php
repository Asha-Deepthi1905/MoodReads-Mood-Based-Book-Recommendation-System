<?php
require 'config.php';
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["error" => "Not logged in"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$book_id = $data["book_id"] ?? 0;

$stmt = $pdo->prepare("INSERT IGNORE INTO favorites (user_id, book_id) VALUES (?, ?)");
$stmt->execute([$_SESSION["user_id"], $book_id]);

echo json_encode(["message" => "Book saved to favorites!"]);


?>