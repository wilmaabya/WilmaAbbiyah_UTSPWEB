<?php
require 'config.php';
require 'header.php';

if (!isset($_GET['id'])) { echo "snake
 id missing"; exit; }
$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM snakes WHERE id = ?");
$stmt->execute([$id]);
$snake = $stmt->fetch();
if (!$snake) { echo "snake
 not found"; exit; }
?>

<div class="row">
  <div class="col-md-6">
    <?php if($snake
  ['photo']): ?>
      <img src="uploads/<?=htmlspecialchars($snake
    ['photo'])?>" class="img-fluid" alt="">
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <h2><?=htmlspecialchars($snake
  ['name'])?></h2>
    <p><strong>Species:</strong> <?=htmlspecialchars($snake
  ['species'])?></p>
    <p><?=nl2br(htmlspecialchars($snake
  ['description']))?></p>
<a href="apply.php?snake_id=<?=$snake['id']?>" class="btn btn-success">Ajukan Adopsi</a>
  </div>
</div>

<?php require 'footer.php'; ?>
