<?php
require_once __DIR__ . '/../../inc/db.php';
header('Content-Type: application/json');
$payload = json_decode(file_get_contents('php://input'), true);
$q = strtolower(trim($payload['q'] ?? ''));
if(!$q){ echo json_encode(['answer'=>'Ask me something!']); exit; }

// naive keyword search over faq
$stmt = $pdo->query("SELECT question, answer FROM faq");
$best = ''; $bestScore = 0;
foreach($stmt as $row){
  $score = 0;
  $qwords = preg_split('/\W+/', $q, -1, PREG_SPLIT_NO_EMPTY);
  foreach($qwords as $w){
    if($w && stripos($row['question'], $w) !== false) $score += 2;
    if($w && stripos($row['answer'], $w) !== false) $score += 1;
  }
  if($score > $bestScore){ $bestScore=$score; $best=$row['answer']; }
}
if(!$best){
  $best = "Sorry, I couldn't find that. Try asking about documents, deadlines, or how to apply.";
}
echo json_encode(['answer'=>$best]);
