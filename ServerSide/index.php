<!--
Authors:
Marios Balamatsias
Gerasimos Chamalis
Loykianos-Nikolaos Xaxiris
Anastasios Lisgaras
Vasileios Karavasilis
-->

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>RPi Weather Station Database</title>

  <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>

<h1>Weather Station Project using Raspberry piS for Greek FOSS Unit of exelence</h1>

<?php
include_once 'config.php';

//Connect to database.
$dbh = new PDO('mysql:dbname='.$dbname.';host='.$servername.';port='.$port, $username, $password);

//Send the query.
$sql = "SELECT * FROM metrics";
$statement=$dbh->prepare($sql);
$statement->execute();

//Get and display the results.
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
	$id = $row['id'];
	$when = $row['when'];
	$key = $row['key'];
	$value = $row['value'];

	echo "$id, $when, $key, $value <br>";
}

//Close connection.
$dbh = null;
?>

</body>
</html>
