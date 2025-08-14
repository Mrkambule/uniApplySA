<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/functions.php';
require_once __DIR__ . '/../inc/csrf.php';
include __DIR__ . '/../inc/header.php';
csrf_validate();
$err = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email = $_POST['email'] ?? '';
  $pass = $_POST['password'] ?? '';
  $stmt = $pdo->prepare('SELECT id, name, email, password_hash, is_admin FROM users WHERE email = :email');
  $stmt->execute([':email'=>$email]);
  $u = $stmt->fetch();
  if($u && password_verify($pass, $u['password_hash'])){
    $_SESSION['user_id']=$u['id']; $_SESSION['name']=$u['name']; $_SESSION['is_admin']=$u['is_admin'];
    header('Location: ' . ($_GET['next'] ?? (BASE_URL.'/')));
    exit;
  } else { $err = 'Invalid credentials'; }
}
?>
<h1>Login</h1>
<form class="card" method="post">
  <?php csrf_field(); ?>
  <?php if($err): ?><p class="notice"><?= e($err) ?></p><?php endif; ?>
  <label>Email</label><input class="input" name="email" type="email" required/>
  <label>Password</label><input class="input" name="password" type="password" required/>
  <button class="btn" type="submit">Login</button>
</form>
<?php include __DIR__ . '/../inc/footer.php'; ?>
