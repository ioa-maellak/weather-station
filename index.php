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

<?php
include_once 'config.php';

//Connect to database.
$dbh = new PDO('mysql:dbname='.$dbname.';host='.$servername.';port='.$port, $username, $password);

//Send the query.
$sql = "SELECT `id`, `when`, GROUP_CONCAT(CONCAT(`key`, ':', `value`) ORDER BY `key` SEPARATOR ',') as val FROM `metrics` GROUP BY `id`, `when` ORDER BY `when` desc;";
$statement=$dbh->prepare($sql);
$statement->execute();

echo "<TABLE border='1'>";
//Get and display the results.
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
	$id = $row['id'];
	$when = $row['when'];
	$val = $row['val'];

	echo "<TR>";
	//echo "$id, $when, $key, $value <br>";
	echo "<TD>$id</TD>";
	echo "<TD>$when</TD>";
	echo "<TD>$val</TD>";
	echo "</TR>";
}
echo "</TABLE>";

//Close connection.
$dbh = null;
?>

</body>
</html>
