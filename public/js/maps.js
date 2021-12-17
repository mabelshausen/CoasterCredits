
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

    addMarker(map, coordinates);
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

    addMarkers(map, parks);
}

function addMarker(map, coordinates) {
    const marker = new ol.Feature({
        type: 'marker',
        geometry: new ol.geom.Point(ol.proj.fromLonLat(coordinates))
    });

    const markerVectors = new ol.source.Vector({
        features: [marker]
    });

    const markerStyle = new ol.style.Style({
        image: new ol.style.Icon({
            src: "../images/marker.png",
            anchor: [0.5, 1]
        })
    });

    const markerLayer = new ol.layer.Vector({
        source: markerVectors,
        style: markerStyle
    });

    map.addLayer(markerLayer);
}

function addMarkers(map, parks) {
    let markers = [];

    parks.forEach((park) => {
        const marker = new ol.Feature({
            type: 'marker',
            geometry: new ol.geom.Point(ol.proj.fromLonLat([park['longitude'], park['latitude']]))
        });
        markers.push(marker)
    });

    const markerVectors = new ol.source.Vector({
        features: markers
    });

    const markerStyle = new ol.style.Style({
        image: new ol.style.Icon({
            src: "../images/marker.png",
            anchor: [0.5, 1]
        })
    });

    const markerLayer = new ol.layer.Vector({
        source: markerVectors,
        style: markerStyle
    });

    map.addLayer(markerLayer);
}
