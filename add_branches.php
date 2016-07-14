<?php
	require_once 'header.php';
	
	$msg = '';
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
	if($action != ''){
		$branch_type = $_REQUEST['branch_type'];
		$branch_name = $_REQUEST['branch_name'];
		$sql = "insert into city(TYPE, NAME) 
					values('" . $branch_type . "', '" . $branch_name . "')";
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Branch added successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_branches.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Could not add Branch!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
										<h3>Add Branch</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<fieldset>
												<div class="control-group">											
													<label for="name" class="control-label">Branch Name</label>
													<div class="controls">
														<input type="text" name="branch_name" value="" id="branch_name" class="span4 validate[required]">
													</div>
												</div>
												<div class="control-group">											
													<label for="branch_type" class="control-label">Branch Type</label>
													<div class="controls">
														<select name="branch_type" value="" id="branch_type" class="span2 validate[required]">
															<option value="BOOKING">Boooking</option>
															<option value="DELIVERY">Delivery</option>
															<option value="BOOKING-DELIVERY">Both</option>
														</select>
													</div>
												</div>
												<div class="form-actions">
													<input name="add" id="add" class="btn btn-primary" type="submit" value="Add">
													<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
													<a class="btn" href="list_branches.php">Back</a>
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