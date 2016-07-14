<?php
	require_once 'header.php';
		
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
	$D_CHARGED_RATE = $row_lr['CHARGED_RATE'];
	$D_FREIGHT = $row_lr['FREIGHT'];
	$D_TOTAL = $row_lr['TOTAL'];
	$D_REMARKS = $row_lr['EXP_'];
	$D_EXP_DEL_DATE = date("Y-m-d", strtotime($row_lr['EXP_DEL_DATE']));
	$D_REMARKS = $row_lr['REMARKS'];
	
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
	if($action != ''){
		$LR_DATE = date("Y-m-d", strtotime($_REQUEST['LR_DATE']));
		$LR_TYPE = $_REQUEST['LR_TYPE'];
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
		$CHARGED_RATE = $_REQUEST['CHARGED_RATE'];
		$FREIGHT = $_REQUEST['FREIGHT'];
		$TOTAL = $_REQUEST['TOTAL'];
		$EXP_DEL_DATE = $_REQUEST['EXP_DEL_DATE'];
		$REMARKS = $_REQUEST['REMARKS'];
		$CREATED_BY = $_SESSION['user_name'];
		
		$sql = "update lr SET LR_DATE = '".$LR_DATE."', LR_TYPE = '".$LR_TYPE."', FROM_BRANCH = '".$FROM_BRANCH."', TO_BRANCH = '".$TO_BRANCH."', CONSR = '".$CONSR."', 
				CONSR_MOBILE = '".$CONSR_MOBILE."', CONSR_EMAIL = '".$CONSR_EMAIL."', CONSE = '".$CONSE."', CONSE_MOBILE = '".$CONSE_MOBILE."', CONSE_ADDRESS = '".$CONSE_ADDRESS."', 
				SHIPPER = '".$SHIPPER."', DELIVERY_AT = '".$DELIVERY_AT."', GOODS = ".$GOODS."', QUANTITY = '".$QUANTITY."', CHARGED_RATE = '".$CHARGED_RATE."', FREIGHT = '".$FREIGHT."',  
				TOTAL = '".$TOTAL."', EXP_DEL_DATE = '".$EXP_DEL_DATE."', REMARKS = '".$REMARKS."', CREATED_BY = '".$CREATED_BY."' where ID = ". $ID;
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$msg = '<div style="color:green;">Booking added successfully!!</div>';
			//$last_lr_id = sqlsrv_insert_id();
			$last_lr_id = sqlsrv_get_field($sql, 0);
			header("Location:edit_lr.php?id=".$last_lr_id);
		} else {
			$msg = '<div style="color:red;">Sorry!! Could not add Booking!!</div>';
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
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="lr_date" class="control-label">Booking Number</label>
																<div class="controls">
																	<input type="text" name="LR_NUMBER" value="<?=$D_LR_NUMBER?>" id="LR_NUMBER" class="span2" readonly>
																</div> 				
															</div>
															<div class="control-group">											
																<label for="lr_date" class="control-label">Booking Date</label>
																<div class="controls">
																	<input type="text" name="LR_DATE" value="<?=$D_LR_DATE?>" id="LR_DATE" class="span2 tcal">
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="from_branch" class="control-label">Origin</label>
																<div class="controls">
																	<?php
																		if($_SESSION['type'] == 'ADMIN'){
																	?>
																	<select class="select span2 " id="FROM_BRANCH" name="FROM_BRANCH">
																		<option selected="" value="">All Branch</option>
																		<?php
																			$sel_f_branch = "select * from city order by NAME";
																			$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
																			while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
																				$f_br_id = $r_f_branch['ID'];
																				$f_br_name = $r_f_branch['NAME'];
																				$sel = '';
																				if($D_FROM_BRANCH == $f_br_id)
																					$sel = "selected";
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
																	<select class="select span2 " id="LR_TYPE" name="LR_TYPE">
																		<?php
																			$sel1 = '';
																			$sel2 = '';
																			if($D_LR_TYPE == 'PAID')
																				$sel1 = 'selected';
																			else
																				$sel2 = 'selected';
																		?>
																		<option value="PAID" <?=$sel1?>>PAID</option>
																		<option value="TO PAY" <?=$sel2?>>TO PAY</option>
																	</select>
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="to_branch" class="control-label">Destination</label>
																<div class="controls">
																	<select class="select span3 " id="TO_BRANCH" name="TO_BRANCH">
																		<option selected="" value="">All Branch</option>
																		<?php
																			$sel_f_branch = "select * from city where TYPE = 'DELIVERY' order by NAME";
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
																	<input id="CONSR" name="CONSR" type="text" value="<?=$D_CONSR?>" class="span2">
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="consr_mob" class="control-label">Mobile</label>
																<div class="controls">
																	<input type="text" name="CONSR_MOBILE" value="<?=$D_CONSR_MOBILE?>" id="CONSR_MOBILE" class="span2 ">
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="consr_email" class="control-label">Email</label>
																<div class="controls">
																	<input type="text" name="CONSR_EMAIL" value="<?=$D_CONSR_EMAIL?>" id="CONSR_EMAIL" class="span2">
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="delivery" class="control-label">Delivery AT</label>
																<div class="controls">
																	<select class="select span3 " id="DELIVERY_AT" name="DELIVERY_AT">
																		<?php
																			$sel1 = '';
																			$sel2 = '';
																			if($D_DELIVERY_AT == 'Branch')
																				$sel1 = 'selected';
																			else
																				$sel2 = 'selected';
																		?>
																		<option value="Branch" <?=$sel1?>>Branch</option>
																		<option value="Home Delivery" <?=$sel2?>>Home Delivery</option>
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
																	<input type="text" name="CONSE" value="<?=$D_CONSE?>" id="CONSE" class="span2">
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="conse_mob" class="control-label">Mobile</label>
																<div class="controls">
																	<input type="text" name="CONSE_MOBILE" value="<?=$D_CONSE_MOBILE?>" id="CONSE_MOBILE" class="span2 ">
																</div> 				
															</div>
															<div class="control-group">											
																<label for="consr_email" class="control-label">Address</label>
																<div class="controls">
																	<textarea name="CONSE_ADDRESS" id="CONSE_ADDRESS" class="span2"><?=$D_CONSE_ADDRESS?></textarea>
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="consr_email" class="control-label">Shipper</label>
																<div class="controls">
																	<input type="text" name="SHIPPER" value="<?=$D_SHIPPER?>" id="SHIPPER" class="span2 ">
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
																	<select class="select span3 " id="GOODS" name="GOODS">
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
																<label for="RATE" class="control-label">Charged Rate</label>
																<div class="controls">
																	<!--<input type="text" name="RATE" value="0" id="RATE" class="span2" onblur="frt_cal();">-->
																	<input type="text" name="CHARGED_RATE" value="<?=$D_CHARGED_RATE?>" id="CHARGED_RATE" class="span2">
																</div> 				
															</div>
														</fieldset>
													</div>
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="act_wgt" class="control-label">Volume <span style="font-size:10px;">(Per Cubic)</span></label>
																<div class="controls">
																	<input type="text" name="QUANTITY" value="<?=$D_QUANTITY?>" id="QUANTITY" class="span2" onblur="javascript:cal_rate();">
																</div> 				
															</div>
															<div class="control-group">											
																<label for="freight" class="control-label">Freight</label>
																<div class="controls">
																	<input type="text" name="FREIGHT" value="<?=$D_FREIGHT?>" id="FREIGHT" class="span2" onblur="javascript:cal_total();">
																</div> 				
															</div>
															<div class="control-group">											
																<label for="total" class="control-label">Total</label>
																<div class="controls">
																	<input type="text" name="TOTAL" value="<?=$D_TOTAL?>" id="TOTAL" class="span2 " readonly>
																</div> 				
															</div>
														</fieldset>
													</div>
												</div>
												<div class="widget-content">
												<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="instruction" class="control-label">Exp. Delivery Date</label>
																<div class="controls">
																	<input type="text" name="EXP_DEL_DATE" value="<?=$D_EXP_DEL_DATE?>" id="EXP_DEL_DATE" class="span2 tcal">
																</div> 				
															</div> 
														</fieldset>
													</div>
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="instruction" class="control-label">Remarks</label>
																<div class="controls">
																	<textarea name="REMARKS" id="REMARKS" class="span3"><?=$D_REMARKS?></textarea>
																</div> 				
															</div> 
														</fieldset>
													</div>
												</div>
												<div class="widget-content">
													<fieldset>
														<div class="form-actions">
															<input name="add" id="add" class="btn btn-primary" type="submit" value="Save">
															<input name="cancel" id="cancel" class="btn" type="reset" value="Cancel">
															<a href="print_lr.php?id=<?=$ID?>" class="btn btn-primary">Print</a>
															<!--<a href="pdf_lr.php?id=<?=$ID?>" class="btn btn-primary">Generate PDF LR</a>-->
															<a class="btn" href="list_lr.php">Back</a>
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
	$.ajax({
		url: 'rate.php',
		data: { 
				from_branch: from_branch,
				to_branch: to_branch,
				goods_id: goods_id,
				quantity: quantity
			},
		success: function(data) {
			$("#CHARGED_RATE").val(data);
			$("#TOTAL").val(data);
		}
	});
}

function cal_total(){
	var CHARGED_RATE = $("#CHARGED_RATE").val();
	var FREIGHT = $("#FREIGHT").val();
	var final_total = parseInt(CHARGED_RATE) + parseInt(FREIGHT);
	$("#TOTAL").val(final_total);
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
<?php
require_once 'footer.php';
?>