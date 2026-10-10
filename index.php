<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
$pageTitle='Find work and talent';
$cats=$pdo->query("SELECT id,name,icon FROM categories ORDER BY name LIMIT 12")->fetchAll();
$jobs=$pdo->query("SELECT j.*, c.name category_name, p.full_name FROM jobs j JOIN categories c ON c.id=j.category_id JOIN profiles p ON p.user_id=j.user_id WHERE j.status='open' ORDER BY j.created_at DESC LIMIT 6")->fetchAll();
include 'includes/header.php';
?>
<section class="hero">
<div class="container hero-inner">
  <div>
    <span class="eyebrow">EAST AFRICA'S SKILLS MARKETPLACE</span>
    <h1>Find a job.<br><span>Find a skill.</span><br>Get hired.</h1>
    <p>From web designers and guitar teachers to tutors, mechanics, nannies and photographers — connect with people who need what you can do.</p>
    <div class="hero-actions"><a class="btn" href="jobs.php">Find Jobs</a><a class="btn btn-outline" href="talents.php">Find Talent</a></div>
  </div>
  <div class="hero-card"><div class="hero-icon">✦</div><h3>What can you do?</h3><p>Create your free profile, list your skills and let opportunities find you.</p><a href="register.php">Create your profile →</a></div>
</div>
</section>
<section class="section"><div class="container">
<div class="section-head"><div><span class="eyebrow">EXPLORE</span><h2>Popular skills</h2></div><a href="talents.php">View all →</a></div>
<div class="category-grid"><?php foreach($cats as $c): ?><a class="category" href="talents.php?category=<?= (int)$c['id'] ?>"><span><?= e($c['icon']) ?></span><strong><?= e($c['name']) ?></strong></a><?php endforeach; ?></div>
</div></section>
<section class="section soft"><div class="container">
<div class="section-head"><div><span class="eyebrow">LATEST OPPORTUNITIES</span><h2>Jobs & gigs</h2></div><a href="jobs.php">Browse all →</a></div>
<div class="cards"><?php foreach($jobs as $j): ?><article class="job-card">
<div class="tag"><?= e($j['category_name']) ?></div><h3><a href="job.php?id=<?= (int)$j['id'] ?>"><?= e($j['title']) ?></a></h3>
<p><?= e(mb_strimwidth($j['description'],0,130,'…')) ?></p><div class="meta"><span>📍 <?= e($j['location']) ?></span><span><?= e(money_range($j['budget_min'],$j['budget_max'],$j['currency'])) ?></span></div>
<div class="card-foot"><span>Posted by <?= e($j['full_name']) ?></span><a href="job.php?id=<?= (int)$j['id'] ?>">View →</a></div>
</article><?php endforeach; ?></div>
</div></section>
<section class="cta"><div class="container"><h2>Your skill can become an opportunity.</h2><p>Whether you need help or you have a skill to offer, Kyensobola.work is built for you.</p><a class="btn" href="register.php">Join Kyensobola.work</a></div></section>
<?php include 'includes/footer.php'; ?>
