<?php
include "../aksi/koneksi.php";
// $obj = $_POST['data'];
// $requestPayLoad= file_get_contents("php://input");
// $object = json_decode($requestPayLoad);
// var_dump($object);
// $a= $object->geometry->coordinates[0][0];
// mysqli_query($koneksi,"INSERT INTO tb_graf (graf) VALUES ('".$obj."')");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Startmin - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

    
    
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


<style>
    html,body, #map { height: 500px; width: 100%;}
</style>
</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Admin</a>
            </div>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>


            <ul class="nav navbar-right navbar-top-links">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> User <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="dashboard.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="daftar_tempat.php"><i class="fa fa-map" aria-hidden="true"></i> Data Tempat</a>
                        </li>
                        <li>
                            <a href="data_graf.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Input Graf</a>
                        </li>
                        <li>
                            <a href="hasil_graf.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Hasil Graf</a>
                        </li>
                        <li>
                            <a href="daftar_user.php"><i class="fa fa-user" aria-hidden="true"></i> Data User</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Daftar Hasil Graf</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div id='map'></div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <!-- <a href='tambah_user.php' class='btn btn-success' style="margin-bottom: 10px;">Tambah Data</a> -->
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Node Awal</th>
                                                <th>Node Akhir</th>
                                                <th>Node Tujuan</th>    
                                                <th>GeoJSON</th>
                                                <th>Jarak</th>
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        $no=1;
                                        $query1 = "SELECT * FROM tb_graf ORDER BY NODE_AKHIR ASC";
                                        $sql1 = mysqli_query($koneksi,$query1);
                                        while ($row1= mysqli_fetch_array($sql1)) {
                                            echo "<tr><th>".$no++."</th>";
                                            $kueri = "SELECT * FROM tb_node WHERE no_node=".$row1['NODE_AWAL']."";
                                            $sqli = mysqli_query($koneksi,$kueri);
                                            while ($a = mysqli_fetch_array($sqli)){
                                            echo "<td>".$a['latitude'].",".$a['longitude']."</td>";
                                            }
                                            echo"
                                            <td>".$row1['NODE_AWAL']."</td>
                                            <td>".$row1['NODE_AKHIR']."</td>
                                            <td>".$row1['GRAF']."</td>
                                            <td>".$row1['BOBOT']."</td>
                                            <td width> <a href='http://localhost:8080/skripsi-revisi/aksi/delete_graf.php?id_del=".$row1['NO']."' class='btn btn-danger'>Delete</a></td>
                                            <td>
                                            <a href='http://localhost:8080/skripsi-revisi/pages/edit_graf.php?id_edit=".$row1['NO']."' class='btn btn-warning'>Edit</a></td>
                                            <td><a href='http://localhost:8080/skripsi-revisi/pages/lihat_jarak.php?id_jarak=".$row1['NO']."' class='btn btn-success'>Jarak</a></td>
                                            </td>"
                                            ;
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<script>
var center = [-7.983908, 112.621391];
var map = L.map('map').setView(center, 13);
var DetriIcon = L.icon({
  iconUrl: '../icon.png',
  iconSize: [25,32], // size of the icon
  popupAnchor: [0, -15]
});

var icon_merah = L.icon({
  iconUrl: '../icon_merah.png',
  iconSize: [25,32], // size of the icon
  popupAnchor: [0, -15]
});

var dot = L.icon({
  iconUrl: '../dot.png',
  iconSize: [10,10], // size of the icon
  popupAnchor: [0, -15]
});

// Set up the OSM layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',

    maxZoom: 18
}).addTo(map);

    <?php 
    $query1 = "SELECT graf FROM tb_graf";
    $json = mysqli_query($koneksi,$query1);
    foreach ($json as $key){ ?>
    var drawnItems = L.geoJSON(<?php echo $key['graf']?>).addTo(map);
    <?php } ?>

    <?php
    $query = "SELECT * FROM tb_node";
    $sql= mysqli_query($koneksi, $query);
    while ($row1= mysqli_fetch_array($sql)) {
    ?>
    var marker = L.marker([<?= $row1['longitude']?>, <?= $row1['latitude']?>],{icon: DetriIcon}).bindPopup("<?=$row1['no_node']?>").addTo(map);
    <?php } ?>

    <?php
    $query = "SELECT * FROM tb_marker";
    $sql= mysqli_query($koneksi, $query);
    while ($row1= mysqli_fetch_array($sql)) {
    ?>
    var marker = L.marker([<?= $row1['longitude']?>, <?= $row1['latitude']?>],{icon: dot}).bindPopup("<?=$row1['id']?><br><?=$row1['nama']?>").addTo(map);
    <?php } ?>

    <?php
    $query = "SELECT * FROM bepergian";
    $sql= mysqli_query($koneksi, $query);
    while ($row1= mysqli_fetch_array($sql)) {
    ?>
    var marker = L.marker([<?= $row1['longitude']?>, <?= $row1['latitude']?>],{icon: icon_merah}).bindPopup("<?=$row1['id']?><br><?=$row1['nama']?>").addTo(map);
    <?php } ?>
// var drawControl = new L.Control.Draw({
//     edit: {
//         featureGroup: drawnItems
//     }
// });
// map.addControl(drawControl);

map.on('draw:created', function (e) {
    var type = e.layerType,
        layer = e.layer;

    if (type === 'marker') {
        layer.bindPopup('A popup!');
    }

    drawnItems.addLayer(layer);
    // console.log(layer.getLatLngs());
    // var collection = layer.toGeoJSON();
    // console.log(collection);
    // var str_json = JSON.stringify(collection);
    // console.log(str_json);
});
</script>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../js/raphael.min.js"></script>
<script src="../js/morris.min.js"></script>
<script src="../js/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>

</body>
</html>
