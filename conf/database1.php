<?php
	error_reporting(5);
	ob_start();
	$a = session_id();
	if (!$a) {
		session_start();
	}
	$hostname = 'database.qubeservices.in';
	$db_user = 'Beta-App';
	$db_pass = 'Qube@2015';
	$db = 'Beta-App-db';
	
	$connection = sqlsrv_connect($hostname, $db_user, $db_pass) or die ("Could not connect to server ... \n" . mysql_error ());
	sqlsrv_select_db($db) or die ("Could not connect to database ... \n" . mysql_error ());
?>