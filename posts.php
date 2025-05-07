<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require "koneksi.php";

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
  <title>Halaman Posts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="padding: 70px 20px 20px 20px;">
  <div class="container">
    <h1 class="text-center mb-4">Daftar Postingan</h1>
    <a href="tambah.php" class="btn btn-info mb-3">Tambah Data</a>
    <a href="index.php" class="btn btn-info mb-3">Ke Beranda</a>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Pengarang</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
      if (mysqli_num_rows($result) > 0) {
          $no = 1;
          while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <tr>
                  <td><?= $no ?></td>
                  <td><a href="detail.php?post_id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a></td>
                  <td><?= htmlspecialchars($row['fullname']) ?></td>
                  <td><?= $row['create_at'] ?></td>
                  <td>
                  <td>
                <form action="hapus_proses.php" method="POST" class="d-inline">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                  <a href="detail.php?post_id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Detail</a>
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Hapus</button>
                </form>
                  </td>
                  </td>
              </tr>
              <?php
              $no++;
          }
      } else {
          echo "<tr><td colspan='5' class='text-center text-danger'>Data tidak ditemukan.</td></tr>";
      }
      ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
