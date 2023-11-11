<?php 

require ("koneksi.php");

$id1 = $_REQUEST['id_del'];
$query1 = "DELETE FROM tb_node WHERE id=".$id1;
$sql2 = $koneksi->query($query1);

if($sql2==true){
	echo "<script> 
	alert('Data berhasil dihapus!');
	document.location.href = ' http://localhost:8080/skripsi-revisi/pages/daftar_node.php';
	</script>
	";
}else{
	echo "<script> 
	alert('Data Gagal dihapus!');
	document.location.href = ' http://localhost:8080/skripsi-revisi/pages/daftar_node.php';
	</script>";
}

// header('Location: http://localhost/sig-teori-coba/pages/daftar_tempat.php');
// die();

?>