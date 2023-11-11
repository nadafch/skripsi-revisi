<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta
        name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" text="text/css" href="style/home.css">

        <script src="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet"/>
        <script src="https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js"></script>
        <link href="https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css" rel="stylesheet"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300&display=swap" rel="stylesheet">
        <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
        <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet"/>

        <title>SIG Tempat Pelayanan Tes Covid-19</title>
    <style>
    .marker {
      background-image: url('icon_merah.png');
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
        <?php 
        include "aksi/koneksi.php";
        $query = "SELECT * FROM tb_marker";
        $sql= mysqli_query($koneksi, $query);
        ?>
        <script>
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
                "gambar": "'.$row['gambar'].'",
                "title": "'.$row['nama'].'",
                "description": "'.$row['alamat'].'",
                }
            },';
            }
            ?>
            ]
        };

        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [112.61804690992061,-7.953818752708465],
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
                    '<img src= "images/'+
                    marker.properties.gambar+
                    '" width="80" height="50"> <h6>' +
                    marker.properties.title +
                    '</h6><p>' +
                    marker.properties.description +
                    '</p><a href="http://localhost:8080/skripsi-revisi/pages/detail_data.php?id='
                    +marker.properties.id+
                    '">Detail</a></td>'
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
                'text-field': ['get', 'title'],
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
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
