<?php
	require_once 'header.php';
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<script>$(document).ready(function(){ $("#menu7").addClass(" active");});</script>
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Delivery List</h3>
									</div>
									<div class="widget-content">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>SL</th>
													<th>Booking No.</th>
													<th>Customer</th>
													<th>Shipper</th>
													<th>Booking Date</th>
													<th>Origin</th>
													<th>Destination</th>
													<th>Type</th>
													<th>Email</th>
													<?php
														if($sess_user_type != 'READONLY'){
													?>
													<th>Delivery</th>
													<?php
													}
													?>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_process = "select LR_ID from process where STATUS = 'BMI'";
													$res_process = sqlsrv_query($conn, $sel_process);
													$lrids = '';
													while($row_process = sqlsrv_fetch_array($res_process)){
														$lrids .= $row_process['LR_ID'];
													}
													$lrids = rtrim($lrids, ',');
													$sel_lr = "select * from lr where STATUS = 'BMI'";
													//echo $sel_lr;
													$res_lr = sqlsrv_query($conn, $sel_lr);
													$i = 1;
													while($row_lr = sqlsrv_fetch_array($res_lr)){
														$ID = $row_lr['ID'];
														$CONSR = $row_lr['CONSR'];
														$SHIPPER = $row_lr['SHIPPER'];
														$LR_NUMBER = $row_lr['LR_NUMBER'];
														$LR_DATE = $row_lr['LR_DATE'];
														$FROM_BRANCH = $row_lr['FROM_BRANCH'];
														$TO_BRANCH = $row_lr['TO_BRANCH'];
														$LR_TYPE = $row_lr['LR_TYPE'];
														$GOODS = $row_lr['GOODS'];
														$STATUS = $row_lr['STATUS'];
														$BMO_BY = $row_lr['BMO_BY'];
														$BMO_DATE = $row_lr['BMO_DATE'];
														$CONSR_EMAIL = $row_lr['CONSR_EMAIL'];
														
														$sel_f_branch = "select * from city where ID = " . $FROM_BRANCH;
														$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
														$row_f_br = sqlsrv_fetch_array($res_f_branch);
														$f_br = $row_f_br['NAME'];
														
														$sel_t_branch = "select * from city where ID = " . $TO_BRANCH;
														$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
														$row_t_br = sqlsrv_fetch_array($res_t_branch);
														$t_br = $row_t_br['NAME'];
														
														$sel_goods = "select * from goods where ID = ".$GOODS;
														$res_goods = sqlsrv_query($conn, $sel_goods);
														$row_goods = sqlsrv_fetch_array($res_goods);
														$GOODS_NAME = $row_goods['NAME'];
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$LR_NUMBER?></td>
													<td><?=$CONSR?></td>
													<td><?=$SHIPPER?></td>
													<td><?=$LR_DATE?></td>
													<td><?=$f_br?></td>
													<td><?=$t_br?></td>
													<td><?=$LR_TYPE?></td>
													<td>
														<select name="email<?=$ID?>" id="email<?=$ID?>" class="span3">
															<option value="">No email is being sent</option>
															<option value="<?=$CONSR_EMAIL?>"><?=$CONSR_EMAIL?></option>
														</select>
													</td>
													<?php
														if($sess_user_type != 'READONLY'){
													?>
													<td><a href="javascript:void(0);" onclick="deliver(<?=$ID?>)" class="btn btn-small btn-success">Deliver</a></td>
													<?php
													}
													?>
												</tr>
												<?php
													$i = $i + 1;
													}
												?>
											</tbody>
										</table>
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
<script type="text/javascript" >
	function deliver(id){
		var r=confirm("Are you sure you want to Deliver!");
		if (r==true){
			var email = $("#email"+id).val();
			$.ajax({
				url: 'deliver.php',
				data: { id: id,
						email : email 
					},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>