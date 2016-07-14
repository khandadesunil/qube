<?php
	require_once 'header.php';
	
	$msg = '';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	$action = isset($_REQUEST['edit']) ? $_REQUEST['edit'] : '';
	
	$sel_goods = "select * from city where ID = ". $ID;
	$res_goods = sqlsrv_query($conn, $sel_goods);
	$row_goods = sqlsrv_fetch_array($res_goods);
	$d_type = $row_goods['TYPE'];
	$d_name = $row_goods['NAME'];
	
	if($action != ''){
		$branch_type = $_REQUEST['type'];
		$branch_name = $_REQUEST['branch_name'];
		$sql = "update city SET TYPE = '" . $branch_type . "', NAME = '" . $branch_name . "' where ID = ". $ID;
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$d_type = $type;
			$d_name = $branch_name;
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Branch edited successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_branches.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not edit Branch!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
										<h3>Edit Branch</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<fieldset>
												<div class="control-group">											
													<label for="name" class="control-label">Branch Name</label>
													<div class="controls">
														<input type="text" name="branch_name" value="<?=$d_name?>" id="branch_name" class="span4 validate[required]">
													</div>
												</div>
												<div class="control-group">											
													<label for="type" class="control-label">Branch Type</label>
													<div class="controls">
														<select name="type" value="" id="type" class="span2 validate[required]">
															<?php
																$sel1 = '';
																$sel2 = '';
																$sel3 = '';
																if($d_type == 'BOOKING')
																	$sel1 = 'selected';
																if($d_type == 'DELIVERY')
																	$sel2 = 'selected';
																if($d_type == 'BOOKING-DELIVERY')
																	$sel3 = 'selected';
															?>
															<option value="BOOKING" <?=$sel1?>>Booking</option>
															<option value="DELIVERY" <?=$sel2?>>Delivery</option>
															<option value="BOOKING-DELIVERY" <?=$sel3?>>Both</option>
														</select>
													</div>
												</div>
												<div class="form-actions">
													<input name="edit" id="edit" class="btn btn-primary" type="submit" value="Save">
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