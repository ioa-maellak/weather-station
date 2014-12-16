<?php
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
