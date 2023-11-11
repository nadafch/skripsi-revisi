<?php 
include "koneksi.php";
$nama_tempat = $_POST['nama_tempat'];
$gambar = $_FILES['gambar'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$lokasi = $_POST['lokasi'];
$website = $_POST['website'];
$kontak = $_POST['kontak'];
$jam = $_POST['jam'];
$keterangan = $_POST['keterangan'];


$rand = rand();
$ekstensi= array('png','jpg','jpeg','gif');
$filename = $_FILES['gambar']['name'];
$size = $_FILES['gambar']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array($ext,$ekstensi) ) {
	echo "<script> 
	alert('Ekstensi Gambar yang anda masukkan salah');
	document.location.href = ' http://localhost:8080/skripsi-revisi/pages/tambah_data.php';
	</script>
	";
}else{
	if($size < 1044070){      
		$xx = $rand.'_'.$filename;
		move_uploaded_file($_FILES['gambar']['tmp_name'], '../images/'.$rand.'_'.$filename);
		mysqli_query($koneksi, "INSERT INTO tb_marker (nama, alamat, longitude, latitude, deskripsi,website,jam_buka,kontak,gambar)VALUES('$nama_tempat','$lokasi','$lng','$lat','$keterangan','$website','$kontak','$jam','$xx')");
		echo "<script> 
		alert('Data Berhasil Ditambahkan');
		document.location.href = ' http://localhost:8080/skripsi-revisi/pages/daftar_tempat.php';
		</script>
		";
	}else{
		echo "<script> 
		alert('Size gambar melebihi ketentuan!');
		document.location.href = ' http://localhost:8080/skripsi-revisi/pages/tambah_data.php';
		</script>
		";
	}
}