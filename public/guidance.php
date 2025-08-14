<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/functions.php';
include __DIR__ . '/../inc/header.php';

// Show simple per-institution guidance
$insts = $pdo->query("SELECT id, name, timeline, requirements FROM institutions ORDER BY name")->fetchAll();
?>
<h1>Application Guidance</h1>
<p>Each institution may have unique timelines and document requirements. Use the guidance below to prepare.</p>

<?php foreach($insts as $i): ?>
  <div class="card">
    <h2><?= e($i['name']) ?></h2>
    <h3>Timeline</h3>
    <p><?= nl2br(e($i['timeline'])) ?></p>
    <h3>Required Documents</h3>
    <p><?= nl2br(e($i['requirements'])) ?></p>
  </div>
<?php endforeach; ?>

<?php include __DIR__ . '/../inc/footer.php'; ?>
