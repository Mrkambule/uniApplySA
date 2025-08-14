<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/functions.php';
require_once __DIR__ . '/../inc/csrf.php';
include __DIR__ . '/../inc/header.php';
csrf_validate();
$msg=''; $err='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $pass = $_POST['password'] ?? '';
  if(!$name || !$email || strlen($pass)<6){ $err='Please fill all fields (password 6+ chars).'; }
  else{
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email'); $stmt->execute([':email'=>$email]);
    if($stmt->fetch()){ $err='Email already registered.'; }
    else{
      $stmt = $pdo->prepare('INSERT INTO users(name,email,password_hash,is_admin) VALUES(:n,:e,:p,0)');
      $stmt->execute([':n'=>$name, ':e'=>$email, ':p'=>password_hash($pass, PASSWORD_DEFAULT)]);
      $msg='Account created. You can now login.';
    }
  }
}
?>
<h1>Register</h1>
<form class="card" method="post">
  <?php csrf_field(); ?>
  <?php if($msg): ?><p class="notice"><?= e($msg) ?></p><?php endif; ?>
  <?php if($err): ?><p class="notice"><?= e($err) ?></p><?php endif; ?>
  <label>Name</label><input class="input" name="name" required/>
  <label>Email</label><input class="input" name="email" type="email" required/>
  <label>Password</label><input class="input" name="password" type="password" required/>
  <button class="btn" type="submit">Create Account</button>
</form>
<?php include __DIR__ . '/../inc/footer.php'; ?>
