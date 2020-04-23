<!--<div class="container">		-->
<div class="container">
<!-- section title -->
    <h2 class="section-title wow fadeIn">Mapa do Mundo</h2>
    <div class="spacer" data-height="60"></div>
    <div class="row" id='world-map-container'>
        <div class="col-md-12">
            <div id="regions_div"></div>
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
    //    var data = google.visualization.arrayToDataTable(mapsData);
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Country'); // Implicit domain label col.
        data.addColumn('number', 'Value'); // Implicit series 1 data col.
        data.addColumn({type:'string', role:'tooltip'}); //
    /*     data.addRows([
             [{v:"br",f:"Olympia"},1,"Casos ativos: 18313"],
             [{v:"ua",f:"Seattle"},8,"5000"]
         ]);*/

       data.addRows(mapsData);

        var options = {
            title: 'Casos ativos do coronavirus no mundo',
        //    colors: ['#e4c8c8', '#800000'],
             colorAxis: {
                 colors: ['#b46969','#af5f5f','#aa5555','#a54b4b','#a04141','#9b3737','#962d2d','#912323','#8c1919','#870f0f','#800000'],
                 minValue: 0,
                 maxValue: 10
             },
            backgroundColor: '#f9f9ff',
            // legend: 'none',
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
        chart.draw(data, options);
    }
</script>

