
<?php

$limit = $_POST['h'];
$Ktora = $_POST['Ktora'];
$Przedzial = $_POST['Przedzial'];
$Parametr = $_POST['Wartosc'];
$label = $_POST['label'];


$connect = mysqli_connect("localhost", "root", "", "machines");

if (!$connect)
{
    die('Could not connect: ' . mysqli_error());
} 
//4 buttony odpowiedzialne za przedstawienie wykresow w zaleznosci od wybrnej daty -->
//funckja_ajax('maszyna wzgledem ktorej bedzie tworzony sql', 'X') --> 	

//0 - kiedy zostanie wybrane, ma pokazuje wszystkie dotychczas zebrane dane -->
//30 -kiedy zostanie wybrane, pokazuje zebrane dane z ostatnich 30 dni-->
//1  -kiedy zostanie wybrane, pokazuje zebrane z dnia poprzedniego(tylko)  -->
//7  -kiedy zostanie wybrane, pokazuje dane zebrane z ostatnich 7 dni(razem z dniem dzisiejszym) -->
//9 - kiedy zostanie wybrane, pokazuje dzisiejsza kolekcje, wraz z aktualnymi danymi  -->		

if($Przedzial!=0 && $Przedzial!=9 && $Przedzial!=1) {
$query = 'SELECT '.$Parametr.',
UNIX_TIMESTAMP(CONCAT_WS(" ", `Date`, `Time`)) AS datetime 
FROM '.$Ktora.' where `Date` >= DATE_SUB(CURDATE(),INTERVAL '.$Przedzial.' DAY)
ORDER BY `Date` DESC, `Time` DESC limit '.$limit.'';
}
else if($Przedzial ==0 )
{
	$query = 'SELECT '.$Parametr.',
UNIX_TIMESTAMP(CONCAT_WS(" ", `Date`, `Time`)) AS datetime 
FROM '.$Ktora.' 
ORDER BY `Date` DESC, `Time` DESC';
}
else if($Przedzial == 9){
	$query = 'SELECT '.$Parametr.',
UNIX_TIMESTAMP(CONCAT_WS(" ", `Date`, `Time`)) AS datetime 
FROM '.$Ktora.' where `Date` = current_date()
ORDER BY `Date` DESC, `Time` DESC ';


}
else if($Przedzial ==1 )
{
	$query = 'SELECT '.$Parametr.',
UNIX_TIMESTAMP(CONCAT_WS(" ", `Date`, `Time`)) AS datetime 
FROM '.$Ktora.' where `Date` = current_date()-1
ORDER BY `Date` DESC, `Time` DESC ';

	// sprawdza czy qwerenda jest pusta, ma to miejsce na przelomie miesiaca
	// przypadek wyluskania danych np 31.01 kiedy aktualna data to 1.02
	if ($query==0) { 

		$query = 'SELECT '.$Parametr.',
		UNIX_TIMESTAMP(CONCAT_WS(" ", `Date`, `Time`)) AS datetime 
		FROM '.$Ktora.' where `Date` = LAST_DAY(NOW() - interval 1 MONTH)
		ORDER BY `Date` DESC, `Time` DESC ';
	}


}
 



$result = mysqli_query($connect, $query);
$rows = array();
$table = array();

$table['cols'] = array(
 array(
  'label' => 'Date Time', 
  'type' => 'datetime'
 ),
 array(
  'label' => $label, 
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
      "v" => $row[$Parametr]
     );
 $rows[] =  array(
     "c" => $sub_array
    );
}
$table['rows'] = $rows;
$jsonTable = json_encode($table);

echo $jsonTable;
?>







