<?php
	require_once 'header.php';
	
	$msg = '';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	
	$sel_user = "select * from users where USER_ID = ". $ID;
	$res_user = sqlsrv_query($conn, $sel_user);
	$row_user = sqlsrv_fetch_array($res_user);
	$D_USER_NAME = $row_user['USER_NAME'];
	$D_FIRST_NAME = $row_user['FIRST_NAME'];
	$D_LAST_NAME = $row_user['LAST_NAME'];
	$D_EMAIL = $row_user['EMAIL'];
	$D_FOR_BRANCH = $row_user['FOR_BRANCH'];
	$D_TYPE = $row_user['TYPE'];
	
	$action = isset($_REQUEST['edit']) ? $_REQUEST['edit'] : '';
	if($action != ''){
		$USER_NAME = $_REQUEST['USER_NAME'];
		$PASSWORD = md5($_REQUEST['USER_NAME']);
		$FIRST_NAME = $_REQUEST['FIRST_NAME'];
		$LAST_NAME = $_REQUEST['LAST_NAME'];
		$EMAIL = $_REQUEST['EMAIL'];
		$FOR_BRANCH = $_REQUEST['FOR_BRANCH'];
		$TYPE = $_REQUEST['TYPE'];
		$sql = "update users SET USER_NAME = '".$USER_NAME."', FIRST_NAME = '".$FIRST_NAME."', LAST_NAME = '".$LAST_NAME."', EMAIL = '".$EMAIL."', 
				FOR_BRANCH = '".$FOR_BRANCH."', TYPE = '".$TYPE."' where USER_ID = ".$ID;
		//echo $sql;
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">User edited successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_users.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not edit User!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		}
	}
?>
<script>
	jQuery(document).ready(function(){
		jQuery("#submit_form").validationEngine();
	});
</script>
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
										<h3>Edit User</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<fieldset>
												<div class="control-group">											
													<label for="name" class="control-label">User Name</label>
													<div class="controls">
														<input type="text" name="USER_NAME" value="<?=$D_USER_NAME?>" id="USER_NAME" class="span4 validate[required]" readonly>
													</div>
												</div>
												<div class="control-group">											
													<label for="name" class="control-label">First Name</label>
													<div class="controls">
														<input type="text" name="FIRST_NAME" value="<?=$D_FIRST_NAME?>" id="FIRST_NAME" class="span4 validate[required]">
													</div>
												</div>
												<div class="control-group">											
													<label for="name" class="control-label">Last Name</label>
													<div class="controls">
														<input type="text" name="LAST_NAME" value="<?=$D_LAST_NAME?>" id="LAST_NAME" class="span4 validate[required]">
													</div>
												</div>
												<div class="control-group">											
													<label for="name" class="control-label">Email</label>
													<div class="controls">
														<input type="text" name="EMAIL" value="<?=$D_EMAIL?>" id="EMAIL" class="span4 validate[required]">
													</div>
												</div>
												<div class="control-group">											
													<label for="TYPE" class="control-label">For Branch</label>
													<div class="controls">
														<select name="FOR_BRANCH" value="" id="FOR_BRANCH" class="span4 validate[required]">
															<option value="">Select</option>
															<?php	
																$sel_city = "select * from city where STATUS = 'A' ORDER BY NAME";
																$res_city = sqlsrv_query($conn, $sel_city);
																while($row_city = sqlsrv_fetch_array($res_city)){
																$ID = $row_city['ID'];
																$FOR_BRANCH = $row_city['NAME'];
																	$sel = '';
																	if($ID == $D_FOR_BRANCH)
																		$sel = 'selected';
																	echo '<option value="'.$ID.'" '.$sel.'>'.$FOR_BRANCH.'</option>';
																}
															?>
														</select>
													</div>
												</div>
												<div class="control-group">											
													<label for="TYPE" class="control-label">User Type</label>
													<div class="controls">
														<select name="TYPE" value="" id="TYPE" class="span2 validate[required]">
															<?php
																$sel1 = '';
																$sel2 = '';
																$sel3 = '';
																if($D_TYPE == 'USER')
																	$sel1 = 'selected';
																else if($D_TYPE == 'ADMIN')
																	$sel2 = 'selected';	
																else if($D_TYPE == 'READONLY')
																	$sel3 = 'selected';	
															?>
															<option value="USER" <?=$sel1?>>User</option>
															<option value="ADMIN" <?=$sel2?>>Admin</option>
															<option value="READONLY" <?=$sel3?>>Readonly</option>
														</select>
													</div>
												</div>
												<div class="form-actions">
													<input name="edit" id="edit" class="btn btn-primary" type="submit" value="Save">
													<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
													<a class="btn" href="list_users.php">Back</a>
												</div>
											</fieldset>
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