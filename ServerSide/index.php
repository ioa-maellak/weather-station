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
define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));

$servername = "localhost";
$username = DB_USER;
$password = DB_PASS;
$dbname = weatherstation;



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT raspberrypi_id, temperature, humidity FROM weatherstationDB";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "RPid: " . $row["raspberrypi_id"]. "\nTemperature: " . $row["temperature"]. "\nHumidity: " . $row["humidity"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>



</body>
</html>
