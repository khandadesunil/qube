<?php
	require_once 'header.php';
	$invoice_id = isset($_REQUEST['invoice_id']) ? $_REQUEST['invoice_id'] : '';
	$invoice = isset($_REQUEST['invoice']) ? $_REQUEST['invoice'] : '';
	$CUSTOMER = isset($_REQUEST['CUSTOMER']) ? $_REQUEST['CUSTOMER'] : '';
	$inv_lrs = isset($_REQUEST['inv_lrs']) ? $_REQUEST['inv_lrs'] : '';
	
	$select_inv = "select max(invoice_id) as inv_num from lr";
	$result_inv = sqlsrv_query($conn, $select_inv);
	$row_inv_number = sqlsrv_fetch_array($result_inv);
	$inv_num = INTVAL(1000) + 1 + $row_inv_number['inv_num'];
	$inv_num = 'DLI/INV/'. $inv_num;
	
	//if($invoice != ''){
		if(!empty($inv_lrs)){
			$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
			$lrids = '';
			foreach($inv_lrs as $lrs){
				$lrids .= $lrs.',';
			}
			$lrids = rtrim($lrids, ',');
			$ins_inv = "update invoice lr_ids = '".$lrids."' where invoice_id = ".$invoice_id;
			$res_inv = sqlsrv_query($conn, $ins_inv);
			
			$update_lr = "update lr set INVOICE = '".$inv_num."', INVOICE_ID = '".$last_inv_id."' where ID in (".$lrids.")";
			$res_lr = sqlsrv_query($conn, $update_lr);
			if($res_lr){
				$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Invoice updated successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				header("Location:list_invoice.php");
			}
			foreach($email as $em){
				$to = $em;
				$subject = 'Qube Services - Booking Confirmation';				
				$message = 'Dear Sir, <br /><br />';
				$message .= 'Invoice is generated!<br />';
				$message .= 'Best Regards,<br />Qube Services<br />';			
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:Qube Services <admin@admin.com>\r\n";
				$headers .= 'Cc:khandade.sunil@gmail.com'."\r\n";	
				$headers .= 'Bcc:confirmation_trucking@qubeservices.in'."\r\n";				
				mail($to, $subject, $message, $headers);
			}
				
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Invoice Generated successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			//header('Location: list_invoice.php');
		}else{
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Please select booking!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		}
	//}
	
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<script>$(document).ready(function(){ $("#menu5").addClass(" active");});</script>
							<form name="form_filter" action="" method="post">
								Customer 
								<select class="select span2 " id="CUSTOMER" name="CUSTOMER">
									<option selected="" value="">Select</option>
									<?php
										$sel_f_branch = "select * from customer order by CONSIGN_NAME";
										$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
										while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
											$C_ID = $r_f_branch['ID'];
											$CONSIGN_NAME = $r_f_branch['CONSIGN_NAME'];
											$sel = '';
											if($CUSTOMER == $CONSIGN_NAME)
												$sel = 'selected';
									?>
									<option value="<?=$CONSIGN_NAME?>" <?=$sel?>><?=$CONSIGN_NAME?></option>
									<?php
										}
									?>
								</select> &nbsp; &nbsp; 
								<input type="submit" name="show" id="show" value="Show Booking" class="btn btn-primary">
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Edit Invoice List</h3>
									</div>
									<div class="widget-content">
										<form name="form1" action="" method="post">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>Select</th>
													<th>Booking No.</th>
													<th>Booking Date</th>
													<th>Costomer</th>
													<th>Origin</th>
													<th>Destination</th>
													<th>No. of Packages</th>
													<th>Amount</th>
													<th>Email</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$num_lr = '';
													if($CUSTOMER != ''){
													$sel_lr = "select * from lr where CONSR = '".$CUSTOMER."' and INVOICE = '' order by LR_DATE DESC";
													//echo $sel_lr;
													$res_lr = sqlsrv_query($conn, $sel_lr);
													$num_lr = mysql_num_rows($res_lr);
													$i = 1;
													while($row_lr = sqlsrv_fetch_array($res_lr)){
														$ID = $row_lr['ID'];
														$LR_NUMBER = $row_lr['LR_NUMBER'];
														$LR_DATE = date("d-m-Y", strtotime($row_lr['LR_DATE']));
														$CONSR = $row_lr['CONSR'];
														$CONSR_EMAIL = $row_lr['CONSR_EMAIL'];
														$FROM_BRANCH = $row_lr['FROM_BRANCH'];
														$TO_BRANCH = $row_lr['TO_BRANCH'];
														$QUANTITY = $row_lr['QUANTITY'];
														$TOTAL = $row_lr['TOTAL'];
														$GOODS = $row_lr['GOODS'];
														$STATUS = $row_lr['STATUS'];
														$CREATED_DATE = $row_lr['CREATED_DATE'];
														
														$sel_f_branch = "select * from city where ID = " . $FROM_BRANCH;
														$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
														$row_f_br = sqlsrv_fetch_array($res_f_branch);
														$f_br = $row_f_br['NAME'];
														
														$sel_t_branch = "select * from city where ID = " . $TO_BRANCH;
														$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
														$row_t_br = sqlsrv_fetch_array($res_t_branch);
														$t_br = $row_t_br['NAME'];
														
														$sel_goods = "select * from goods where ID = ".$GOODS;
														$res_goods = sqlsrv_query($conn, $sel_goods);
														$row_goods = sqlsrv_fetch_array($res_goods);
														$GOODS_NAME = $row_goods['NAME'];
												?>
												<tr>
													<td><input type="checkbox" name="inv_lrs[]" value="<?=$ID?>" checked></td>
													<td><?=$LR_NUMBER?></td>
													<td><?=$LR_DATE?></td>
													<td><?=$CONSR?></td>
													<td><?=$f_br?></td>
													<td><?=$t_br?></td>
													<td><?=$QUANTITY?></td>
													<td><?=$TOTAL?></td>
													<td>
														<select name="email[]" class="span3">
															<option value="">No email is being sent</option>
															<option value="<?=$CONSR_EMAIL?>"><?=$CONSR_EMAIL?></option>
														</select>
													</td>
												</tr>
												<?php
													$i = $i + 1;
													}
													}
												?>
											</tbody>
										</table><center>
										<?php
											if($CUSTOMER != '' && $sess_user_type != 'READONLY' && $num_lr > 0){
										?>
										<input type="text" name="INVOICE" id="INVOICE" value="<?=$inv_num?>" readonly> &nbsp; &nbsp;
										<input type="submit" name="invoice" id="invoice" value="Generate Invoice" class="btn btn-primary"><br /><br />
										<?php
											}
										?>
										</form>
									</div>	
								</div>	
							</div>	
						</div>	
					</div>	
				</div>	
			</div>	
		</div>	
	</div>	
</div>	
<?php
require_once 'footer.php';
?>
<script type="text/javascript" >
	function delete_data(id){
		var r=confirm("Are you sure you want to delete!");
		if (r==true){
			$.ajax({
				url: 'delete_lr.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>