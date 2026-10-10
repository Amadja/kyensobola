<?php
require_once '../config/database.php';require_once '../includes/functions.php';require_login();
$u=$pdo->prepare("SELECT role FROM users WHERE id=?");$u->execute([current_user_id()]);if($u->fetchColumn()!=='admin'){http_response_code(403);exit('Admin access required.');}
$users=$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();$jobs=$pdo->query("SELECT COUNT(*) FROM jobs")->fetchColumn();$apps=$pdo->query("SELECT COUNT(*) FROM applications")->fetchColumn();
$pageTitle='Admin';include '../includes/header.php';?><section class="section"><div class="container"><span class="eyebrow">ADMIN</span><h1>Platform overview</h1><div class="stats"><div><strong><?=$users?></strong><span>Users</span></div><div><strong><?=$jobs?></strong><span>Jobs</span></div><div><strong><?=$apps?></strong><span>Applications</span></div></div><p><a href="../jobs.php">View marketplace →</a></p></div></section><?php include '../includes/footer.php';?>
