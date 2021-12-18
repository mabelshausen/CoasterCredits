<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Credit') }}
        </h2>
    </x-slot>

    <div>
        <form action="{{ route('save-credit', ['id' => $coaster_id]) }}" method="post">
            {{ csrf_field() }}

            <div>
                <label for="first_ride_date">First Ride Date</label>
                <input type="date" name="first_ride_date" value="{{$first_ride_date}}">
            </div>

            <div>
                <label for="rides_count">Number of Times Ridden</label>
                <input type="number" name="rides_count" value="{{$rides_count}}">
            </div>

            <div>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</x-app-layout>
