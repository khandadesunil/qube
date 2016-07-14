<?php
	require_once 'header.php';
	
	$msg = '';
	$action = isset($_REQUEST['edit']) ? $_REQUEST['edit'] : '';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	
	$sel_customer = "select * from customer where ID = ".$ID;
	$res_customer = sqlsrv_query($conn, $conn, $conn, $sel_customer);
	$row_cust = sqlsrv_fetch_array($res_customer);
	
	$B_CONSIGN_NAME = $row_cust['CONSIGN_NAME'];
	$B_ALIAS_NAME = $row_cust['ALIAS_NAME'];
	$B_ADDRESS = $row_cust['ADDRESS'];
	$B_CITY = $row_cust['CITY'];
	$B_PINCODE = $row_cust['PINCODE'];
	$B_PHONE = $row_cust['PHONE'];
	$B_FAX = $row_cust['FAX'];
	$B_MOBILE = $row_cust['MOBILE'];
	$B_EMAIL = $row_cust['EMAIL'];
	$B_WEBSITE = $row_cust['WEBSITE'];
	$B_CON_NAME = $row_cust['CON_NAME'];
	$B_CON_DESIGNATION = $row_cust['CON_DESIGNATION'];
	$B_CON_MOBILE = $row_cust['CON_MOBILE'];
	$B_CON_EMAIL = $row_cust['CON_EMAIL'];
	$B_TIN = $row_cust['TIN'];
	$B_PAN = $row_cust['PAN'];
	$B_CST = $row_cust['CST'];
	
	if($action != ''){
		$CONSIGN_NAME = $_REQUEST['CONSIGN_NAME'];
		$ALIAS_NAME = $_REQUEST['ALIAS_NAME'];
		$ADDRESS = $_REQUEST['ADDRESS'];
		$CITY = $_REQUEST['CITY'];
		$PINCODE = $_REQUEST['PINCODE'];
		$PHONE = $_REQUEST['PHONE'];
		$FAX = $_REQUEST['FAX'];
		$MOBILE = $_REQUEST['MOBILE'];
		$EMAIL = $_REQUEST['EMAIL'];
		$WEBSITE = $_REQUEST['WEBSITE'];
		$CON_NAME = $_REQUEST['CON_NAME'];
		$CON_DESIGNATION = $_REQUEST['CON_DESIGNATION'];
		$CON_MOBILE = $_REQUEST['CON_MOBILE'];
		$CON_EMAIL = $_REQUEST['CON_EMAIL'];
		$TIN = $_REQUEST['TIN'];
		$PAN = $_REQUEST['PAN'];
		$CST = $_REQUEST['CST'];
		
		$B_CONSIGN_NAME = $_REQUEST['CONSIGN_NAME'];
		$B_ALIAS_NAME = $_REQUEST['ALIAS_NAME'];
		$B_ADDRESS = $_REQUEST['ADDRESS'];
		$B_CITY = $_REQUEST['CITY'];
		$B_PINCODE = $_REQUEST['PINCODE'];
		$B_PHONE = $_REQUEST['PHONE'];
		$B_FAX = $_REQUEST['FAX'];
		$B_MOBILE = $_REQUEST['MOBILE'];
		$B_EMAIL = $_REQUEST['EMAIL'];
		$B_WEBSITE = $_REQUEST['WEBSITE'];
		$B_CON_NAME = $_REQUEST['CON_NAME'];
		$B_CON_DESIGNATION = $_REQUEST['CON_DESIGNATION'];
		$B_CON_MOBILE = $_REQUEST['CON_MOBILE'];
		$B_CON_EMAIL = $_REQUEST['CON_EMAIL'];
		$B_TIN = $_REQUEST['TIN'];
		$B_PAN = $_REQUEST['PAN'];
		$B_CST = $_REQUEST['CST'];
		
		$sql = "update customer set CONSIGN_NAME = '".$CONSIGN_NAME."', ALIAS_NAME = '".$ALIAS_NAME."', ADDRESS = '".$ADDRESS."', 
									CITY = '".$CITY."', PINCODE = '".$PINCODE."', PHONE = '".$PHONE."', FAX = '".$FAX."', MOBILE = '".$MOBILE."', 
									EMAIL = '".$EMAIL."', WEBSITE = '".$WEBSITE."',
									CON_NAME = '".$CON_NAME."', CON_DESIGNATION = '".$CON_DESIGNATION."', CON_MOBILE = '".$CON_MOBILE."', CON_EMAIL = '".$CON_EMAIL."', 
									TIN = '".$TIN."', PAN = '".$PAN."', CST = '".$CST."' where ID = ".$ID;
		$res = sqlsrv_query($conn, $conn, $conn, $sql);
		if ($res) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Client edited successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_customers.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not add Client!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
</style>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<script>$(document).ready(function(){ $("#menu2").addClass(" active");});</script>
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Edit Client</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<div class="span5">
												<div class="widget-content">
													<fieldset>
														<div class="control-group">											
															<label for="cname" class="control-label">Consignor Name</label>
															<div class="controls">
																<input type="text" name="CONSIGN_NAME" value="<?=$B_CONSIGN_NAME?>" id="CONSIGN_NAME" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="aname" class="control-label">Alias Name</label>
															<div class="controls">
																<input type="text" name="ALIAS_NAME" value="<?=$B_ALIAS_NAME?>" id="ALIAS_NAME" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="address" class="control-label">Address</label>
															<div class="controls">
																<textarea name="ADDRESS" id="ADDRESS" class="span3 validate[required]"><?=$B_ADDRESS?></textarea>
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="city" class="control-label">City</label>
															<div class="controls">
																<select class="select span3 validate[required]" id="CITY" name="CITY">
																	<option value="">-Select-</option>
																	<?php
																		$sel_state = "select * from city order by NAME";
																		$res_state = sqlsrv_query($conn, $conn, $conn, $sel_state);
																		while($r_state = sqlsrv_fetch_array($res_state)){
																			$f_st_id = $r_state['ID'];
																			$f_st_name = $r_state['NAME'];
																			$sel = '';
																			if($B_CITY == $f_st_id)
																				$sel = 'selected';
																	?>
																	<option value="<?=$f_st_id?>" <?=$sel?>><?=$f_st_name?></option>
																	<?php
																		}
																	?>
																</select>
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="pincode" class="control-label">Pincode</label>
															<div class="controls">
																<input type="text" name="PINCODE" value="<?=$B_PINCODE?>" id="PINCODE" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="phone" class="control-label">Phone</label>
															<div class="controls">
																<input type="text" name="PHONE" value="<?=$B_PHONE?>" id="PHONE" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="fax" class="control-label">Fax</label>
															<div class="controls">
																<input type="text" name="FAX" value="<?=$B_FAX?>" id="FAX" class="span2">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="mobile" class="control-label">Mobile</label>
															<div class="controls">
																<input type="text" name="MOBILE" value="<?=$B_MOBILE?>" id="MOBILE" class="span2">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="email" class="control-label">Office Email</label>
															<div class="controls">
																<input type="text" name="EMAIL" value="<?=$B_EMAIL?>" id="EMAIL" class="span2">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="web" class="control-label">Website</label>
															<div class="controls">
																<input type="text" name="WEBSITE" value="<?=$B_WEBSITE?>" id="WEBSITE" class="span2">
															</div> 				
														</div> 
													</fieldset>
												</div>
											</div>
											<div class="span5">
												<div class="widget-content">
													<fieldset>
														<div class="control-group">											
															<label for="con_name" class="control-label">Contact Name</label>
															<div class="controls">
																<input type="text" name="CON_NAME" value="<?=$B_CON_NAME?>" id="CON_NAME" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="con_des" class="control-label">Contact Designation</label>
															<div class="controls">
																<input type="text" name="CON_DESIGNATION" value="<?=$B_CON_DESIGNATION?>" id="CON_DESIGNATION" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="con_mob" class="control-label">Contact Mobile</label>
															<div class="controls">
																<input type="text" name="CON_MOBILE" value="<?=$B_CON_MOBILE?>" id="CON_MOBILE" class="span2 validate[required]">
															</div> 					
														</div> 
														<div class="control-group">											
															<label for="con_email" class="control-label">Personal Email</label>
															<div class="controls">
																<input type="text" name="CON_EMAIL" value="<?=$B_CON_EMAIL?>" id="CON_EMAIL" class="span2 validate[required]">
															</div> 					
														</div> 
													</fieldset>
												</div>
												<div class="widget-content">
													<fieldset>
														<div class="control-group">											
															<label for="tin" class="control-label">TIN</label>
															<div class="controls">
																<input type="text" name="TIN" value="<?=$B_TIN?>" id="TIN" class="span2">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="pan" class="control-label">PAN</label>
															<div class="controls">
																<input type="text" name="PAN" value="<?=$B_PAN?>" id="PAN" class="span2">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="cst" class="control-label">CST Number</label>
															<div class="controls">
																<input type="text" name="CST" value="<?=$B_CST?>" id="CST" class="span2">
															</div> 					
														</div> 
													</fieldset>
												</div>
											</div>
											<div class="span12">
												<div class="widget-content">
													<fieldset>
														<div class="form-actions">
															<input name="edit" id="edit" class="btn btn-primary" type="submit" value="Save">
															<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
															<a class="btn" href="list_customers.php">Back</a>
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
<?php
require_once 'footer.php';
?>