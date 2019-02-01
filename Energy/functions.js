function changeColorRedGreen(data)
 {
	 var today = new Date();
											
			// sprawdza czy istnieje pierwszy rekord, jesli nie
										//	to ustawia na czaerwony bez definiowania 'lastdate' itp
									if(data.wg[0] == 'undefined' || data.wg[0] == null)
									{
										console.log("data is undefined!!!");
										document.getElementById("collecting").style.background='#e50000';

									}
									else
									{
										var lastdate = data.wg[0].c[0].v;					
										var diff = today.getTime()/1000 - lastdate.getTime()/1000;
																			
										if(diff > '121') {										
											document.getElementById("collecting").style.background='#e50000';											
										}
										else{
											document.getElementById("collecting").style.background='#32CD32';
										}
									}
 }
 
 
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

   function changeColor(a,b) {
	   
	    document.getElementById('a_energy').style.color   = "#000000"; // forecolor		
		document.getElementById('a_voltage').style.color  = "#000000"; // forecolor
		document.getElementById('a_current').style.color  = "#000000"; // forecolor
		document.getElementById('a_freq').style.color     = "#000000"; // forecolor	
		document.getElementById('a_apperent').style.color = "#000000"; // forecolor	
		document.getElementById('a_active').style.color   = "#000000"; // forecolor	
	   
	   if(b.includes("Energy"))
	   {
		  document.getElementById('a_energy').style.color = "red"; // forecolor			   	   			
	   }
	   else if(b.includes("Voltage"))
	   {
		   document.getElementById('a_voltage').style.color = "red"; // forecolor
	   }
	   else if(b.includes("Current"))
	   {
		   document.getElementById('a_current').style.color = "red"; // forecolor
	   }
	    else if(b.includes("Frequency"))
	   {
		   document.getElementById('a_freq').style.color = "red"; // forecolor
	   }
	    else if(b.includes("Apperent"))
	   {
		   document.getElementById('a_apperent').style.color = "red"; // forecolor
	   }
	    else if(b.includes("Active"))
	   {
		   document.getElementById('a_active').style.color = "red"; // forecolor
	   }
		   
	   document.getElementById("column").innerHTML = b+a;
			   	 funkcja_ajax(a,'9');

        return false;
    }  
	
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
			var d5 = document.getElementById('a_apperent').style.color;
			var d6 = document.getElementById('a_active').style.color;

			if(d1 == 'red' )
			{
				parametr = 'Current';
				tekst = ' Current usage in A';				
				temp = '1';			
			}
					
			if(d2 == 'red' )
			{
				parametr = 'PowerConsumption';
				tekst = ' Energy Consumption in kWh';
				temp = '2';
			}
			if( d3 == 'red')
			{			
				parametr = 'Voltage';
				tekst = ' Voltage level in V';		
				temp = '3';
			}
			
			if( d4 == 'red')
			{
				parametr = 'Frequency';
				tekst = ' Frequency level in Hz';		
				temp = '4';
			}
			if( d5 == 'red')
			{
				parametr = 'Calk_moc_pozorna';
				tekst = ' Apperent power in W';
				temp = '5';
			}
			
			if( d6 == 'red')
			{
				parametr = 'Calk_moc_czynna';
				tekst = ' Active power in W';		
				temp = '6';
			}
				   
				   
			if(przedzial == 0 )
			{
				titlee = 'Energy consumption with all collected measurments';
				if(temp == 0)
				{
					titlee = 'Voltage level with all collected measurments';
				}
				else if(temp == 1)
				{
					titlee = 'Current level with all collected measurments';
				}
				else if(temp == 2)
				{
					titlee = 'Energy Consumptionwith all collected measurments';
				}
				else if(temp == 3)
				{
					titlee = 'Voltage usage with all collected measurments';
				}
				else if(temp == 4)
				{
					titlee = 'Frequency level with all collected measurments';
				}
				else if(temp == 5)
				{
					titlee = 'Apperent energy with all collected measurments';
				}
				else if(temp == 6)
				{
					titlee = 'Active energy with all collected measurments';
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
				else if(temp == 4)
				{
					titlee = 'Frequency level in last 30 days';
				}
				else if(temp == 5)
				{
					titlee = 'Apperent energy in last 30 days';
				}
				else if(temp == 6)
				{
					titlee = 'Active energy in last 30 days';
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
				else if(temp == 4)
				{
					titlee = 'Frequency level from the previous day';
				}
				else if(temp == 5)
				{
					titlee = 'Apperent energy from the previous day';
				}
				else if(temp == 6)
				{
					titlee = 'Active energy from the previous day';
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
					titlee = 'Energy Consumption in last 7 days';
				}
				else if(temp == 3)
				{
					titlee = 'Voltage usage in last 7 days';
				}
				else if(temp == 4)
				{
					titlee = 'Frequency level in last 7 days';
				}
				else if(temp == 5)
				{
					titlee = 'Apperent energy in last 7 days';
				}
				else if(temp == 6)
				{
					titlee = 'Active energy in last 7 days';
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
				else if(temp == 4)
				{
					titlee = 'todays Frequency level';
				}
				else if(temp == 5)
				{
					titlee = 'todays Apperent energy';
				}
				else if(temp == 6)
				{
					titlee = 'todays Active energy ';
				}
			}
				   		
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
											
									// trzeba pozniej sprawdzic czy to jest konieczne								
									var data = new google.visualization.DataTable(arr)
									{
										refreshInterval: 5
									};
									
									var dateFormatter = new google.visualization.DateFormat({pattern: 'dd-MM-YYY HH:mm'});
										dateFormatter.format(data, 0);
									
									
								    var options = {
									 explorer: {
									    actions: ['dragToZoom', 'rightClickToReset'],
										axis: 'horizontal',
										keepInBounds: false,
										maxZoomIn: 32.0
									},
									 title: titlee,
									 pointSize: 4,
									 legend:{position:'bottom'},
									 curveType: 'function',
									 chartArea:{width:'80%', height:'80%'},
									 hAxis: {
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


