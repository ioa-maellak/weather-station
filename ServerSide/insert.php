<?php
/*
Authors:
Marios Balamatsias

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


define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));

if (isset($_GET["rpiid"]) && isset($_GET["temp"]) && isset($_GET["hum"])){
	
	$servername = "localhost";
	$username = DB_USER;
	$password = DB_PASS;
	$dbname = weatherstation;

	$rpiid=$_GET["rpiid"];
	$temp=$_GET["temp"];
	$hum=$_GET["hum"];

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	} 


	$sql = "INSERT INTO  weatherstationDB (raspberrypi_id, temperature, humidity)
        VALUES ($rpiid, $temp, $hum)";
	

	if ($conn->query($sql) === TRUE) {
    		//echo "New record created successfully";
	} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}
?>
