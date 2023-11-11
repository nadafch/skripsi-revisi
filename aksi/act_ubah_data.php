<?php 
include "koneksi.php";
$x=$_POST['x'];
$foto         =$_FILES['gambar']['tmp_name'];
$foto_name     =$_FILES['gambar']['name'];
$acak        = rand(1,99);
$tujuan_foto = $acak.$foto_name;
$tempat_foto = '../images/'.$tujuan_foto;

$id = $_POST['id'];
$nama_tempat = $_POST['nama_tempat'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$lokasi = $_POST['lokasi'];
$website = $_POST['website'];
$kontak = $_POST['kontak'];
$jam = $_POST['jam'];
$keterangan = $_POST['keterangan'];

if (isset($_POST['update'])){
	if (!$foto==""){
		$buat_foto=$tujuan_foto;
		$d = '../images/'.$x;
		@unlink ("$d");
		copy ($foto,$tempat_foto);
	}else{
		$buat_foto=$x;
	}
	$sql= "UPDATE tb_marker SET nama='$nama_tempat', longitude='$lng', latitude='$lat',alamat='$lokasi',deskripsi='$keterangan',website='$website',kontak='$kontak',jam_buka='$jam',gambar='$buat_foto' WHERE id='$id'";
	$a=$koneksi->query($sql);
	if($a==true){
		echo "<script> 
		alert('Data berhasil ubah!');
		document.location.href = '../pages/daftar_tempat.php';
		</script>";
	}else{
		echo "<script> 
		alert('Data Gagal ubah!');
		document.location.href = '../pages/ubah_data.php?id_edit=".$id.';
		</script>"';
	}
}
?>