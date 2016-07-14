<?php
	require_once 'conf/database.php';
	$from_branch = isset($_REQUEST['from_branch']) ? $_REQUEST['from_branch'] : '';
	$to_branch = isset($_REQUEST['to_branch']) ? $_REQUEST['to_branch'] : '';
	$goods_id = isset($_REQUEST['goods_id']) ? $_REQUEST['goods_id'] : '';
	$quantity = isset($_REQUEST['quantity']) ? $_REQUEST['quantity'] : '';
	
	$sel_rate = "select * from rates where SRC = '".$from_branch."' and DEST = '".$to_branch."' and GOODS = '".$goods_id."'";
	//echo $sel_rate;
	$res_rate = sqlsrv_query($conn, $sel_rate);
	$row_rate = sqlsrv_fetch_array($res_rate);
	$MIN_RATE = $row_rate['MIN_RATE'];
	$RATE = $row_rate['RATE'];
	echo $MIN_RATE.'|'.$RATE.'|'.$quantity;
?>