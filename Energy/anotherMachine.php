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
   function drawChart()
   {
	 document.getElementById('a_energy').style.color = "red";
    var data = new google.visualization.DataTable(
<?php
$connect = mysqli_connect("localhost", "root", "", "machines");

$query = 'SELECT PowerConsumption,
UNIX_TIMESTAMP(CONCAT_WS(" ", `Date`, `Time`)) AS datetime 
FROM bn25_pr2_1 where `Date` = current_date()
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
     title:'Energy consumption by BN25_1 PR2- current date',
	 pointSize: 4,
     legend:{position:'bottom'},
	 curveType: 'function',
     chartArea:{width:'80%', height:'80%'},
	 hAxis: {
		 format: 'hh-mm-ss',
		textStyle: {
			bold: true
		}
	 },
	 backgroundColor: { fill:'transparent'},
	 
	 vAxis:
	 {
		 textStyle: {
			bold: true
		 }
	 }

    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

    chart.draw(data, options);
	changeColorRedGreen(data);
   }  
  </script>
  
  
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script language="javascript">
        function funkcja_ajax(maszyna, przedzial) {
			
			var value_to_send = 2000;
			var Limit_danych = 50;
			var Ktora_maszyna = maszyna;
			var Przedzial_czasu = przedzial; // dni
			var titlee = 'Energy tralala';
			var parametr = 'PowerConsumption';
			var tekst = ' Energy Consumption in kWh';
				
					
			var temp = '1';
			// "#ff0000;
			var d1 = document.getElementById('a_current').style.color;
			var d2 = document.getElementById('a_energy').style.color;
			var d3 =  document.getElementById('a_voltage').style.color;
			var d4 = document.getElementById('a_freq').style.color;
			
			console.log(d1);
			console.log(d2);
			console.log(d3);
			console.log(d4);
			if(d1 == 'red' )
			{
				console.log("cur1231312321rent");
				parametr = 'Current';
				tekst = ' Current usage in A';
				
				temp = '1';
				
			}
					
			if(d2 == 'red' )
			{
				console.log("energy");
				parametr = 'PowerConsumption';
				tekst = ' Energy Consumption in kWh';
				temp = '2';
				
			}
			if( d3 == 'red')
			{
				
				console.log("Volts");
				parametr = 'Voltage';
				tekst = ' Voltage level in V';
				
				temp = '3';
			}
			
			if( d4 == 'red')
			{
				
				console.log("Freq");
				parametr = 'Frequency';
				tekst = ' Frequency level in Hz';
				
				temp = '4';
			}
				   
				   
			if(przedzial == 0 )
			{
				titlee = 'Energy consumption with all collected measurments';
				if(temp == 0)
				{
					titlee = 'Voltage level with all collected measurments';
				}
			}
			else if (przedzial == 30)
			{
				titlee = 'Energy consumption in last 30 days';
				if(temp == 0)
				{
					titlee = 'Voltage level in last 30 days';
				}
				else if(temp == 1)
				{
					titlee = 'Current level in last 30 days';
				}
				else if(temp == 2)
				{
					titlee = 'Energy Consumption in last 30 days';
				}
				else if(temp == 3)
				{
					titlee = 'Voltage usage in last 30 days';
				}
			}
			else if (przedzial == 1)
			{
				titlee = 'Energy consumtion from the previous day';
				if(temp == 0)
				{
					titlee = 'Voltage level from the previous day';
				}
				else if(temp == 1)
				{
					titlee = 'Current level from the previous day';
				}
				else if(temp == 2)
				{
					titlee = 'Energy Consumption from the previous day';
				}
				else if(temp == 3)
				{
					titlee = 'Voltage usage from the previous day';
				}
				
			}
			else if (przedzial == 7)
			{
				titlee = 'Energy conumption in last 7 days';
				if(temp == 0)
				{
					titlee = 'Voltage level in last 7 days';
				}
				else if(temp == 1)
				{
					titlee = 'Current level in last 7 days';
				}
				else if(temp == 2)
				{
					titlee = 'Energy Consumption from the previous day';
				}
				else if(temp == 3)
				{
					titlee = 'Voltage usage from the previous day';
				}
			}
			else if (przedzial == 9)
			{
				titlee = 'Todays power consumption';
				if(temp == 0)
				{
					titlee = 'todays voltage level';
				}
				else if(temp == 1)
				{
					titlee = 'todays Current level';
				}
				else if(temp == 2)
				{
					titlee = 'todays Energy Consumption';
				}
				else if(temp == 3)
				{
					titlee = 'todays Voltage usage';
				}
			}
				   

			
			console.log(Ktora_maszyna);
			console.log(Przedzial_czasu);
			console.log("duap" + parametr);

			
            $.ajax({
                type: "POST",   			// 	post i get dzialaja
                url: "databaseFetch.php" ,
                data:  {h: value_to_send,
						Limit: Limit_danych,
						Ktora: Ktora_maszyna,
						Przedzial: Przedzial_czasu,
						Wartosc: parametr,
						label: tekst
						},
                success : function(result) { 
				
									var arr=JSON.parse(result);
									
									var data = new google.visualization.DataTable(arr)
									{
									refreshInterval: 5

									};
								   var options = {
									 title: titlee,
									 pointSize: 4,
									 legend:{position:'bottom'},
									 curveType: 'function',
									 chartArea:{width:'80%', height:'80%'},
									 hAxis: {
										 format: 'hh-mm-ss',
										textStyle: {
											bold: true
										}
									 },
									 backgroundColor: { fill:'transparent'},
									 
									 vAxis:
									 {
										 textStyle: {
											bold: true
										 }
									 }

									};

									var chart = new google.visualization.LineChart(document.getElementById('line_chart'));
									chart.draw(data, options);
									changeColorRedGreen(data);


									
									
									
								
                }
            });
        }
    </script>
	
	


  
 </head>  
 <body>
 
 
 <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Machines</button>
  <div id="myDropdown" class="dropdown-content">
   <a href="http://192.168.90.123/Energy">BN25</a>
    <a href="#about">CO110</a>
    <a href="#contact">AVN10</a>
  </div>
</div>

 <div class="dropdown_2">
  <div id="myDropdown_2" class="dropdown-content_2">
	<button class="test2" id ="a_energy">Energy</button> 
	 <button class="test2"id ="a_voltage">Voltage</button> 
     <button class="test2"id ="a_current" >Current</button> 
	<button  class="test2" id ="a_freq">Freq</button> 
  </div>
</div>

<script>
    document.getElementById('a_energy').onclick = changeColor;   
    function changeColor() {
		  document.getElementById('a_energy').style.color = "red"; // forecolor
			
			 document.getElementById('a_voltage').style.color = "#000000 "; // forecolor
			  document.getElementById('a_current').style.color = "#000000 "; // forecolor
			   document.getElementById('a_freq').style.color = "#000000 "; // forecolor
			   
			   			document.getElementById("column").innerHTML = "Energy Consumption";

			   			   funkcja_ajax('bn25_pr2_1','9')

        return false;
    }   

</script>

<script>
    document.getElementById('a_voltage').onclick = changeColor;   
    function changeColor() {
		  document.getElementById('a_voltage').style.color = "red"; // forecolor
			
			 document.getElementById('a_energy').style.color = "#000000 "; // forecolor
			  document.getElementById('a_current').style.color = "#000000 "; // forecolor
			   document.getElementById('a_freq').style.color = "#000000 "; // forecolor
			   
			document.getElementById("column").innerHTML = "Voltage Usage";
			   
			   funkcja_ajax('bn25_pr2_1','9')
        return false;
    }   

</script>

<script>
    document.getElementById('a_current').onclick = changeColor;   
    function changeColor() {
		  document.getElementById('a_current').style.color = "red"; // forecolor
			
			 document.getElementById('a_energy').style.color = "#000000 "; // forecolor
			  document.getElementById('a_voltage').style.color = "#000000 "; // forecolor
			   document.getElementById('a_freq').style.color = "#000000 "; // forecolor
			   
			   			document.getElementById("column").innerHTML = "Current Usage";

			   
			   			   funkcja_ajax('bn25_pr2_1','9')

        return false;
    }   

</script>

<script>
    document.getElementById('a_freq').onclick = changeColor;   
    function changeColor() {
		  document.getElementById('a_freq').style.color = "red"; // forecolor
			
			 document.getElementById('a_energy').style.color = "#000000 "; // forecolor
			  document.getElementById('a_current').style.color = "#000000 "; // forecolor
			   document.getElementById('a_voltage').style.color = "#000000 "; // forecolor
			   
			   			document.getElementById("column").innerHTML = "Frequency level";

			   
			   			   funkcja_ajax('bn25_pr2','9')

        return false;
    }   

</script>

  <div id = "box" class = "page-wrapper">
  
  <div  class="row">
	 <div  id="column" class="column">
		Energy Consumption by BN25
	</div>
	<div class="column">
		<div id ="collecting" class="square">data collecting</div>
	</div>
  </div>
  
 
   <div  ng-app="autoRefreshApp" ng-controller="autoRefreshController"id="line_chart" style="width: 70%; height: 80%; margin-left:auto; margin-right:auto"></div>
   
				  
	<table>
		<tr>
			<td><button class="test" type ="button" onclick="funkcja_ajax('bn25_pr2_1','1')"> yesterdays</button> </td>
			<td> <button class="test" type ="button" onclick="funkcja_ajax('bn25_pr2_1','7')"> last week</button> </td>
			<td><button id ="dupa" class="test" type ="button" onclick="funkcja_ajax('bn25_pr2_1','30')"> last 1month</button> </td>
			<td> <button id = "click_button" class="test" type ="button" onclick="funkcja_ajax('bn25_pr2_1','0')"> ALL data</button> </td>
		</tr>
	
	</table>
				   
 </body>
</html>