<?php
/*
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
 */

include_once 'config.php';

//Connect to database.
$dbh = new PDO('mysql:dbname='.$dbname.';host='.$servername.';port='.$port, $username, $password);

//Check if user and password are correct.

if (isset($_GET["id"]) && isset($_GET["pass"]) && isset($_GET["when"])){
	$id=$_GET["id"];
	$pass=$_GET["pass"];
	$when=$_GET["when"];
	
	echo "$id, $pass, $wnen <br>";
	foreach($_GET as $key => $value){
		echo ">>>>$key, $value <br>";
		if($key<>"id" && $key<>"pass" && $key<>"when") {
			echo "$key, $value <br>";
			$stmt = $dbh->prepare("INSERT INTO metrics (id, when, key, value) VALUES (:id, :when, :key, :value)");
			$stmt->bindParam(':id', $id);
			$stmt->bindParam(':when', $when);
			$stmt->bindParam(':key', $key);
			$stmt->bindParam(':value', $value);
			$stmt->execute();
		}
	}
} else {
	echo "Error in id of pass <br>";
}

//Close connection.
$dbh = null;
?>
