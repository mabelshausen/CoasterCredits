<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $coaster->name }}
        </h2>
    </x-slot>

    <div>
        <div>
            <table>
                <tbody>
                <tr>
                    <td>Park</td>
                    <td>{{$coaster->park}}</td>
                </tr>
                <tr>
                    <td>Manufacturer</td>
                    <td>{{$coaster->manufacturer}}</td>
                </tr>
                <tr>
                    <td>Material</td>
                    <td>{{$coaster->materialType}}</td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td>{{$coaster->seatingType}}</td>
                </tr>
                <tr>
                    <td>Top Speed</td>
                    <td>{{$coaster->speed}} km/h</td>
                </tr>
                <tr>
                    <td>Height</td>
                    <td>{{$coaster->height}} m</td>
                </tr>
                <tr>
                    <td>Length</td>
                    <td>{{$coaster->length}} m</td>
                </tr>
                <tr>
                    <td>Inversions</td>
                    <td>{{$coaster->inversionsNumber}}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{$coaster->status}}</td>
                </tr>
                <tr>
                    <td>Rank</td>
                    <td>{{$coaster->rank}}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div>
            <img src="https://captaincoaster.com/images/coasters/{{$coaster->imagePath}}">
        </div>

        <div id="single-coaster-map" class="map"></div>
        <script>
            let park = @json($park);
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
        </script>
    </div>
</x-app-layout>

