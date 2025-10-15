<?php
require '../config.php';

// cek login admin
if (empty($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}

require '../header.php';

$snakes = $pdo->query("SELECT * FROM snakes ORDER BY created_at DESC")->fetchAll();
?>
<h2>Daftar Snakes</h2>
<a href="snakes_create.php" class="btn btn-success mb-3">Tambah Snake</a>
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama</th>
      <th>Spesies</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($snakes as $snake): ?>
    <tr>
      <td><?= $snake['id'] ?></td>
      <td><?= htmlspecialchars($snake['name']) ?></td>
      <td><?= htmlspecialchars($snake['species']) ?></td>
      <td><?= htmlspecialchars($snake['status']) ?></td>
      <td>
        <a href="snakes_edit.php?id=<?= $snake['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
        <a href="snakes_delete.php?id=<?= $snake['id'] ?>" class="btn btn-sm btn-danger"
           onclick="return confirm('Yakin mau hapus snake ini?')">Hapus</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php require '../footer.php'; ?>
