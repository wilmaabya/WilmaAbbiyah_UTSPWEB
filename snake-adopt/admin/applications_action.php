<?php
require '../config.php';
if (empty($_SESSION['admin_id'])) {
    header('Location: /snake-adopt/login.php');
    exit;
}

$id = $_GET['id'] ?? 0;
$action = $_GET['action'] ?? '';

if ($id && in_array($action, ['approve', 'reject'])) {
    $status = ($action === 'approve') ? 'Approved' : 'Rejected';

    $stmt = $pdo->prepare("UPDATE applications SET status=? WHERE id=?");
    $stmt->execute([$status, $id]);

    if ($status === 'Approved') {
        $pdo->prepare("UPDATE snakes 
                       SET status='Adopted' 
                       WHERE id=(SELECT snake_id FROM applications WHERE id=?)")
            ->execute([$id]);
    }
}

header('Location: applications_list.php');
exit;
