<?php
require_once 'config/database.php'; require_once 'includes/functions.php';
if (is_logged_in()) redirect('dashboard.php');
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf();
 $name=trim($_POST['full_name']??''); $email=trim(strtolower($_POST['email']??'')); $phone=trim($_POST['phone']??''); $password=$_POST['password']??'';
 if (!$name || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<8) $error='Enter a valid name, email and password of at least 8 characters.';
 else {
  $stmt=$pdo->prepare("SELECT id FROM users WHERE email=?"); $stmt->execute([$email]);
  if($stmt->fetch()) $error='An account with this email already exists.';
  else {
   $pdo->beginTransaction();
   $stmt=$pdo->prepare("INSERT INTO users(email,password_hash,role) VALUES(?,?, 'user')");
   $stmt->execute([$email,password_hash($password,PASSWORD_DEFAULT)]); $uid=(int)$pdo->lastInsertId();
   $stmt=$pdo->prepare("INSERT INTO profiles(user_id,full_name,phone,country,city) VALUES(?,?,?,?,?)");
   $stmt->execute([$uid,$name,$phone,'Uganda','Kampala']); $pdo->commit();
   $_SESSION['user_id']=$uid; flash('success','Welcome to Kyensobola.work! Complete your profile.'); redirect('dashboard.php');
  }
 }
}
$pageTitle='Create account'; include 'includes/header.php';
?>
<div class="auth-wrap"><div class="form-card"><span class="eyebrow">JOIN FREE</span><h1>Create your account</h1><p>Be both a talent and a client. You can change your profile anytime.</p>
<?php if($error): ?><div class="alert error"><?=e($error)?></div><?php endif; ?>
<form method="post"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
<label>Full name<input name="full_name" required value="<?=e($_POST['full_name']??'')?>"></label>
<label>Email<input type="email" name="email" required value="<?=e($_POST['email']??'')?>"></label>
<label>Phone / WhatsApp<input name="phone" value="<?=e($_POST['phone']??'')?>"></label>
<label>Password<input type="password" name="password" minlength="8" required></label>
<button class="btn full">Create account</button></form><p class="center">Already registered? <a href="login.php">Login</a></p></div></div>
<?php include 'includes/footer.php'; ?>
