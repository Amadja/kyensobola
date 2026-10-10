<?php
require_once __DIR__.'/functions.php';
$pageTitle = $pageTitle ?? 'Kyensobola.work';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> | Kyensobola.work</title>
<meta name="description" content="Find jobs, gigs, skills and trusted local talent across East Africa.">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container nav-wrap">
    <a class="logo" href="index.php">kyensobola<span>.work</span></a>
    <nav>
      <a href="jobs.php">Find Jobs</a>
      <a href="talents.php">Find Talent</a>
      <?php if (is_logged_in()): ?>
        <a href="dashboard.php">Dashboard</a>
        <a class="btn btn-small" href="post-job.php">Post a Job</a>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
        <a class="btn btn-small" href="register.php">Join Free</a>
      <?php endif; ?>
    </nav>
    <button class="menu-toggle" aria-label="Menu">☰</button>
  </div>
</header>
<main>
<?php if ($msg=flash('success')): ?><div class="container"><div class="alert success"><?= e($msg) ?></div></div><?php endif; ?>
<?php if ($msg=flash('error')): ?><div class="container"><div class="alert error"><?= e($msg) ?></div></div><?php endif; ?>
