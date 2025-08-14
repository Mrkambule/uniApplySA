<?php
require_once __DIR__ . '/../../inc/db.php';
require_once __DIR__ . '/../../inc/auth.php';
require_admin();
include __DIR__ . '/../../inc/header.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $id = $_POST['id'] ?? '';
  $q = $_POST['question'] ?? '';
  $a = $_POST['answer'] ?? '';
  if($id){
    $stmt=$pdo->prepare('UPDATE faq SET question=:q, answer=:a WHERE id=:id');
    $stmt->execute([':q'=>$q,':a'=>$a,':id'=>$id]);
  } else {
    $stmt=$pdo->prepare('INSERT INTO faq(question,answer) VALUES(:q,:a)');
    $stmt->execute([':q'=>$q,':a'=>$a]);
  }
}
if(isset($_GET['delete'])){
  $stmt=$pdo->prepare('DELETE FROM faq WHERE id=:id'); $stmt->execute([':id'=>$_GET['delete']]);
}
$rows=$pdo->query('SELECT * FROM faq ORDER BY id DESC')->fetchAll();
?>
<h1>Manage FAQ (Chatbot Knowledge Base)</h1>
<div class="card">
  <form method="post" class="grid grid-2">
    <div><label>Question</label><input class="input" name="question" required></div>
    <div><label>Answer</label><input class="input" name="answer" required></div>
    <div><button class="btn" type="submit">Add</button></div>
  </form>
</div>
<table class="table">
  <tr><th>ID</th><th>Question</th><th>Answer</th><th>Actions</th></tr>
  <?php foreach($rows as $r): ?>
    <tr>
      <td><?= e($r['id']) ?></td><td><?= e($r['question']) ?></td><td><?= e($r['answer']) ?></td>
      <td><a class="btn small outline" href="?delete=<?= e($r['id']) ?>" onclick="return confirm('Delete?')">Delete</a></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php include __DIR__ . '/../../inc/footer.php'; ?>
