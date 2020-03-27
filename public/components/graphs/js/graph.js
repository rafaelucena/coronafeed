// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

  // Create the data table.
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Cases');
  data.addColumn('number', 'People');
  data.addRows([
	['Confirmed', 33333],
	['Deaths', 1111],
	
	['Cured', 122]
  ]);

  // Set chart options
  var options = {'title':'Active Cases',
  				colors: ['#800000', '#aa0000', '#ff2a2a' , '#d40000' , '#ff4c60', '#d5d5d5'],
				 'width':600,
				 'height':300};

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}
