<?php
	require_once 'header.php';
	
	$msg = '';
	$action = isset($_REQUEST['add']) ? $_REQUEST['add'] : '';
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
		$sql = "insert into employee(NAME, REF_NAME, TYPE, DOJ, BRANCH_ID, DEPARTMENT, DESIGNATION, DOB, GENDER, MARTIAL, BLOOD, LANGUAGE, FATHER_NAME, LAST_COMPANY, EXPERIENCE, PF, PAN, REMARKS, PRES_ADDRESS, PRES_STATE_ID, PRES_CITY_ID, PRES_PINCODE, PRES_PHONE, PRES_MOBILE, RES_ADDRESS, RES_STATE_ID, RES_CITY_ID, RES_PINCODE, RES_PHONE, RES_MOBILE) 
					values('".$NAME."', '".$REF_NAME."', '".$TYPE."', '".$DOJ."', '".$BRANCH_ID."', '".$DEPARTMENT."', '".$DESIGNATION."', '".$DOB."', '".$GENDER."', '".$MARTIAL."', '".$BLOOD."', '".$LANGUAGE."', '".$FATHER_NAME."', '".$LAST_COMPANY."', '".$EXPERIENCE."', '".$PF."', '".$PAN."', '".$REMARKS."', '".$PRES_ADDRESS."', '".$PRES_STATE_ID."', '".$PRES_CITY_ID."', '".$PRES_PINCODE."', '".$PRES_PHONE."', '".$PRES_MOBILE."', '".$RES_ADDRESS."', '".$RES_STATE_ID."', '".$RES_CITY_ID."', '".$RES_PINCODE."', '".$RES_PHONE."', '".$RES_MOBILE."')";
		$res = sqlsrv_query($conn, $sql);
		if ($res) {
			$msg = '<div style="color:green;">Employee added successfully!!</div>';
			header("Location:list_employees.php");
		} else {
			$msg = '<div style="color:red;">Sorry!! Could not add Employee!!</div>';
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
										<h3>Add User</h3>
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
																<input type="text" name="NAME" value="" id="NAME" class="span2 validate[required]">
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="rname" class="control-label">Ref Name</label>
															<div class="controls">
																<input type="text" name="REF_NAME" value="" id="REF_NAME" class="span2 validate[required]">
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
																<input type="text" name="DOJ" value="" id="DOJ" class="span2 tcal validate[required]">
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
																	?>
																	<option value="<?=$f_br_id?>"><?=$f_br_name?></option>
																	<?php
																		}
																	?>
															</select>
															</div> 				
														</div> 
														<div class="control-group">											
															<label for="dept" class="control-label">Department</label>
															<div class="controls">
																<input type="text" name="DEPARTMENT" value="" id="DEPARTMENT" class="span2">
															</div> 					
														</div> 
														<div class="control-group">											
															<label for="designation" class="control-label">Designation</label>
															<div class="controls">
																<input type="text" name="DESIGNATION" value="" id="DESIGNATION" class="span2">
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
																				<input type="text" name="DOB" value="" id="DOB" class="span2 tcal validate[required]">
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
																				<input type="text" name="BLOOD" value="" id="BLOOD" class="span2">
																			</div> 					
																		</div> 
																		<div class="control-group">											
																			<label for="language" class="control-label">Mother Tongue</label>
																			<div class="controls">
																				<input type="text" name="LANGUAGE" value="" id="LANGUAGE" class="span2">
																			</div> 					
																		</div> 
																		<div class="control-group">											
																			<label for="fname" class="control-label">Father's Name</label>
																			<div class="controls">
																				<input type="text" name="FATHER_NAME" value="" id="FATHER_NAME" class="span2 validate[required]">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="company" class="control-label">Last Company</label>
																			<div class="controls">
																				<input type="text" name="LAST_COMPANY" value="" id="LAST_COMPANY" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="experience" class="control-label">Year of Experience</label>
																			<div class="controls">
																				<input type="text" name="EXPERIENCE" value="" id="EXPERIENCE" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pf" class="control-label">PF Number</label>
																			<div class="controls">
																				<input type="text" name="PF" value="" id="PF" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pan" class="control-label">PAN</label>
																			<div class="controls">
																				<input type="text" name="PAN" value="" id="PAN" class="span2 validate[required]">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="remarks" class="control-label">Remarks</label>
																			<div class="controls">
																				<textarea name="REMARKS" id="REMARKS" class="span4"></textarea>
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
																				<input type="text" name="PRES_PINCODE" value="" id="PRES_PINCODE" class="span2 validate[required]">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pres_phone" class="control-label">Phone</label>
																			<div class="controls">
																				<input type="text" name="PRES_PHONE" value="" id="PRES_PHONE" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="pres_mobile" class="control-label">Mobile</label>
																			<div class="controls">
																				<input type="text" name="PRES_MOBILE" value="" id="PRES_MOBILE" class="span2">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
																<div class="span5">
																	<fieldset>
																		<div class="control-group">											
																			<label for="res_add" class="control-label">Permanent Address</label>
																			<div class="controls">
																				<textarea name="RES_ADDRESS" id="RES_ADDRESS" class="span3"></textarea>
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
																				<input type="text" name="RES_PINCODE" value="" id="RES_PINCODE" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="res_phone" class="control-label">Permanent Phone</label>
																			<div class="controls">
																				<input type="text" name="RES_PHONE" value="" id="RES_PHONE" class="span2">
																			</div> 				
																		</div> 
																		<div class="control-group">											
																			<label for="res_mobile" class="control-label">Permanent Mobile</label>
																			<div class="controls">
																				<input type="text" name="RES_MOBILE" value="" id="RES_MOBILE" class="span2">
																			</div> 				
																		</div> 
																	</fieldset>
																</div>
															</div>
															
														</div>
													  
													  
													</div>
													<fieldset>
														<div class="form-actions">
															<input name="add" id="add" class="btn btn-primary" type="submit" value="Add Employee">
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