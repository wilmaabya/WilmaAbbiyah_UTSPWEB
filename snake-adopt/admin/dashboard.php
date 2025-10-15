<?php
require '../config.php';
if (empty($_SESSION['admin_id'])) {
    header('Location: /snake-adopt/login.php'); exit;
}

require '../config.php';
if (empty($_SESSION['admin_id'])) { header('Location: /snake-adopt/login.php'); exit; }
require '../header.php';

//stats dari heidi
$pCount = $pdo->query("SELECT COUNT(*) FROM snakes")->fetchColumn();
$appPending = $pdo->query("SELECT COUNT(*) FROM applications WHERE status='Pending'")->fetchColumn();
$adopterCount = $pdo->query("SELECT COUNT(*) FROM adopters")->fetchColumn();
?>

<h1>Admin Dashboard</h1>
<div class="row">
  <div class="col-md-4"><div class="card p-3">snakes: <?=$pCount?></div></div>
  <div class="col-md-4"><div class="card p-3">Applications pending: <?=$appPending?></div></div>
  <div class="col-md-4"><div class="card p-3">Adopters: <?=$adopterCount?></div></div>
</div>

<hr>
<a href="snakes_list.php" class="btn btn-primary">Snakes</a>
<a href="adopters_list.php" class="btn btn-secondary">Adopters</a>
<a href="applications_list.php" class="btn btn-warning">Applications</a>

<?php require '../footer.php'; ?>
