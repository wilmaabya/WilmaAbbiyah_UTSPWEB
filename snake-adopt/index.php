
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require 'config.php';
require 'header.php';


$stmt = $pdo->query("SELECT * FROM snakes WHERE status='Available' ORDER BY created_at DESC");
$snakes = $stmt->fetchAll();
?>

<h1>Ular Siap Diadopsi</h1>
<div class="row">
<?php foreach($snakes as $snake): ?>
  <div class="col-md-4">
    <div class="card mb-4">
      <?php if($snake['photo']): ?>
        <img src="uploads/<?=htmlspecialchars($snake['photo'])?>" 
              class="card-img-top" 
              alt="" 
              style="height:350px;object-fit:cover;border-radius:10px;">
      <?php else: ?>
        <div class="card-img-top d-flex align-items-center justify-content-center" style="height:200px;background:#f0f0f0;">
          <strong>No Photo</strong>
        </div>
      <?php endif; ?>
      <div class="card-body">
        <h5 class="card-title"><?=htmlspecialchars($snake['name'])?></h5>
        <p class="card-text"><?=htmlspecialchars($snake['species'])?> — <?=htmlspecialchars($snake['age'])?></p>
        <a href="snake_detail.php?id=<?=$snake['id']?>" class="btn btn-primary">Lihat</a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>

<?php require 'footer.php'; ?>
