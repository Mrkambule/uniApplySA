<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/functions.php';
include __DIR__ . '/../inc/header.php';

$province = $_GET['province'] ?? '';
$field = $_GET['field'] ?? '';

$sql = "SELECT * FROM institutions WHERE 1";
$params = [];
if ($province) { $sql .= " AND province = :province"; $params[':province'] = $province; }
if ($field) { $sql .= " AND FIND_IN_SET(:field, fields)"; $params[':field'] = $field; }
$sql .= " ORDER BY name ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll();

$allFields = $pdo->query("SELECT DISTINCT TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(fields, ',', n.n), ',', -1)) AS field
FROM institutions i
JOIN (SELECT a.N + b.N * 10 + 1 n FROM (SELECT 0 N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) a,
(SELECT 0 N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) b
) n
WHERE n.n <= 1 + LENGTH(fields) - LENGTH(REPLACE(fields, ',', ''))
")->fetchAll(PDO::FETCH_COLUMN);
?>
<h1>Universities & Colleges</h1>
<form class="card" method="get">
  <div class="form-row">
    <div>
      <label>Province</label>
      <select name="province" class="input">
        <option value="">All provinces</option>
        <?php foreach(provinces() as $p): ?>
          <option value="<?= e($p) ?>" <?= $province===$p?'selected':'' ?>><?= e($p) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label>Field of Study</label>
      <select name="field" class="input">
        <option value="">All fields</option>
        <?php foreach($allFields as $f): if(!$f) continue; ?>
          <option value="<?= e($f) ?>" <?= $field===$f?'selected':'' ?>><?= e($f) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <button class="btn" type="submit">Filter</button>
</form>

<?php if(!$rows): ?>
  <p class="card">No institutions found. Try a different filter.</p>
<?php endif; ?>

<?php foreach($rows as $r): ?>
  <div class="card">
    <h2><?= e($r['name']) ?> <span class="badge"><?= e($r['province']) ?></span></h2>
    <p><?= e($r['description']) ?></p>
    <div class="tags">
      <?php foreach(explode(',', $r['fields']) as $tag): ?>
        <span class="tag"><?= e(trim($tag)) ?></span>
      <?php endforeach; ?>
    </div>
    <p><a class="btn" href="<?= e($r['application_url']) ?>" target="_blank" rel="noopener">Apply on official site</a></p>
  </div>
<?php endforeach; ?>

<?php include __DIR__ . '/../inc/footer.php'; ?>
