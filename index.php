<?php
require "koneksi.php";

// Ambil semua postingan dengan nama pengarang (join dengan tabel users)
$query = "SELECT posts.id, posts.title, posts.create_at, users.fullname 
          FROM posts 
          JOIN users ON posts.user_id = users.id 
          ORDER BY posts.create_at DESC";

$result = mysqli_query($conn, $query);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .card-link {
  color:rgb(0, 0, 0); /* Ganti dengan warna yang diinginkan */
  font-weight: bold;
  font-style: italic;
  }

    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand text-white fw-bold" href="#">Blog Sederhana</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
              <li class="nav-item"><a class="nav-link text-white" href="posts.php">Posts</a></li>
              <li class="nav-item"><a class="nav-link text-white" href="login.php">Login</a></li>
              <li class="nav-item"><a class="nav-link text-white" href="register.php">Register</a></li>
              <li class="nav-item"><a class="nav-link text-white" href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Konten -->
    <div class="container mt-5 pt-5">
      <h1 class="mb-4">Daftar Postingan</h1>

      <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <div class="col-md-4 mb-4">
            <div class="card shadow">
              <div class="card-body">
                <h5 class="card-title">
                  <a href="detail.php?post_id=<?= $row['id'] ?>" class="text-decoration-none card-link">
                    <?= htmlspecialchars($row['title']) ?>
                  </a>
                </h5>
                <p class="card-text mb-1"><strong>Pengarang:</strong> <?= htmlspecialchars($row['fullname']) ?></p>
                <p class="card-text text-muted"><small>Dibuat pada <?= $row['create_at'] ?></small></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

    </div>
    <!-- Konten -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
