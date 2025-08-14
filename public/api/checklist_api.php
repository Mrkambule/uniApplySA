<?php
require_once __DIR__ . '/../../inc/db.php';
require_once __DIR__ . '/../../inc/auth.php';
header('Content-Type: application/json');

$payload = json_decode(file_get_contents('php://input'), true);
$action = $payload['action'] ?? '';
$text = trim($payload['text'] ?? '');

if(!is_logged_in()){
  // store in session for guests
  if($action==='add' && $text){
    if(!isset($_SESSION['guest_checklist'])) $_SESSION['guest_checklist']=[];
    $_SESSION['guest_checklist'][] = $text;
    echo json_encode(['ok'=>true]); exit;
  }
  echo json_encode(['ok'=>false,'error'=>'login-required-for-db']); exit;
}

$uid = $_SESSION['user_id'];
if($action==='add' && $text){
  $stmt = $pdo->prepare('INSERT INTO checklist(user_id,text,is_done) VALUES(:u,:t,0)');
  $stmt->execute([':u'=>$uid, ':t'=>$text]);
  echo json_encode(['ok'=>true]); exit;
}
echo json_encode(['ok'=>false,'error'=>'unknown-action']);
