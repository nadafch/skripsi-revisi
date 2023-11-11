<?php
include "../aksi/koneksi.php";
$id = $_GET['id'];
$marker  = "SELECT * FROM tb_marker WHERE id='$id'";
$b=$koneksi->query($marker);
$c=mysqli_fetch_array($b);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <title>Driving directions</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
      body { margin:0; padding:0; }
      #map { position:absolute; top:10; width:100%; height: 70%; margin-left: -10%}
  </style>
</head>
<body>
    <style>
        #inputs,
        #directions {
            position: absolute;
            margin-top: 56px;
            height: 70%;
            width: 33.3333%;
            max-width: 300px;
            min-width: 200px;
        }
        #inputs {
            z-index: 10;
            top: 10px;
            left: 10px;
        }
        #directions {
            z-index: 99;
            background: rgba(0,0,0,.8);
            top: 0;
            right: 0;
            bottom: 0;
            overflow: auto;
        }

        #errors {
            z-index: 8;
            opacity: 0;
            padding: 10px;
            border-radius: 0 0 3px 3px;
            background: rgba(0,0,0,.25);
            top: 90px;
            left: 10px;
        }

    </style>

    <script src='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.css' type='text/css' />

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../hospital.png" width="30" height="30" class="d-inline-block align-top" alt="">
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
                    </ul>
                </div>
            </div>
        </nav>

<div class="container">
    <div class="row">
        <!-- <div class="col">
            <div id='map'></div>
            <div id='inputs'></div>
            <div id='directions'>
                <div id='routes'></div>
                <div id='instructions'></div>
            </div>
        </div> -->
        <div class="col">
            <img src="../images/<?php echo $c['gambar'];?>" width="800" height="auto">
        </div>
        <div class="row" style=" margin-top: 10%; margin-bottom: 10%">
         <div class="col">
           <div class="panel-body">
            <table class="table">
                <tr>
                    <th>Item</th>
                    <th>Detail</th>
                </tr>
                <tr>
                    <td>Nama Tempat</td>
                    <td><h4><?php echo $c['nama']; ?></h4></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?php echo $c['alamat']; ?></td>
                </tr>
                <tr>
                    <td>Website</td>
                    <td><?php echo $c['website']; ?></td>
                </tr>
                <tr>
                    <td>Kontak</td>
                    <td><?php echo $c['kontak']; ?></td>
                </tr>
                <tr>
                    <td>Jam operasional</td>
                    <td><?php echo $c['jam_buka']; ?></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><?php echo $c['deskripsi']; ?></td>
                </tr>
            </table>
            </div>
        </div>
    </div>

    </div>


</div>
</div>

<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoibmFkYWZjaCIsImEiOiJja242NjlicmkwYjJ1MnZsZ2E2b3E3cW04In0.9y4R-3t0qsf5rucdAUGFqw';
    var map = L.mapbox.map('map', null, {
        zoomControl: false
    })
    .setView([-7.767454943207647, 112.15076611068258], 9)
    .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

// move the attribution control out of the way
map.attributionControl.setPosition('bottomleft');

// create the initial directions object, from which the layer
// and inputs will pull data.
var start = {lat: -7.7468658454199035, lng: 112.16794441534073}; 
var finish = {lat: <?php  echo $c['latitude'] ?>, lng: <?php echo $c['longitude'] ?>};

// Set the origin and destination for the direction and call the routing service
var directions = L.mapbox.directions();
directions.setOrigin(L.latLng(start.lat, start.lng)); 
directions.setDestination(L.latLng(finish.lat, finish.lng));   
directions.query(); 

// directions.setOrigin(L.latLng(start.lat, start.lng)); 
// directions.setDestination(L.latLng(finish.lat, finish.lng));   
// directions.query(); 

var directionsLayer = L.mapbox.directions.layer(directions).addTo(map); 
var directionsRoutesControl = L.mapbox.directions.routesControl('routes', directions)
.addTo(map);

var directionsInputControl = L.mapbox.directions.inputControl('inputs', directions)
.addTo(map);

var directionsErrorsControl = L.mapbox.directions.errorsControl('errors', directions)
.addTo(map);

// var directionsRoutesControl = L.mapbox.directions.routesControl('routes', directions)
// .addTo(map);

var directionsInstructionsControl = L.mapbox.directions.instructionsControl('instructions', directions)
.addTo(map);
</script>
</body>
</html>