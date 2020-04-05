<div class="container">

    <!-- section title -->
    <h2 class="section-title wow fadeInUp">Gráficos</h2>

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
        dates: {
            label: 'Datas',
            list: {!! json_encode($form->charts->getDates()) !!}
        },
        confirmed: {
            label: 'Confirmados',
            list: {!! json_encode($form->charts->getConfirmed()) !!}
        },
        deaths: {
            label: 'Mortes',
            list: {!! json_encode($form->charts->getDeaths()) !!}
        },
        cured: {
            label: 'Curados',
            list: {!! json_encode($form->charts->getCured()) !!}
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
            labels: chartData.dates.list,
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
            labels: ["Confirmados", "Mortos", "Curados"],
            datasets: [{
                data: [9900, 448, 127],
                backgroundColor: ["#FF4C60", "#800000", "#80ff80"],
                hoverBackgroundColor: ["#ff8080", "#aa0000", "#aaffaa"]
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
            labels: ["Acre", "Alagoas", "Amapá", "Green", "Purple", "Orange", "Red1", "Blue1", "Yellow1", "Green1", "Purple1", "Orange1"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
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