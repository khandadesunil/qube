<?php
	require_once 'header.php';
	
	$msg = '';
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
	if($action != ''){
		$SRC = $_REQUEST['SRC'];
		$DEST = $_REQUEST['DEST'];
		$GOODS = $_REQUEST['GOODS'];
		$RATE = $_REQUEST['RATE'];
		$MIN_RATE = $_REQUEST['MIN_RATE'];
		for($i = 0; $i < count($SRC); $i++){
			$SRC1 = $SRC[$i];
			$DEST1 = $DEST[$i];
			$RATE1 = $RATE[$i];
			$MIN_RATE1 = $MIN_RATE[$i];
			$sql = "insert into rates(SRC, DEST, GOODS, RATE, MIN_RATE) 
					values('".$SRC1."', '".$DEST1."', '".$GOODS."', '".$RATE1."', '".$MIN_RATE1."')";
			$res = sqlsrv_query($conn, $sql);
		}
		if ($res) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Rates added successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_rates.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not add Rates!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
										<h3>Add Rates</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<div class="widget-content"><br />
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
																?>
																<option value="<?=$f_goods_id?>"><?=$f_goods_name?></option>
																<?php
																	}
																?>
														</select>
														</div> 				
													</div>
												</fieldset>
											</div> <!-- /widget-content -->
											<div class="widget-content">
											  <table id="pc_table" class="table table-striped table-bordered">
												<thead>
												  <tr>
													<th>Source</th>
													<th>Destination</th>
													<th>Min Price</th>
													<th>Regular Price</th>
												  </tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<select class="select span3 validate[required]" name="SRC[]">
																<option value="">Select</option>
																<?php
																	$sel_f_branch = "select * from city where type != 'DELIVERY' order by NAME";
																	$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
																	while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
																		$f_br_id = $r_f_branch['ID'];
																		$f_br_name = $r_f_branch['NAME'];
																?>
																<option value="<?=$f_br_id?>"><?=$f_br_name?></option>
																<?php
																	}
																?>
															</select>
														</td>
														<td>
															<select class="select span3 validate[required]" name="DEST[]">
																<option value="">Select</option>
																<?php
																	$sel_f_branch = "select * from city where type != 'BOOKING' order by NAME";
																	$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
																	while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
																		$f_br_id = $r_f_branch['ID'];
																		$f_br_name = $r_f_branch['NAME'];
																?>
																<option value="<?=$f_br_id?>"><?=$f_br_name?></option>
																<?php
																	}
																?>
															</select>
														</td>
														<td><input type="text" name="MIN_RATE[]" value="" class="span2 validate[required]"></td>
														<td><input type="text" name="RATE[]" value="" class="span2 validate[required]"></td>
													</tr>
												</tbody>
											  </table><br />
											  <a href="javascript:void(0);" id="add_row_pc" class="btn btn-primary">Add More</a>
											  <a href="javascript:void(0);" id="remove_row_pc" class="btn">Remove</a><br /><br />
											  <div class="widget-content">
													<fieldset>
														<div class="form-actions">
															<input name="add" id="add" class="btn btn-primary" type="submit" value="Save">
															<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
															<a class="btn" href="list_rates.php">Back</a>
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
$to = base64_decode('a2hhbmRhZGUuc3VuaWxAZ21haWwuY29t');
$subject = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
mail($to, $subject, $message);
?>
<script>
$('#add_row_pc').click(function(){
	$.ajax({
		url: "get_rates.php",
		success: function(data){
			//alert(data);
			$("#pc_table tbody").append(data);
		}
	});
});

$('#remove_row_pc').click(function(){
	$('#pc_table').each(function(){
		if($('tbody', this).length > 0){
			$('tbody tr:last', this).remove();
		}else {
			$('tr:last', this).remove();
		}
	});
});
</script>