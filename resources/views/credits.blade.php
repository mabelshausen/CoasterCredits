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

    <div>
        <canvas id="barchart" class="chart"></canvas>
    </div>
    <script>
        let credits = @json($credits);
        let data = {};

            _.map(credits, function(credit) {
           let date = new Date(credit['first_ride_date']);
           let key = moment(date.getFullYear(), 'YYYY');

           if (data[key] === undefined) {
               data[key] = 0;
           }

           data[key]++;
        });

        const ctx = document.querySelector('#barchart').getContext('2d');

        const configuration = {
            type: 'bar',
            data: {
                datasets: [
                    {
                        data: data,
                        backgroundColor: ['rgba(59, 130, 246, 0.5)'],
                        borderColor: ['rgba(59, 130, 246, 0.8)'],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Coaster Credits per Year"
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'year'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: "Credits"
                        },
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        };

        new Chart(ctx, configuration);
    </script>
</x-app-layout>
