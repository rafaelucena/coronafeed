
google.charts.load('current', {
    'packages':['geochart'],
    // Note: you will need to get a mapsApiKey for your project.
    // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
    'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
});
google.charts.setOnLoadCallback(drawRegionsMap);

function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable([
    ['Country', 'Number Of Cases'],
    ['Germany', 47278],
    ['United States', 85749],
    ['China', 81340],
    ['Brazil', 2988],
    ['Canada', 4043],
    ['France', 29155],
    ['Poland', 1244],
    ['Italy', 80589],
    ['Spain', 64059],
    ['Iran', 32332],
    ['Switzerland',11951],
    ['UK', 11658],
    ['RU', 1036]
    ]);

    var options = {
        
        title: 'World Map of Coronavirus Spread',
        colors: ['#ffd5d5', '#800000'],
        backgroundColor: '#f9f9ff'
        
    };

    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

    chart.draw(data, options);
}
