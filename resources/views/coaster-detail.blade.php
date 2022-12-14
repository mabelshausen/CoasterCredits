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

        <div class="map-container">
            <div id="single-coaster-map" class="map"></div>
            <div id="fullscreen" class="material-icons">fullscreen</div>
            <div id="fullscreen_exit" class="material-icons invisible">fullscreen_exit</div>
        </div>
        <script>
            let park = @json($park);
            createParkMap(park);
        </script>
    </div>
</x-app-layout>

