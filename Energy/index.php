<html>
 <head>
 
 <link rel="stylesheet" href="style.css">
 
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="refresh" content="40" />
	
	 <script type="text/javascript" src="functions.js"></script>
 
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">
  
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);

   // funkcja rysujaca 'live', odpowiada za glowny wykres energi z aktualna data
   function drawChart()
   {
	 document.getElementById('a_energy').style.color = "red";
    var data = new google.visualization.DataTable(
<?php
$connect = mysqli_connect("localhost", "root", "", "machines");

$query = 'SELECT PowerConsumption,
UNIX_TIMESTAMP(CONCAT_WS(" ", `Date`, `Time`)) AS datetime 
FROM bn25_pr2 where `Date` = current_date()
ORDER BY `Date` DESC, `Time` DESC ';

$result = mysqli_query($connect, $query);
$rows = array();
$table = array();

$table['cols'] = array(
 array(
  'label' => 'Date Time', 
  'type' => 'datetime'
 ),
 array(
  'label' => 'Energy Consumption in kWh', 
  'type' => 'number'
 )
);


while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
$datetime = explode(".", $row["datetime"]);

 $sub_array[] =  array(
      "v" =>  'Date(' . $datetime[0] .  '000)'
	  
     );
 $sub_array[] =  array(
      "v" => $row["PowerConsumption"]
     );
 $rows[] =  array(
     "c" => $sub_array
    );
}
$table['rows'] = $rows;
$jsonTable = json_encode($table);

echo $jsonTable;

	?>);
	
	var dateFormatter = new google.visualization.DateFormat({pattern: 'HH:mm'});
	dateFormatter.format(data, 0);
	
    var options = {
		   explorer: {
      actions: ['dragToZoom', 'rightClickToReset'],
        axis: 'horizontal',
        keepInBounds: false,
        maxZoomIn: 32.0
    },
	  smoothLine: true,

     title:'Energy consumption by BN25 PR2- current date',
	 pointSize: 4,
     legend:{position:'bottom'},
	 curveType: 'function',
     chartArea:{width:'80%', height:'80%'},
	 hAxis: {
		 format: 'MM dd, yyyy hh-mm-ss',
		textStyle: {
			bold: true
		}
	 },
	 backgroundColor: { fill:'transparent'},
	 
	 vAxis:
	 {
		 textStyle: {
			bold: true
		 },
		pattern: '# (ms)'
	 }

    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

    chart.draw(data, options);
	changeColorRedGreen(data);
   }  
  </script>
  
 </head>  
 <body>
 
 
 <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Machines</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="anotherMachine.php">C01112</a>
    <a href="#about">CO110</a>
    <a href="#contact">AVN10</a>
  </div>
</div>

 <div class="dropdown_2">
  <div id="myDropdown_2" class="dropdown-content_2">
	<button  class="test2" id ="a_energy"  onclick="changeColor('bn25_pr2', 'Energy Consumption by ')">Energy</button> 
	<button  class="test2" id ="a_voltage" onclick="changeColor('bn25_pr2', 'Voltage level by ')">Voltage</button> 
    <button  class="test2" id ="a_current" onclick="changeColor('bn25_pr2', 'Current level by ')">Current</button> 
	<button  class="test2" id ="a_freq"    onclick="changeColor('bn25_pr2', 'Frequency level by ')">Freq</button> 
	<button  class="test2" id ="a_apperent"onclick="changeColor('bn25_pr2', 'Apperent power by ')">Apperent</button> 
	<button  class="test2" id ="a_active"  onclick="changeColor('bn25_pr2', 'Active power by ')">Active</button> 
  </div>
</div>

<script>
	document.addEventListener("load", function(){
    document.getElementById('a_energy').onclick = changeColor('bn25_pr2', 'Energy Consumption by ');
});
</script>


 <!--  sprawdzic czy nieuzytek -->
  <div id = "box" class = "page-wrapper">
  
  <div  class="row">
	<div  id="column" class="column">Energy Consumption by BN25</div>
	<div class="column">
		<div id ="collecting" class="square">data collecting</div>
	</div>
  </div>
  
 		<!--  div odpowiedzialny za glowna wizualizacje -->
   <div  ng-app="autoRefreshApp" ng-controller="autoRefreshController"id="line_chart" style="width: 70%; height: 80%; margin-left:auto; margin-right:auto"></div>
   
	<!-- 4 buttony odpowiedzialne za przedstawienie wykresow w zaleznosci od wybrnej daty -->
		  <!-- funckja_ajax('maszyna wzgledem ktorej bedzie tworzony sql', 'X') --> 	
		  <!-- 0 - kiedy zostanie wybrane, ma pokazuje wszystkie dotychczas zebrane dane -->
		  <!-- 30  kiedy zostanie wybrane, pokazuje zebrane dane z ostatnich 30 dni-->
		  <!-- 1  -kiedy zostanie wybrane, pokazuje zebrane z dnia poprzedniego(tylko)  -->
		  <!-- 7  -kiedy zostanie wybrane, pokazuje dane zebrane z ostatnich 7 dni(razem z dniem dzisiejszym) -->
		  <!-- 9 - kiedy zostanie wybrane, pokazuje dzisiejsza kolekcje, wraz z aktualnymi danymi  -->		  
	<table>
		<tr>
			<td><button class="test" type ="button" onclick="funkcja_ajax('bn25_pr2','1')"> yesterdays</button> </td>
			<td><button class="test" type ="button" onclick="funkcja_ajax('bn25_pr2','7')"> last week</button> </td>
			<td><button id ="dupa" class="test" type ="button" onclick="funkcja_ajax('bn25_pr2','30')"> last 1month</button> </td>
			<td><button id = "click_button" class="test" type ="button" onclick="funkcja_ajax('bn25_pr2','0')"> ALL data</button> </td>
		</tr>
	</table>
				   
 </body>
</html>