<?php
	require_once 'conf/database.php';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	if($ID != ''){
		$delete = "delete from city where ID = ". $ID;
		$res_delete = sqlsrv_query($conn, $delete);
		if ($res_delete) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Record deleted successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not delete record!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		}
	}
?>