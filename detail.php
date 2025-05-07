<?php
session_start();
require "koneksi.php";

// Pastikan user_id ada di session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Ambil data user dari database
    $query = "SELECT fullname FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $fullname = $user['fullname'];  // Ambil fullname dari database
    } else {
        $fullname = 'Nama tidak tersedia';  // Jika user tidak ditemukan
    }
} else {
    $fullname = 'User belum login';  // Jika user_id tidak ada di session
}

// Ambil post_id dari query string
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : 0;

// Ambil data post dari database berdasarkan post_id
$query_post = "SELECT title, content, create_at FROM posts WHERE id = '$post_id'";
$result_post = mysqli_query($conn, $query_post);

if ($result_post && mysqli_num_rows($result_post) > 0) {
    $post = mysqli_fetch_assoc($result_post);
    $title = $post['title'];
    $content = $post['content'];  // Ambil content dari database
    $create_at = $post['create_at'];
} else {
    echo "Post tidak ditemukan.";
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Post</title>
</head>
<body>
    <h1>Detail Post: <?php echo $title; ?></h1>
    <p><strong>Nama Lengkap:</strong> <?php echo $fullname; ?></p> <!-- Menampilkan fullname -->
    <p><strong>Tanggal diupload:</strong> <?php echo $create_at; ?></p> <!-- Menampilkan tanggal -->
    <p><strong>Content:</strong> <?php echo nl2br($content); ?></p> <!-- Menampilkan content -->
</body>
</html>
