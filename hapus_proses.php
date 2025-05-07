<?php
// Masukan file koneksi php

require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];

    // Lakukan  query delte ke database
    $query = "DELETE FROM posts WHERE id =$id";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil melakukan hapus data di database kembali ke index.php
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    }else{
        // Jika gagal tampilkan pesn gagal dan kembali ke index.php
        echo mysqli_error($conn);
        echo "<meta http-equiv='refresh' content='5;url=index.php'>";
    }
}
?>