<html>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  
    <script language="javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(cancelClicked);
        function cancelClicked() {
			
			var value_to_send = 20;
			
            // function below will run clear.php?h=michael
            $.ajax({
                type: "POST",   			// 	post i get dzialaja
                url: "databaseFetch.php" ,
				//dataType: "json"  ,			// json nie dziala 'json'
                data:  {h: value_to_send},
                success : function(result) { 
				
									var arr=JSON.parse(result);
									
									var data = new google.visualization.DataTable(arr);
									var options = {
									 title:'',
									 pointSize: 1,
									 legend:{position:'bottom'},
									 chartArea:{width: '50%', height:'85%'},
									 backgroundColor: { fill:'transparent'}

									};

									var chart = new google.visualization.LineChart(document.getElementById('line_chart'));
									chart.draw(data, options);
									
										// function below reloads current page
									   // location.reload();
				
				

                }
            });
        }
    </script>
	
</head>
<body>


<button onclick="cancelClicked()">Stop Toggling</button>



</body>
</html>