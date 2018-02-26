<?php
$today = date("Ymd");
$csv_dir = '/home/jdo/';
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
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["table"]});
    google.setOnLoadCallback(drawTable);

    function drawTable() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Time');
    data.addColumn('number', 'Temperature');
    data.addColumn('number', 'Pressure');
    data.addColumn('number', 'Humidity');
    data.addRows([
	
<?php echo $grapgh; ?>

    ]);

    var table = new google.visualization.Table(document.getElementById('table_div'));
    table.draw(data, {showRowNumber: true});
}
</script>

</head>
<body>
<div id="table_div"></div>
</body>
</html>
