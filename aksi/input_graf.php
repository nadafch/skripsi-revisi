<?php
include "koneksi.php";
$obj = $_POST['result'];
$node_awal = $_POST['node_awal'];
$node_tujuan = $_POST['node_tujuan'];
$json = json_decode($obj);

var_dump($node_awal,$node_tujuan);
$items = array();
foreach ($json->features[0]->geometry->coordinates as $coordinates){
     $items[]=array($coordinates[0],$coordinates[1]);
}
print_r($items);
// mysqli_query($koneksi,"INSERT INTO tb_graf (graf) VALUES ('".$obj."')");

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
echo "total Jarak :";    
var_dump ($total_km);



$sql="INSERT INTO tb_graf (node_awal,node_akhir,graf,bobot) VALUES ('".$node_awal."','".$node_tujuan."','".$obj."','".$total_km."')";
$a=$koneksi->query($sql);
if($a==true){
echo "<script>alert('Data Node berhasil Dimasukkan');
document.location.href = ' http://localhost:8080/skripsi-revisi/pages/hasil_graf.php';
</script>";
}else{
	echo "<script>alert('Data Node Gagal dimasukkan');
    document.location.href = ' http://localhost:8080/skripsi-revisi/pages/data_graf.php';
    </script>";
}
?>