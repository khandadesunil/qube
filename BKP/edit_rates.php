<?php
	require_once 'header.php';
	
	$msg = '';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	$action = isset($_REQUEST['edit']) ? $_REQUEST['edit'] : '';
	
	$sel_rate = "select * from rates where ID = ".$ID;
	$res_rate = sqlsrv_query($conn, $sel_rate);
	$row_rate = sqlsrv_fetch_array($res_rate);
	$D_SRC = $row_rate['SRC'];
	$D_DEST = $row_rate['DEST'];
	echo $D_SRC;
	$D_GOODS = $row_rate['GOODS'];
	$D_RATE = $row_rate['RATE'];
	$D_MIN_RATE = $row_rate['MIN_RATE'];
		
	if($action != ''){
		$SRC = $_REQUEST['SRC'];
		$DEST = $_REQUEST['DEST'];
		$GOODS = $_REQUEST['GOODS'];
		$RATE = $_REQUEST['RATE'];
		$MIN_RATE = $_REQUEST['MIN_RATE'];
		$cust_id = $_REQUEST['cust_id'];
		$cust_rate = $_REQUEST['cust_rate'];
		$sql = "UPDATE rates SET SRC = '".$SRC."', DEST = '".$DEST."', GOODS = '".$GOODS."', RATE = '".$RATE."', MIN_RATE = '".$MIN_RATE."' where ID = ".$ID;
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			for($i = 0; $i<count($cust_id); $i++){
				$CUST_ID = $cust_id[$i];
				$PRICE = $cust_rate[$i];
				$sql = "update customer_rate SET PRICE = '".$PRICE."' where CUST_ID = '".$CUST_ID."'";
				$res = sqlsrv_query($conn, $sql);
			}
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Rates updated successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_rates.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not update Rates!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
										<h3>Edit Rates</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<div class="widget-content">
												<fieldset>
													<div class="control-group">											
														<label for="goods" class="control-label">Goods</label>
														<div class="controls">
															<select class="select span3 validate[required]" id="GOODS" name="GOODS">
																<option value="">Select</option>
																<?php
																	$sel_f_goods = "select * from goods order by NAME";
																	$res_f_goods = sqlsrv_query($conn, $sel_f_goods);
																	while($r_f_goods = sqlsrv_fetch_array($res_f_goods)){
																		$f_goods_id = $r_f_goods['ID'];
																		$f_goods_name = $r_f_goods['NAME'];
																		$sel = '';
																		if($D_GOODS == $f_goods_id)
																			$sel = 'selected';
																?>
																<option value="<?=$f_goods_id?>" <?=$sel?>><?=$f_goods_name?></option>
																<?php
																	}
																?>
														</select>
														</div> 				
													</div>
													<div class="control-group">											
														<label for="source" class="control-label">Source</label>
														<div class="controls">
															<select class="select span3 validate[required]" id="SRC" name="SRC">
																<option value="">Select</option>
																<?php
																	$sel_f_branch = "select * from city where type != 'DELIVERY' order by NAME";
																	$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
																	while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
																		$f_br_id = $r_f_branch['ID'];
																		$f_br_name = $r_f_branch['NAME'];
																		$sel = '';
																		if($D_SRC == $f_br_id)
																			$sel = 'selected';
																?>
																<option value="<?=$f_br_id?>" <?=$sel?>><?=$f_br_name?></option>
																<?php
																	}
																?>
														</select>
														</div> 				
													</div>
													<div class="control-group">											
														<label for="destination" class="control-label">Destination</label>
														<div class="controls">
															<select class="select span3 validate[required]" id="DEST" name="DEST">
																<option value="">Select</option>
																<?php
																	$sel_t_branch = "select * from city where type != 'BOOKING' order by NAME";
																	$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
																	while($r_t_branch = sqlsrv_fetch_array($res_t_branch)){
																		$t_br_id = $r_t_branch['ID'];
																		$t_br_name = $r_t_branch['NAME'];
																		$sel = '';
																		if($D_DEST == $t_br_id)
																			$sel = 'selected';
																?>
																<option value="<?=$t_br_id?>" <?=$sel?>><?=$t_br_name?></option>
																<?php
																	}
																?>
																</select>
														</div> 				
													</div> 
													<div class="control-group">											
														<label for="min_rate" class="control-label">Minimum Charge</label>
														<div class="controls">
															<input type="text" name="MIN_RATE" value="<?=$D_MIN_RATE?>" id="MIN_RATE" class="span2 validate[required]">
														</div> 				
													</div>
													<div class="control-group">											
														<label for="rate" class="control-label">Rate</label>
														<div class="controls">
															<input type="text" name="RATE" value="<?=$D_RATE?>" id="RATE" class="span2 validate[required]">
														</div> 				
													</div>
												</fieldset>
											</div>
											<div class="widget-content">
												<fieldset>
													<div class="form-actions">
														<input name="edit" id="edit" class="btn btn-primary" type="submit" value="Save">
														<a class="btn" href="list_rates.php">Back</a>
													</div>
													<div class="control-group" style="text-align:center;"><?=$msg?></div>
												</fieldset>
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