<?php
$today = date("Ymd");
$csv_dir = '/home/pi/';
$csv_file = $today.'.csv';
$grapgh = '';
 
if (($handle = fopen($csv_dir.$csv_file, "r")) !== false) {
while (($line = fgets($handle)) !== false) {
$grapgh .= '['.rtrim($line).'],'.PHP_EOL;
}
fclose($handle);
}else{
echo 'no data';
}
?>
<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['line']});
      // Draw the chart when Charts is loaded.
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        // Create the data table 
        var data = new google.visualization.DataTable();
data.addColumn('string', 'Time');
data.addColumn('number', 'Temperature');
data.addColumn('number', 'Pressure');
data.addColumn('number', 'Humidity');
data.addRows([

<?php echo $grapgh; ?>

    ]);

//Set options for the chart
var options = {title:'RasPi Weather',
                       width:600,
                       height:400,
		       series: {
			0: {axis:'Temp'},
			1: {axis:'Pressure'}
			}
		};

    var chart = new google.charts.Line(document.getElementById('chart_div'));
    chart.draw(data, google.charts.Line.convertOptions(options));
}
</script>

</head>
<body>
<div id="table_div"></div>
<div id="chart_div"></div>
</body>
</html>
