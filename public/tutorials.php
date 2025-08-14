<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/functions.php';
include __DIR__ . '/../inc/header.php';
$playlist = 'PLbpi6ZahtOH6Blw2R4iAfDdc_1Ji4VluW'; // Placeholder playlist id – replace with your curated list.
?>
<h1>YouTube Tutorials</h1>
<div class="card">
  <p>Below is a curated playlist with application walkthroughs, bursary tips, and motivational content.</p>
  <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:16px">
    <iframe style="position:absolute;top:0;left:0;width:100%;height:100%;" src="https://www.youtube.com/embed/videoseries?list=<?= e($playlist) ?>" title="YouTube playlist" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
</div>
<?php include __DIR__ . '/../inc/footer.php'; ?>
