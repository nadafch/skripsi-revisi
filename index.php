<?php 
include "aksi/koneksi.php";
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


    <title>SIG Tempat Pelayanan Tes Covid-19</title>
    <style>
        #map { height: 500px; width: 75%;}
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
            <p>Sistem Informasi Geografis Tempat Pelayanan Tes Covid-19</p>
        </div>
        <div class="container">
            <div id="map"></div>
            <form method="post" action="rute_bellman.php">
            <!-- <div class="form-group">
                    <?php $sql = $koneksi->query("SELECT * FROM tb_marker") ?>
                    <?php while ($data = mysqli_fetch_array($sql)) { ?>
                    <input type="hidden" name="node_awal" id="node_awal" value="<?=$data["id"]?>">
                    <?php }; ?>
            </div> -->
            <div class="form-group">
                <label for="node_tujuan">Pilih Tujuan Anda</label>
                <select class="form-control" name="node_tujuan" id="node_tujuan">
                    <?php $sql = $koneksi->query("SELECT * FROM bepergian") ?>
                    <?php while ($data = mysqli_fetch_array($sql)) { ?>
                    <option value="<?=$data["id"]?>"><?php echo $data["nama"]?></option>
                    <?php }; ?>
                </select>
            </div>
            <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Cari </button>
            </form>
        </div>
        <!-- Bellman-Ford -->
     
        <script>
            var center = [-7.953908, 112.621391];
            var map = L.map('map').setView(center, 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',

                maxZoom: 18
            }).addTo(map);
            var icon_merah = L.icon({
            iconUrl: 'icon_merah.png',
            iconSize: [25,32], // size of the icon
            popupAnchor: [0, -15]
            });
            var dot = L.icon({
            iconUrl: 'dot.png',
            iconSize: [15,15], // size of the icon
            popupAnchor: [0, -15]
            });
            <?php
            $query = "SELECT * FROM bepergian";
            $sql= mysqli_query($koneksi, $query);
            while ($row1= mysqli_fetch_array($sql)) {
            ?>
            var marker = L.marker([<?= $row1['longitude']?>, <?= $row1['latitude']?>],{icon: icon_merah}).bindPopup("<?=$row1['nama']?><br>").addTo(map);
            <?php } ?>
            <?php
            $query = "SELECT * FROM tb_marker";
            $sql= mysqli_query($koneksi, $query);
            while ($row1= mysqli_fetch_array($sql)) {
            ?>
            var marker = L.marker([<?= $row1['longitude']?>, <?= $row1['latitude']?>],{icon: dot}).bindPopup("<?=$row1['nama']?><br>").addTo(map);
            <?php } ?>
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
