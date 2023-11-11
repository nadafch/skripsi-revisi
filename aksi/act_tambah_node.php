<?php 
include "koneksi.php";
$no_node = $_POST['nomor_node'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];



$sql="INSERT INTO tb_node(no_node,latitude,longitude) VALUES('".$no_node."','".$lng."','".$lat."')";
$a=$koneksi->query($sql);
if($a==true){
echo "<script>alert('Data Node berhasil Dimasukkan');
document.location.href = ' http://localhost:8080/skripsi-revisi/pages/daftar_node.php';
</script>";
}else{
	echo "<script>alert('Data Node Gagal dimasukkan');
    document.location.href = ' http://localhost:8080/skripsi-revisi/pages/tambah_node.php';
    </script>";
}