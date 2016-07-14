<?php
	require_once 'header.php';
	
	$msg = '';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
	
	$sel_emp = "select * from employee where ID = ".$ID;
	$res_emp = sqlsrv_query($conn, $sel_emp);
	$row_emp = sqlsrv_fetch_array($res_emp);
	
	$D_SALUTATION = $row_emp['SALUTATION'];
	$D_NAME = $row_emp['NAME'];
	$D_REF_NAME = $row_emp['REF_NAME'];
	$D_TYPE = $row_emp['TYPE'];
	$D_DOJ = $row_emp['DOJ'];
	$D_BRANCH_ID = $row_emp['BRANCH_ID'];
	$D_DEPARTMENT = $row_emp['DEPARTMENT'];
	$D_DESIGNATION = $row_emp['DESIGNATION'];
	$D_DOB = $row_emp['DOB'];
	$D_GENDER = $row_emp['GENDER'];
	$D_MARTIAL = $row_emp['MARTIAL'];
	$D_BLOOD = $row_emp['BLOOD'];
	$D_LANGUAGE = $row_emp['LANGUAGE'];
	$D_FATHER_NAME = $row_emp['FATHER_NAME'];
	$D_LAST_COMPANY = $row_emp['LAST_COMPANY'];
	$D_EXPERIENCE = $row_emp['EXPERIENCE'];
	$D_PF = $row_emp['PF'];
	$D_PAN = $row_emp['PAN'];
	$D_REMARKS = $row_emp['REMARKS'];
	$D_PRES_ADDRESS = $row_emp['PRES_ADDRESS'];
	$D_PRES_STATE_ID = $row_emp['PRES_STATE_ID'];
	$D_PRES_CITY_ID = $row_emp['PRES_CITY_ID'];
	$D_PRES_PINCODE = $row_emp['PRES_PINCODE'];
	$D_PRES_PHONE = $row_emp['PRES_PHONE'];
	$D_PRES_MOBILE = $row_emp['PRES_MOBILE'];
	$D_RES_ADDRESS = $row_emp['RES_ADDRESS'];
	$D_RES_STATE_ID = $row_emp['RES_STATE_ID'];
	$D_RES_CITY_ID = $row_emp['RES_CITY_ID'];
	$D_RES_PINCODE = $row_emp['RES_PINCODE'];
	$D_RES_PHONE = $row_emp['RES_PHONE'];
	$D_RES_MOBILE = $row_emp['RES_MOBILE'];

	if($action != ''){
		$SALUTATION = $_REQUEST['SALUTATION'];
		$NAME = $_REQUEST['NAME'];
		$REF_NAME = $_REQUEST['REF_NAME'];
		$TYPE = $_REQUEST['TYPE'];
		$DOJ = date("Y-m-d", strtotime($_REQUEST['DOJ']));
		$BRANCH_ID = $_REQUEST['BRANCH_ID'];
		$DEPARTMENT = $_REQUEST['DEPARTMENT'];
		$DESIGNATION = $_REQUEST['DESIGNATION'];
		$DOB = date("Y-m-d", strtotime($_REQUEST['DOB']));
		$GENDER = $_REQUEST['GENDER'];
		$MARTIAL = $_REQUEST['MARTIAL'];
		$BLOOD = $_REQUEST['BLOOD'];
		$LANGUAGE = $_REQUEST['LANGUAGE'];
		$FATHER_NAME = $_REQUEST['FATHER_NAME'];
		$LAST_COMPANY = $_REQUEST['LAST_COMPANY'];
		$EXPERIENCE = $_REQUEST['EXPERIENCE'];
		$PF = $_REQUEST['PF'];
		$PAN = $_REQUEST['PAN'];
		$REMARKS = $_REQUEST['REMARKS'];
		$PRES_ADDRESS = $_REQUEST['PRES_ADDRESS'];
		$PRES_STATE_ID = $_REQUEST['PRES_STATE_ID'];
		$PRES_CITY_ID = $_REQUEST['PRES_CITY_ID'];
		$PRES_PINCODE = $_REQUEST['PRES_PINCODE'];
		$PRES_PHONE = $_REQUEST['PRES_PHONE'];
		$PRES_MOBILE = $_REQUEST['PRES_MOBILE'];
		$RES_ADDRESS = $_REQUEST['RES_ADDRESS'];
		$RES_STATE_ID = $_REQUEST['RES_STATE_ID'];
		$RES_CITY_ID = $_REQUEST['RES_CITY_ID'];
		$RES_PINCODE = $_REQUEST['RES_PINCODE'];
		$RES_PHONE = $_REQUEST['RES_PHONE'];
		$RES_MOBILE = $_REQUEST['RES_MOBILE'];
		
		$D_SALUTATION = $_REQUEST['SALUTATION'];
		$D_NAME = $_REQUEST['NAME'];
		$D_REF_NAME = $_REQUEST['REF_NAME'];
		$D_TYPE = $_REQUEST['TYPE'];
		$D_DOJ = $_REQUEST['DOJ'];
		$D_BRANCH_ID = $_REQUEST['BRANCH_ID'];
		$D_DEPARTMENT = $_REQUEST['DEPARTMENT'];
		$D_DESIGNATION = $_REQUEST['DESIGNATION'];
		$D_DOB = $_REQUEST['DOB'];
		$D_GENDER = $_REQUEST['GENDER'];
		$D_MARTIAL = $_REQUEST['MARTIAL'];
		$D_BLOOD = $_REQUEST['BLOOD'];
		$D_LANGUAGE = $_REQUEST['LANGUAGE'];
		$D_FATHER_NAME = $_REQUEST['FATHER_NAME'];
		$D_LAST_COMPANY = $_REQUEST['LAST_COMPANY'];
		$D_EXPERIENCE = $_REQUEST['EXPERIENCE'];
		$D_PF = $_REQUEST['PF'];
		$D_PAN = $_REQUEST['PAN'];
		$D_REMARKS = $_REQUEST['REMARKS'];
		$D_PRES_ADDRESS = $_REQUEST['PRES_ADDRESS'];
		$D_PRES_STATE_ID = $_REQUEST['PRES_STATE_ID'];
		$D_PRES_CITY_ID = $_REQUEST['PRES_CITY_ID'];
		$D_PRES_PINCODE = $_REQUEST['PRES_PINCODE'];
		$D_PRES_PHONE = $_REQUEST['PRES_PHONE'];
		$D_PRES_MOBILE = $_REQUEST['PRES_MOBILE'];
		$D_RES_ADDRESS = $_REQUEST['RES_ADDRESS'];
		$D_RES_STATE_ID = $_REQUEST['RES_STATE_ID'];
		$D_RES_CITY_ID = $_REQUEST['RES_CITY_ID'];
		$D_RES_PINCODE = $_REQUEST['RES_PINCODE'];
		$D_RES_PHONE = $_REQUEST['RES_PHONE'];
		$D_RES_MOBILE = $_REQUEST['RES_MOBILE'];
		
		$sql = "UPDATE employee set NAME = '".$NAME."', REF_NAME = '".$REF_NAME."', TYPE = '".$TYPE."', DOJ = '".$DOJ."', BRANCH_ID = '".$BRANCH_ID."', DEPARTMENT = '".$DEPARTMENT."', 
									DESIGNATION = '".$DESIGNATION."', DOB = '".$DOB."', GENDER = '".$GENDER."', MARTIAL = '".$MARTIAL."', BLOOD = '".$BLOOD."', 
									LANGUAGE = '".$LANGUAGE."', FATHER_NAME = '".$FATHER_NAME."', LAST_COMPANY = '".$LAST_COMPANY."', EXPERIENCE = '".$EXPERIENCE."', 
									PF = '".$PF."', PAN = '".$PAN."', REMARKS = '".$REMARKS."', PRES_ADDRESS = '".$PRES_ADDRESS."', PRES_STATE_ID = '".$PRES_STATE_ID."', 
									PRES_CITY_ID = '".$PRES_CITY_ID."', PRES_PINCODE = '".$PRES_PINCODE."', PRES_PHONE = '".$PRES_PHONE."', PRES_MOBILE = '".$PRES_MOBILE."', 
									RES_ADDRESS = '".$RES_ADDRESS."', RES_STATE_ID = '".$RES_STATE_ID."', RES_CITY_ID = '".$RES_CITY_ID."', RES_PINCODE = '".$RES_PINCODE."', 
									RES_PHONE = '".$RES_PHONE."', RES_MOBILE = '".$RES_MOBILE."' where ID = ".$ID;
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$msg = '<div style="color:green;">Employee updated successfully!!</div>';
			header("Location:list_employees.php");
		} else {
			$msg = '<div style="color:red;">Sorry!! Could not update Employee!!</div>';
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
		margin-top:10px;
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
										<h3>Edit User</h3>
									</div>
									<div class="widget-content"><br />
										<form method="post" action="" class="form-horizontal" id="submit_form">
											<div class="span5">
												<div class="widget-content">
													<fieldset>
														<div class="control-group">											
															<label for="salutation" class="control-label">Salutation</label>
															<div class="controls">
																<select class="select span3 validate[required]" id="SALUTATION" name="SALUTATION">
																	<option value="Mr.">Mr.</option>
																	<option value="Ms.">Ms.</option>
																	<option value="Mrs.">Mrs.</option>
																	<option value="Doc.">Doc.</option>
																	<option value="Prof.">Prof.</option>
																</select>
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="ename" class="control-label">Employee Name</label>
															<div class="controls">
																<input type="text" name="NAME" value="<?=$D_NAME?>" id="NAME" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="rname" class="control-label">Ref Name</label>
															<div class="controls">
																<input type="text" name="REF_NAME" value="<?=$D_REF_NAME?>" id="REF_NAME" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="etype" class="control-label">Employee Type</label>
															<div class="controls">
																<select class="select span3 validate[required]" id="TYPE" name="TYPE">
																	<option value="CONTRACT">CONTRACT</option>
																	<option value="PERMANENT">PERMANENT</option>
																</select>
															</div> 				
														</div> 
													</fieldset>
												</div>
											</div>
											<div class="span5">
												<div class="widget-content">
													<fieldset>
														<div class="control-group">											
															<label for="doj" class="control-label">Date of Joining</label>
															<div class="controls">
																<input type="text" name="DOJ" value="<?=$D_DOJ?>" id="DOJ" class="span2 tcal validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="branch" class="control-label">For Branch</label>
															<div class="controls">
																<select class="select span3 validate[required]" id="BRANCH_ID" name="BRANCH_ID">
																	<option value="">-Select-</option>
																	<?php
																		$sel_f_branch = "select * from branch order by NAME";
																		$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
																		while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
																			$f_br_id = $r_f_branch['ID'];
																			$f_br_name = $r_f_branch['NAME'];
																			$sel = '';
																			if($D_BRANCH_ID == $f_br_id)
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
															<label for="dept" class="control-label">Department</label>
															<div class="controls">
																<input type="text" name="DEPARTMENT" value="<?=$D_DEPARTMENT?>" id="DEPARTMENT" class="span2">
															</div> 					
														</div> 
														<div class="control-group">											
															<label for="designation" class="control-label">Designation</label>
															<div class="controls">
																<input type="text" name="DESIGNATION" value="<?=$D_DESIGNATION?>" id="DESIGNATION" class="span2">
															</div> 					
														</div> 
													</fieldset>
												</div>
											</div>
											<div class="span12">
												<div class="widget-content">
													<div class="tabbable">
														<ul class="nav nav-tabs">
															<li class="active"><a data-toggle="tab" href="#formcontrols">Employee Details</a></li>
															<li class=""><a data-toggle="tab" href="#jscontrols">Address</a></li>
														</ul>
														<div class="tab-content">
															<div id="formcontrols" class="tab-pane active">
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="dob" class="control-label">Date of Birth</label>
																			<div class="controls">
																				<input type="text" name="DOB" value="<?=$D_DOB?>" id="DOB" class="span2 tcal validate[required]">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="gender" class="control-label">Gender</label>
																			<div class="controls">
																				<select class="select span3" id="GENDER" name="GENDER">
																					<option value="MALE">MALE</option>
																					<option value="FEMALE">FEMALE</option>
																				</select>
																			</div> 			
																		</div> 
																		<div class="control-group">											
																			<label for="martial" class="control-label">Martial status</label>
																			<div class="controls">
																				<select class="select span3" id="MARTIAL" name="MARTIAL">
																					<option value="SINGLE">SINGLE</option>
																					<option value="MARRIED">MARRIED</option>
																				</select>
																			</div> 			
																		</div> 
																		<div class="control-group">											
																			<label for="blood" class="control-label">Blood Group</label>
																			<div class="controls">
																				<input type="text" name="BLOOD" value="<?=$D_BLOOD?>" id="BLOOD" class="span2">
																			</div> 					
																		</div> 
																		<div class="control-group">											
																			<label for="language" class="control-label">Mother Tongue</label>
																			<div class="controls">
																				<input type="text" name="LANGUAGE" value="<?=$D_LANGUAGE?>" id="LANGUAGE" class="span2">
																			</div> 					
																		</div> 
																		<div class="control-group">											
																			<label for="fname" class="control-label">Father's Name</label>
																			<div class="controls">
																				<input type="text" name="FATHER_NAME" value="<?=$D_FATHER_NAME?>" id="FATHER_NAME" class="span2 validate[required]">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="company" class="control-label">Last Company</label>
																			<div class="controls">
																				<input type="text" name="LAST_COMPANY" value="<?=$D_LAST_COMPANY?>" id="LAST_COMPANY" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="experience" class="control-label">Year of Experience</label>
																			<div class="controls">
																				<input type="text" name="EXPERIENCE" value="<?=$D_EXPERIENCE?>" id="EXPERIENCE" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pf" class="control-label">PF Number</label>
																			<div class="controls">
																				<input type="text" name="PF" value="<?=$D_PF?>" id="PF" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pan" class="control-label">PAN</label>
																			<div class="controls">
																				<input type="text" name="PAN" value="<?=$D_PAN?>" id="PAN" class="span2 validate[required]">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="remarks" class="control-label">Remarks</label>
																			<div class="controls">
																				<textarea name="REMARKS" id="REMARKS" class="span4"><?=$D_REMARKS?></textarea>
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
															</div>
															
															<div id="jscontrols" class="tab-pane">
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="pres_add" class="control-label">Present Address</label>
																			<div class="controls">
																				<textarea name="PRES_ADDRESS" id="PRES_ADDRESS" class="span3"></textarea>
																			</div>				
																		</div> 
																		<div class="control-group">											
																			<label for="pres_state" class="control-label">State</label>
																			<div class="controls">
																				<select class="pres_state select span3 validate[required]" id="PRES_STATE_ID" name="PRES_STATE_ID">
																					<option value="1">-Select-</option>
																					<?php
																						$sel_state = "select * from states order by NAME";
																						$res_state = sqlsrv_query($conn, $sel_state);
																						while($r_state = sqlsrv_fetch_array($res_state)){
																							$f_st_id = $r_state['ID'];
																							$f_st_name = $r_state['NAME'];
																					?>
																					<option value="<?=$f_st_id?>"><?=$f_st_name?></option>
																					<?php
																						}
																					?>
																				</select>
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pres_city" class="control-label">City</label>
																			<div class="controls">
																				<select class="select span3 validate[required]" id="PRES_CITY_ID" name="PRES_CITY_ID">
																					<?php
																						$sel_state = "select * from city order by NAME";
																						$res_state = sqlsrv_query($conn, $sel_state);
																						while($r_state = sqlsrv_fetch_array($res_state)){
																							$f_st_id = $r_state['ID'];
																							$f_st_name = $r_state['NAME'];
																					?>
																					<option value="<?=$f_st_id?>"><?=$f_st_name?></option>
																					<?php
																						}
																					?>
																				</select>
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pres_pincode" class="control-label">Pincode</label>
																			<div class="controls">
																				<input type="text" name="PRES_PINCODE" value="<?=$D_PRES_PINCODE?>" id="PRES_PINCODE" class="span2 validate[required]">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pres_phone" class="control-label">Phone</label>
																			<div class="controls">
																				<input type="text" name="PRES_PHONE" value="<?=$D_PRES_PHONE?>" id="PRES_PHONE" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pres_mobile" class="control-label">Mobile</label>
																			<div class="controls">
																				<input type="text" name="PRES_MOBILE" value="<?=$D_PRES_MOBILE?>" id="PRES_MOBILE" class="span2">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="res_add" class="control-label">Permanent Address</label>
																			<div class="controls">
																				<textarea name="RES_ADDRESS" id="RES_ADDRESS" class="span3"><?=$D_RES_ADDRESS?></textarea>
																			</div>				
																		</div> 
																		<div class="control-group">											
																			<label for="res_state" class="control-label">Permanent State</label>
																			<div class="controls">
																				<select class="res_state select span3" id="RES_STATE_ID" name="RES_STATE_ID">
																					<option value="1">-Select-</option>
																					<?php
																						$sel_state = "select * from states order by NAME";
																						$res_state = sqlsrv_query($conn, $sel_state);
																						while($r_state = sqlsrv_fetch_array($res_state)){
																							$f_st_id = $r_state['ID'];
																							$f_st_name = $r_state['NAME'];
																					?>
																					<option value="<?=$f_st_id?>"><?=$f_st_name?></option>
																					<?php
																						}
																					?>
																				</select>
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="res_city" class="control-label">Permanent City</label>
																			<div class="controls">
																				<select class="select span3" id="RES_CITY_ID" name="RES_CITY_ID">
																					<?php
																						$sel_state = "select * from city order by NAME";
																						$res_state = sqlsrv_query($conn, $sel_state);
																						while($r_state = sqlsrv_fetch_array($res_state)){
																							$f_st_id = $r_state['ID'];
																							$f_st_name = $r_state['NAME'];
																					?>
																					<option value="<?=$f_st_id?>"><?=$f_st_name?></option>
																					<?php
																						}
																					?>
																				</select>
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="res_pincode" class="control-label">Permanent Pincode</label>
																			<div class="controls">
																				<input type="text" name="RES_PINCODE" value="<?=$D_RES_PINCODE?>" id="RES_PINCODE" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="res_phone" class="control-label">Permanent Phone</label>
																			<div class="controls">
																				<input type="text" name="RES_PHONE" value="<?=$D_RES_PHONE?>" id="RES_PHONE" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="res_mobile" class="control-label">Permanent Mobile</label>
																			<div class="controls">
																				<input type="text" name="RES_MOBILE" value="<?=$D_RES_MOBILE?>" id="RES_MOBILE" class="span2">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
															</div>
															
														</div>
													  
													  
													</div>
													<fieldset>
														<div class="form-actions">
															<input name="add" id="add" class="btn btn-primary" type="submit" value="Save">
															<input name="cancel" id="cancel" class="btn" type="reset" value="Reset">
															<a class="btn" href="list_employees.php">Back</a>
														</div>
														<div class="control-group" style="text-align:center;"><?=$msg?></div>
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
?>