<!--<div class="container">		-->
<div class="container">
<!-- section title -->
    <h2 class="section-title wow fadeIn">Mapa do Mundo</h2>
    <div class="spacer" data-height="60"></div>
    <div class="row" id='world-map-container'>
        <div class="col-md-12">
            <div id="map-world"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var mapsData = {!! json_encode($form->maps->getWorld()) !!};
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
        // var data = google.visualization.arrayToDataTable(mapsData);
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Country'); // Implicit domain label col.
        data.addColumn('number', 'Value'); // Implicit series 1 data col.
        data.addColumn({type:'string', role:'tooltip'}); //
        data.addRows(mapsData);

        var options = {
            title: 'Casos ativos do coronavirus no mundo',
            colors: ['#dfbfbf', '#cf9f9f', '#c08080', 'b06060', '#a04040','#902020', '#800000'],
            backgroundColor: '#f9f9ff',
            legend: 'none',
        };

        var chart = new google.visualization.GeoChart(document.getElementById('map-world'));
        chart.draw(data, options);
    }
</script>

