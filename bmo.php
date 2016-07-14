<?php
	require_once 'header.php';
		
	$msg = '';
	$bmo = isset($_REQUEST['bmo']) ? $_REQUEST['bmo'] : '';
	$FROM_BRANCH = isset($_REQUEST['FROM_BRANCH']) ? $_REQUEST['FROM_BRANCH'] : '';
	$TO_BRANCH = isset($_REQUEST['TO_BRANCH']) ? $_REQUEST['TO_BRANCH'] : '';
	$TYPE = isset($_REQUEST['TYPE']) ? $_REQUEST['TYPE'] : '';
	$ROUTE = isset($_REQUEST['ROUTE']) ? $_REQUEST['ROUTE'] : '';
	$curr_date = date('d-m-Y');
	$exp_del_date = date('d-m-Y', strtotime(date('d-m-Y'). ' + 4 days'));
	$sel_f_branch = "select * from branch where ID = ".$FROM_BRANCH;
	$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
	$row_f_branch = sqlsrv_fetch_array($res_f_branch);
	$F_NAME = $row_f_branch['NAME'];
	
	$sel_t_branch = "select * from branch where ID = ".$TO_BRANCH;
	$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
	$row_t_branch = sqlsrv_fetch_array($res_t_branch);
	$T_NAME = $row_t_branch['NAME'];
	
	if($bmo != ''){
		$VEHICLE = $_REQUEST['VEHICLE'];
		$CREATED_BY = $_SESSION['user_name'];
		$lr_id = $_REQUEST['lr_id'];
		$lrids = '';
		foreach($lr_id as $lrs){
			$lrids .= $lrs.',';
		}
		$LR_ID = rtrim ($lrids , ",");
		if($LR_ID != ''){
			$sql = "insert into process(VEHICLE, LR_ID, STATUS, CREATED_BY) 
						values('".$VEHICLE."', '".$LR_ID."', 'BMO', '".$CREATED_BY."')";
			//echo $sql;
			$res = sqlsrv_query($conn, $sql);
			//$last_lr_id = sqlsrv_insert_id();
			$last_lr_id = sqlsrv_get_field($sql, 0);
			if ($res) {
				$msg = '<div style="color:green;">BMO successful!!</div>';
				$curr_date = date('Y-m-d');
				$update_lr = "update lr set STATUS = 'BMO', BMO_DATE = '".$curr_date."', BMO_BY = '".$CREATED_BY."' where ID in (".$LR_ID.")";
				$res_update_lr = sqlsrv_query($conn, $update_lr);
				
				$to = $CONSR_EMAIL;
				$subject = 'Qube Services - Booking Confirmation';
				
				$message = 'Dear Sir, <br /><br />';
				$message .= 'Your shipment has been loaded in Truck '.$VEHICLE.' which is scheduled to leave '.$F_NAME.' on '.$curr_date.' and is expected to reach '.$T_NAME.' on '.$exp_del_date;
				$message .= 'Best Regards,<br />Qube Services<br />';			
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From:Qube Services <admin@qubeservices.in>\r\n";
				$headers .= 'Cc:khandade.sunil@gmail.com'."\r\n";
				
				//mail($to, $subject, $message, $headers);
				send_smtpEmail($to, $subject, $message);
				header("Location:print_bmo.php?id=".$last_lr_id);
			} else {
				$msg = '<div style="color:red;">Sorry!! Could not add BMO!!</div>';
			}
		}else{
			$msg = '<div style="color:red;">There is no booking selected for BMO</div>';
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
	left: 225px;
	top:230px;
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
													$sel_f_branch = "select * from city order by NAME";
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
													$sel_f_branch = "select * from city order by NAME";
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
														if($ROUTE == $route_id)
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
														<th>Booking Date</th>
														<th>From</th>
														<th>To</th>
														<th>Goods</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$search = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';
														if($search != ''){
														$condi = '';
														if($TYPE == 'DIRECT'){
															//if($FROM_BRANCH != '' && $TO_BRANCH != '')
																$condi .= " and ( FROM_BRANCH = ". $FROM_BRANCH. " and TO_BRANCH = ".$TO_BRANCH.")";															
															/*if($FROM_BRANCH != '' && $TO_BRANCH == '')
																$condi .= " and ( FROM_BRANCH = ". $FROM_BRANCH. ")";
																
															if($FROM_BRANCH == '' && $TO_BRANCH != '')
																$condi .= " and ( TO_BRANCH = ".$TO_BRANCH.")";*/
														}else{
															$condi .= " and FROM_BRANCH = ". $FROM_BRANCH. ' and (TO_BRANCH IN ('.$ROUTE.') or TO_BRANCH IN ('.$TO_BRANCH.'))';
														}
															
														$sel_lr = "select ID, LR_DATE, (select NAME from city where ID = FROM_BRANCH) AS FROM_BRANCH, (select NAME from city where ID = TO_BRANCH) AS TO_BRANCH, 
																LR_TYPE, (select NAME from goods where ID = GOODS) AS GOODS, STATUS, CREATED_DATE from lr where status = 'Active' ".$condi;
														//echo $sel_lr;
														$res_lr = sqlsrv_query($conn, $sel_lr);
														while($row_lr = sqlsrv_fetch_array($res_lr)){
															$ID = $row_lr['ID'];
															$LR_DATE = $row_lr['LR_DATE'];
															$FROM_BRANCH = $row_lr['FROM_BRANCH'];
															$TO_BRANCH = $row_lr['TO_BRANCH'];
															$LR_TYPE = $row_lr['LR_TYPE'];
															$GOODS = $row_lr['GOODS'];
															$STATUS = $row_lr['STATUS'];
															$CREATED_DATE = $row_lr['CREATED_DATE'];
													?>
													<tr>
														<td><input type="checkbox" name="lr_id[]" value="<?=$ID?>"></td>
														<td><?=$LR_DATE?></td>
														<td><?=$FROM_BRANCH?></td>
														<td><?=$TO_BRANCH?></td>
														<td><?=$GOODS?></td>
													</tr>
													<?php
														}
														}
													?>
												</tbody>
											</table><br />
											<center>&nbsp; Truck / Vehicle Number
											<input type="text" name="VEHICLE" value="" id="VEHICLE" class="span2"><br /><br />
											<input type="submit" name="bmo" id="bmo" value="BMO" class="btn btn-primary"><br /><br />
											<?=$msg?>
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
	  url: "autosuggest_user.php",
	  data: 'act=autoSuggestUser&queryString='+inputString,
	  success: function(msg){
		  	if(msg.length >0) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(msg);
				$('#CONSIGN_NAME').removeClass('load');
			}
	  }
	});
	}
}
function fill(thisValue1,thisValue2) {
	$('#CONSR').val(thisValue1);
	$('#CONSIGN_NAME').val(thisValue2);
	setTimeout("$('#suggestions').fadeOut();", 600);
}
function fillId(thisValue) {
	$('#CONSIGN_NAME').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 600);
}

</script>
<?php
require_once 'footer.php';
?>