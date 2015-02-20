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
/* //Send the query.
   $sql = ("SELECT `when`, GROUP_CONCAT(`value` SEPARATOR ' ') " .
   "as val FROM `metrics`" .
   "GROUP BY `id`, `when` ORDER BY `when` desc;"); */

$sql = "SELECT * FROM metrics ORDER BY `when` DESC, `key` ASC;";

$statement=$dbh->prepare($sql);
$statement->execute();

$sql = "SELECT unit FROM units;";

$units = $dbh->prepare ($sql);
$units->execute ();

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

$id = 'etepi';

while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $when = $row['when'];
    $val = $row['value'];

    $unit_row = $units->fetch (PDO::FETCH_ASSOC);
    $unit = $unit_row['unit'];
    
    if ($when != $prev_when) {
        echo "<TR>";
        echo "<TD>$id</TD>";
        echo "<TD>$when</TD>";
        $prev_when = $when;
    }
    
    echo "<TD>$val $unit</TD>";
}

echo "</tbody>";
echo "</TABLE>";

//Close connection.
$dbh = null;
?>

</body>
</html>
