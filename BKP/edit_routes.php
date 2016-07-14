<?php
	require_once 'header.php';
	
	$msg = '';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	
	$sel_route = "select * from route where ID = ".$ID;
	$res_route = sqlsrv_query($conn, $sel_route);
	$row_route = sqlsrv_fetch_array($res_route);
	$D_SOURCE = $row_route['SOURCE'];
	$D_DESTINATION = $row_route['DESTINATION'];
	$D_TYPE = $row_route['TYPE'];
	$D_VIA = $row_route['VIA'];
	$D_VIA = explode(",", $D_VIA);
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
	
	if($action != ''){
		$SOURCE = $_REQUEST['SOURCE'];
		$DESTINATION = $_REQUEST['DESTINATION'];
		$TYPE = $_REQUEST['TYPE'];
		$VIA = $_REQUEST['VIA'];
		$v = '';
		foreach($VIA as $r_via){
			$v .= $r_via.',';
		}
		$VIA  = rtrim($v, ',');
		$sql = "update route set SOURCE = '".$SOURCE."', DESTINATION = '".$DESTINATION."', TYPE = '".$TYPE."', VIA = '".$VIA."' where ID = ".$ID;
		//echo $sql;
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Route updated successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_routes.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not update Route!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			$msg = '<div style="color:red;">!</div>';
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
										<h3>Edit Route</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<div class="span12">
												<div class="widget-content">
													<div class="span1">
														<fieldset>
															<div class="control-group">											
																<label for="veh_num" class="control-label">Source</label>
																<div class="controls">
																	<select id="SOURCE" name="SOURCE" class="span3 validate[required]">
																		<?php
																			$sel_f_branch = "select * from city where type != 'DELIVERY' order by NAME";
																			$res_f_branch = sqlsrv_query($sel_f_branch);
																			while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
																				$f_br_id = $r_f_branch['ID'];
																				$f_br_name = $r_f_branch['NAME'];
																				$sel = '';
																				if($f_br_id == $D_SOURCE)
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
																<label for="veh_name" class="control-label">Destination</label>
																<div class="controls">
																	<select id="DESTINATION" name="DESTINATION" class="span3 validate[required]">
																		<?php
																			$sel_f_branch = "select * from city where type != 'BOOKING' order by NAME";
																			$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
																			while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
																				$f_br_id = $r_f_branch['ID'];
																				$f_br_name = $r_f_branch['NAME'];
																				$sel = '';
																				if($f_br_id == $D_DESTINATION)
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
																<label for="veh_class" class="control-label">Type</label>
																<div class="controls">
																	<select class="select span3 " id="TYPE" name="TYPE" class="span2 validate[required]" onchange="route_type();">
																		<?php
																			$sel1 = '';
																			$sel2 = '';
																			if($D_TYPE == 'VIA')
																				$sel2 = 'selected';
																			else
																				$sel1 = 'selected';
																		?>
																		<option value="DIRECT" <?=$sel1?>>Direct</option>
																		<option value="VIA" <?=$sel2?>>Via</option>
																	</select>
																</div> 				
															</div> 
															<div class="control-group" id="viatype">											
																<label for="model" class="control-label">Via <span style="font-size:10px;"><strong>(Ex. Delhi, Agara etc..)</strong></span></label>
																<div class="controls">
																	
																	<select multiple class="select span3 " id="VIA" name="VIA[]" class="span2 validate[required]" style="height:300px;">
																		<?php
																			$sel_f_branch = "select * from city order by NAME";
																			$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
																			while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
																				$f_br_id = $r_f_branch['ID'];
																				$f_br_name = $r_f_branch['NAME'];
																				$sel = '';
																				if(in_array($f_br_id, $D_VIA)) 
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
																<input name="add" id="add" class="btn btn-primary" type="submit" value="Save">
																<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
																<a class="btn" href="list_routes.php">Back</a>
															</div>
															<div class="control-group" style="text-align:center;"><?=$msg?></div>
														</fieldset>	
													</div>
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
<script>
var via1 = $("#TYPE option:selected").val();
if(via1 == 'DIRECT'){	
	$("#viatype").hide();
}
	
function route_type(){
	var via = $("#TYPE option:selected").val();
	if(via == 'DIRECT'){	
		$("#viatype").hide();
	}else{
		$("#viatype").show();
	}	
}
</script>