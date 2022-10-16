<?php
include "koneksi.php";
//panggil koneksi database
$pass = md5($_POST['password']);
$username = mysqli_escape_string($koneksi, $_POST['username']);
$password = mysqli_escape_string($koneksi, $pass);
$level = mysqli_escape_string($koneksi, $_POST['level']);

//cek username,terdaftar atau tidak
$cek_user = mysqli_query($koneksi, "SELECT * FROM tlogin WHERE username='$username'
and level='$level'");
$user_valid = mysqli_fetch_array($cek_user);

//uji username terdaftar
if($user_valid){
if ($password == $user_valid['password']) {
    //jika password sesuai 
    //buat sesions
    session_start();
    $_SESSION['username'] = $user_valid['username'];
    $_SESSION['nama_lengkap'] = $user_valid['nama_lengkap'];
    $_SESSION['level'] = $user_valid['level'];

    //uji level user
    if ($level == 'guru') {
        header('location:home_guru.php');
    }elseif ($level == 'admin') {
        header('location:home_admin.php');
    }
}else{
    echo "<script>alert('Maaf,Username tidak terdaftar'); 
   document.location='index.php'</script>";
}
}else{
    echo "<script>alert('Maaf,Username tidak terdaftar'); 
   document.location='index.php'</script>";
}
?>