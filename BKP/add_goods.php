<?php
	require_once 'header.php';
	
	$msg = '';
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
	if($action != ''){
		$code = $_REQUEST['code'];
		$goods_name = $_REQUEST['goods_name'];
		$sql = "insert into goods(CODE, NAME) 
					values('" . $code . "', '" . $goods_name . "')";
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$msg = '<div style="color:green;">!</div>';
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Commodity added successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_goods.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not add Commodity!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
										<h3>Add Commodity</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<fieldset>
												<div class="control-group">											
													<label for="code" class="control-label">Good Code</label>
													<div class="controls">
														<input type="text" name="code" value="" id="code" class="span2 validate[required]">
													</div>
												</div>
												<div class="control-group">											
													<label for="name" class="control-label">Good Name</label>
													<div class="controls">
														<input type="text" name="goods_name" value="" id="goods_name" class="span4 validate[required]">
													</div>
												</div>
												<div class="form-actions">
													<input name="add" id="add" class="btn btn-primary" type="submit" value="Add">
													<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
													<a class="btn" href="list_goods.php">Back</a>
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