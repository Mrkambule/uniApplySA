<?php
require_once __DIR__ . '/../../inc/db.php';
require_once __DIR__ . '/../../inc/auth.php';
require_once __DIR__ . '/../../inc/functions.php';
require_admin();
include __DIR__ . '/../../inc/header.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $id = $_POST['id'] ?? '';
  $name = $_POST['name'] ?? '';
  $province = $_POST['province'] ?? '';
  $fields = $_POST['fields'] ?? '';
  $url = $_POST['application_url'] ?? '';
  $desc = $_POST['description'] ?? '';
  $timeline = $_POST['timeline'] ?? '';
  $reqs = $_POST['requirements'] ?? '';
  if($id){
    $stmt=$pdo->prepare('UPDATE institutions SET name=:n,province=:p,fields=:f,application_url=:u,description=:d,timeline=:t,requirements=:r WHERE id=:id');
    $stmt->execute([':n'=>$name,':p'=>$province,':f'=>$fields,':u'=>$url,':d'=>$desc,':t'=>$timeline,':r'=>$reqs,':id'=>$id]);
  } else {
    $stmt=$pdo->prepare('INSERT INTO institutions(name,province,fields,application_url,description,timeline,requirements) VALUES(:n,:p,:f,:u,:d,:t,:r)');
    $stmt->execute([':n'=>$name,':p'=>$province,':f'=>$fields,':u'=>$url,':d'=>$desc,':t'=>$timeline,':r'=>$reqs]);
  }
}
if(isset($_GET['delete'])){
  $stmt=$pdo->prepare('DELETE FROM institutions WHERE id=:id'); $stmt->execute([':id'=>$_GET['delete']]);
}
$rows=$pdo->query('SELECT * FROM institutions ORDER BY name')->fetchAll();
?>
<h1>Manage Institutions</h1>
<div class="card">
  <form method="post" class="grid grid-2">
    <div><label>Name</label><input class="input" name="name" required></div>
    <div><label>Province</label><select name="province" class="input"><?php foreach(provinces() as $p){ echo "<option>$p</option>"; } ?></select></div>
    <div><label>Fields (comma-separated)</label><input class="input" name="fields" placeholder="Engineering, Health, ICT"></div>
    <div><label>Application URL</label><input class="input" name="application_url"></div>
    <div class="grid-col-span-2"><label>Description</label><textarea class="input" name="description"></textarea></div>
    <div class="grid-col-span-2"><label>Timeline</label><textarea class="input" name="timeline" placeholder="Open: May 1; Close: Sep 30"></textarea></div>
    <div class="grid-col-span-2"><label>Requirements</label><textarea class="input" name="requirements" placeholder="ID copy, latest results, ..."></textarea></div>
    <div><button class="btn" type="submit">Save</button></div>
  </form>
</div>
<table class="table">
  <tr><th>Name</th><th>Province</th><th>Fields</th><th>Actions</th></tr>
  <?php foreach($rows as $r): ?>
    <tr>
      <td><?= e($r['name']) ?></td>
      <td><?= e($r['province']) ?></td>
      <td><?= e($r['fields']) ?></td>
      <td><a class="btn small outline" href="?delete=<?= e($r['id']) ?>" onclick="return confirm('Delete?')">Delete</a></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php include __DIR__ . '/../../inc/footer.php'; ?>
