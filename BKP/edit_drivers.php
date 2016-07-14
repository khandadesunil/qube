<?php
	require_once 'header.php';
	
	$msg = '';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	$action = isset($_REQUEST['edit']) ? $_REQUEST['edit'] : '';
	
	$sel_driver = "select * from driver where ID = ". $ID;
	$res_driver = sqlsrv_query($conn, $sel_driver);
	$row_driver = sqlsrv_fetch_array($res_driver);
	
	$D_NAME = $row_driver['NAME'];
	$D_MOBILE = $row_driver['MOBILE'];
	$D_DL_NUMBER = $row_driver['DL_NUMBER'];
	$D_DL_EXP = date("d-m-Y", strtotime($row_driver['DL_EXP']));
	$D_CON_NAME = $row_driver['CON_NAME'];
	$D_CON_CONTACT = $row_driver['CON_CONTACT'];

	if($action != ''){
		$NAME = $_REQUEST['NAME'];
		$MOBILE = $_REQUEST['MOBILE'];
		$DL_NUMBER = $_REQUEST['DL_NUMBER'];
		$DL_EXP = date("Y-m-d", strtotime($_REQUEST['DL_EXP']));
		$CON_NAME = $_REQUEST['CON_NAME'];
		$CON_CONTACT = $_REQUEST['CON_CONTACT'];
		
		$D_NAME = $_REQUEST['NAME'];
		$D_MOBILE = $_REQUEST['MOBILE'];
		$D_DL_NUMBER = $_REQUEST['DL_NUMBER'];
		$D_DL_EXP = $_REQUEST['DL_EXP'];
		$D_CON_NAME = $_REQUEST['CON_NAME'];
		$D_CON_CONTACT = $_REQUEST['CON_CONTACT'];
		
		$sql = "update  driver SET NAME = '".$NAME."', MOBILE = '".$MOBILE."', DL_NUMBER = '".$DL_NUMBER."', DL_EXP = '".$DL_EXP."', CON_NAME = '".$CON_NAME."', 
									CON_CONTACT = '".$CON_CONTACT."' where ID = ". $ID;
		//echo $sql;
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Drivers updated successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_drivers.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not update Drivers!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
										<h3>Edit Drivers</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<div class="span12">
												<div class="widget-content">
													<fieldset>
														<div class="control-group">											
															<label for="name" class="control-label">Driver Name</label>
															<div class="controls">
																<input type="text" name="NAME" value="<?=$D_NAME?>" id="NAME" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="iname" class="control-label">Mobile</label>
															<div class="controls">
																<input type="text" name="MOBILE" value="<?=$D_MOBILE?>" id="MOBILE" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="doj" class="control-label">DL Number</label>
															<div class="controls">
																<input type="text" name="DL_NUMBER" value="<?=$D_DL_NUMBER?>" id="DL_NUMBER" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="mobile" class="control-label">DL Exp.</label>
															<div class="controls">
																<input type="text" name="DL_EXP" value="<?=$D_DL_EXP?>" id="DL_EXP" class="span2 tcal validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="mobile" class="control-label">Contact Person Name</label>
															<div class="controls">
																<input type="text" name="CON_NAME" value="<?=$D_CON_NAME?>" id="CON_NAME" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="mobile" class="control-label">Contact Person Name</label>
															<div class="controls">
																<input type="text" name="CON_CONTACT" value="<?=$D_CON_CONTACT?>" id="CON_CONTACT" class="span2 validate[required]">
															</div> 				
														</div> 
													</fieldset>
												</div>
												<div class="widget-content">
													<fieldset>
														<div class="form-actions">
															<input name="edit" id="edit" class="btn btn-primary" type="submit" value="Save">
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