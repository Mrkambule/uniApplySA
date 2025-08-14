<?php
require_once __DIR__ . '/../../inc/db.php';
require_once __DIR__ . '/../../inc/auth.php';
require_once __DIR__ . '/../../inc/functions.php';
require_admin();
include __DIR__ . '/../../inc/header.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $id = $_POST['id'] ?? '';
  $name = $_POST['name'] ?? '';
  $program = $_POST['program'] ?? '';
  $merit = $_POST['merit_type'] ?? '';
  $province = $_POST['province'] ?? 'National';
  $deadline = $_POST['deadline'] ?? '';
  $url = $_POST['url'] ?? '';
  $desc = $_POST['description'] ?? '';
  if($id){
    $stmt=$pdo->prepare('UPDATE bursaries SET name=:n,program=:pr,merit_type=:m,province=:p,deadline=:d,url=:u,description=:de WHERE id=:id');
    $stmt->execute([':n'=>$name,':pr'=>$program,':m'=>$merit,':p'=>$province,':d'=>$deadline,':u'=>$url,':de'=>$desc,':id'=>$id]);
  } else {
    $stmt=$pdo->prepare('INSERT INTO bursaries(name,program,merit_type,province,deadline,url,description) VALUES(:n,:pr,:m,:p,:d,:u,:de)');
    $stmt->execute([':n'=>$name,':pr'=>$program,':m'=>$merit,':p'=>$province,':d'=>$deadline,':u'=>$url,':de'=>$desc]);
  }
}
if(isset($_GET['delete'])){
  $stmt=$pdo->prepare('DELETE FROM bursaries WHERE id=:id'); $stmt->execute([':id'=>$_GET['delete']]);
}
$rows=$pdo->query('SELECT * FROM bursaries ORDER BY deadline')->fetchAll();
?>
<h1>Manage Bursaries</h1>
<div class="card">
  <form method="post" class="grid grid-2">
    <div><label>Name</label><input class="input" name="name" required></div>
    <div><label>Programme</label><input class="input" name="program" placeholder="e.g. Engineering"></div>
    <div><label>Merit Type</label><select class="input" name="merit_type"><?php foreach(merit_types() as $m){ echo "<option>$m</option>"; } ?></select></div>
    <div><label>Province</label><select class="input" name="province"><option>National</option><?php foreach(provinces() as $p){ echo "<option>$p</option>"; } ?></select></div>
    <div><label>Deadline (YYYY-MM-DD)</label><input class="input" name="deadline" placeholder="2025-09-30"></div>
    <div><label>Link</label><input class="input" name="url"></div>
    <div class="grid-col-span-2"><label>Description</label><textarea class="input" name="description"></textarea></div>
    <div><button class="btn" type="submit">Save</button></div>
  </form>
</div>
<table class="table">
  <tr><th>Name</th><th>Programme</th><th>Merit</th><th>Province</th><th>Deadline</th><th>Actions</th></tr>
  <?php foreach($rows as $r): ?>
    <tr>
      <td><?= e($r['name']) ?></td><td><?= e($r['program']) ?></td><td><?= e($r['merit_type']) ?></td><td><?= e($r['province']) ?></td><td><?= e($r['deadline']) ?></td>
      <td><a class="btn small outline" href="?delete=<?= e($r['id']) ?>" onclick="return confirm('Delete?')">Delete</a></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php include __DIR__ . '/../../inc/footer.php'; ?>
