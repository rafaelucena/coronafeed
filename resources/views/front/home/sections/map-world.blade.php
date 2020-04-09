<!--<div class="container">		-->
<div class="container">
<!-- section title -->
    <h2 class="section-title wow fadeIn">Mapa do Mundo</h2>
    <div class="spacer" data-height="60"></div>
    <div class="row" id='world-map-container'>
        <div id="regions_div" style="width: 900px; height: 500px;"></div>
    </div>
</div>

<script type="text/javascript">
    var mapsData = {!! json_encode($form->maps->getList()) !!};
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
    });
    google.charts.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable(mapsData);

        var options = {

            title: 'World Map of Coronavirus Spread',
            colors: ['#ffd5d5', '#800000'],
            backgroundColor: '#f9f9ff',
            legend: 'none',
            // legend: 'left',
            // title:'My Big Pie Chart',
            // is3D: true
            // width: 400,
            // height: 300

        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
    }
</script>

