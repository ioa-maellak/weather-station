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

	$sql = "SELECT count(*) as val_num FROM units";
	$val_num = $dbh->prepare ($sql);
	$val_num->execute ();

	$res = $val_num->fetch (PDO::FETCH_ASSOC);
	$val_num = $res['val_num'];

	if (! $_GET['lim']) {
	    $lim = 105;
	} else {
	    $lim = $_GET['lim'];
	}


	$sql = "SELECT * FROM metrics ORDER BY `when` DESC, `key` ASC LIMIT $lim;";


	$statement=$dbh->prepare($sql);
	$statement->execute();

	$sql = "SELECT unit FROM units;";
	$units = $dbh->prepare ($sql);
	$units->execute ();

	?>
	<table class=simpletable>
	    <thead> 
		<tr> 
		    <th> Station </th>
		    <th> Time </th>
		    <th> Carbon Monoxide </th>
		    <th> Humidity </th> 
		    <th> Light Level </th>
		    <th> Pressure </th>
		    <th colspan = 2> Temperature </th>
		    <th> Noise </th>
		</tr>
	    </thead>
	    <tbody>

		<?php
		//Get and display the results.

		$id = 'etepi';

		while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		    $when = $row['when'];
		    $val = $row['value'];

		    $unit_row = $units->fetch (PDO::FETCH_ASSOC);
		    $unit = $unit_row['unit'];
		    
		    if ($when != $prev_when) {
			echo "<tr>";
			echo "<td>$id</td>";
			echo "<td>$when</td>";
			$prev_when = $when;
		    }
		    
		    echo "<td>$val $unit</td>";
		}

		//Close connection.
		$dbh = null;


		print "</tbody>";
		print "</table>";
		print "<br>";
		print "<form method=GET action='loadmore.pl'>";
		print "<button type=submit name=lim value=$lim>";
		print "<img src=graphics/more.png>";
		print "</button>";
		print "</form>";
		
		print "</body>";
		print "</html>";

		?>
