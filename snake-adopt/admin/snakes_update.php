<?php
require '../config.php';
if (empty($_SESSION['admin_id'])) {
    header('Location: /snake-adopt/login.php'); exit;
}

// Cek login admin
if (empty($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: snakes_list.php');
    exit;
}

$id = $_POST['id'];
$name = trim($_POST['name']);
$species = trim($_POST['species']);
$status = $_POST['status'] ?? 'Available';

// Upload foto baru kalau ada
$photoName = null;
if (!empty($_FILES['photo']['name'])) {
    $targetDir = '../uploads/';
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $photoName = time() . '_' . basename($_FILES['photo']['name']);
    $targetFile = $targetDir . $photoName;

    // pindahkan file
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
        // update data dengan foto baru
        $stmt = $pdo->prepare("UPDATE snakes SET name=?, species=?, status=?, photo=? WHERE id=?");
        $stmt->execute([$name, $species, $status, $photoName, $id]);
    } else {
        echo "Gagal upload foto.";
        exit;
    }
} else {
    // tanpa ganti foto
    $stmt = $pdo->prepare("UPDATE snakes SET name=?, species=?, status=? WHERE id=?");
    $stmt->execute([$name, $species, $status, $id]);
}

// Kembali ke daftar
header('Location: snakes_list.php');
exit;
