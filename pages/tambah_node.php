<?php
include "../aksi/koneksi.php"
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

    
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet" />

    <script src="https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js"></script>
    <link href="https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300&display=swap" rel="stylesheet">
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                            <a href="index.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
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
                        <h1 class="page-header">Tambah Node</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                 <h4></h4>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="../aksi/act_tambah_node.php" enctype="multipart/form-data">    
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nomor Node <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="nomor_node" />
                                    </div>
                                    <div class="form-group">
                                        <label>Latitude <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="lat" id="lat" />
                                    </div>
                                    <div class="form-group">
                                        <label>Longitude <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="lng" name="lng" />
                                    </div>
                                        <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                                        <a class="btn btn-danger" href="daftar_node.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
                                    </div>        
                                </div>
                                <div class="col-lg-12">
                                    <div id="map" style="height: 400px;"></div>
                                </div>       
                            </div>
                        </form>
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

<script type="text/javascript">
    L.mapbox.accessToken = "pk.eyJ1IjoibmFkYWZjaCIsImEiOiJja242NjlicmkwYjJ1MnZsZ2E2b3E3cW04In0.9y4R-3t0qsf5rucdAUGFqw";
    var map = L.mapbox.map('map')
    .setView([ -7.983908, 112.621391], 11)
    .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));


    var myLayer = L.mapbox.featureLayer().addTo(map);

    var latInput = document.querySelector("[name=latitude]");
    var lntInput = document.querySelector("[name=longitude]");

    var curLocation = [ -7.983908, 112.621391];

    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation,{
        draggable : "true",
    });

    marker.on('dragend', function(event){
        var position = marker.getLatLng();
        marker.setLatLng(position,{
            draggable: true,
        }).bindPopup(position).update();
        $("#lat").val(position.lat);
        $("#lng").val(position.lng);

    });

    map.addLayer(marker);
    
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
