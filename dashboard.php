<?php
require_once 'config/database.php'; require_once 'includes/auth.php';
$s=$pdo->prepare("SELECT p.*,u.email FROM profiles p JOIN users u ON u.id=p.user_id WHERE p.user_id=?");$s->execute([current_user_id()]);$p=$s->fetch();
$jobs=$pdo->prepare("SELECT * FROM jobs WHERE user_id=? ORDER BY created_at DESC LIMIT 5");$jobs->execute([current_user_id()]);$myjobs=$jobs->fetchAll();
$app=$pdo->prepare("SELECT a.*,j.title FROM applications a JOIN jobs j ON j.id=a.job_id WHERE a.user_id=? ORDER BY a.created_at DESC LIMIT 5");$app->execute([current_user_id()]);$apps=$app->fetchAll();
$pageTitle='Dashboard';include 'includes/header.php';?>
<section class="section"><div class="container">
<div class="dashboard-head"><div><span class="eyebrow">YOUR SPACE</span><h1>Hello, <?=e($p['full_name'])?> 👋</h1><p>Manage your profile, jobs and applications.</p></div><a class="btn" href="edit-profile.php">Edit profile</a></div>
<div class="dashboard-grid"><div class="dash-card"><h3>Profile</h3><p><?=e($p['headline']?:'Add a headline to tell people what you do.')?></p><div class="progress"><span style="width:<?=($p['headline']&&$p['bio']&&$p['skills'])?'100':'55'?>%"></span></div><a href="profile.php?id=<?=(int)$p['user_id']?>">View public profile →</a></div>
<div class="dash-card"><h3>Post an opportunity</h3><p>Need a skill? Tell the community what you need.</p><a class="btn btn-small" href="post-job.php">Post a job</a></div></div>
<div class="two-col"><div><h2>My jobs</h2><?php if(!$myjobs):?><p class="muted">You haven't posted any jobs yet.</p><?php else: foreach($myjobs as $j):?><div class="list-item"><div><strong><?=e($j['title'])?></strong><small><?=e($j['status'])?></small></div><a href="job.php?id=<?=(int)$j['id']?>">View</a></div><?php endforeach;endif;?></div>
<div><h2>My applications</h2><?php if(!$apps):?><p class="muted">No applications yet.</p><?php else: foreach($apps as $a):?><div class="list-item"><div><strong><?=e($a['title'])?></strong><small><?=e($a['status'])?></small></div></div><?php endforeach;endif;?></div></div>
</div></section><?php include 'includes/footer.php';?>
