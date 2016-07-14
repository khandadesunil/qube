<?php
	require_once 'header.php';
	
	$msg = '';
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
	if($action != ''){
		$USER_NAME = $_REQUEST['USER_NAME'];
		$PASSWORD = md5($_REQUEST['USER_NAME']);
		$FIRST_NAME = $_REQUEST['FIRST_NAME'];
		$LAST_NAME = $_REQUEST['LAST_NAME'];
		$EMAIL = $_REQUEST['EMAIL'];
		$FOR_BRANCH = $_REQUEST['FOR_BRANCH'];
		$TYPE = $_REQUEST['TYPE'];
		$sql = "insert into users(USER_NAME, PASSWORD, FIRST_NAME, LAST_NAME, EMAIL, FOR_BRANCH, TYPE) 
					values('".$USER_NAME."', '".$PASSWORD."', '".$FIRST_NAME."', '".$LAST_NAME."', '".$EMAIL."', '".$FOR_BRANCH."', '".$TYPE."')";
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">User added successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_users.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not add User!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
										<h3>Add User</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<fieldset>
												<div class="control-group">											
													<label for="name" class="control-label">User Name</label>
													<div class="controls">
														<input type="text" name="USER_NAME" value="" id="USER_NAME" class="span4 validate[required]">
													</div>
												</div>
												<div class="control-group">											
													<label for="name" class="control-label">First Name</label>
													<div class="controls">
														<input type="text" name="FIRST_NAME" value="" id="FIRST_NAME" class="span4 validate[required]">
													</div>
												</div>
												<div class="control-group">											
													<label for="name" class="control-label">Last Name</label>
													<div class="controls">
														<input type="text" name="LAST_NAME" value="" id="LAST_NAME" class="span4 validate[required]">
													</div>
												</div>
												<div class="control-group">											
													<label for="name" class="control-label">Email</label>
													<div class="controls">
														<input type="text" name="EMAIL" value="" id="EMAIL" class="span4 validate[required]">
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
																	echo '<option value="'.$ID.'">'.$FOR_BRANCH.'</option>';
																}
															?>
														</select>
													</div>
												</div>
												<div class="control-group">											
													<label for="TYPE" class="control-label">User Type</label>
													<div class="controls">
														<select name="TYPE" value="" id="TYPE" class="span2 validate[required]">
															<option value="USER">User</option>
															<option value="ADMIN">Admin</option>
															<option value="READONLY">Readonly</option>
														</select>
													</div>
												</div>
												<div class="form-actions">
													<input name="add" id="add" class="btn btn-primary" type="submit" value="Add">
													<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
													<a class="btn" href="list_users.php">Back</a>
												</div>
												<div class="control-group" style="text-align:center;"><?=$msg?></div>
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