<?php
	require_once 'conf/database.php';
	
	header("Content-Disposition: attachment; filename=Booking.csv");
	header("Content-Type: text/csv"); 
	//$headers = array("Booking ID","Booking Date","Client","Origin","Destination","Shipment Receipt Date","BMO Date","BMI Date","Invoice","Delivery date");
	$headers = array("Booking Number","Booking Date","Client","Origin","Destination","Delivery date");
	$fp = fopen("php://output", 'w');
	fputcsv($fp, $headers, ',', '"');
			
	$f_date = isset($_REQUEST['f_date']) ? $_REQUEST['f_date'] : '';
	$t_date = isset($_REQUEST['t_date']) ? $_REQUEST['t_date'] : '';
	$f_date = date('Y-m-d', strtotime($f_date));
	$f_date = str_replace("1970-01-01", "", $f_date);
	$t_date = date('Y-m-d', strtotime($t_date));
	$t_date = str_replace("1970-01-01", "", $t_date);
	
	$condi = '';
	if($f_date != ''){
		$condi .= " AND LR_DATE >= '".$f_date."'";
	}	
	if($t_date != ''){
		$condi .= " AND LR_DATE <= '".$t_date."'";
	}
	
	//$sql = 	"select LR_NUMBER, LR_DATE, CONSR, (select name from city where ID = FROM_BRANCH) as FROM_BRANCH, (select name from city where ID = TO_BRANCH) as TO_BRANCH, SHIPMENT_REC_DATE, BMO_DATE, BMI_DATE, 'Invoice', EXP_DEL_DATE from lr where status = 'Active'";
	$sql = 	"select LR_NUMBER, LR_DATE, CONSR, (select name from city where ID = FROM_BRANCH) as FROM_BRANCH, (select name from city where ID = TO_BRANCH) as TO_BRANCH, EXP_DEL_DATE from lr where status = 'Active' ".$condi;
	//echo $sql;die;
	$result = sqlsrv_query($conn, $sql);
	$export_array = array();
	while($res = sqlsrv_fetch_array($result)){
		fputcsv($fp, $res, ',', '"');
	}
	fclose($fp);
	exit;
?>