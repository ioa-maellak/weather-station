<!--
Authors:
Marios Balamatsias
Gerasimos Chamalis
Loykianos-Nikolaos Xaxiris
Anastasios Lisgaras
Vasileios Karavasilis
Tsiolkas Michalis
-->

<!doctype html>
<html lang="en">
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Weather Station</title>

	<link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>

    <body>
	<h2>
            a low cost weather station with AirPi -- check the code at
            <a href="https://github.com/ioa-maellak/weather-station"> github
            </a>
        </h2>
	<br>

<?php
include_once 'config.php';

//Connect to database.
$dbh = new PDO('mysql:dbname='.$dbname.';host='.$servername.';port='.$port, $username, $password);

//Send the query.
$sql = "SELECT `id`, `when`, GROUP_CONCAT(`value` SEPARATOR '<td>') as val " . 
       "FROM `metrics` GROUP BY `id`, `when` ORDER BY `when` desc;";

$statement=$dbh->prepare($sql);
$statement->execute();

echo "<TABLE class=simpletable>" .
     "<thead>" .
     "<TR>" . 
     "<th> Station </th>" .
     "<th> Time </TH>" . 
     "<TH> Carbon Monoxide </TH>" .
     "<TH> Humidity </TH>" . 
     "<TH> Light Level </TH>" . 
     "<TH> Pressure </TH>" . 
     "<TH colspan = 2> Temperature </TH>" .
     "<TH> Noise </TH>" .
     "</TR>" .
     "</thead>" .
     "<tbody>" ;

//Get and display the results.
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $when = $row['when'];
    $val = $row['val'];


    echo "<TR>";
    //echo "$id, $when, $key, $value <br>";
    echo "<TD>$id</TD>";
    echo "<TD>$when</TD>";
    echo "<TD>$val<TD>";
    echo "</TR>";
}
echo "</tbody>";
echo "</TABLE>";

//Close connection.
$dbh = null;
?>

</body>
</html>
