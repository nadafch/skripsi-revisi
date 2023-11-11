var center = [-7.983908, 112.621391];

// Create the map
var map = L.map('map').setView(center, 13);

// Set up the OSM layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',

    maxZoom: 18
}).addTo(map);

// var editableLayers = new L.FeatureGroup();
// map.addLayer(editableLayers);

// var options = {
//     position: 'topleft',
//     draw: {
//         polygon: {
//             allowIntersection: false, // Restricts shapes to simple polygons
//             drawError: {
//                 color: '#e1e100', // Color the shape will turn when intersects
//                 message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect
//             },
//             shapeOptions: {
//                 color: '#97009c'
//             }
//         },
//         polyline: {
//             shapeOptions: {
//                 color: '#f357a1',
//                 weight: 10
//             }
//         },
//         // disable toolbar item by setting it to false
//         polyline: true,
//         circle: true, // Turns off this drawing tool
//         polygon: false,
//         marker: false,
//         rectangle: false
//     },
//     edit: {
//         featureGroup: editableLayers, // REQUIRED!!
//         remove: true
//     }
// };

// // Initialise the draw control and pass it the FeatureGroup of editable layers
// var drawControl = new L.Control.Draw(options);
// map.addControl(drawControl);

// var editableLayers = new L.FeatureGroup();
// map.addLayer(editableLayers);

// map.on('draw:created', function (e) {
//     var type = e.layerType,
//         layer = e.layer;

//     if (type === 'polyline') {
//         layer.bindPopup('A polyline!');
//     } else if (type === 'polygon') {
//         layer.bindPopup('A polygon!');
//     } else if (type === 'marker') {
//         layer.bindPopup('marker!');
//     } else if (type === 'circle') {
//         layer.bindPopup('A circle!');
//     } else if (type === 'rectangle') {
//         layer.bindPopup('A rectangle!');
//     }


//     editableLayers.addLayer(layer);
// });

var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

// Initialise the draw control and pass it the FeatureGroup of editable layers
var drawControl = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems
    }
});
map.addControl(drawControl);

// and keep the drawn items on the map
map.on('draw:created', function (e) {
    var type = e.layerType,
        layer = e.layer;

    if (type === 'marker') {
        layer.bindPopup('A popup!');
    }

    drawnItems.addLayer(layer);
    console.log(layer.getLatLngs());
    var collection = layer.toGeoJSON();
    console.log(collection);
    var str_json = JSON.stringify(collection);
    console.log(str_json);


    //     var coordinate = layer.getLatLngs();
    //     for (var i = 0; i < coordinate.length; i++) {
    //         if (map.getBounds().contains(coordinate[i])) {
    //             console.log(coordinate[i])
    //             var outputvar = document.getElementById("graf");
    //             outputvar.innerHTML = '<input type=text id=array_graf value=' + coordinate[i] + '>';
    //         }
    //     }


    //     if (e.layerType = 'polyline') {
    //         var coords = layer.getLatLngs();
    //         var length = 0;
    //         for (var i = 0; i < coords.length - 1; i++) {
    //             length += coords[i].distanceTo(coords[i + 1]);
    //         }
    //         console.log(length);
    //     }
});
document.getElementById("graf").addEventListener("click", function () {
    var hasil = $('#result').html(JSON.stringify(drawnItems.toGeoJSON()));
    var data_geo = document.getElementById('result').innerHTML;
    if (data_geo == '{"type":"FeatureCollection","features":[]}') {
        alert("data kosong");
    } else {
        ajax_simpan();
    }
});

function ajax_simpan() {
    var url = "../aksi/input_graf.php";
    var hasil = JSON.stringify(drawnItems.toGeoJSON());

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            result: hasil
        },
        beforeSend: function (s) {
            $('#result').html('tunggu');
        },
        success: function (data) {
            $('#result').html(data);
        }
    })
}

// const xhr = new XMLHttpRequest();


// xhr.open("POST", "data_graf.php");
// xhr.setRequestHeader("Content-Type", "application/json");
// xhr.send(str_json);
map.on("keypress", function (e) {
    console.log(e.originalEvent.key);
    if (e.originalEvent.key == 1) {
        downloadJson(drawnItems, "mydrawnItems.geojson");
    }
});
