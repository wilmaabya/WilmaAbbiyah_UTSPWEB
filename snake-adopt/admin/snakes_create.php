<?php
require '../config.php';

// Cek login admin
if (empty($_SESSION['admin_id'])) {
    header('Location: /snake-adopt/login.php');
    exit;
}

//form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $species = $_POST['species'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $desc = $_POST['description'];
    $photoName = null;

    $uploadDir = realpath(__DIR__ . '/../uploads');
    if (!$uploadDir) {
        mkdir(__DIR__ . '/../uploads', 0777, true);
        $uploadDir = realpath(__DIR__ . '/../uploads');
    }

    // Upload foto (jika ada)
    if (!empty($_FILES['photo']['name']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = time() . '-' . bin2hex(random_bytes(6)) . '.' . $ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . '/' . $photoName);
    }

    // Masukkan ke database
    $stmt = $pdo->prepare("
        INSERT INTO snakes (name, species, age, gender, description, photo, status)
        VALUES (?, ?, ?, ?, ?, ?, 'Available')
    ");
    $stmt->execute([$name, $species, $age, $gender, $desc, $photoName]);

    header('Location: snakes_list.php');
    exit;
}

require '../header.php';
?>

<h2>Tambah Snake</h2>
<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <input name="name" class="form-control" placeholder="Name" required>
  </div>
  <div class="mb-3">
    <input name="species" class="form-control" placeholder="Species" required>
  </div>
  <div class="mb-3">
    <input name="age" class="form-control" placeholder="Age">
  </div>
  <div class="mb-3">
    <select name="gender" class="form-control">
      <option value="Unknown">Unknown</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
  </div>
  <div class="mb-3">
    <textarea name="description" class="form-control" placeholder="Description"></textarea>
  </div>
  <div class="mb-3">
    <input type="file" name="photo" accept="image/*" class="form-control">
  </div>
  <button class="btn btn-primary">Simpan</button>
</form>

<?php require '../footer.php'; ?>
