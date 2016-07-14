<?php
	require_once 'conf/database.php';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
	if($ID != ''){
		$update = "update lr set DELIVERY_DATE = '".date('Y-m-d')."', STATUS = 'Delivered' where ID = ". $ID;
		$res_update = sqlsrv_query($conn, $update);
		if($res_update){
			$sel_lr = "select * from lr where ID = ".$ID;
			$res_lr = sqlsrv_query($conn, $sel_lr);
			$row_lr = sqlsrv_fetch_array($res_lr);
			$LR_NUMBER = $row_lr['LR_NUMBER'];
			$SHIPPER = $row_lr['SHIPPER'];
			$NO_OF_PKGS = $row_lr['NO_OF_PKGS'];
			$QUANTITY = $row_lr['QUANTITY'];
			$FROM_BRANCH = $row_lr['FROM_BRANCH'];
			$TO_BRANCH = $row_lr['TO_BRANCH'];
			$CONSR = $row_lr['CONSR'];
			$CONSR_EMAIL = $row_lr['CONSR_EMAIL'];
			
			$sel_f_branch = "select * from city where ID = ".$FROM_BRANCH;
			$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
			$r_f_branch = sqlsrv_fetch_array($res_f_branch);
			$FROM_BRANCH = $r_f_branch['NAME'];
			
			$sel_t_branch = "select * from city where ID = ".$TO_BRANCH;
			$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
			$r_t_branch = sqlsrv_fetch_array($res_t_branch);
			$TO_BRANCH = $r_t_branch['NAME'];
					
			$to = $email;
			$subject = 'Delivery Confirmation - Qube Services';
			
			$message = 'Dear '.$CONSR.', <br /><br />';
			$message .= 'Your shipment with below details has been delivered on '. date('d-m-Y');
			$message .= '
						<table border="1" width="80%">
							<tr><td>Booking No.</td><td>'.$LR_NUMBER.'</td></tr>
							<tr><td>Shipper</td><td>'.$SHIPPER.'</td></tr>
							<tr><td>No of Pkgs</td><td>'.$NO_OF_PKGS.'</td></tr>
							<tr><td>Volume</td><td>'.$QUANTITY.'</td></tr>
							<tr><td>Origin</td><td>'.$FROM_BRANCH.'</td></tr>
							<tr><td>Destination</td><td>'.$TO_BRANCH.'</td></tr>
						</table><br /><br />';
			$message .= 'Best Regards,<br />For Qube Services Private Ltd.<br />';			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From:Qube Services <admin@admin.com>\r\n";
			$headers .= 'Cc:khandade.sunil@gmail.com'."\r\n";				
			$headers .= 'Bcc:confirmation_trucking@qubeservices.in'."\r\n";				
			mail($to, $subject, $message, $headers);
		}
	}
?>