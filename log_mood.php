<?php 
session_start(); 
header("Content-Type: application/json"); 
include 'config.php'; 

$data = json_decode(file_get_contents("php://input"), true); 

$mood = trim($data["mood"] ?? ""); 

if (!$mood || !isset($_SESSION["user_id"])) { 
    echo json_encode(["status" => "error", "message" => "Missing mood or not logged in"]); 
    exit; 
} 

// Prevent duplicate mood logging in the same session 
if (isset($_SESSION["last_logged_mood"]) && $_SESSION["last_logged_mood"] === $mood) { 
    echo json_encode(["status" => "ok", "message" => "Already logged"]); 
    exit; 
} 



$stmt = $pdo->prepare("INSERT INTO mood_logs (user_id, mood_text) VALUES (?, ?)"); 
$stmt->execute([$_SESSION["user_id"], $mood]); 

$_SESSION["last_logged_mood"] = $mood; 

echo json_encode(["status" => "ok", "message" => "Mood logged"]); 
?>



