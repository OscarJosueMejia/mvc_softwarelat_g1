<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<h2 class="text-center mt-5">{{mode}}</h2>
<div id="chartContainer" style="margin-top: 20px !important;" class="m-auto">
    <canvas id="myChart"></canvas>
</div>

<script>
    var labels;
    var data;
    var config;
    if("{{mode}}" === "Licencias más vendidas"){
        labels =  {{labels}};
        data = {
            labels: labels,
            datasets: [{
                data: {{data}},
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ]
            }]
        };

        config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            },
        };
        $("#chartContainer").addClass("w-75");
    }
    else{
        data = {
          labels: {{labels}},
          datasets: [{
            label: '',
            data: {{data}} ,
            backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(54, 162, 235)',
              'rgb(255, 205, 86)',
               'rgb(255, 159, 64)',
               'rgb(255, 205, 86)',
               'rgb(75, 192, 192)',
               'rgb(54, 162, 235)',
               'rgb(153, 102, 255)',
               'rgb(201, 203, 207)'
            ],
            hoverOffset: 4
          }]
        };
        config = {
          type: 'doughnut',
          data: data,
        };
        $("#chartContainer").addClass("w-45");
    }
    
</script>

<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>