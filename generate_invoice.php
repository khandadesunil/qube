<?php
	require_once 'header.php';
	$invoice = isset($_REQUEST['invoice']) ? $_REQUEST['invoice'] : '';
	$inv_lrs = isset($_REQUEST['inv_lrs']) ? $_REQUEST['inv_lrs'] : '';
	
	$select_inv = "select max(invoice_id) as inv_num from lr";
	$result_inv = sqlsrv_query($conn, $select_inv);
	$row_inv_number = sqlsrv_fetch_array($result_inv);
	$inv_num = INTVAL(1001) + $row_inv_number['inv_num'];
	$inv_num = 'DLI/INV/'. $inv_num;
	
	if($invoice != ''){
		if(!empty($inv_lrs)){
			$email = $_REQUEST['email'];
			$lrids = '';
			foreach($inv_lrs as $lrs){$lrids .= $lrs.',';}
			$lrids = rtrim($lrids, ',');
			$dt = date('Y-m-d');
			$ins_inv = "insert into invoice (lr_ids, invoice_date) values ('".$lrids."', '".$dt."')";
			$res_inv = sqlsrv_query($conn, $ins_inv);
			//$last_inv_id = sqlsrv_insert_id();
			$last_inv_id = sqlsrv_get_field($ins_inv, 0);
			$selbmo = "select top 1 ID from invoice order by ID desc";
			$resbmo = sqlsrv_query($conn, $selbmo);
			$rowbmo = sqlsrv_fetch_array($resbmo);
			$last_inv_id = $rowbmo['ID'];
			$update_lr = "update lr set INVOICE = '".$inv_num."', INVOICE_ID = '".$last_inv_id."' where ID in (".$lrids.")";
			$res_lr = sqlsrv_query($conn, $update_lr);
			echo '<script>window.open("print_inv.php?inv_id='.$last_inv_id.'");</script>';
			$i = 0;
			$lids = explode(",", $lrids);
			foreach($email as $em){
				$get_details = "select * from lr where ID = ".$lids[$i];
				$res_details = sqlsrv_query($conn, $get_details);
				$row_details = sqlsrv_fetch_array($res_details);
				$LR_NUMBER = $row_details['LR_NUMBER'];
				$SHIPPER = $row_details['SHIPPER'];
				$NO_OF_PKGS = $row_details['NO_OF_PKGS'];
				$QUANTITY = $row_details['QUANTITY'];
				$FROM_BRANCH = $row_details['FROM_BRANCH'];
				$TO_BRANCH = $row_details['TO_BRANCH'];
				
				$sel_f_branch = "select * from city where ID = ".$FROM_BRANCH;
				$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
				$r_f_branch = sqlsrv_fetch_array($res_f_branch);
				$FROM_BRANCH = $r_f_branch['NAME'];
				
				$sel_t_branch = "select * from city where ID = ".$TO_BRANCH;
				$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
				$r_t_branch = sqlsrv_fetch_array($res_t_branch);
				$TO_BRANCH = $r_t_branch['NAME'];
				
				$to = $em;
				$subject = 'Your invoice is generated - Qube Services';
				$message = 'Dear Sir, <br /><br />';
				$message .= 'Your Invoice is generated for below shipment (s).<br />';
				$message .= '
						<table border="1" width="80%">
							<tr><td>Booking No.</td><td> : '.$LR_NUMBER.'</td></tr>
							<tr><td>Invoice No.</td><td> : '.$inv_num.'</td></tr>
							<tr><td>Shipper</td><td> : '.$SHIPPER.'</td></tr>
							<tr><td>No of Pkgs</td><td> : '.$NO_OF_PKGS.'</td></tr>
							<tr><td>Volume</td><td> : '.$QUANTITY.'</td></tr>
							<tr><td>Origin</td><td> : '.$FROM_BRANCH.'</td></tr>
							<tr><td>Destination</td><td> : '.$TO_BRANCH.'</td></tr>
						</table><br /><br />';
				$message .= 'Best Regards,<br />Qube Services<br />';			
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:Qube Services <admin@qubeservices.in>\r\n";
				$headers .= 'Cc:khandade.sunil@gmail.com'."\r\n";				
				//mail($to, $subject, $message, $headers);
				send_smtpEmail($to, $subject, $message);
				$i = $i + 1;
				$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Invoice Generated successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			}
				
			//header('Location: list_invoice.php');
		}else{
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Please select booking!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		}
	}
	
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<script>$(document).ready(function(){ $("#menu5").addClass(" active");});</script>
							<!--<form name="form_filter" action="" method="post">
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
							</form>-->
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Invoice List</h3>
									</div>
									<?php
										if (isset($_SESSION['alert_msg'])){echo $_SESSION['alert_msg']; unset($_SESSION['alert_msg']);}
									?>
									<div class="widget-content">
										<form name="form1" action="" method="post">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>Select</th>
													<th>Booking No.</th>
													<th>Booking Date</th>
													<th>Customer</th>
													<th>Shipper</th>
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
													//if($CUSTOMER != ''){
													//$sel_lr = "select * from lr where CONSR = '".$CUSTOMER."' and INVOICE = '' order by LR_DATE DESC";
													$sel_lr = "select lr.*, CONVERT(VARCHAR(10), lr.LR_DATE,105) as LR_DATE from lr where INVOICE = '' or INVOICE is null order by lr.LR_DATE DESC";
													//echo $sel_lr;
													//$res_lr = sqlsrv_query($conn, $sel_lr);
													$res_lr = sqlsrv_query($conn, $sel_lr, array(), array("Scrollable" => 'static'));
													$num_lr = sqlsrv_num_rows($res_lr);
													$i = 1;
													while($row_lr = sqlsrv_fetch_array($res_lr)){
														//print_r($row_lr);
														$ID = $row_lr['ID'];
														$LR_NUMBER = $row_lr['LR_NUMBER'];
														$LR_DATE = date("d-m-Y", strtotime($row_lr['LR_DATE']));
														$CONSR = $row_lr['CONSR'];
														$SHIPPER = $row_lr['SHIPPER'];
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
													<td><input type="checkbox" name="inv_lrs[]" value="<?=$ID?>"></td>
													<td><?=$LR_NUMBER?></td>
													<td><?=$LR_DATE?></td>
													<td><?=$CONSR?></td>
													<td><?=$SHIPPER?></td>
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
													//}
												?>
											</tbody>
										</table><center>
										<?php
											if($sess_user_type != 'READONLY' && $num_lr > 0){
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