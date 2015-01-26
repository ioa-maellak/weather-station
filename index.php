<!--
Authors:
Marios Balamatsias
Gerasimos Chamalis
Loykianos-Nikolaos Xaxiris
Anastasios Lisgaras
Vasileios Karavasilis

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
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

<section class='container'>
          <hgroup>
            <h1>Weather Station Project using Raspberry piS for Greek FOSS Unit of exelence</h1>
          </hgroup>


        <div class="row">
          <section class='col-xs-12 col-sm-6 col-md-6'>

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
