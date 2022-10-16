<?php
$server = "localhost";
$user = "root";
$password = "12345123";
$database = "dbsiswa";
//buat koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

?>