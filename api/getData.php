<?php
	include_once 'config.php';
	
	$dbh = new PDO('mysql:dbname='.$dbname.';host='.$servername.';port='.$port, $username, $password);

	$db=mysql_connect($host, $username, $password) or die('Could not connect');
	mysql_select_db($db_name, $db) or die('');
	$lim = 7;
	$result = mysql_query("SELECT * FROM metrics ORDER BY `when` DESC, `key` ASC LIMIT $lim;") or die('Could not query');
	
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
