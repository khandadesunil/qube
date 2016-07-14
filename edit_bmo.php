<?php
	require_once 'header.php';
		
	$msg = '';
	$bmo = isset($_REQUEST['bmo']) ? $_REQUEST['bmo'] : '';
	$bmo_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	
	$sel_bmo = "select p.*, CONVERT(VARCHAR(10), p.BMO_DATE,110) as BMO_DATE, CONVERT(VARCHAR(10), p.ETA,105) as ETA, CONVERT(VARCHAR(10), p.ETD,105) as ETD from process p where p.ID = ".$bmo_id;
	$res_bmo = sqlsrv_query($conn, $sel_bmo);
	$row_bmo = sqlsrv_fetch_array($res_bmo);
	$D_BMO_NUM = $row_bmo['BMO_NUMBER'];
	$D_FROM_BRANCH = $row_bmo['FROM_BRANCH'];
	$D_TO_BRANCH = $row_bmo['TO_BRANCH'];
	$D_BMO_DATE = $row_bmo['BMO_DATE'];
	$D_DRIVER_NAME = $row_bmo['DRIVER_NAME'];
	$D_VEHICLE = $row_bmo['VEHICLE'];
	$D_ETA = $row_bmo['ETA'];
	$D_ETD = $row_bmo['ETD'];
	$OLDLID = explode(",", $row_bmo['LR_ID']);
		
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
			$sql = "update process set DRIVER_NAME = '".$DRIVER_NAME."', VEHICLE = '".$VEHICLE."', BMO_DATE = '".$BMO_DATE."', ETA = '".$ETA."', ETD = '".$ETD."', LR_ID = '".$LR_ID."', 
			FROM_BRANCH = '".$FROM_BRANCH."', TO_BRANCH = '".$TO_BRANCH."', CREATED_BY = '".$CREATED_BY."' where ID = ".$bmo_id;
			//echo $sql;die;
			$res = sqlsrv_query($conn, $sql);
			if ($res) {
				$curr_date = date('Y-m-d');
				$update_lr = "update lr set STATUS = 'BMO', BMO_DATE = '".$curr_date."', BMO_BY = '".$CREATED_BY."' where ID in (".$LR_ID.")";
				$res_update_lr = sqlsrv_query($conn, $update_lr);
				
				//$lids = explode(",", $LR_ID);
				$oldlids = explode(",", $OLDLID);
				
				foreach($email as $em){
					if(in_array($oldlids, $em)){
						/*$get_email = "select * from lr where ID = ".$lid;
						$res_email = sqlsrv_query($conn, $get_email);
						$row_email = sqlsrv_fetch_array($res_email);
						$CONSR_EMAIL = $row_email['CONSR_EMAIL'];*/
						$to = $em;
						$subject = 'Qube Services - Booking Confirmation';				
						$message = 'Dear Sir, <br /><br />';
						$message .= 'Your shipment has been loaded in Truck '.$VEHICLE.' which is scheduled to leave '.$F_NAME.' on '.$curr_date.' and is expected to reach '.$T_NAME.' on '.$exp_del_date;
						$message .= 'Best Regards,<br />Qube Services<br />';			
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= "From:Qube Services <admin@admin.com>\r\n";
						$headers .= 'Cc:khandade.sunil@gmail.com'."\r\n";				
						$headers .= 'Bcc:confirmation_trucking@qubeservices.in'."\r\n";
						mail($to, $subject, $message, $headers);
					}
				}
				$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">BMO updated successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				header("Location:list_bmo.php");
			} else {
				$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not update BMO!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			}
		}else{
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">There is no booking selected for BMO!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
	left: 605px;
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
														if($bmo_id != ''){
														$condi = '';
														$condi .= " ID in (".$row_bmo['LR_ID'].")";
														if($TYPE == 'DIRECT'){
																$condi .= " or ( FROM_BRANCH = '". $FROM_BRANCH. "' and TO_BRANCH = '".$TO_BRANCH."')";
														}else{
															$condi .= " or FROM_BRANCH = '". $FROM_BRANCH. "' and (TO_BRANCH IN ('".$ROUTE."') or TO_BRANCH IN ('".$TO_BRANCH."'))";
														}														
															
														$sel_lr = "select ID, CONSR, LR_NUMBER, CONVERT(VARCHAR(10), LR_DATE,110) as LR_DATE, (select NAME from city where ID = FROM_BRANCH) AS FROM_BRANCH, (select NAME from city where ID = TO_BRANCH) AS TO_BRANCH, 
																CONSR_EMAIL, LR_TYPE, GOODS, STATUS, CREATED_DATE from lr where ".$condi. " order by LR_DATE DESC";
														//echo $sel_lr;
														$res_lr = sqlsrv_query($conn, $sel_lr);
														while($row_lr = sqlsrv_fetch_array($res_lr)){
															$ID = $row_lr['ID'];
															$CONSR = $row_lr['CONSR'];
															$LR_NUMBER = $row_lr['LR_NUMBER'];
															$LR_DATE = $row_lr['LR_DATE'];
															$FROM_BRANCH = $row_lr['FROM_BRANCH'];
															$TO_BRANCH = $row_lr['TO_BRANCH'];
															$CONSR_EMAIL = $row_lr['CONSR_EMAIL'];
															$LR_TYPE = $row_lr['LR_TYPE'];
															$GOODS = $row_lr['GOODS'];
															$sel_goods = "select * from goods where ID = ".$GOODS;
															$res_goods = sqlsrv_query($conn, $sel_goods);
															$r_goods = sqlsrv_fetch_array($res_goods);
															$GOODS = $r_goods['NAME'];
															$STATUS = $row_lr['STATUS'];
															$CREATED_DATE = $row_lr['CREATED_DATE'];
																$checked = '';
															if(in_array($ID, $OLDLID))
																$checked = 'checked';
													?>
													<tr>
														<td><input type="checkbox" name="lr_id[]" value="<?=$ID?>" <?=$checked?>></td>
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
														<input type="text" name="BMO_NUMBER" id="BMO_NUMBER" value="<?=$D_BMO_NUM?>" class="span2" readonly>
													</td>	
													<td>
														BMO Date
													</td>	
													<td>
														<input type="text" name="BMO_DATE" id="BMO_DATE" value="<?=$D_BMO_DATE?>" class="span2 tcal">
													</td>
													<td>
														ETA
													</td>	
													<td>
														<input type="text" name="ETA" id="ETA" value="<?=$D_ETA?>" class="span2 tcal">
													</td>
												</tr>
												<tr>
													<td>
														Driver Name
													</td>	
													<td>
														<input type="text" name="DRIVER_NAME" id="DRIVER_NAME" value="<?=$D_DRIVER_NAME?>" class="span2">
													</td>
													<td>
														ETD
													</td>	
													<td>
														<input type="text" name="ETD" id="ETD" value="<?=$D_ETD?>" class="span2 tcal">
													</td>	
													<td>
														Truck / Vehicle Number
													</td>	
													<td><br />
														<input type="text" name="VEHICLE" id="VEHICLE" value="<?=$D_VEHICLE?>" onkeyup="suggest(this.value);" onblur="fill();fillId();" class="span2" autocomplete="off"><br /><br />
														<div class="suggestionsBox" id="suggestions" style="display: none;"> <div class="suggestionList" id="suggestionsList"> &nbsp; </div></div>
													</td>	
													<td>
												</tr>
											</table>
											<input type="submit" name="bmo" id="bmo" value="Save BMO" class="btn btn-primary">
											<a href="print_bmo.php?id=<?=$bmo_id?>" target="_blank" class="btn btn-primary">Print</a>
											<a href="list_bmo.php" class="btn btn-primary">Back</a><br /><br />
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