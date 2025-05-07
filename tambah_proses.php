<?php
session_start();
require "koneksi.php";

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);
    $user_id = $_SESSION['user_id']; // ambil ID user dari session

    $create_at = date("Y-m-d H:i:s"); // ambil waktu sekarang

    $query = "INSERT INTO posts (title, content, user_id, create_at) 
              VALUES ('$title', '$content', '$user_id', '$create_at')";
    

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<meta http-equiv='refresh' content='1;url=posts.php'>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
