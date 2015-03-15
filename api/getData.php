<?php
	include_once 'config.php';
	$db_name = 'met';
	$db = 'metrics';	
	$db=mysql_connect($host, $username, $password) or die('Could not connect');
	mysql_select_db($db_name, $db) or die('');
	$lim = 7;
	$sql = "SELECT * FROM `metrics` LIMIT 0, 30 ";
	$result = mysql_query($sql) or die('Could not query');
	
	if(mysql_num_rows($result)){
    		echo '{"data":[';

    		$first = true;
    		$row=mysql_fetch_assoc($result);
    	while($row=mysql_fetch_row($result)){
        	//  cast results to specific data types

        	if($first) {
            		$first = false;
        	} else {
            		echo ',';
        	}
        	echo json_encode($row);
    	}	
    		echo ']}';
	} else {
    		echo '[]';
	}
	
	
	mysql_close($db);

>
