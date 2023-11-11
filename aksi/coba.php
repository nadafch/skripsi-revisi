<?php
include "koneksi.php";
 $query1 = "SELECT graf FROM tb_graf";
    $json = mysqli_query($koneksi,$query1);
   foreach ($json->features[0]->geometry->coordinates as $coordinates){
       var_dump($coordinates[0]);
       var_dump($coordinates[1]);
   }
?>