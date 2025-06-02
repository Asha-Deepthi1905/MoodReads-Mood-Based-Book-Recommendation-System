 <?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

require 'config.php';
session_start();
if (!isset($_SESSION["user_id"])) {
    echo json_encode(["error" => "Not logged in"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true); 
$mood = strtolower(trim($data['mood'] ?? ''));

$stmt = $pdo->prepare("INSERT INTO mood_logs (user_id, mood_text) VALUES (?, ?)");
$stmt->execute([$_SESSION["user_id"], $mood]);

function mapMoodToVibe($text){ 
    $keywords = [ 'bittersweet' => 'bittersweet', 'wanderlust' => 'wanderlust', 'travel' => 'wanderlust', 'rebellious' => 'rebellious', 
                  'rebel' => 'rebellious', 'wholesome' => 'wholesome', 'uplifting' => 'wholesome', 'anxious' => 'anxious', 
                  'melancholy' => 'melancholic', 'melancholic' => 'melancholic', 'existential' => 'existential', 'cozy' => 'cozy', 
                  'warm' => 'cozy', 'mind-bending' => 'mind-bending', 'trippy' => 'mind-bending', 'quiet' => 'quiet', 'peaceful' => 'quiet', 
                  'horror' => 'horror', 'scary' => 'horror', 'ghost' => 'horror', 'spooky' => 'horror', 'mystery' => 'mystery', 'mysterious' => 'mystery',
                  'thriller' => 'mystery', 'magic' => 'magic', 'magical' => 'magic', 'fantasy' => 'magic', 'romantic' => 'romantic comedy', 
                  'funny love' => 'romantic comedy', 'love story' => 'romantic comedy', 'comedy' => 'comedy', 'funny' => 'comedy', 'laugh' => 'comedy', 
                  'sad' => 'sad', 'cry' => 'sad', 'gothic' => 'gothic', 'dark' => 'gothic', 'haunting' => 'gothic' ];
    foreach ($keywords as $keyword => $vibe){ 
        if (strpos($text, $keyword) !== false){ 
            return $vibe;
        } 
    } 
    return null; 
} 
$vibe = mapMoodToVibe($mood); 
if (!$vibe) { 
    echo json_encode([       
       'books' => [], 
       'message' => 'No matching vibe found. Try different wording.'
    ]); 
    exit; 
} 

$sql = "SELECT b.* FROM books b JOIN book_vibe_tags bv ON b.book_id = bv.book_id 
        JOIN vibe_tags v ON bv.vibe_id = v.vibe_id 
        WHERE v.name LIKE :vibe
        ORDER BY RAND()
        LIMIT 10"; 

$stmt = $pdo->prepare($sql); 
$stmt->execute(['vibe' => "%$vibe%"]); 
$books = $stmt->fetchAll(PDO::FETCH_ASSOC); 

echo json_encode(['books' => $books, 'matched_vibe' => $vibe]); 

?> 