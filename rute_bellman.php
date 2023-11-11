<?php 
include "aksi/koneksi.php";
$node_tujuan = $_POST['node_tujuan'];
$result = mysqli_query($koneksi,"SELECT * FROM tb_graf WHERE NODE_AKHIR='".$node_tujuan."'");
// print_r($result);

//BELLMAN FORD
$node_awal=0;
$node_akhir = PHP_FLOAT_MAX;
while($row = mysqli_fetch_array($result)){
    if ($node_awal == 0 && $row['BOBOT'] < $node_akhir){
        $id = $row['NO'];
        $node_akhir = $node_awal + $row['BOBOT'];
        // echo $node_awal." + ".$row['BOBOT']." = ".$node_akhir."<br>";
    } else if ($node_awal != 0 && $row['BOBOT'] < $node_akhir){
        $id = $row['NO'];
        $node_akhir = $node_awal + $row['BOBOT'];
        // echo $node_awal." + ".$row['BOBOT']." = ".$node_akhir."<br>";
    }
    else if ($node_awal != 0 && $row['BOBOT'] > $node_akhir){
        return $id = $row['NO'];
        return $node_akhir;
        // echo $node_akhir;
    }
}
$sql = $koneksi->query("SELECT * FROM tb_graf WHERE NO='".$id."'");
while ($data = mysqli_fetch_array($sql)) {
    $rs = $data['NODE_AWAL'];
    $tujuan = $data['NODE_AKHIR'];
}
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta
        name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" text="text/css" href="style/rute.css">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js" integrity="sha512-ozq8xQKq6urvuU6jNgkfqAmT7jKN2XumbrX1JiB3TnF7tI48DPI4Gy1GXKD/V3EExgAs1V+pRO7vwtS1LHg0Gw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <title>SIG Tempat Pelayanan Tes Covid-19</title>
    <style>
        /* #map { height: 500px; width: 75%;} */
        <style>
        body{
            margin:0
        }
        #map{
            width:100vw;
            height:100vh
        }
        p {
            margin: 10px;
        }
    </style>

    </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="hospital.png" width="30" height="30" class="d-inline-block align-top" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/login.html">Login</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="rute_bellman.php">Perhitungan Rute Terdekat</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>

        <div class="judul">
            <p>Perhitungan Rute Terdekat Menggunakan Metode Bellman-Ford</p>
        </div>
        <div class="container">
            
            <div class="row">
            <?php $sql = $koneksi->query("SELECT * FROM bepergian WHERE id='".$node_tujuan."'") ?>
            <?php while ($data = mysqli_fetch_array($sql)) { ?>
                <?php $sql1 = $koneksi->query("SELECT * FROM tb_marker WHERE id='".$rs."'") ?>
                <?php while ($data1 = mysqli_fetch_array($sql1)) { ?>
                <p><?php echo $data1['nama']?> merupakan tempat pelayanan tedekat jika ingin bepergian ke <?php echo $data['nama']?></p>
                <?php };?>
            <?php };?>
            <div id="map"></div>
            </div>
            </div>
            </form>
        </div>
        <!-- Bellman-Ford -->
     
        <script>
            var center = [-7.953908, 112.621391];
            var map = L.map('map').setView(center, 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',

                maxZoom: 18
            }).addTo(map);

            <?php $sql = $koneksi->query("SELECT * FROM tb_node") ?>
            <?php while ($row1 = mysqli_fetch_array($sql)) {?>
                let latLng1 = L.latLng(<?=$row1['longitude'] ?>, <?=$row1['latitude']?>);
                let wp1 = new L.Routing.Waypoint(latLng1);
            <?php } ?>

            <?php $sql = $koneksi->query("SELECT * FROM tb_marker WHERE id='".$rs."'") ?>
            <?php while ($data1 = mysqli_fetch_array($sql)) {?>
                let latLng2 = L.latLng( <?=$data1['longitude'] ?>, <?= $data1['latitude']?>);
                let wp2 = new L.Routing.Waypoint(latLng2);
            <?php } ?>;

            <?php $sql = $koneksi->query("SELECT * FROM bepergian WHERE id='".$tujuan."'") ?>
            <?php while ($data = mysqli_fetch_array($sql)) {?>
                let latlng3 = L.latLng( <?=$data['longitude'] ?>, <?= $data['latitude']?>)
            <?php } ?>



            L.Routing.control({
            waypoints: [latLng1,latLng2,latlng3]
            }).addTo(map);

   


            
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>

