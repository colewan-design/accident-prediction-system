<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-2 gap-4">
                    <div class="chart-container">
                        <canvas id="chart2" width="400" height="400"></canvas>
                        <p class="chart-title">Average Accident Predictions & Total Accidents per Prediction</p>
                    </div>
                    <div class="chart-container">
                        <canvas id="chart1" width="400" height="400"></canvas>
                        <p class="chart-title">Total Cases Per Time</p>
                    </div>
                    <div class="chart-container">
                        <canvas id="chart3" width="400" height="400"></canvas>
                        <p class="chart-title">Total Accidents Per Direction</p>
                    </div>
                    <div class="chart-container">
                        <canvas id="chart4" width="400" height="400"></canvas>
                        <p class="chart-title">Total Accidents Per Location</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



<script>
 // Fetch data from the user_searches table using an AJAX request
$.ajax({
    url: '/user_searches',
    method: 'GET',
    success: function(response) {
        // Extract the relevant data from the response
        var data = response.data;

        // Group the data by created_at
        var groupedData = {};
        data.forEach(function(item) {
            var created_at = item.created_at;
            if (!groupedData[created_at]) {
                groupedData[created_at] = {
                    count: []
                };
            }
            groupedData[created_at].count.push(item.count);
        });

        // Calculate the total count for each group
        var totalCount = [];
        for (var created_at in groupedData) {
            var count = groupedData[created_at].count;
            var sumCount = count.reduce(function(a, b) {
                return a + b;
            });
            totalCount.push({
                created_at: created_at,
                count: sumCount
            });
        }

        // Format the data for use in the chart
        var chartData = {
            labels: totalCount.map(function(item) {
                return item.created_at;
            }),
            datasets: [{
                label: 'Total Searches Per Time',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: totalCount.map(function(item) {
                    return item.count;
                })
            }]
        };

        // Create the chart using the formatted data
        var ctx1 = document.getElementById('chart1').getContext('2d');
        var chart1 = new Chart(ctx1, {
            type: 'line',
            data: chartData,
            options: {}
        });
    },
    error: function(xhr) {
        console.log(xhr.responseText);
    }
});



// Fetch data from the predictions table using an AJAX request
$.ajax({
    url: '/predictions',
    method: 'GET',
    success: function(response) {
        // Extract the relevant data from the response
        var data = response.data;

        // Group the data by direction
        var groupedData = {};
        data.forEach(function(item) {
            var direction = item.direction;
            if (!groupedData[direction]) {
                groupedData[direction] = {
                    total_accidents: [],
                    accident_predictions: []
                };
            }
            groupedData[direction].total_accidents.push(item.total_accidents);
            groupedData[direction].accident_predictions.push(item.accident_prediction);
        });

        // Calculate the averages for each group
        var groupAverages = [];
        for (var direction in groupedData) {
            var totalAccidents = groupedData[direction].total_accidents;
            var accidentPredictions = groupedData[direction].accident_predictions;
            var avgTotalAccidents = totalAccidents.reduce(function(a, b) {
                return a + b;
            }) / totalAccidents.length;
            var avgAccidentPredictions = accidentPredictions.reduce(function(a, b) {
                return a + b;
            }) / accidentPredictions.length;
            groupAverages.push({
                direction: direction,
                avgTotalAccidents: avgTotalAccidents,
                avgAccidentPredictions: avgAccidentPredictions
            });
        }

        // Format the data for use in the chart
        var chartData = {
            labels: groupAverages.map(function(item) {
                return item.direction;
            }),
            datasets: [{
                label: 'Average Accident Predictions per Direction',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: groupAverages.map(function(item) {
                    return item.avgAccidentPredictions;
                })
            }, {
                label: 'Average Total Accidents per Direction',
                backgroundColor: 'rgb(54, 162, 235)',
                borderColor: 'rgb(54, 162, 235)',
                data: groupAverages.map(function(item) {
                    return item.avgTotalAccidents;
                })
            }]
        };

        // Create the chart using the formatted data
        var ctx2 = document.getElementById('chart2').getContext('2d');
        var chart2 = new Chart(ctx2, {
            type: 'bar',
            data: chartData,
            options: {}
        });
    },
    error: function(xhr) {
        console.log(xhr.responseText);
    }
});




// Fetch data from the predictions table using an AJAX request
$.ajax({
    url: '/predictions',
    method: 'GET',
    success: function(response) {
        // Extract the relevant data from the response
        var data = response.data;

        // Group the data by direction and sum the total accidents for each group
        var directionGroups = {};
        data.forEach(function(item) {
            var direction = item.direction;
            if (!directionGroups[direction]) {
                directionGroups[direction] = {
                    direction: direction,
                    total_accidents: 0
                };
            }
            directionGroups[direction].total_accidents += item.total_accidents;
        });

        // Convert the direction groups object to an array of values
        var directions = Object.values(directionGroups);

        // Calculate the average of the total accidents for all directions
        var avgTotalAccidents = directions.reduce(function(sum, item) {
            return sum + item.total_accidents;
        }, 0) / directions.length;

        // Format the data for use in the chart
        var chartData = {
            labels: directions.map(function(item) {
                return item.direction;
            }),
            datasets: [{
                label: 'Total Accidents per Direction',
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 
                                'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 
                                'rgb(255, 159, 64)', 'rgb(201, 203, 207)'],
                borderColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 
                            'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 
                            'rgb(255, 159, 64)', 'rgb(201, 203, 207)'],
                data: directions.map(function(item) {
                    return item.total_accidents;
                })
            }]


        };

        // Create the chart using the formatted data
        var ctx3 = document.getElementById('chart3').getContext('2d');
        var chart3 = new Chart(ctx3, {
            type: 'pie',
            data: chartData,
            options: {}
        });
    },
    error: function(xhr) {
        console.log(xhr.responseText);
    }
});


// Fetch data from the predictions table using an AJAX request
$.ajax({
    url: '/total_accidents_per_location',
    method: 'GET',
    success: function(response) {
        // Extract the relevant data from the response
        var data = response.data;

        // Format the data for use in the chart
        var chartData = {
            labels: data.map(function(item) {
                return item.location;
            }),
            datasets: [{
                label: 'Total Accidents per Location',
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 
                                'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 
                                'rgb(255, 159, 64)', 'rgb(201, 203, 207)'],
                borderColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 
                            'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 
                            'rgb(255, 159, 64)', 'rgb(201, 203, 207)'],
                data: data.map(function(item) {
                    return item.total_accidents;
                })
            }]


        };

        // Create the chart using the formatted data
        var ctx = document.getElementById('chart4').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {}
        });
    },
    error: function(xhr) {
        console.log(xhr.responseText);
    }
});


</script>