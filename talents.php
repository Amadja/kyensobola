<?php
require_once 'config/database.php';require_once 'includes/functions.php';
$q=trim($_GET['q']??'');$country=trim($_GET['country']??'');$cat=(int)($_GET['category']??0);
$sql="SELECT DISTINCT p.*, GROUP_CONCAT(s.name SEPARATOR ', ') skills_text FROM profiles p LEFT JOIN user_skills us ON us.user_id=p.user_id LEFT JOIN skills s ON s.id=us.skill_id WHERE 1";$params=[];
if($q){$sql.=" AND (p.full_name LIKE ? OR p.headline LIKE ? OR p.bio LIKE ? OR s.name LIKE ?)";$like="%$q%";$params=[$like,$like,$like,$like];}
if($country){$sql.=" AND p.country=?";$params[]=$country;}
if($cat){$sql.=" AND s.category_id=?";$params[]=$cat;}
$sql.=" GROUP BY p.user_id ORDER BY p.created_at DESC";$st=$pdo->prepare($sql);$st->execute($params);$people=$st->fetchAll();
$pageTitle='Find Talent';include 'includes/header.php';?>
<section class="section"><div class="container"><div class="section-head"><div><span class="eyebrow">SKILLS & SERVICES</span><h1>Find local talent</h1></div></div>
<form class="searchbar"><input name="q" value="<?=e($q)?>" placeholder="Search web design, guitar, nanny, tutor..."><select name="country"><option value="">All East Africa</option><?php foreach(['Uganda','Kenya','Tanzania','Rwanda','Burundi','South Sudan','DRC','Ethiopia','Somalia'] as $c):?><option <?=$country===$c?'selected':''?>><?=$c?></option><?php endforeach;?></select><button class="btn">Search</button></form>
<div class="talent-grid"><?php foreach($people as $p):?><article class="talent-card"><?php if($p['photo']):?><img src="<?=e($p['photo'])?>" alt="<?=e($p['full_name'])?>"><?php else:?><div class="avatar"><?=e(strtoupper(substr($p['full_name'],0,1)))?></div><?php endif;?><span class="tag"><?=e($p['country'])?></span><h3><a href="profile.php?id=<?=(int)$p['user_id']?>"><?=e($p['full_name'])?></a></h3><strong><?=e($p['headline']?:'Skilled professional')?></strong><p><?=e(mb_strimwidth($p['bio']??'',0,100,'…'))?></p><small>🛠 <?=e($p['skills_text']??'Skills coming soon')?></small></article><?php endforeach;?></div>
<?php if(!$people):?><div class="empty">No profiles found. Try another search.</div><?php endif;?></div></section><?php include 'includes/footer.php';?>
