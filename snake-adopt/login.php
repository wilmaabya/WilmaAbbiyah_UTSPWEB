<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$u]);
    $admin = $stmt->fetch();
    if ($admin && password_verify($p, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: admin/dashboard.php'); exit;
    } else {
        $error = "Login gagal";
    }
}
require 'header.php';
?>
<div class="col-md-4 mx-auto">
  <h3>Admin Login</h3>
  <?php if(!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="post">
    <div class="mb-3"><input class="form-control" name="username" placeholder="username"></div>
    <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="password"></div>
    <button class="btn btn-primary">Login</button>
  </form>
</div>
<?php require 'footer.php'; ?>
