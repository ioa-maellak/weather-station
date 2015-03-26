<?php
   /*
   Authors:
   Marios Balamatsias
   */
    include_once '../config.php';

    $db = mysql_connect($servername,$username,$password);

    if (!$db) {
        die('Could not connect to db: ' . mysql_error());
   }
 
    
mysql_select_db($dbname,$db);
echo "Conected and Selected DB";  
$sql = "SELECT * FROM `metrics` LIMIT 0, 30 ";    
 
$result = mysql_query($sql, $db);  
echo "query completed";
echo $result;

$json_response = array();
    
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $row_array['id'] = $row['id'];
        $row_array['when'] = $row['when'];
        $row_array['key'] = $row['key'];
        $row_array['value'] = $row['value'];
        
        array_push($json_response,$row_array);
    }
    echo json_encode($json_response);
    
    fclose($db);
 
?>
