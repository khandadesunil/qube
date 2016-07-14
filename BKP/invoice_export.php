<?php
	require_once 'conf/database.php';
	
	header("Content-Disposition: attachment; filename=Invoice.csv");
	header("Content-Type: text/csv"); 
	$headers = array("Invoice Number", "Invoice Date", "Booking Number","Booking Date","Consignor","Shipper", "Origin","Destination","Goods", "No. of Pkgs", "Volume", "Invoie Amount");
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
		$condi .= " AND invoice.invoice_date >= '".$f_date." 00:00:00'";
	}	
	if($t_date != ''){
		$condi .= " AND invoice.invoice_date <= '".$t_date." 23:59:59'";
	}
	
	$sql = 	"select lr.INVOICE, invoice.invoice_date, lr.LR_NUMBER, lr.LR_DATE, lr.CONSR, lr.shipper, (select name from city where ID = lr.FROM_BRANCH) as FROM_BRANCH, 
			(select name from city where ID = lr.TO_BRANCH) as TO_BRANCH, (select NAME from goods where ID = GOODS) as GOODS,
			lr.NO_OF_PKGS, lr.QUANTITY, lr.TOTAL from lr, invoice where lr.INVOICE_ID = invoice.invoice_id and lr.INVOICE != '' ".$condi;
	//echo $sql;die;
	$result = sqlsrv_query($conn, $sql);
	$export_array = array();
	while($res = sqlsrv_fetch_array($result)){
		fputcsv($fp, $res, ',', '"');
	}
	fclose($fp);
	exit;
?>