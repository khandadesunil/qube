<?php
	require_once 'header.php';
	
	$msg = '';
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
	if($action != ''){
		$NAME = $_REQUEST['NAME'];
		$MOBILE = $_REQUEST['MOBILE'];
		$DL_NUMBER = $_REQUEST['DL_NUMBER'];
		$DL_EXP = $_REQUEST['DL_EXP'];
		$CON_NAME = $_REQUEST['CON_NAME'];
		$CON_CONTACT = $_REQUEST['CON_CONTACT'];
		$sql = "insert into driver(NAME, MOBILE, DL_NUMBER, DL_EXP, CON_NAME, CON_CONTACT) 
					values('".$NAME."', '".$MOBILE."', '".$DL_NUMBER."', '".$DL_EXP."', '".$CON_NAME."', '".$CON_CONTACT."')";
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Drivers added successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_drivers.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not add Drivers!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
										<h3>Add Drivers</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<div class="span12">
												<div class="widget-content">
													<fieldset>
														<div class="control-group">											
															<label for="name" class="control-label">Driver Name</label>
															<div class="controls">
																<input type="text" name="NAME" value="" id="NAME" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="iname" class="control-label">Mobile</label>
															<div class="controls">
																<input type="text" name="MOBILE" value="" id="MOBILE" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="doj" class="control-label">DL Number</label>
															<div class="controls">
																<input type="text" name="DL_NUMBER" value="" id="DL_NUMBER" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="mobile" class="control-label">DL Expiry</label>
															<div class="controls">
																<input type="text" name="DL_EXP" value="" id="DL_EXP" class="span2 tcal validate[required]">
															</div> 				
														</div>  
														<div class="control-group">											
															<label for="mobile" class="control-label">Emergency Contact Name</label>
															<div class="controls">
																<input type="text" name="CON_NAME" value="" id="CON_NAME" class="span2 validate[required]">
															</div> 				
														</div>  
														<div class="control-group">											
															<label for="mobile" class="control-label">Emergency Contact Number</label>
															<div class="controls">
																<input type="text" name="CON_CONTACT" value="" id="CON_CONTACT" class="span2 validate[required]">
															</div> 				
														</div> 
													</fieldset>
												</div>
												<div class="widget-content">
													<fieldset>
														<div class="form-actions">
															<input name="add" id="add" class="btn btn-primary" type="submit" value="Add">
															<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
															<a class="btn" href="list_drivers.php">Back</a>
														</div>
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