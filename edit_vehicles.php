<?php
	require_once 'header.php';
	
	$msg = '';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	$action = isset($_REQUEST['edit']) ? $_REQUEST['edit'] : '';
	
	$sel_veh = "select * from vehicle where ID = ".$ID;
	$res_veh = sqlsrv_query($conn, $sel_veh);
	$row_veh = sqlsrv_fetch_array($res_veh);
	
	$D_VEH_NUMBER = $row_veh['VEH_NUMBER'];
	$D_VEH_NAME = $row_veh['VEH_NAME'];
	$D_VEH_CLASS = $row_veh['VEH_CLASS'];
	$D_MODEL = $row_veh['MODEL'];
	$D_PURCHASE_MODE = $row_veh['PURCHASE_MODE'];
	$D_PURCHASE_YEAR = $row_veh['PURCHASE_YEAR'];
	$D_OWN_TYPE = $row_veh['OWN_TYPE'];
	$D_OWNER_NAME = $row_veh['OWNER_NAME'];
	$D_ENGINE_NUMBER = $row_veh['ENGINE_NUMBER'];
	$D_CHASIS_NUMBER = $row_veh['CHASIS_NUMBER'];
	$D_VEH_WEIGHT = $row_veh['VEH_WEIGHT'];
	$D_LADEN_WEIGHT = $row_veh['LADEN_WEIGHT'];
	$D_UNLADEN_WEIGHT = $row_veh['UNLADEN_WEIGHT'];
	$D_LOAD_CAPACITY = $row_veh['LOAD_CAPACITY'];
	$D_PETRO_NUMBER = $row_veh['PETRO_NUMBER'];
	$D_PETRO_NAME = $row_veh['PETRO_NAME'];
	$D_VEH_PRICE = $row_veh['VEH_PRICE'];
	$D_BANK_NAME = $row_veh['BANK_NAME'];
	$D_ACC_NUM = $row_veh['ACC_NUM'];
	$D_LOAN_EXP = date("d-m-Y", strtotime($row_veh['LOAN_EXP']));
	$D_INS_COMPANY = $row_veh['INS_COMPANY'];
	$D_POLICY_NUM = $row_veh['POLICY_NUM'];
	$D_INS_TYPE = $row_veh['INS_TYPE'];
	$D_BROKER_NAME = $row_veh['BROKER_NAME'];
	$D_BROKER_ADD = $row_veh['BROKER_ADD'];
	$D_BROKER_STATE = $row_veh['BROKER_STATE'];
	$D_BROKER_PHONE = $row_veh['BROKER_PHONE'];
	$D_BROKER_MOBILE = $row_veh['BROKER_MOBILE'];
	$D_ROADTAX_EXP = date("d-m-Y", strtotime($row_veh['ROADTAX_EXP']));
	$D_NP_EXP = date("d-m-Y", strtotime($row_veh['NP_EXP']));
	$D_INS_EXP = date("d-m-Y", strtotime($row_veh['INS_EXP']));
	$D_AUTH_EXP = date("d-m-Y", strtotime($row_veh['AUTH_EXP']));
	$D_FITNESS_EXP = date("d-m-Y", strtotime($row_veh['FITNESS_EXP']));
	$D_REM_DAYS = $row_veh['REM_DAYS'];
	$D_PERMIT_TYPE = $row_veh['PERMIT_TYPE'];
	$D_PERMIT_NUM = $row_veh['PERMIT_NUM'];
	$D_PERMIT_STATUS = $row_veh['PERMIT_STATUS'];
	$D_DRIVER1 = $row_veh['DRIVER1'];
	$D_DRIVER2 = $row_veh['DRIVER1'];

	if($action != ''){
		$VEH_NUMBER = $_REQUEST['VEH_NUMBER'];
		$VEH_NAME = $_REQUEST['VEH_NAME'];
		$VEH_CLASS = $_REQUEST['VEH_CLASS'];
		$MODEL = $_REQUEST['MODEL'];
		$PURCHASE_MODE = $_REQUEST['PURCHASE_MODE'];
		$PURCHASE_YEAR = $_REQUEST['PURCHASE_YEAR'];
		$OWN_TYPE = $_REQUEST['OWN_TYPE'];
		$OWNER_NAME = $_REQUEST['OWNER_NAME'];
		$ENGINE_NUMBER = $_REQUEST['ENGINE_NUMBER'];
		$CHASIS_NUMBER = $_REQUEST['CHASIS_NUMBER'];
		$VEH_WEIGHT = $_REQUEST['VEH_WEIGHT'];
		$LADEN_WEIGHT = $_REQUEST['LADEN_WEIGHT'];
		$UNLADEN_WEIGHT = $_REQUEST['UNLADEN_WEIGHT'];
		$LOAD_CAPACITY = $_REQUEST['LOAD_CAPACITY'];
		$PETRO_NUMBER = $_REQUEST['PETRO_NUMBER'];
		$PETRO_NAME = $_REQUEST['PETRO_NAME'];
		$VEH_PRICE = $_REQUEST['VEH_PRICE'];
		$BANK_NAME = $_REQUEST['BANK_NAME'];
		$ACC_NUM = $_REQUEST['ACC_NUM'];
		$LOAN_EXP = date("Y-m-d", strtotime($_REQUEST['LOAN_EXP']));
		$INS_COMPANY = $_REQUEST['INS_COMPANY'];
		$POLICY_NUM = $_REQUEST['POLICY_NUM'];
		$INS_TYPE = $_REQUEST['INS_TYPE'];
		$BROKER_NAME = $_REQUEST['BROKER_NAME'];
		$BROKER_ADD = $_REQUEST['BROKER_ADD'];
		$BROKER_STATE = $_REQUEST['BROKER_STATE'];
		$BROKER_PHONE = $_REQUEST['BROKER_PHONE'];
		$BROKER_MOBILE = $_REQUEST['BROKER_MOBILE'];
		$ROADTAX_EXP = date("Y-m-d", strtotime($_REQUEST['ROADTAX_EXP']));
		$NP_EXP = date("Y-m-d", strtotime($_REQUEST['NP_EXP']));
		$INS_EXP = date("Y-m-d", strtotime($_REQUEST['INS_EXP']));
		$AUTH_EXP = date("Y-m-d", strtotime($_REQUEST['AUTH_EXP']));
		$FITNESS_EXP = date("Y-m-d", strtotime($_REQUEST['FITNESS_EXP']));
		$REM_DAYS = $_REQUEST['REM_DAYS'];
		$PERMIT_TYPE = $_REQUEST['PERMIT_TYPE'];
		$PERMIT_NUM = $_REQUEST['PERMIT_NUM'];
		$PERMIT_STATUS = $_REQUEST['PERMIT_STATUS'];
		$DRIVER1 = $_REQUEST['DRIVER1'];
		$DRIVER2 = $_REQUEST['DRIVER1'];
		
		$D_VEH_NUMBER = $_REQUEST['VEH_NUMBER'];
		$D_VEH_NAME = $_REQUEST['VEH_NAME'];
		$D_VEH_CLASS = $_REQUEST['VEH_CLASS'];
		$D_MODEL = $_REQUEST['MODEL'];
		$D_PURCHASE_MODE = $_REQUEST['PURCHASE_MODE'];
		$D_PURCHASE_YEAR = $_REQUEST['PURCHASE_YEAR'];
		$D_OWN_TYPE = $_REQUEST['OWN_TYPE'];
		$D_OWNER_NAME = $_REQUEST['OWNER_NAME'];
		$D_ENGINE_NUMBER = $_REQUEST['ENGINE_NUMBER'];
		$D_CHASIS_NUMBER = $_REQUEST['CHASIS_NUMBER'];
		$D_VEH_WEIGHT = $_REQUEST['VEH_WEIGHT'];
		$D_LADEN_WEIGHT = $_REQUEST['LADEN_WEIGHT'];
		$D_UNLADEN_WEIGHT = $_REQUEST['UNLADEN_WEIGHT'];
		$D_LOAD_CAPACITY = $_REQUEST['LOAD_CAPACITY'];
		$D_PETRO_NUMBER = $_REQUEST['PETRO_NUMBER'];
		$D_PETRO_NAME = $_REQUEST['PETRO_NAME'];
		$D_VEH_PRICE = $_REQUEST['VEH_PRICE'];
		$D_BANK_NAME = $_REQUEST['BANK_NAME'];
		$D_ACC_NUM = $_REQUEST['ACC_NUM'];
		$D_LOAN_EXP = date("d-m-Y", strtotime($_REQUEST['LOAN_EXP']));
		$D_INS_COMPANY = $_REQUEST['INS_COMPANY'];
		$D_POLICY_NUM = $_REQUEST['POLICY_NUM'];
		$D_INS_TYPE = $_REQUEST['INS_TYPE'];
		$D_BROKER_NAME = $_REQUEST['BROKER_NAME'];
		$D_BROKER_ADD = $_REQUEST['BROKER_ADD'];
		$D_BROKER_STATE = $_REQUEST['BROKER_STATE'];
		$D_BROKER_PHONE = $_REQUEST['BROKER_PHONE'];
		$D_BROKER_MOBILE = $_REQUEST['BROKER_MOBILE'];
		$D_ROADTAX_EXP = date("d-m-Y", strtotime($_REQUEST['ROADTAX_EXP']));
		$D_NP_EXP = date("d-m-Y", strtotime($_REQUEST['NP_EXP']));
		$D_INS_EXP = date("d-m-Y", strtotime($_REQUEST['INS_EXP']));
		$D_AUTH_EXP = date("d-m-Y", strtotime($_REQUEST['AUTH_EXP']));
		$D_FITNESS_EXP = date("d-m-Y", strtotime($_REQUEST['FITNESS_EXP']));
		$D_REM_DAYS = $_REQUEST['REM_DAYS'];
		$D_PERMIT_TYPE = $_REQUEST['PERMIT_TYPE'];
		$D_PERMIT_NUM = $_REQUEST['PERMIT_NUM'];
		$D_PERMIT_STATUS = $_REQUEST['PERMIT_STATUS'];
		$D_DRIVER1 = $_REQUEST['DRIVER1'];
		$D_DRIVER2 = $_REQUEST['DRIVER1'];

		$sql = "update vehicle SET VEH_NUMBER = '".$VEH_NUMBER."', VEH_NAME = '".$VEH_NAME."', VEH_CLASS = '".$VEH_CLASS."', MODEL = '".$MODEL."', 
							PURCHASE_MODE = '".$PURCHASE_MODE."', PURCHASE_YEAR = '".$PURCHASE_YEAR."', OWN_TYPE = '".$OWN_TYPE."', OWNER_NAME = '".$OWNER_NAME."', 
							ENGINE_NUMBER = '".$ENGINE_NUMBER."', CHASIS_NUMBER = '".$CHASIS_NUMBER."', VEH_WEIGHT = '".$VEH_WEIGHT."', LADEN_WEIGHT = '".$LADEN_WEIGHT."', 
							UNLADEN_WEIGHT = '".$UNLADEN_WEIGHT."', LOAD_CAPACITY = '".$LOAD_CAPACITY."', PETRO_NUMBER = '".$PETRO_NUMBER."', PETRO_NAME = '".$PETRO_NAME."', 
							VEH_PRICE = '".$VEH_PRICE."', BANK_NAME = '".$BANK_NAME."', ACC_NUM = '".$ACC_NUM."', LOAN_EXP = '".$LOAN_EXP."', INS_COMPANY = '".$INS_COMPANY."', 
							POLICY_NUM = '".$POLICY_NUM."', INS_TYPE = '".$INS_TYPE."', BROKER_NAME = '".$BROKER_NAME."', BROKER_ADD = '".$BROKER_ADD."', BROKER_STATE = '".$BROKER_STATE."', 
							BROKER_PHONE = '".$BROKER_PHONE."', BROKER_MOBILE = '".$BROKER_MOBILE."', ROADTAX_EXP = '".$ROADTAX_EXP."', NP_EXP = '".$NP_EXP."', INS_EXP = '".$INS_EXP."', 
							AUTH_EXP = '".$AUTH_EXP."', FITNESS_EXP = '".$FITNESS_EXP."', REM_DAYS = '".$REM_DAYS."', PERMIT_TYPE = '".$PERMIT_TYPE."', PERMIT_NUM = '".$PERMIT_NUM."', 
							PERMIT_STATUS = '".$PERMIT_STATUS."', DRIVER1 = '".$DRIVER1."', DRIVER2 ='".$DRIVER2."' where ID = ".$ID;
		//echo $sql;
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$_SESSION['alert_msg'] = '<div class="alert alert-success" role="alert"><a href="#" class="alert-link">Vehicles updated successfully!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			header("Location:list_vehicles.php");
		} else {
			$_SESSION['alert_msg'] = '<div class="alert alert-danger" role="alert"><a href="#" class="alert-link">Sorry!! Could not update Vehicles!</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
										<h3>Edit Vehicles</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<div class="span12">
												<div class="widget-content">
													<div class="span5">
														<fieldset>
															<div class="control-group">											
																<label for="veh_num" class="control-label">Vehicle No.</label>
																<div class="controls">
																	<input type="text" name="VEH_NUMBER" value="<?=$D_VEH_NUMBER?>" id="VEH_NUMBER" class="span2 validate[required]">
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="veh_name" class="control-label">Vehicle Name</label>
																<div class="controls">
																	<input type="text" name="VEH_NAME" value="<?=$D_VEH_NAME?>" id="VEH_NAME" class="span2 validate[required]">
																</div> 				
															</div> 
															<!--<div class="control-group">											
																<label for="veh_class" class="control-label">Class of Vehicle</label>
																<div class="controls">
																	<input type="text" name="VEH_CLASS" value="<?=$D_VEH_CLASS?>" id="VEH_CLASS" class="span2">
																</div> 				
															</div> -->
															<div class="control-group">											
																<label for="model" class="control-label">Model</label>
																<div class="controls">
																	<input type="text" name="MODEL" value="<?=$D_MODEL?>" id="MODEL" class="span2 validate[required]">
																</div> 				
															</div> 
														</fieldset>
													</div>
													<div class="span5">
														<fieldset>
															<!--<div class="control-group">											
																<label for="pur_mode" class="control-label">Mode of Purchase</label>
																<div class="controls">
																	<input type="text" name="PURCHASE_MODE" value="<?=$D_PURCHASE_MODE?>" id="PURCHASE_MODE" class="span2 validate[required]">
																</div> 				
															</div> -->
															<div class="control-group">											
																<label for="pur_year" class="control-label">Year of Purchase</label>
																<div class="controls">
																	<input type="text" name="PURCHASE_YEAR" value="<?=$D_PURCHASE_YEAR?>" id="PURCHASE_YEAR" class="span2 validate[required]">
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="own_type" class="control-label">Ownership Type</label>
																<div class="controls">
																	<select class="select span2 validate[required]" id="OWN_TYPE" name="OWN_TYPE">
																		<option value="OWN">OWN</option>
																		<option value="RENT">RENT</option>
																	</select>
																</div> 				
															</div> 
															<div class="control-group">											
																<label for="owner_name" class="control-label">Owner Name</label>
																<div class="controls">
																	<input type="text" name="OWNER_NAME" value="<?=$D_OWNER_NAME?>" id="OWNER_NAME" class="span2 validate[required]">
																</div> 				
															</div> 
														</fieldset>
													</div>
												</div>
												<!--<div class="widget-content">
													<div class="tabbable">
														<ul class="nav nav-tabs">
															<li class=""><a data-toggle="tab" href="#formcontrols">Engine/Petro Details</a></li>
															<li class=""><a data-toggle="tab" href="#jscontrols">Loan/Insurance Details</a></li>
															<li class="active"><a data-toggle="tab" href="#remarks">Expiry/Scan Details</a></li>
															<li class=""><a data-toggle="tab" href="#permit_details">Permit/Driver Details</a></li>
														</ul>
														<div class="tab-content">
															<div id="formcontrols" class="tab-pane">
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="eng_num" class="control-label">Engine Number</label>
																			<div class="controls">
																				<input type="text" name="ENGINE_NUMBER" value="<?=$D_ENGINE_NUMBER?>" id="ENGINE_NUMBER" class="span2 validate[required]">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="chasis_num" class="control-label">Chasis Number</label>
																			<div class="controls">
																				<input type="text" name="CHASIS_NUMBER" value="<?=$D_CHASIS_NUMBER?>" id="CHASIS_NUMBER" class="span3 validate[required]">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="veh_weight" class="control-label">Gross Vehicle Weight</label>
																			<div class="controls">
																				<input type="text" name="VEH_WEIGHT" value="<?=$D_VEH_WEIGHT?>" id="VEH_WEIGHT" class="span3">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="lad_weight" class="control-label">Laden Weight</label>
																			<div class="controls">
																				<input type="text" name="LADEN_WEIGHT" value="<?=$D_LADEN_WEIGHT?>" id="LADEN_WEIGHT" class="span3">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="unlad_weight" class="control-label">Un Laden Weight</label>
																			<div class="controls">
																				<input type="text" name="UNLADEN_WEIGHT" value="<?=$D_UNLADEN_WEIGHT?>" id="UNLADEN_WEIGHT" class="span3">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="load_cap" class="control-label">Load Capacity</label>
																			<div class="controls">
																				<input type="text" name="LOAD_CAPACITY" value="<?=$D_LOAD_CAPACITY?>" id="LOAD_CAPACITY" class="span3">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="pet_number" class="control-label">Petro Card Number</label>
																			<div class="controls">
																				<input type="text" name="PETRO_NUMBER" value="<?=$D_PETRO_NUMBER?>" id="PETRO_NUMBER" class="span3">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pet_name" class="control-label">Petro Card Name</label>
																			<div class="controls">
																				<input type="text" name="PETRO_NAME" value="<?=$D_PETRO_NAME?>" id="PETRO_NAME" class="span3">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
															</div>
															
															<div id="jscontrols" class="tab-pane">
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="veh_price" class="control-label">Vehicle Price</label>
																			<div class="controls">
																				<input type="text" name="VEH_PRICE" value="<?=$D_VEH_PRICE?>" id="VEH_PRICE" class="span2 validate[required]">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="bank_name" class="control-label">Bank/Finance Name</label>
																			<div class="controls">
																				<input type="text" name="BANK_NAME" value="<?=$D_BANK_NAME?>" id="BANK_NAME" class="span2 validate[required]">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="acc_number" class="control-label">Loan Account Number</label>
																			<div class="controls">
																				<input type="text" name="ACC_NUM" value="<?=$D_ACC_NUM?>" id="ACC_NUM" class="span2 validate[required]">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="loan_exp" class="control-label">Loan Expiry Date</label>
																			<div class="controls">
																				<input type="text" name="LOAN_EXP" value="<?=$D_LOAN_EXP?>" id="LOAN_EXP" class="span2 tcal validate[required]">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="ins_comp" class="control-label">Insurance Company</label>
																			<div class="controls">
																				<input type="text" name="INS_COMPANY" value="<?=$D_INS_COMPANY?>" id="INS_COMPANY" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="policy_num" class="control-label">Policy Number</label>
																			<div class="controls">
																				<input type="text" name="POLICY_NUM" value="<?=$D_POLICY_NUM?>" id="POLICY_NUM" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="ins_type" class="control-label">Insurance Type</label>
																			<div class="controls">
																				<input type="text" name="INS_TYPE" value="<?=$D_INS_TYPE?>" id="INS_TYPE" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="bname" class="control-label">Broker Name</label>
																			<div class="controls">
																				<input type="text" name="BROKER_NAME" value="<?=$D_BROKER_NAME?>" id="BROKER_NAME" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="brok_add" class="control-label">Broker Address</label>
																			<div class="controls">
																				<textarea id="BROKER_ADD" name="BROKER_ADD" class="span3"><?=$D_BROKER_ADD?></textarea>
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="brok_state" class="control-label">Broker State</label>
																			<div class="controls">
																				<select class="select span3" id="BROKER_STATE" name="BROKER_STATE">
																						<option selected="" value="1">Karnataka</option>
																						<option selected="" value="2">Tamilnadu</option>
																						<option selected="" value="3">Kerala</option>
																						<option selected="" value="4">Maharastra</option>
																						<option selected="" value="16">SBCMakali-Booking</option>
																						<option selected="" value="15">SBCNTPET-(B)-Booking</option>
																						<option selected="" value="14">SBCNTPET-(A)-Booking</option>
																						<option selected="" value="13">SBCTPT-Booking</option>
																						<option selected="" value="17">SBCYPR-Booking</option>
																						<option selected="" value="12">SBCKPM-booking</option>
																						<option selected="" value="10">Goa</option>
																						<option selected="" value="11">Gujarat</option>
																						<option selected="" value="8">Bihar</option>
																						<option selected="" value="7">Assam</option>
																						<option selected="" value="6">Arunachal Pradesh</option>
																						<option selected="" value="5">Andhra Pradesh</option>
																						<option selected="" value="9"> 	Chhattisgarh</option>
																				</select>
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="brok_phone" class="control-label">Broker Phone</label>
																			<div class="controls">
																				<input type="text" name="BROKER_PHONE" value="<?=$D_BROKER_PHONE?>" id="BROKER_PHONE" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="brok_mobile" class="control-label">Broker Mobile</label>
																			<div class="controls">
																				<input type="text" name="BROKER_MOBILE" value="<?=$D_BROKER_MOBILE?>" id="BROKER_MOBILE" class="span2">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
															</div>
															<div id="remarks" class="tab-pane active">
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="rtax" class="control-label">Road Tax Expiry Date</label>
																			<div class="controls">
																				<input type="text" name="ROADTAX_EXP" value="<?=$D_ROADTAX_EXP?>" id="ROADTAX_EXP" class="span2 tcal validate[required]">
																			</div>				
																		</div> 
																		<div class="control-group">											
																			<label for="permit" class="control-label">NP Permit Expiry Date</label>
																			<div class="controls">
																				<input type="text" name="NP_EXP" value="<?=$D_NP_EXP?>" id="NP_EXP" class="span2 tcal validate[required]">
																			</div>				
																		</div> 
																		<div class="control-group">											
																			<label for="insurance" class="control-label">Insurance Expiry Date</label>
																			<div class="controls">
																				<input type="text" name="INS_EXP" value="<?=$D_INS_EXP?>" id="INS_EXP" class="span2 tcal">
																			</div>				
																		</div> 
																		<div class="control-group">											
																			<label for="auth_exp" class="control-label">Authorization Expiry Date</label>
																			<div class="controls">
																				<input type="text" name="AUTH_EXP" value="<?=$D_AUTH_EXP?>" id="AUTH_EXP" class="span2 tcal">
																			</div>				
																		</div> 
																		<div class="control-group">											
																			<label for="fitness" class="control-label">Fitness Expiry Date</label>
																			<div class="controls">
																				<input type="text" name="FITNESS_EXP" value="<?=$D_FITNESS_EXP?>" id="FITNESS_EXP" class="span2 tcal">
																			</div>				
																		</div> 
																		<div class="control-group">											
																			<label for="rdays" class="control-label">Remainder Days</label>
																			<div class="controls">
																				<input type="text" name="REM_DAYS" value="<?=$D_REM_DAYS?>" id="REM_DAYS" class="span2">
																			</div>				
																		</div> 
																	</fieldset>
																</div>
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="reason" class="control-label">Scan Copies</label>
																			<div class="controls">
																				<input type="file" name="scan" id="scan" class="span3">
																			</div>				
																		</div> 
																		
																	</fieldset>
																</div>
															</div>
															<div id="permit_details" class="tab-pane">
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="permit_type" class="control-label">Permit Type</label>
																			<div class="controls">
																				<select class="select span2" id="PERMIT_TYPE" name="PERMIT_TYPE">
																					<option value="STATE">STATE</option>
																					<option value="NATIONAL">NATIONAL</option>
																				</select>
																			</div>				
																		</div> 
																		<div class="control-group">											
																			<label for="permit_num" class="control-label">Permit Number</label>
																			<div class="controls">
																				<input type="text" name="PERMIT_NUM" value="<?=$D_PERMIT_NUM?>" id="PERMIT_NUM" class="span2 validate[required]">
																			</div>				
																		</div> 
																		<div class="control-group">											
																			<label for="permit_status" class="control-label">Permit Status</label>
																			<div class="controls">
																				<select class="select span2 validate[required]" id="PERMIT_STATUS" name="PERMIT_STATUS">
																					<option value="VALID">VALID</option>
																					<option value="EXPIRED">EXPIRED</option>
																				</select>
																			</div>				
																		</div> 
																		<div class="control-group">											
																			<label for="driver1" class="control-label">Driver 1</label>
																			<div class="controls">
																				<select class="select span2" value="<?=$D_DRIVER1?>" id="DRIVER1" name="DRIVER1">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="driver2" class="control-label">Driver 2</label>
																			<div class="controls">
																				<select class="select span2" value="<?=$D_DRIVER2?>" id="DRIVER2" name="DRIVER2">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
															</div>
														</div>
													</div>
													<fieldset>
														<div class="form-actions">
															<input name="edit" id="edit" class="btn btn-primary" type="submit" value="Save">
															<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
															<a class="btn" href="list_vehicles.php">Back</a>
														</div>
														<div class="control-group" style="text-align:center;"><?=$msg?></div>
													</fieldset>
												</div>-->
												<div class="form-actions">
													<input name="edit" id="edit" class="btn btn-primary" type="submit" value="Save">
													<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
													<a class="btn" href="list_vehicles.php">Back</a>
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