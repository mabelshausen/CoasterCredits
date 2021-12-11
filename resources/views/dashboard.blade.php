<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coasters') }}
        </h2>
    </x-slot>

    <div>
        <table>
            <thead>
            <th>Name</th>
            <th>Park</th>
            <th>Material</th>
            <th>Type</th>
            <th>Rank</th>
            <th>Status</th>
            </thead>

            <tbody>
            @foreach($coasters as $coaster)
                <tr>
                    <td>{{$coaster->name}}</td>
                    <td>{{$coaster->park}}</td>
                    <td>{{$coaster->materialType}}</td>
                    <td>{{$coaster->seatingType}}</td>
                    <td>{{$coaster->rank}}</td>
                    <td>{{$coaster->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <a href="{{ route('dashboard', ['page' => 1]) }}">First</a>
            <a href="{{ route('dashboard', ['page' => ($currentPage > 1) ? $currentPage - 1 : 1]) }}">Previous</a>
            <a href="{{ route('dashboard', ['page' => ($currentPage < $lastPage) ? $currentPage + 1 : $lastPage ]) }}">Next</a>
            <a href="{{ route('dashboard', ['page' => $lastPage]) }}">Last</a>
        </div>
    </div>
</x-app-layout>
