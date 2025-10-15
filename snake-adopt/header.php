<?php
// header.php
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Snake Adopt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
  body {
    background-color: #121212;
    color: #f1f1f1;
  }

  .navbar {
    background-color: #1e1e1e !important;
  }

  .navbar a {
    color: #f1f1f1 !important;
  }

  .container {
    background-color: #181818;
    border-radius: 10px;
    padding: 20px;
  }

  .card, .table, .form-control {
    background-color: #1f1f1f !important;
    color: #f1f1f1 !important;
    border: 1px solid #333;
  }

  .btn-primary {
    background-color: #4caf50;
    border: none;
  }

  .btn-primary:hover {
    background-color: #45a049;
  }

  a {
    color: #90caf9;
  }

  a:hover {
    color: #64b5f6;
  }

  footer {
    background-color: #1a1a1a;
    color: #bbb;
  }
</style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="/snake-adopt/">🐍SnakeAdopt</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/snake-adopt/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/snake-adopt/login.php">Admin</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container py-4">
