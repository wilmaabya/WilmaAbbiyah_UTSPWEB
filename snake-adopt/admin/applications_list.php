<?php
require '../config.php';
if (empty($_SESSION['admin_id'])) {
    header('Location: /snake-adopt/login.php');
    exit;
}

require '../header.php';

// ambil data aplikasi gabung sama nama adopter & ular
$stmt = $pdo->query("
  SELECT a.id, s.name AS snake_name, ad.name AS adopter_name, ad.email, ad.phone, 
         a.message, a.created_at, a.status
  FROM applications a
  JOIN snakes s ON a.snake_id = s.id
  JOIN adopters ad ON a.adopter_id = ad.id
  ORDER BY a.created_at DESC
");
$applications = $stmt->fetchAll();
?>

<h2 class="text-light mb-4">Daftar Pengajuan Adopsi</h2>
<table class="table table-dark table-striped align-middle">
  <thead>
    <tr>
      <th>#</th>
      <th>Ular</th>
      <th>Adopter</th>
      <th>Email</th>
      <th>Telepon</th>
      <th>Pesan</th>
      <th>Tanggal</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($applications): ?>
      <?php foreach ($applications as $app): ?>
        <tr>
          <td><?= $app['id'] ?></td>
          <td><?= htmlspecialchars($app['snake_name']) ?></td>
          <td><?= htmlspecialchars($app['adopter_name']) ?></td>
          <td><?= htmlspecialchars($app['email']) ?></td>
          <td><?= htmlspecialchars($app['phone']) ?></td>
          <td><?= nl2br(htmlspecialchars($app['message'])) ?></td>
          <td><?= $app['created_at'] ?></td>
          <td>
            <?php if ($app['status'] == 'Pending'): ?>
              <span class="badge bg-warning text-dark">Pending</span>
            <?php elseif ($app['status'] == 'Approved'): ?>
              <span class="badge bg-success">Approved</span>
            <?php else: ?>
              <span class="badge bg-danger">Rejected</span>
            <?php endif; ?>
          </td>
          <td>
            <?php if ($app['status'] == 'Pending'): ?>
              <a href="application_action.php?id=<?= $app['id'] ?>&action=approve" class="btn btn-sm btn-success">Approve</a>
              <a href="application_action.php?id=<?= $app['id'] ?>&action=reject" class="btn btn-sm btn-danger">Reject</a>
            <?php else: ?>
              <span class="text-muted">Selesai</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="9" class="text-center text-muted">Belum ada pengajuan adopsi</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<?php require '../footer.php'; ?>
