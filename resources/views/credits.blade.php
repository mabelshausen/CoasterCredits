<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Credits') }}
        </h2>
    </x-slot>

    <div>
        <table id="table">
            <thead>
            <th>Coaster</th>
            <th>Park</th>
            <th>Date</th>
            <th># Rides</th>
            <th></th>
            </thead>

            <tbody>
            @foreach($credits as $credit)
                <tr>
                    <td>{{ $coasters[$credit->id]->name }}</td>
                    <td>{{ $coasters[$credit->id]->park }}</td>
                    <td>{{ $credit->first_ride_date }}</td>
                    <td>{{ $credit->rides_count }}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
