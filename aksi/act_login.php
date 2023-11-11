<?php
session_start();
include "koneksi.php";
$user=$_POST['username'];
$psw= $_POST['password'];

$query_1="SELECT * FROM tb_user where username='$user' AND password='$psw'";
$data = mysqli_query($koneksi,$query_1);
$cek = mysqli_num_rows($data);
if ($cek>0) {
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:../pages/dashboard.php");
}
else{
	echo "<script>alert('Data yang anda masukkan salah');history.go(-1);</script>";
}
?>