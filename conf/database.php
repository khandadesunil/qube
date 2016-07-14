<?php
	error_reporting(5);
	ob_start();
	$a = session_id();
	if (!$a) {
		session_start();
	}
	$serverName = "database.qubeservices.in";
	$connectionInfo = array("Database" => "BetaApp-DB", "UID" => "Beta-App", "PWD" => "Qube@2015");
	$conn = sqlsrv_connect($serverName, $connectionInfo);
	/*if($conn){
		echo 'success';
	}else{
		echo 'Failed<br /><pre>';
		print_r(sqlsrv_errors());
	}*/
?>