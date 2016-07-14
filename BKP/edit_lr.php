<?php
	session_start();
	require_once 'header.php';
	$for_branch = $_SESSION['for_branch'];
	$msg = '';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	
	$sel_lr = "select * from lr where ID = ".$ID;
	$res_lr = sqlsrv_query($conn, $sel_lr);
	$row_lr = sqlsrv_fetch_array($res_lr);
	
	$D_LR_DATE = date("d-m-Y", strtotime($row_lr['LR_DATE']));
	$D_LR_NUMBER = $row_lr['LR_NUMBER'];
	$D_LR_TYPE = $row_lr['LR_TYPE'];
	$D_FROM_BRANCH = $row_lr['FROM_BRANCH'];
	$D_TO_BRANCH = $row_lr['TO_BRANCH'];
	$D_CONSR = $row_lr['CONSR'];
	$D_CONSR_MOBILE = $row_lr['CONSR_MOBILE'];
	$D_CONSR_EMAIL = $row_lr['CONSR_EMAIL'];
	$D_CONSE = $row_lr['CONSE'];
	$D_CONSE_MOBILE = $row_lr['CONSE_MOBILE'];
	$D_CONSE_ADDRESS = $row_lr['CONSE_ADDRESS'];
	$D_SHIPPER = $row_lr['SHIPPER'];
	$D_DELIVERY_AT = $row_lr['DELIVERY_AT'];
	$D_GOODS = $row_lr['GOODS'];
	$D_QUANTITY = $row_lr['QUANTITY'];
	$D_NO_OF_PKGS = $row_lr['NO_OF_PKGS'];
	$D_CHARGED_RATE = $row_lr['CHARGED_RATE'];
	$D_MIN_RATE = $row_lr['MIN_RATE'];
	$D_FREIGHT = $row_lr['FREIGHT'];
	$D_TOTAL = $row_lr['TOTAL'];
	$D_REMARKS = $row_lr['REMARKS'];
	$D_EXP_DEL_DATE = date("d-m-Y", strtotime($row_lr['EXP_DEL_DATE']));
	$D_REMARKS = $row_lr['REMARKS'];
	
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
	
	if($action != ''){
		$LR_DATE = date("Y-m-d", strtotime($_REQUEST['LR_DATE']));
		$LR_TYPE = $_REQUEST['LR_TYPE'];
		$LR_NUMBER = $_REQUEST['LR_NUMBER'];
		$FROM_BRANCH = $_REQUEST['FROM_BRANCH'];
		$TO_BRANCH = $_REQUEST['TO_BRANCH'];
		$CONSR = $_REQUEST['CONSR'];
		$CONSR_MOBILE = $_REQUEST['CONSR_MOBILE'];
		$CONSR_EMAIL = $_REQUEST['CONSR_EMAIL'];
		$CONSE = $_REQUEST['CONSE'];
		$CONSE_MOBILE = $_REQUEST['CONSE_MOBILE'];
		$CONSE_ADDRESS = $_REQUEST['CONSE_ADDRESS'];
		$SHIPPER = $_REQUEST['SHIPPER'];
		$DELIVERY_AT = $_REQUEST['DELIVERY_AT'];
		$GOODS = $_REQUEST['GOODS'];
		$QUANTITY = $_REQUEST['QUANTITY'];
		$NO_OF_PKGS = $_REQUEST['NO_OF_PKGS'];
		$CHARGED_RATE = $_REQUEST['CHARGED_RATE'];
		$MIN_RATE = $_REQUEST['MIN_RATE'];
		//$FREIGHT = $_REQUEST['FREIGHT'];
		$TOTAL = $_REQUEST['TOTAL'];
		$EXP_DEL_DATE = date("Y-m-d", strtotime($_REQUEST['EXP_DEL_DATE']));
		$REMARKS = $_REQUEST['REMARKS'];
		$CREATED_BY = $_SESSION['user_name'];
		
		$sql = "update lr SET LR_DATE = '".$LR_DATE."', LR_TYPE = '".$LR_TYPE."', FROM_BRANCH = '".$FROM_BRANCH."', TO_BRANCH = '".$TO_BRANCH."', CONSR = '".$CONSR."', 
				CONSR_MOBILE = '".$CONSR_MOBILE."', CONSR_EMAIL = '".$CONSR_EMAIL."', CONSE = '".$CONSE."', CONSE_MOBILE = '".$CONSE_MOBILE."', CONSE_ADDRESS = '".$CONSE_ADDRESS."', 
				SHIPPER = '".$SHIPPER."', DELIVERY_AT = '".$DELIVERY_AT."', GOODS = '".$GOODS."', QUANTITY = '".$QUANTITY."', NO_OF_PKGS = '".$NO_OF_PKGS."', CHARGED_RATE = '".$CHARGED_RATE."', MIN_RATE = '".$MIN_RATE."', FREIGHT = '".$FREIGHT."',  
				TOTAL = '".$TOTAL."', EXP_DEL_DATE = '".$EXP_DEL_DATE."', REMARKS = '".$REMARKS."', CREATED_BY = '".$CREATED_BY."' where ID = ". $ID;
		//echo $sql;
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Booking updated successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_lr.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not add Booking!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
	top:240px;
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

.suggestionsBox1 {
	position: absolute;
	left: 725px;
	top:240px;
	margin: 26px 0px 0px 0px;
	width: 200px;
	padding:0px;
	background-color: #000;
	border-top: 3px solid #000;
	color: #fff;
}
.suggestionList1 {
	margin: 0px;
	padding: 0px;
}
.suggestionList1 ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList1 ul li:hover {
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
						<script>$(document).ready(function(){ $("#menu3").addClass(" active");});</script>
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Edit Booking</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<div class="span12">
												<div class="widget-content">
													<div class="span10">
														<fieldset>
															<div class="control-group">											
																<label for="lr_date" class="control-label">Booking Number</label>
																<div class="controls">
																	<input type="text" name="LR_NUMBER" value="<?=$D_LR_NUMBER?>" id="LR_NUMBER" class="span2validate[required]" readonly>
																</div> 				
															</div>
														</fieldset>
													</div>
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="lr_date" class="control-label">Booking Date</label>
																<div class="controls">
																	<input type="text" name="LR_DATE" value="<?=date('d-m-Y')?>" id="LR_DATE" class="span2 validate[required] tcal" tabindex="1">
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="from_branch" class="control-label">Origin</label>
																<div class="controls">
																	<?php
																		if($_SESSION['type'] == 'ADMIN'){
																	?>
																	<select class="select span2 " id="FROM_BRANCH" name="FROM_BRANCH" tabindex="3">
																		<?php
																			$sel_f_branch = "select * from city where type != 'DELIVERY' order by NAME";
																			$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
																			while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
																				$f_br_id = $r_f_branch['ID'];
																				$f_br_name = $r_f_branch['NAME'];
																				$sel = '';
																				if($D_FROM_BRANCH == $f_br_id)
																					$sel = 'selected';
																		?>
																		<option value="<?=$f_br_id?>" <?=$sel?>><?=$f_br_name?></option>
																		<?php
																			}
																		?>
																	</select>
																	<?php
																		}else{
																	?>
																	<input type="text" readonly="" name="from_branch1" value="<?=$sess_user_name?>" id="from_branch1" class="span2 ">
																	<input type="hidden" name="FROM_BRANCH" value="<?=$sess_user_id?>" id="FROM_BRANCH" >
																	<?php
																		}
																	?>
																</div> 				
															</div> 
														</fieldset>
													</div>
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="lr_type" class="control-label">Booking Type</label>
																<div class="controls">
																	<select class="select span2 " id="LR_TYPE" name="LR_TYPE" tabindex="2">
																		<?php
																			$sel1 = '';
																			$sel2 = '';
																			$sel3 = '';
																			if($D_LR_TYPE == 'PAID')
																				$sel1 = 'selected';
																			elseif($D_LR_TYPE == 'TO PAY')
																				$sel2 = 'selected';
																			else
																				$sel3 = 'selected';
																		?>
																		<option value="PAID" <?=$sel1?>>PAID</option>
																		<option value="TO PAY" <?=$sel2?>>TO PAY</option>
																		<option value="TO BE BILLED" <?=$sel3?>>TO BE BILLED</option>
																	</select>
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="to_branch" class="control-label">Destination</label>
																<div class="controls">
																	<select class="select span3 " id="TO_BRANCH" name="TO_BRANCH" tabindex="4">
																		<?php
																			$sel_f_branch = "select * from city where type != 'BOOKING' order by NAME";
																			$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
																			while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
																				$f_br_id = $r_f_branch['ID'];
																				$f_br_name = $r_f_branch['NAME'];
																				$sel = '';
																				if($D_TO_BRANCH == $f_br_id)
																					$sel = "selected";
																		?>
																		<option value="<?=$f_br_id?>" <?=$sel?>><?=$f_br_name?></option>
																		<?php
																			}
																		?>
																	</select>
																</div> 				
															</div> 
														</fieldset>
													</div>
												</div>
												<div class="widget-content">
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="branch" class="control-label">Consignor</label>
																<div class="controls">
																	<input type="text" name="CONSR" id="CONSR" value="<?=$D_CONSR?>" onkeyup="suggest(this.value);" onblur="fill();fillId();" class="span2 validate[required]" autocomplete="off" tabindex="5"><br /><br />
																	<div class="suggestionsBox" id="suggestions" style="display: none;"> <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="consr_mob" class="control-label">Mobile</label>
																<div class="controls">
																	<input type="text" name="CONSR_MOBILE" value="<?=$D_CONSR_MOBILE?>" id="CONSR_MOBILE" class="span2 validate[required]" tabindex="6">
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="consr_email" class="control-label">Email</label>
																<div class="controls">
																	<input type="text" name="CONSR_EMAIL" value="<?=$D_CONSR_EMAIL?>" id="CONSR_EMAIL" class="span2 validate[required]" tabindex="7">
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="delivery" class="control-label">Service Type</label>
																<div class="controls">
																	<select class="select span3 " id="DELIVERY_AT" name="DELIVERY_AT" tabindex="8">
																		<?php
																			$sel1 = '';
																			$sel2 = '';
																			$sel3 = '';
																			$sel4 = '';
																			if($D_DELIVERY_AT == 'Warehouse to Warehouse')
																				$sel1 = 'selected';
																			elseif($D_DELIVERY_AT == 'Door to Door')
																				$sel2 = 'selected';
																			elseif($D_DELIVERY_AT == 'Door to Warehouse')
																				$sel3 = 'selected';
																			else
																				$sel4 = 'selected';
																		?>
																		<option value="Warehouse to Warehouse" <?=$sel1?>>Warehouse to Warehouse</option>
																		<option value="Door to Door" <?=$sel2?>>Door to Door</option>
																		<option value="Door to Warehouse" <?=$sel3?>>Door to Warehouse</option>
																		<option value="Warehouse to Door" <?=$sel4?>>Warehouse to Door</option>
																	</select>
																</div> 				
															</div> 
														</fieldset>
													</div>
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="branch" class="control-label">Consignee</label>
																<div class="controls">
																	<input type="text" name="CONSE" id="CONSE" value="<?=$D_CONSE?>" onkeyup="suggest1(this.value);" onblur="fill1();fillId1();" class="span2 validate[required]" autocomplete="off" tabindex="9"><br /><br />
																	<div class="suggestionsBox1" id="suggestions1" style="display: none;"> <div class="suggestionList1" id="suggestionsList1"> &nbsp; </div>
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="conse_mob" class="control-label">Mobile</label>
																<div class="controls">
																	<input type="text" name="CONSE_MOBILE" value="<?=$D_CONSE_MOBILE?>" id="CONSE_MOBILE" class="span2 validate[required]" tabindex="10">
																</div> 				
															</div>
															<div class="control-group">											
																<label for="consr_email" class="control-label">Address</label>
																<div class="controls">
																	<textarea name="CONSE_ADDRESS" id="CONSE_ADDRESS" class="span2 validate[required]" tabindex="11"><?=$D_CONSE_ADDRESS?></textarea>
																</div> 				
															</div>
															<div class="control-group">											
																<label for="consr_email" class="control-label">Shipper</label>
																<div class="controls">
																	<input type="text" name="SHIPPER" value="<?=$D_SHIPPER?>" id="SHIPPER" class="span2 validate[required]" tabindex="12">
																</div> 				
															</div>															
														</fieldset>
													</div>
												</div>
												<div class="widget-content">
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="goods" class="control-label">Commodity</label>
																<div class="controls">
																	<select class="select span3 " id="GOODS" name="GOODS" tabindex="13">
																		<option selected="" value="">-Select-</option>
																		<?php
																			$sel_goods = "select * from goods where STATUS = 'A'";
																			$res_goods = sqlsrv_query($conn, $sel_goods);
																			while($r_goods = sqlsrv_fetch_array($res_goods)){
																				$gid = $r_goods['ID'];
																				$gname = $r_goods['NAME'];
																				$sel = '';
																				if($D_GOODS == $gid)
																					$sel = 'selected';
																		?>
																		<option value="<?=$gid?>" <?=$sel?>><?=$gname?></option>
																		<?php
																			}
																		?>
																	</select>
																</div> 				
															</div>
															<div class="control-group">											
																<label for="RATE" class="control-label">Minimum Rate</label>
																<div class="controls">
																	<!--<input type="text" name="RATE" value="0" id="RATE" class="span2" onblur="frt_cal();">-->
																	<input type="text" name="MIN_RATE" value="<?=$D_MIN_RATE?>" id="MIN_RATE" class="span2 validate[required]" onblur="javascript:change_cal();" tabindex="15">
																</div> 				
															</div>
															<div class="control-group">											
																<label for="RATE" class="control-label">Rate</label>
																<div class="controls">
																	<!--<input type="text" name="RATE" value="0" id="RATE" class="span2" onblur="frt_cal();">-->
																	<input type="text" name="CHARGED_RATE" value="<?=$D_CHARGED_RATE?>" id="CHARGED_RATE" class="span2 validate[required]" onblur="javascript:change_cal();" tabindex="15">
																</div> 				
															</div>
														</fieldset>
													</div>
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="act_wgt" class="control-label">Volume <span style="font-size:10px;">(Per Cubic)</span></label>
																<div class="controls">
																	<input type="text" name="QUANTITY" value="<?=$D_QUANTITY?>" id="QUANTITY" class="span2 validate[required]" onblur="javascript:cal_rate();" tabindex="14">
																</div> 				
															</div>
															<!--<div class="control-group">											
																<label for="freight" class="control-label">Freight</label>
																<div class="controls">
																	<input type="text" name="FREIGHT" value="0" id="FREIGHT" class="span2" onblur="javascript:cal_total();">
																</div> 				
															</div>-->
															<div class="control-group">											
																<label for="total" class="control-label">Total</label>
																<div class="controls">
																	<input type="text" name="TOTAL" value="<?=$D_TOTAL?>" id="TOTAL" class="span2 validate[required]" readonly tabindex="16">
																</div> 				
															</div>
															<div class="control-group">											
																<label for="RATE" class="control-label">No. of Pkgs.</label>
																<div class="controls">
																	<!--<input type="text" name="RATE" value="0" id="RATE" class="span2" onblur="frt_cal();">-->
																	<input type="text" name="NO_OF_PKGS" value="<?=$D_NO_OF_PKGS?>" id="NO_OF_PKGS" class="span2 validate[required]" onblur="javascript:change_cal();" tabindex="15">
																</div> 				
															</div>
														</fieldset>
													</div>
												</div>
												<div class="widget-content">
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="freight" class="control-label">Exp. Delivery Date</label>
																<div class="controls">
																	<input type="text" name="EXP_DEL_DATE" value="<?=$D_EXP_DEL_DATE?>" id="EXP_DEL_DATE" class="span2 validate[required]  tcal" tabindex="17">
																</div> 				
															</div>
														</fieldset>
													</div>
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="instruction" class="control-label">Remarks</label>
																<div class="controls">
																	<textarea name="REMARKS" id="REMARKS" class="span3 validate[required]" tabindex="18"><?=$D_REMARKS?></textarea>
																</div> 				
															</div> 
														</fieldset>
													</div>
												</div>
												<div class="widget-content">
													<fieldset>
														<div class="form-actions">
															<input name="add" id="add" class="btn btn-primary" type="submit" value="Save" tabindex="19">
															<a href="print_lr.php?id=<?=$ID?>" target="_blank"class="btn btn-primary" tabindex="20">Print</a>
															<a class="btn" href="list_lr.php" tabindex="21">Back</a>
														</div>
														<div class="control-group" style="text-align:center;"><?=$msg?></div>
													</fieldset>
												</div>
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
function  cal_rate(){
	var from_branch = $("#FROM_BRANCH :selected").val();
	var to_branch = $("#TO_BRANCH :selected").val();
	var goods_id = $("#GOODS :selected").val();
	var quantity = $("#QUANTITY").val();
	$("#TOTAL").val('0');
	$.ajax({
		url: 'rate.php',
		data: { 
				from_branch: from_branch,
				to_branch: to_branch,
				goods_id: goods_id,
				quantity: quantity
			},
		success: function(data) {
			var res = data.split("|"); 
			$("#MIN_RATE").val(res[0]);
			$("#CHARGED_RATE").val(res[1]);
			var both = res[1] * quantity;
			if(res[0] > both)
				$("#TOTAL").val(res[0]);
			else
				$("#TOTAL").val(both);
		}
	});
}

function cal_total(){
	var CHARGED_RATE = $("#CHARGED_RATE").val();
	//var FREIGHT = $("#FREIGHT").val();
	//var HAMALI = $("#HAMALI").val();
	var final_total = parseInt(CHARGED_RATE);
	$("#TOTAL").val(final_total);
}

function change_cal(){
	var MIN_RATE = $("#MIN_RATE").val();
	var CHARGED_RATE = $("#CHARGED_RATE").val();
	var QUANTITY = $("#QUANTITY").val();
	var both = CHARGED_RATE * QUANTITY
	if(MIN_RATE > both)
		$("#TOTAL").val(MIN_RATE);
	else
		$("#TOTAL").val(both);
	//var final_total = parseInt(CHARGED_RATE) * parseInt(QUANTITY);
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
				$('#CONSR').removeClass('load');
			}
	  }
	});
	}
}
function fill(thisValue1, thisValue2, thisValue3) {
	$('#CONSR').val(thisValue1);
	$('#CONSR_MOBILE').val(thisValue2);
	$('#CONSR_EMAIL').val(thisValue3);
	setTimeout("$('#suggestions').fadeOut();", 100);
}
function fillId(thisValue) {
	$('#CONSR').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 100);
}
</script>
<script>
function suggest1(inputString){
	if(inputString.length == 0) {
		$('#suggestions1').fadeOut();
	} else {
	$.ajax({
	  url: "autosuggest_user1.php",
	  data: 'act=autoSuggestUser&queryString='+inputString,
	  success: function(msg){
		  	if(msg.length >0) {
				$('#suggestions1').fadeIn();
				$('#suggestionsList1').html(msg);
				$('#CONSE').removeClass('load');
			}
	  }
	});
	}
}
function fill1(thisValue1, thisValue2, thisValue3) {
	$('#CONSE').val(thisValue1);
	$('#CONSE_MOBILE').val(thisValue2);
	$('#CONSE_ADDRESS').val(thisValue3);
	setTimeout("$('#suggestions1').fadeOut();", 100);
}
function fillId1(thisValue) {
	$('#CONSE').val(thisValue);
	setTimeout("$('#suggestions1').fadeOut();", 100);
}
</script>
<?php
require_once 'footer.php';
?>