<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/functions.php';
include __DIR__ . '/../inc/header.php';
?>
<h1>Welcome to <?= e(APP_NAME) ?></h1>
<p class="notice">One hub for South African university & college applications, bursaries, checklists, and guidance.</p>

<div class="grid grid-3">
  <div class="card">
    <h2>Find Universities</h2>
    <p>Browse accredited institutions by province and field of study. Go straight to official application pages.</p>
    <a href="universities.php" class="btn">Browse Universities</a>
  </div>
  <div class="card">
    <h2>Bursaries & Aid</h2>
    <p>Search bursaries with filters for programme, need or merit, and deadlines.</p>
    <a href="bursaries.php" class="btn">Explore Bursaries</a>
  </div>
  <div class="card">
    <h2>Step-by-Step Guidance</h2>
    <p>Clear instructions, required documents, and key timelines per institution.</p>
    <a href="guidance.php" class="btn">Get Guidance</a>
  </div>
</div>

<div class="grid grid-3">
  <div class="card">
    <h2>Checklist</h2>
    <p>Track your documents and tasks. Save progress to your account.</p>
    <a href="checklist.php" class="btn">Open Checklist</a>
  </div>
  <div class="card">
    <h2>Tutorials</h2>
    <p>Watch curated YouTube videos with tips and walkthroughs.</p>
    <a href="tutorials.php" class="btn">Watch Tutorials</a>
  </div>
  <div class="card">
    <h2>Chatbot</h2>
    <p>Ask common questions — get instant answers from our FAQ knowledge base.</p>
    <a href="chatbot.php" class="btn">Open Chatbot</a>
  </div>
</div>
<?php include __DIR__ . '/../inc/footer.php'; ?>
