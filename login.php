<?php
require_once 'config/database.php'; require_once 'includes/functions.php';
if(is_logged_in()) redirect('dashboard.php'); $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){verify_csrf();$email=strtolower(trim($_POST['email']??''));$pass=$_POST['password']??'';$s=$pdo->prepare("SELECT * FROM users WHERE email=?");$s->execute([$email]);$u=$s->fetch();if($u&&password_verify($pass,$u['password_hash'])){session_regenerate_id(true);$_SESSION['user_id']=$u['id'];redirect('dashboard.php');}$error='Incorrect email or password.';}
$pageTitle='Login';include 'includes/header.php'; ?>
<div class="auth-wrap"><div class="form-card"><span class="eyebrow">WELCOME BACK</span><h1>Login</h1><?php if($error):?><div class="alert error"><?=e($error)?></div><?php endif;?><form method="post"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><label>Email<input type="email" name="email" required></label><label>Password<input type="password" name="password" required></label><button class="btn full">Login</button></form><p class="center">New here? <a href="register.php">Create an account</a></p></div></div>
<?php include 'includes/footer.php'; ?>
