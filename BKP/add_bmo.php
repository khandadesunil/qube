<?php
	require_once 'header.php';
		
	$msg = '';
	$bmo = isset($_REQUEST['bmo']) ? $_REQUEST['bmo'] : '';
	
	$select_bmo = "select max(ID) as bmo_num from process";
	$result_bmo = sqlsrv_query($conn, $select_bmo);
	$row_bmo_number = sqlsrv_fetch_array($result_bmo);
	$bmo_num = INTVAL(1000) + $row_bmo_number['bmo_num'];
	$bmo_num = 'DLI/BMO/'. $bmo_num;
	
	
	$FROM_BRANCH = isset($_REQUEST['FROM_BRANCH']) ? $_REQUEST['FROM_BRANCH'] : '';
	$TO_BRANCH = isset($_REQUEST['TO_BRANCH']) ? $_REQUEST['TO_BRANCH'] : '';
	$TYPE = isset($_REQUEST['TYPE']) ? $_REQUEST['TYPE'] : '';
	$ROUTE = isset($_REQUEST['ROUTE']) ? $_REQUEST['ROUTE'] : '';
	$curr_date = date('d-m-Y');
	$exp_del_date = date('d-m-Y', strtotime(date('d-m-Y'). ' + 4 days'));
	$sel_f_branch = "select * from city where ID = '".$FROM_BRANCH."'";
	$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
	$row_f_branch = sqlsrv_fetch_array($res_f_branch);
	$F_NAME = $row_f_branch['NAME'];
	
	$sel_t_branch = "select * from city where ID = '".$TO_BRANCH."'";
	$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
	$row_t_branch = sqlsrv_fetch_array($res_t_branch);
	$T_NAME = $row_t_branch['NAME'];
	
	if($bmo != ''){
		$DRIVER_NAME = $_REQUEST['DRIVER_NAME'];
		$VEHICLE = $_REQUEST['VEHICLE'];
		$BMO_NUMBER = $_REQUEST['BMO_NUMBER'];
		$BMO_DATE = date("Y-m-d", strtotime($_REQUEST['BMO_DATE']));
		$ETA = date("Y-m-d", strtotime($_REQUEST['ETA']));
		$ETD = date("Y-m-d", strtotime($_REQUEST['ETD']));
		$CREATED_BY = $_SESSION['user_name'];
		$email = $_REQUEST['email'];
		$lr_id = $_REQUEST['lr_id'];
		$lrids = '';
		foreach($lr_id as $lrs){
			$lrids .= $lrs.',';
		}
		$LR_ID = rtrim ($lrids , ",");
		if($LR_ID != ''){
			$sql = "insert into process(BMO_NUMBER, DRIVER_NAME, VEHICLE, BMO_DATE, ETA, ETD, LR_ID, FROM_BRANCH, TO_BRANCH, STATUS, CREATED_BY) 
						values('".$BMO_NUMBER."', '".$DRIVER_NAME."', '".$VEHICLE."', '".$BMO_DATE."', '".$ETA."', '".$ETD."', '".$LR_ID."', '".$FROM_BRANCH."', '".$TO_BRANCH."', 'BMO', '".$CREATED_BY."')";
			//echo $sql;
			$res = sqlsrv_query($conn, $sql);
			$last_bmo_id = sqlsrv_insert_id();
			if ($res) {
				$msg = '<div style="color:green;">BMO successful!!</div>';
				$curr_date = date('Y-m-d');
				$update_lr = "update lr set STATUS = 'BMO', BMO_DATE = '".$curr_date."', BMO_BY = '".$CREATED_BY."' where ID in (".$LR_ID.")";
				$res_update_lr = sqlsrv_query($conn, $update_lr);
				
				$lids = explode(",", $LR_ID);
				$i = 0;
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
					$subject = 'Your shipment is loaded and ready to move - Qube Services';
					$message = 'Dear Sir, <br /><br />';
					$message .= 'Your shipment has been loaded in the truck number '.$VEHICLE.' and is ready to move. Details are as follows;';
					$message .= '
								<table border="1" width="80%">
									<tr><td>Booking No.</td><td>'.$LR_NUMBER.'</td></tr>
									<tr><td>BMO No.</td><td>'.$BMO_NUMBER.'</td></tr>
									<tr><td>Shipper</td><td>'.$SHIPPER.'</td></tr>
									<tr><td>No of Pkgs</td><td>'.$NO_OF_PKGS.'</td></tr>
									<tr><td>Volume</td><td>'.$QUANTITY.'</td></tr>
									<tr><td>Origin</td><td>'.$FROM_BRANCH.'</td></tr>
									<tr><td>Destination</td><td>'.$TO_BRANCH.'</td></tr>
									<tr><td>ETD</td><td>'.$ETD.'</td></tr>
									<tr><td>ETA</td><td>'.$ETA.'</td></tr>
								</table><br /><br />';
					$message .= 'Best Regards,<br />For Qube Services Private Ltd.<br />';			
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= "From:Qube Services <admin@admin.com>\r\n";
					$headers .= 'Cc:khandade.sunil@gmail.com'."\r\n";				
					$headers .= 'Bcc:confirmation_trucking@qubeservices.in'."\r\n";				
					mail($to, $subject, $message, $headers);
					$i = $i + 1;
				}
				$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">BMO Created successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				header("Location:list_bmo.php");
			} else {
				$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not add BMO!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			}
		}else{
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">There is no booking selected for BMO</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		}
	}
?>
<script>
	jQuery(document).ready(function(){
		jQuery("#submit_form").validationEngine();
	});
</script>
<style>
fieldset{
	padding-top:10px;
}
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
.suggestionsBox {
	position: absolute;
	left: 850px;
	top:245px;
	margin: 26px 0px 0px 0px;
	width: 200px;
	padding:0px;
	background-color: #000;
	border-top: 3px solid #000;
	color: #fff;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#FFF;
	padding:0;
	margin:0;
}
.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}
#suggest {
	position:relative;
}
</style>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<script>$(document).ready(function(){ $("#menu4").addClass(" active");});</script>
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>BMO</h3>
									</div>
									<div class="widget-content"><br />
										<form name="form_filter" action="" method="post">
											&nbsp; Route Type 
											<select class="select span2 " id="TYPE" name="TYPE">
												<?php
													$sel1 = '';
													$sel2 = '';
													if($TYPE == 'VIA')
														$sel2 = 'selected';
													else
														$sel1 = 'selected';
												?>
												<option value="DIRECT" <?=$sel1?>>Direct</option>
												<option value="VIA" <?=$sel2?>>Via</option>
											</select> &nbsp; &nbsp; 
											&nbsp; Origin 
											<select class="select span2 " id="FROM_BRANCH" name="FROM_BRANCH" onchange="javascript:form_filter.submit();">
												<option selected="" value="">Origin</option>
												<?php
													$sel_f_branch = "select * from city where type != 'DELIVERY' order by NAME";
													$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
													while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
														$f_br_id = $r_f_branch['ID'];
														$f_br_name = $r_f_branch['NAME'];
														$sel = '';
														if($f_br_id == $FROM_BRANCH)
															$sel = 'selected';
														echo '<option value="'.$f_br_id.'" '.$sel.'>'.$f_br_name.'</option>';
													}
												?>
											</select> &nbsp; &nbsp; 
											Destination 
											<select class="select span2 " id="TO_BRANCH" name="TO_BRANCH" onchange="javascript:form_filter.submit();">
												<option selected="" value="">Destination</option>
												<?php
													$sel_f_branch = "select * from city where type != 'BOOKING' order by NAME";
													$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
													while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
														$f_br_id = $r_f_branch['ID'];
														$f_br_name = $r_f_branch['NAME'];
														$sel = '';
														if($TO_BRANCH == $f_br_id)
															$sel = 'selected';
														echo '<option value="'.$f_br_id.'" '.$sel.'>'.$f_br_name.'</option>';
													}
												?>
											</select> &nbsp; &nbsp; 
											&nbsp; Route 
											<select class="select span2 " id="ROUTE" name="ROUTE">
												<option selected="" value="">Route</option>
												<?php
													$condi = '';
													if($TYPE == 'VIA')
														$condi .= " and TYPE = '".$TYPE."'";
													if($FROM_BRANCH != '' && $TO_BRANCH != '')
														$condi .= ' and SOURCE = '.$FROM_BRANCH . ' and DESTINATION = '.$TO_BRANCH;
													$sel_route = "select * from route where 1=1 ".$condi;
													//echo $sel_route;
													$res_route = sqlsrv_query($conn, $sel_route);
													while($r_route = sqlsrv_fetch_array($res_route)){
														$route_id = $r_route['ID'];
														$via = $r_route['VIA'];
														$sel_city = "select * from city where ID in (".$via.")";
														$res_city = sqlsrv_query($conn, $sel_city);
														$cities = '';
														while($row_city = sqlsrv_fetch_array($res_city)){
															$cities .= $row_city['NAME']. ', ';
														}
														$cities = rtrim($cities, ', ');
														$sel = '';
														if($ROUTE == $via)
															$sel = 'selected';
														echo '<option value="'.$via.'" '.$sel.'>'.$cities.'</option>';
													}
												?>
											</select> &nbsp; &nbsp; 
											<input type="submit" name="search" id="search" value="Search" class="btn btn-primary"><br /><br />
										<div class="widget-content">
											<table class="table table-striped table-bordered" >
												<thead>
													<tr>
														<th>Select</th>
														<th>Customer</th>
														<th>Booking Number</th>
														<th>Booking Date</th>
														<th>From</th>
														<th>To</th>
														<th>Goods</th>
														<th>Email</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$search = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
														if($search != ''){
														$condi = '';
														if($TYPE == 'DIRECT'){
																$condi .= " and ( FROM_BRANCH = ". $FROM_BRANCH. " and TO_BRANCH = ".$TO_BRANCH.")";
														}else{
															$condi .= " and FROM_BRANCH = ". $FROM_BRANCH. ' and (TO_BRANCH IN ('.$ROUTE.') or TO_BRANCH IN ('.$TO_BRANCH.'))';
														}
															
														$sel_lr = "select ID, CONSR, LR_NUMBER, LR_DATE, (select NAME from city where ID = FROM_BRANCH) AS FROM_BRANCH, (select NAME from city where ID = TO_BRANCH) AS TO_BRANCH, 
																CONSR_EMAIL, LR_TYPE, (select NAME from goods where ID = GOODS) AS GOODS, STATUS, CREATED_DATE from lr where status = 'Active' ".$condi;
														//echo $sel_lr;
														$res_lr = sqlsrv_query($conn, $sel_lr);
														while($row_lr = sqlsrv_fetch_array($res_lr)){
															$ID = $row_lr['ID'];
															$LR_NUMBER = $row_lr['LR_NUMBER'];
															$CONSR = $row_lr['CONSR'];
															$LR_DATE = date("d-m-Y", strtotime($row_lr['LR_DATE']));
															$FROM_BRANCH = $row_lr['FROM_BRANCH'];
															$TO_BRANCH = $row_lr['TO_BRANCH'];
															$CONSR_EMAIL = $row_lr['CONSR_EMAIL'];
															$LR_TYPE = $row_lr['LR_TYPE'];
															$GOODS = $row_lr['GOODS'];
															$STATUS = $row_lr['STATUS'];
															$CREATED_DATE = $row_lr['CREATED_DATE'];
													?>
													<tr>
														<td><input type="checkbox" name="lr_id[]" value="<?=$ID?>"></td>
														<td><?=$CONSR?></td>
														<td><?=$LR_NUMBER?></td>
														<td><?=$LR_DATE?></td>
														<td><?=$FROM_BRANCH?></td>
														<td><?=$TO_BRANCH?></td>
														<td><?=$GOODS?></td>
														<td>
															<select name="email[]" class="span3">
																<option value="">No email is being sent</option>
																<option value="<?=$CONSR_EMAIL?>"><?=$CONSR_EMAIL?></option>
															</select>
														</td>
													</tr>
													<?php
														}
														}
													?>
												</tbody>
											</table><br />
											<center>
											<table border="0" width="80%">
												<tr>
													<td>
														BMO Number
													</td>	
													<td>
														<input type="text" name="BMO_NUMBER" id="BMO_NUMBER" value="<?=$bmo_num?>" class="span2" readonly>
													</td>	
													<td>
														BMO Date
													</td>	
													<td>
														<input type="text" name="BMO_DATE" id="BMO_DATE" value="<?=date('d-m-Y')?>" class="span2 tcal">
													</td>
													<td>
														Truck / Vehicle Number
													</td>	
													<td><br />
														<input type="text" name="VEHICLE" id="VEHICLE" value="" onkeyup="suggest(this.value);" onblur="fill();fillId();" class="span2" autocomplete="off"><br /><br />
														<div class="suggestionsBox" id="suggestions" style="display: none;"> <div class="suggestionList" id="suggestionsList"> &nbsp; </div></div>
													</td>
												</tr>
												<tr>
													<td>
														Driver Name
													</td>	
													<td>
														<input type="text" name="DRIVER_NAME" id="DRIVER_NAME" value="" class="span2">
													</td>
													<td>
														ETD
													</td>	
													<td>
														<input type="text" name="ETD" id="ETD" value="<?=date('d-m-Y', strtotime(date('d-m-Y'). ' + 4 days'));?>" class="span2 tcal">
													</td>
													<td>
														ETA
													</td>	
													<td>
														<input type="text" name="ETA" id="ETA" value="<?=date('d-m-Y', strtotime(date('d-m-Y'). ' + 4 days'));?>" class="span2 tcal">
													</td>
												</tr>
											</table>
											<input type="submit" name="bmo" id="bmo" value="Create BMO" class="btn btn-primary"><br /><br />
											</center>
										</div>
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
<script>
function get_consignor(){
	var e = document.getElementById("CONSR");
	var id = e.options[e.selectedIndex].value;
	$.ajax({
		url: 'get_consignor.php',
		data: { id: id},
		success: function(data) {
			var obj = JSON.parse(data);
			var MOBILE = obj.MOBILE;
			var EMAIL = obj.EMAIL;
			var TIN = obj.TIN;
			document.getElementById('CONSR_MOBILE').value = MOBILE;
			document.getElementById('CONSR_EMAIL').value = EMAIL;
			document.getElementById('TIN').value = TIN;
		}
	});
}
function frt_cal(){
	var CHARGED_WEIGHT = document.getElementById('CHARGED_WEIGHT').value;
	var RATE = document.getElementById('RATE').value;
	var total = parseInt(CHARGED_WEIGHT) * parseInt(RATE);
	document.getElementById('FREIGHT').value = total;	
}

function cal_total(){
	var FREIGHT = document.getElementById('FREIGHT').value;
	var GC = document.getElementById('GC').value;
	var DCC = document.getElementById('DCC').value;
	var DDC = document.getElementById('DDC').value;
	var ODA = document.getElementById('ODA').value;
	var SC = document.getElementById('SC').value;
	var HAMALI = document.getElementById('HAMALI').value;
	var total = parseInt(FREIGHT) + parseInt(GC) + parseInt(DCC) + parseInt(DDC) + parseInt(ODA) + parseInt(SC) + parseInt(HAMALI);
	document.getElementById('TOTAL').value = total;	
}
</script>
<script>
function suggest(inputString){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$.ajax({
	  url: "autosuggest_vehicle.php",
	  data: 'act=autoSuggestUser&queryString='+inputString,
	  success: function(msg){
		  	if(msg.length >0) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(msg);
				$('#VEHICLE').removeClass('load');
			}
	  }
	});
	}
}
function fill(thisValue1) {
	$('#VEHICLE').val(thisValue1);
	setTimeout("$('#suggestions').fadeOut();", 600);
}
function fillId(thisValue) {
	$('#VEHICLE').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 600);
}

</script>
<?php
require_once 'footer.php';
?>