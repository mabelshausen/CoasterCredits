
function createParkMap(park) {
    let coordinates = [park['longitude'], park['latitude']];

    const map = new ol.Map({
        target: 'single-coaster-map',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat(coordinates),
            zoom: 10
        })
    });

    addMarkers(map, createMarkerFromCoordinates(coordinates), "../images/marker.png");
}

function createParksMap(parks) {
    let coordinates = [parks[0]['longitude'], parks[0]['latitude']];

    const map = new ol.Map({
       target: 'all-parks-map',
       layers: [
           new ol.layer.Tile({
               source: new ol.source.OSM()
           })
       ],
       view: new ol.View({
           center: ol.proj.fromLonLat(coordinates),
           zoom: 9
       })
    });

    addMarkers(map, createMarkersFromParks(parks), "../images/marker.png");
    addHomeMarker(map);
}

function addMarkers(map, markers, markerImage) {
    const markerVectors = new ol.source.Vector({
        features: markers
    });

    const markerStyle = new ol.style.Style({
        image: new ol.style.Icon({
            src: markerImage,
            anchor: [0.5, 1]
        })
    });

    const markerLayer = new ol.layer.Vector({
        source: markerVectors,
        style: markerStyle
    });

    map.addLayer(markerLayer);
}

function createMarkerFromCoordinates(coordinates) {
    const marker = new ol.Feature({
        type: 'marker',
        geometry: new ol.geom.Point(ol.proj.fromLonLat(coordinates))
    });

    return [marker];
}

function createMarkersFromParks(parks) {
    let markers = [];

    parks.forEach((park) => {
        const marker = new ol.Feature({
            type: 'marker',
            geometry: new ol.geom.Point(ol.proj.fromLonLat([park['longitude'], park['latitude']]))
        });
        markers.push(marker)
    });

    return markers;
}

function addHomeMarker(map) {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition((pos) => {
            addMarkers(map,
                createMarkerFromCoordinates([pos.coords.longitude, pos.coords.latitude]),
                "../images/home-marker.png"
            );
        });
    }
}
