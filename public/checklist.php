<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/functions.php';
include __DIR__ . '/../inc/header.php';

$userId = $_SESSION['user_id'] ?? 0;
if(!$userId){ echo '<p class="card">You are not signed in. Items will be saved to your browser session.</p>'; }

// Fetch items: if logged in, from DB; else from session
$items = [];
if($userId){
  $stmt = $pdo->prepare("SELECT * FROM checklist WHERE user_id = :uid ORDER BY created_at DESC");
  $stmt->execute([':uid'=>$userId]);
  $items = $stmt->fetchAll();
}else{
  if(!isset($_SESSION['guest_checklist'])) $_SESSION['guest_checklist'] = [];
  $items = array_map(function($t){ return ['text'=>$t,'is_done'=>0,'id'=>0]; }, $_SESSION['guest_checklist']);
}
?>
<h1>Application Checklist</h1>
<div class="card">
  <button id="add-checklist-item" class="btn">Add Item</button>
  <ul>
    <?php foreach($items as $it): ?>
      <li>
        <span class="tag"><?= e($it['is_done'] ? 'Done' : 'Todo') ?></span>
        <?= e($it['text']) ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <p>Common items: ID copy, Academic results, Proof of residence, Motivational letter, Reference letters, Certified copies.</p>
</div>
<?php include __DIR__ . '/../inc/footer.php'; ?>
