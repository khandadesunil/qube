<?php
	session_start();
	require_once 'header.php';
	
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
	
	$select_bmi = "select max(ID) as bmi_num from process";
	$result_bmi = sqlsrv_query($conn, $select_bmi);
	$row_bmi_number = sqlsrv_fetch_array($result_bmi);
	$bmi_num = INTVAL(1000) + $row_bmi_number['bmi_num'];
	$bmi_num = 'DLI/BMI/'. $bmi_num;
	
	if($action != ''){
		$BMI_NUMBER = $_REQUEST['BMI_NUMBER'];
		$BMI_DATE = date("Y-m-d", strtotime($_REQUEST['BMI_DATE']));
		$CREATED_BY = $_SESSION['user_name'];
		$bmi_ids = $_REQUEST['bmi_ids'];
		$bmo_num = $_REQUEST['bmo_num'];
		$bmo_dt = $_REQUEST['bmo_dt'];
		$bmiids = '';
		foreach($bmi_ids as $bmis){
			$bmiids .= $bmis.',';
		}
		$bmiids = rtrim($bmiids , ",");
		
		$bmo_num1 = '';
		foreach($bmo_num as $bmonum){
			$bmo_num1 .= $bmonum.',';
		}
		$bmo_num = rtrim($bmo_num1 , ",");
		
		$bmo_dt1 = '';
		foreach($bmo_dt as $bmodt){
			$bmo_dt1 .= date("Y-m-d", strtotime($bmodt)).',';
		}
		$bmo_dt = rtrim($bmo_dt1 , ",");
		
		if($bmiids != ''){
			$sql = "insert into process(BMI_NUMBER, BMO_NUMBER, BMI_DATE, BMO_DATE, LR_ID, STATUS, CREATED_BY) 
						values('".$BMI_NUMBER."', '".$bmo_num."', '".$BMI_DATE."',  '".$BMI_DATE."', '".$bmiids."', 'BMI', '".$CREATED_BY."')";
			//echo $sql;die;
			$res = sqlsrv_query($conn, $sql);
			if ($res) {
				$curr_date = date('Y-m-d');
				$update_lr = "update lr set STATUS = 'BMI', BMI_DATE = '".$curr_date."', BMI_BY = '".$CREATED_BY."' where ID in (".$bmiids.")";
				$res_update_lr = sqlsrv_query($conn, $update_lr);
				
				$sellr = "select * from lr where ID in (".$bmiids.")";
				$reslr = sqlsrv_query($conn, $sellr);
				while($rowlr = sqlsrv_fetch_array($reslr)){
					$LR_NUMBER = $rowlr['LR_NUMBER'];
					$SHIPPER = $rowlr['SHIPPER'];
					$NO_OF_PKGS = $rowlr['NO_OF_PKGS'];
					$QUANTITY = $rowlr['QUANTITY'];
					$QUANTITY = $rowlr['QUANTITY'];
					$em = $rowlr['CONSR_EMAIL'];
					$FROM_BRANCH = $rowlr['FROM_BRANCH'];
					$TO_BRANCH = $rowlr['TO_BRANCH'];
					
					$sel_f_branch = "select * from city where ID = ".$FROM_BRANCH;
					$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
					$r_f_branch = sqlsrv_fetch_array($res_f_branch);
					$FROM_BRANCH = $r_f_branch['NAME'];
					
					$sel_t_branch = "select * from city where ID = ".$TO_BRANCH;
					$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
					$r_t_branch = sqlsrv_fetch_array($res_t_branch);
					$TO_BRANCH = $r_t_branch['NAME'];
					
					$to = $em;
					$subject = 'Your shipment has reached - Qube Services';				
					$message = 'Dear Sir, <br /><br />';
					$message .= 'Your shipment is reached and ready for delivery. Your shipment details are as below.';
					$message .= '
								<table border="1" width="80%">
									<tr><td>Booking No.</td><td>'.$LR_NUMBER.'</td></tr>
									<tr><td>BMI No.</td><td>'.$BMI_NUMBER.'</td></tr>
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
				$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">BMI created successful!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				header("Location:list_bmi.php");
			} else {
				$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not create BMI!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			}
		}else{
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">There is no booking selected for BMI</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		}
	}
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<script>$(document).ready(function(){ $("#menu6").addClass(" active");});</script>
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>BMI List</h3>
									</div>
									<div class="widget-content">
										<form name="form1" action="" method="post">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>Select</th>
													<th>Booking Number</th>
													<th>BMO Number</th>
													<th>Booking Date</th>
													<th>Shipper</th>
													<th>From</th>
													<th>To</th>
													<th>Type</th>
													<th>Goods</th>
													<th>Size</th>
													<th>BMO By</th>
													<th>BMO Date</th>
													<!--<th>Status</th>-->
													<th>Email</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_process = "select LR_ID, BMO_NUMBER from process where STATUS = 'BMO'";
													$res_process = sqlsrv_query($conn, $sel_process);
													$lrids = '';
													while($row_process = sqlsrv_fetch_array($res_process)){
														$lrids .= $row_process['LR_ID'];
													}
													$lrids = rtrim($lrids, ',');
													$sel_lr = "select * from lr where STATUS = 'BMO'";
													//echo $sel_lr;
													$res_lr = sqlsrv_query($conn, $sel_lr);
													$i = 1;
													while($row_lr = sqlsrv_fetch_array($res_lr)){
														$ID = $row_lr['ID'];
														$LR_DATE = date("d-m-Y", strtotime($row_lr['LR_DATE']));
														$sel_process = "select LR_ID, BMO_NUMBER from process where STATUS = 'BMO'";
														$res_process = sqlsrv_query($conn, $sel_process);
														$lrids = '';
														$row_process = sqlsrv_fetch_array($res_process);															
														$BMO_NUMBER = $row_process['BMO_NUMBER'];
														
														$LR_NUMBER = $row_lr['LR_NUMBER'];
														$FROM_BRANCH = $row_lr['FROM_BRANCH'];
														$TO_BRANCH = $row_lr['TO_BRANCH'];
														$LR_TYPE = $row_lr['LR_TYPE'];
														$GOODS = $row_lr['GOODS'];
														$QUANTITY = $row_lr['QUANTITY'];
														$SHIPPER = $row_lr['SHIPPER'];
														$STATUS = $row_lr['STATUS'];
														$BMO_BY = $row_lr['BMO_BY'];
														$CONSR_EMAIL = $row_lr['CONSR_EMAIL'];
														$BMO_DATE = date("d-m-Y", strtotime($row_lr['BMO_DATE']));
														
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
													<td><input type="checkbox" name="bmi_ids[]" value="<?=$ID?>" checked></td>
													<td><?=$LR_NUMBER?></td>
													<td><?=$BMO_NUMBER?><input type="hidden" name="bmo_num[]" value="<?=$BMO_NUMBER?>"></td>
													<td><?=$LR_DATE?></td>
													<td><?=$SHIPPER?></td>
													<td><?=$f_br?></td>
													<td><?=$t_br?></td>
													<td><?=$LR_TYPE?></td>
													<td><?=$GOODS_NAME?></td>
													<td><?=$QUANTITY?></td>
													<td><?=$BMO_BY?></td>
													<td><?=$BMO_DATE?><input type="hidden" name="bmo_dt[]" value="<?=$BMO_DATE?>"></td>
													<!--<td><?=$STATUS?></td>-->
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
												?>
											</tbody>
										</table><center>
										BMI Number <input type="text" name="BMI_NUMBER" id="BMI_NUMBER" value="<?=$bmi_num?>" class="span2" readonly> &nbsp; &nbsp; 
										BMI Date <input type="text" name="BMI_DATE" id="BMI_DATE" value="<?=date('d-m-Y')?>" class="span2 tcal"> &nbsp; &nbsp; 
										<input type="submit" name="add" id="add" value="Create BMI" class="btn btn-primary"><br /><br />
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