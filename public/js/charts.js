
const creditChartOptions = {
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
};

function createCreditChart(credits) {
    let data = formatCreditsData(credits);
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
        options: creditChartOptions
    };

    new Chart(ctx, configuration);
}

function formatCreditsData(credits) {
    let data = {};

    _.map(credits, function(credit) {
        let date = new Date(credit['first_ride_date']);
        let key = moment(date.getFullYear(), 'YYYY');

        if (data[key] === undefined) {
            data[key] = 0;
        }

        data[key]++;
    });

    return data;
}
