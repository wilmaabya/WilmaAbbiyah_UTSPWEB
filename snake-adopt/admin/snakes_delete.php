<?php
require '../config.php';

// cek login admin
if (empty($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}

// cek id
if (empty($_GET['id'])) {
    header('Location: snakes_list.php');
    exit;
}

$id = (int) $_GET['id'];

// hapus data
$stmt = $pdo->prepare("DELETE FROM snakes WHERE id = ?");
$stmt->execute([$id]);

header('Location: snakes_list.php');
exit;
