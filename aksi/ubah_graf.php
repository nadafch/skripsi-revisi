<?php
include "koneksi.php";
$obj = $_POST['result'];
$id = $_POST ['Id'];
$json = json_decode($obj);
$items = array();
foreach ($json->features[0]->geometry->coordinates as $coordinates){
     $items[]=array($coordinates[0],$coordinates[1]);
}
print_r($items);
//euclidean
$total_km = 0;
for ($i=0; $i < count($items)-1 ; $i++) { 
    $deltaLat = pow(($items[$i][0]-$items[$i+1][0]),2);
    $deltaLong = pow(($items[$i][1]-$items[$i+1][1]),2);
    $jarak_km = (sqrt($deltaLat + $deltaLong)) * 111.322;
    $total_km += $jarak_km;
    echo "jarak : ";
    var_dump ($jarak_km);
}

$sql = "UPDATE tb_graf SET GRAF='$obj',BOBOT='$total_km' WHERE NO='$id'";
$a=$koneksi->query($sql);
	if($a==true){
		echo "<script> 
		alert('Data berhasil ubah!');
		document.location.href = '../pages/hasil_graf.php';
		</script>";
	}else{
		echo "<script> 
		alert('Data Gagal ubah!');
		document.location.href = '../pages/edit_graf.php';
		</script>";
	}
?>