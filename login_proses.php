<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query langsung (raw, tanpa perlindungan tambahan)
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: posts.php");
            exit;
        } else {
            header("Location: login.php?error=Password salah");
            exit;
        }
    } else {
        header("Location: login.php?error=Email tidak ditemukan");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
