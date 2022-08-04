<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Content Header (Page header) -->
<div class="container text-center">
    <div class="row mb-2 justify-content-center">
        <div class="mt-2">
            <div class="d-flex align-items-center pt-2 mt-2">
                <h2 class="text-center">{{mode}}</h2> 
                <img class="ml-4" src="/{{BASE_DIR}}/public/imgs/imagesPublic/growth.png" width="50px">
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

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
              'rgb(34, 143, 215)',
              'rgb(255, 205, 86)',
              'rgb(255, 1, 76)',
               'rgb(255, 159, 64)',
               'rgb(255, 205, 86)',
               'rgb(75, 192, 192)',
               'rgb(100, 180, 180)',
               'rgb(54, 162, 235)',
               'rgb(153, 102, 255)',
               'rgb(190, 80, 220)',
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