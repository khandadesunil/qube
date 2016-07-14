<?php
	require_once 'header.php';
	
	$msg = '';
	$action = isset($_REQUEST['change']) ? $_REQUEST['change'] : '';
	if($action != ''){
		$USER_NAME = $_REQUEST['USER_NAME'];
		$PASSWORD = $_REQUEST['PASSWORD'];
		$NEW_PASSWORD = $_REQUEST['NEW_PASSWORD'];
		
		$sel_user = "select * from users where USER_NAME = '".$USER_NAME."' AND PASSWORD = '".md5($PASSWORD)."'";
		$res_user = sqlsrv_query($conn, $sel_user);
		$num_row = sqlsrv_num_rows($res_user);
		
		if($num_row > 0){
			$sql = "update users set PASSWORD = '".md5($NEW_PASSWORD)."' where USER_NAME = '".$USER_NAME."'";
			$res = sqlsrv_query($conn, $sql);
			if ($res) {
				$msg = '<div style="color:green;">Password changeed successfully!!</div>';
			}
		}else {
			$msg = '<div style="color:red;">Sorry!! Could not change Password!!</div>';
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
						<script>$(document).ready(function(){ $("#menu2").changeClass(" active");});</script>
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Change Password</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<fieldset>
												<div class="control-group">											
													<label for="CODE" class="control-label">User Name</label>
													<div class="controls">
														<input type="text" name="USER_NAME" value="<?=$sess_user_name?>" id="USER_NAME" class="span2" readonly>
													</div> 				
												</div> 
												<div class="control-group">											
													<label for="name" class="control-label">Old Password</label>
													<div class="controls">
														<input type="password" name="PASSWORD" value="" id="PASSWORD" class="span2 validate[required]">
													</div> 				
												</div> 
												<div class="control-group">											
													<label for="changeress" class="control-label">New Password</label>
													<div class="controls">
														<input type="password" name="NEW_PASSWORD" value="" id="NEW_PASSWORD" class="span2 validate[required]">
													</div> 				
												</div> 
												<div class="form-actions">
													<input name="change" id="change" class="btn btn-primary" type="submit" value="Change Password">
													<input name="cancel" id="cancel" class="btn" type="reset" value="Cancel">
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