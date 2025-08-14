<?php
$links = [
  ['/', 'Home'],
  ['/universities.php', 'Universities'],
  ['/bursaries.php', 'Bursaries'],
  ['/guidance.php', 'Guidance'],
  ['/checklist.php', 'Checklist'],
  ['/tutorials.php', 'Tutorials'],
  ['/chatbot.php', 'Chatbot'],
];
?>
<nav class="nav">
  <div class="brand"><a href="<?= BASE_URL ?>/"><?= e(APP_NAME) ?></a></div>
  <ul class="nav-links">
    <?php foreach($links as $l): ?>
      <li><a href="<?= BASE_URL . $l[0] ?>"><?= e($l[1]) ?></a></li>
    <?php endforeach; ?>
  </ul>
  <div class="auth">
    <?php if(is_logged_in()): ?>
      <span>Hi, <?= e($_SESSION['name'] ?? 'User') ?></span>
      <?php if(is_admin()): ?><a href="<?= BASE_URL ?>/admin/index.php" class="btn small">Admin</a><?php endif; ?>
      <a href="<?= BASE_URL ?>/logout.php" class="btn outline small">Logout</a>
    <?php else: ?>
      <a href="<?= BASE_URL ?>/login.php" class="btn small">Login</a>
      <a href="<?= BASE_URL ?>/register.php" class="btn outline small">Register</a>
    <?php endif; ?>
  </div>
</nav>
