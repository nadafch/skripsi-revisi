<?php
include "../aksi/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daftar Tempat</title>
    
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
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

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
  <style>
    .marker {
      background-image: url('../icon.png');
      background-size: cover;
      width: 20px;
      height: 30px;
      border-radius: 10%;
      cursor: pointer;
    }
    .mapboxgl-popup {
      max-width: 200px;
    }
    .mapboxgl-popup-content {
      text-align: center;
      font-family: 'Open Sans', sans-serif;
    }
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
                        <h1 class="page-header">Daftar Tempat</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                    <div id="map" style="height: 400px;"></div>
                </div> 
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tabel Daftar Tempat
                            </div>
                            <div id="map"></div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <a href='tambah_data.php' class='btn btn-success' style="margin-bottom: 10px;">Tambah Data</a>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nomor Node</th>
                                                <th>Longitude</th>
                                                <th>Latitude</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nomor Node</th>
                                                <th>Longitude</th>
                                                <th>Latitude</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php 
                                        $no=1;
                                        $query1 = "SELECT * FROM tb_node";
                                        $sql1 = mysqli_query($koneksi,$query1);
                                        while ($row1= mysqli_fetch_array($sql1)) {
                                            echo "<tr><th>".$no++."</th>
                                            <td>".$row1['no_node']."</td>
                                            <td>".$row1['longitude']."</td>
                                            <td>".$row1['latitude']."</td>
                                            <td width> <a href='http://localhost:8080/skripsi-revisi/aksi/act_hapus_node.php?id_del=".$row1['id']."' class='btn btn-danger'>Delete</a></td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->

            <!-- jQuery -->
<?php 
$query = "SELECT * FROM tb_node";
$sql= mysqli_query($koneksi, $query);
?>
<script type="text/javascript">
 mapboxgl.accessToken = 'pk.eyJ1IjoibmFkYWZjaCIsImEiOiJja242NjlicmkwYjJ1MnZsZ2E2b3E3cW04In0.9y4R-3t0qsf5rucdAUGFqw';

  var geojson = {
    'type': 'FeatureCollection',
    'features': [
    <?php while ($row = $sql->fetch_array()){ 
      echo'{
        "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": ['.$row['latitude'].','.$row['longitude'].']
        },
        "properties": {
          "id": "'.$row['id'].'",
          "no_node": "'.$row['no_node'].'",
        }
      },';
    }
    ?>
    ]
  };

  var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [112.621391,-7.983908],
    zoom: 10
  });

      // add markers to map
      geojson.features.forEach(function (marker) {
        // create a HTML element for each feature
        var el = document.createElement('div');
        el.className = 'marker';

        // make a marker for each feature and add it to the map
        new mapboxgl.Marker(el)
        .setLngLat(marker.geometry.coordinates)
        .setPopup(
            new mapboxgl.Popup({ offset: 25 }) // add popups
            .setHTML(
              '<h6>' +
              marker.properties.no_node +
              '</h6>'
              )
            )
        .addTo(map);
      });

      map.on('load', function () {
    // Add a GeoJSON source containing place coordinates and information.
    map.addSource('places', {
      'type': 'geojson',
      'data': geojson
    });

    map.addLayer({
      'id': 'poi-labels',
      'type': 'symbol',
      'source': 'places',
      'layout': {
        'text-field': ['get', 'no_node'],
        'text-anchor': 'top',
        "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
        "text-size": 15
      },
      'paint': {
        "text-color": "#B22222"
      }
    });
  });

</script>
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
            <script>
            $(document).ready(function(){
                $('#dataTables-example').DataTable();
            });
        </script>

        </body>
        </html> 
