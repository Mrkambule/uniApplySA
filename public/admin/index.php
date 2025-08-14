<?php
require_once __DIR__ . '/../../inc/db.php';
require_once __DIR__ . '/../../inc/auth.php';
require_admin();
include __DIR__ . '/../../inc/header.php';
?>
<h1>Admin Dashboard</h1>
<div class="grid grid-3">
  <div class="card"><h2>Institutions</h2><p>Manage universities & colleges.</p><a class="btn" href="institutions_manage.php">Open</a></div>
  <div class="card"><h2>Bursaries</h2><p>Manage bursary listings.</p><a class="btn" href="bursaries_manage.php">Open</a></div>
  <div class="card"><h2>FAQ</h2><p>Manage chatbot knowledge base.</p><a class="btn" href="faq_manage.php">Open</a></div>
</div>
<?php include __DIR__ . '/../../inc/footer.php'; ?>
