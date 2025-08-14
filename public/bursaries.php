<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/functions.php';
include __DIR__ . '/../inc/header.php';

$program = $_GET['program'] ?? '';
$merit = $_GET['merit'] ?? '';
$province = $_GET['province'] ?? '';

$sql = "SELECT * FROM bursaries WHERE 1";
$params = [];
if ($program) { $sql .= " AND program LIKE :program"; $params[':program'] = '%' . $program . '%'; }
if ($merit) { $sql .= " AND merit_type = :merit"; $params[':merit'] = $merit; }
if ($province) { $sql .= " AND (province = :province OR province = 'National')"; $params[':province'] = $province; }
$sql .= " ORDER BY deadline ASC";
$stmt = $pdo->prepare($sql); $stmt->execute($params); $rows = $stmt->fetchAll();
?>
<h1>Bursaries & Financial Aid</h1>
<form class="card" method="get">
  <div class="form-row">
    <div>
      <label>Study Programme</label>
      <input class="input" name="program" placeholder="e.g. Engineering" value="<?= e($program) ?>"/>
    </div>
    <div>
      <label>Need/Merit</label>
      <select name="merit" class="input">
        <option value="">Any</option>
        <?php foreach(merit_types() as $m): ?>
          <option <?= $merit===$m?'selected':'' ?>><?= e($m) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div>
      <label>Province</label>
      <select name="province" class="input">
        <option value="">All</option>
        <option <?= $province==='National'?'selected':'' ?>>National</option>
        <?php foreach(provinces() as $p): ?>
          <option <?= $province===$p?'selected':'' ?>><?= e($p) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div style="align-self:end">
      <button class="btn" type="submit">Filter</button>
    </div>
  </div>
</form>

<?php if(!$rows): ?>
  <p class="card">No bursaries found. Try different filters.</p>
<?php endif; ?>

<?php foreach($rows as $r): ?>
  <div class="card">
    <h2><?= e($r['name']) ?> <span class="badge"><?= e($r['merit_type']) ?></span></h2>
    <p><strong>Programme:</strong> <?= e($r['program']) ?> · <strong>Province:</strong> <?= e($r['province']) ?> · <strong>Deadline:</strong> <?= e($r['deadline']) ?></p>
    <p><?= e($r['description']) ?></p>
    <p><a class="btn" href="<?= e($r['url']) ?>" target="_blank" rel="noopener">View & Apply</a></p>
  </div>
<?php endforeach; ?>

<?php include __DIR__ . '/../inc/footer.php'; ?>
