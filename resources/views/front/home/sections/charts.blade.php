<div class="container">

    <!-- section title -->
    <h2 class="section-title wow fadeInUp">Graficos</h2>

    <div class="spacer" data-height="60"></div>

    <!-- testimonials wrapper -->
    <div class="testimonials-wrapper">

        <!-- testimonial item -->
        <div class="testimonial-item text-center mx-auto">
            <canvas id="lineChart"></canvas>
        </div>

        <!-- testimonial item -->
        <div class="testimonial-item text-center mx-auto">
            <canvas id="pieChart"></canvas>
        </div>

        <!-- testimonial item -->
        <div class="testimonial-item text-center mx-auto">
            <canvas id="barChart"></canvas>
        </div>

        <!-- testimonial item -->
        <div class="testimonial-item text-center mx-auto">
            <canvas id="horizontalBar"></canvas>
        </div>
    </div>

</div>
<script>
    // var confirmed = {!! json_encode($form->about) !!};
    var chartData = {
        confirmed: {
            label: 'Confirmados',
            list: [1, 8, 32, 128, 512, 2024, 10510],
        },
        deaths: {
            label: 'Mortes',
            list: [0, 0, 2, 5, 21, 114, 500],
        },
        cured: {
            label: 'Curados',
            list: [0, 0, 3, 10, 40, 220, 1500],
        }
    };
</script>
<script type="text/javascript" src="{{ asset('components/mdb/js/mdb.js') }}"></script>
<script type="text/javascript">
    //linechart
    var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: chartData.confirmed.label,
                data: chartData.confirmed.list,
                backgroundColor: [
                    'rgba(0, 0, 0, 0)', //transparent
                ],
                borderColor: [
                    'rgba(255, 76, 96, .7)',
                ],
                borderWidth: 5
            }, {
                label: chartData.deaths.label,
                data: chartData.deaths.list,
                backgroundColor: [
                    'rgba(0, 0, 0, 0)', //transparent
                ],
                borderColor: [
                    'rgba(144, 0, 0, .7)',
                ],
                borderWidth: 5
            }, {
                label: chartData.cured.label,
                data: chartData.cured.list,
                backgroundColor: [
                    'rgba(0, 0, 0, 0)', //transparent
                ],
                borderColor: [
                    'rgba(0, 144, 0, .7)',
                ],
                borderWidth: 5
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

<script type="text/javascript">
    //piechart
    var ctxP = document.getElementById("pieChart").getContext('2d');
    var myPieChart = new Chart(ctxP, {
        type: 'pie',
        data: {
            labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
            datasets: [{
                data: [300, 50, 100, 40, 120],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

<script type="text/javascript">
    //barchart
    //bar
    var ctxB = document.getElementById("barChart").getContext('2d');
    var myBarChart = new Chart(ctxB, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script type="text/javascript">
    //horizontalbar
    new Chart(document.getElementById("horizontalBar"), {
        "type": "horizontalBar",
        "data": {
            "labels": ["Red", "Orange", "Yellow", "Green", "Blue", "Purple", "Grey"],
            "datasets": [{
                "label": "My First Dataset",
                "data": [22, 33, 55, 12, 86, 23, 14],
                "fill": false,
                "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
                    "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
                ],
                "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
                ],
                "borderWidth": 1
            }]
        },
        "options": {
            "scales": {
                "xAxes": [{
                    "ticks": {
                        "beginAtZero": true
                    }
                }]
            }
        }
    });
</script>