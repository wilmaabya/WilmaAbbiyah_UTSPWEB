<?php
require '../config.php';
if (empty($_SESSION['admin_id'])) {
    header('Location: /snake-adopt/login.php'); exit;
}

require '../config.php';
if (empty($_SESSION['admin_id'])) {
    header('Location: /snake-adopt/login.php');
    exit;
}

require '../header.php';

$adopters = $pdo->query("SELECT * FROM adopters ORDER BY id DESC")->fetchAll();
?>

<h2>Daftar Adopter</h2>
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Telepon</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($adopters): ?>
      <?php foreach ($adopters as $a): ?>
        <tr>
          <td><?= $a['id'] ?></td>
          <td><?= htmlspecialchars($a['name']) ?></td>
          <td><?= htmlspecialchars($a['email']) ?></td>
          <td><?= htmlspecialchars($a['phone']) ?></td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="4" class="text-center text-muted">Belum ada adopter</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<?php require '../footer.php'; ?>
