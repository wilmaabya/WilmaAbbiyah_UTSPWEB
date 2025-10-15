<?php
require 'config.php';
require 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $snake_id = (int)$_POST['snake_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);

    // cek adopter
    $stmt = $pdo->prepare("SELECT id FROM adopters WHERE email = ?");
    $stmt->execute([$email]);
    $adopter = $stmt->fetch();

    if (!$adopter) {
        $stmt = $pdo->prepare("INSERT INTO adopters (name,email,phone) VALUES (?,?,?)");
        $stmt->execute([$name,$email,$phone]);
        $adopter_id = $pdo->lastInsertId();
    } else {
        $adopter_id = $adopter['id'];
    }

    // buat aplikasi
    $stmt = $pdo->prepare("INSERT INTO applications (snake_id, adopter_id, message) VALUES (?,?,?)");
    $stmt->execute([$snake_id, $adopter_id, $message]);

    echo '<div class="alert alert-success">Permohonan adopsi dikirim. Kami akan menghubungi Anda.</div>';
}

$snake_id = isset($_GET['snake_id']) ? (int)$_GET['snake_id'] : 0;
?>
<h2>Formulir Pengajuan Adopsi</h2>
<form method="post">
  <input type="hidden" name="snake_id" value="<?=$snake_id?>">
  <div class="mb-3">
    <label>Nama</label>
    <input class="form-control" name="name" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input class="form-control" type="email" name="email" required>
  </div>
  <div class="mb-3">
    <label>Telepon</label>
    <input class="form-control" name="phone">
  </div>
  <div class="mb-3">
    <label>Pesan (kenapa ingin mengadopsi)</label>
    <textarea class="form-control" name="message" rows="4"></textarea>
  </div>
  <button class="btn btn-primary">Kirim Permohonan</button>
</form>


<?php require 'footer.php'; ?>


