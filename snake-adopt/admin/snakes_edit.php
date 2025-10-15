<?php
require '../config.php';
if (empty($_SESSION['admin_id'])) {
    header('Location: /snake-adopt/login.php'); exit;
}

$id = $_GET['id'] ?? 0;

// ambil data snake
$stmt = $pdo->prepare("SELECT * FROM snakes WHERE id = ?");
$stmt->execute([$id]);
$snake = $stmt->fetch();

if (!$snake) {
    echo "Data tidak ditemukan!";
    exit;
}

// kalau form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $species = $_POST['species'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $photoName = $snake['photo']; // default foto lama
    if (!empty($_FILES['photo']['name'])) {
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = time().'-'.bin2hex(random_bytes(6)).'.'.$ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/".$photoName);
    }

    $stmt = $pdo->prepare("UPDATE snakes SET name=?, species=?, age=?, gender=?, description=?, photo=?, status=? WHERE id=?");
    $stmt->execute([$name,$species,$age,$gender,$description,$photoName,$status,$id]);

    header('Location: snakes_list.php');
    exit;
}
?>

<?php require '../header.php'; ?>
<h2>Edit Snake</h2>
<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Nama</label>
    <input name="name" class="form-control" value="<?=htmlspecialchars($snake['name'])?>">
  </div>
  <div class="mb-3">
    <label>Species</label>
    <input name="species" class="form-control" value="<?=htmlspecialchars($snake['species'])?>">
  </div>
  <div class="mb-3">
    <label>Umur</label>
    <input name="age" class="form-control" value="<?=htmlspecialchars($snake['age'])?>">
  </div>
  <div class="mb-3">
    <label>Gender</label>
    <select name="gender" class="form-control">
      <option value="Male" <?=$snake['gender']=='Male'?'selected':''?>>Male</option>
      <option value="Female" <?=$snake['gender']=='Female'?'selected':''?>>Female</option>
      <option value="Unknown" <?=$snake['gender']=='Unknown'?'selected':''?>>Unknown</option>
    </select>
  </div>
  <div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="description" class="form-control"><?=htmlspecialchars($snake['description'])?></textarea>
  </div>
  <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
      <option value="Available" <?=$snake['status']=='Available'?'selected':''?>>Available</option>
      <option value="Adopted" <?=$snake['status']=='Adopted'?'selected':''?>>Adopted</option>
    </select>
  </div>
  <div class="mb-3">
    <label>Foto (biarkan kosong jika tidak diganti)</label>
    <input type="file" name="photo" accept="image/*" class="form-control">
  </div>
  <button class="btn btn-primary">Simpan Perubahan</button>
</form>
<?php require '../footer.php'; ?>
