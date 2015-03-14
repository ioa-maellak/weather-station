<?php
	include_once 'config.php';
	$dbh = new PDO('mysql:dbname='.$dbname.';host='.$servername.';port='.$port, $username, $password);

	/* //Send the query.
	   $sql = ("SELECT `when`, GROUP_CONCAT(`value` SEPARATOR ' ') " .
	   "as val FROM `metrics`" .
	   "GROUP BY `id`, `when` ORDER BY `when` desc;"); */

	$sql = "SELECT count(*) as val_num FROM units";
	$val_num = $dbh->prepare ($sql);
	$val_num->execute ();

	$res = $val_num->fetch (PDO::FETCH_ASSOC);
	$val_num = $res['val_num'];

	if (! $_GET['lim']) {
	    $lim = 7;
	} else {
	    $lim = $_GET['lim'];
	}


	$sql = "SELECT * FROM metrics ORDER BY `when` DESC, `key` ASC LIMIT $lim;";


	$statement=$dbh->prepare($sql);
	$statement->execute();

	$sql = "SELECT unit FROM units;";
	$units = $dbh->prepare ($sql);
	$units->execute ();
	echo units
		

>
