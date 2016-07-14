<?php
	require_once 'header.php';
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<script>$(document).ready(function(){ $("#menu4").addClass(" active");});</script>
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>BMO List</h3>
										<?php
											if($sess_user_type != 'READONLY')
												echo '<span class="right_link"><a href="add_bmo.php">Add BMO</a></span>';
										?>
									</div>
									<?php
										if (isset($_SESSION['alert_msg'])){echo $_SESSION['alert_msg']; unset($_SESSION['alert_msg']);}
									?>
									<div class="widget-content">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>SL</th>
													<th>BMO Number</th>
													<th>Booking No.</th>
													<th>Customer</th>
													<th>Shipper</th>
													<th>Origin</th>
													<th>Destination</th>
													<th>ETA</th>
													<th>ETD</th>
													<th>Print</th>
													<?php
														if($sess_user_type != 'READONLY'){
													?>
													<th>Edit</th>
													<?php
													}
													?>
													<!--<th>Delete</th>-->
												</tr>
											</thead>
											<tbody>
												<?php
													$selbmo = "select * from process where STATUS = 'BMO' order by BMO_DATE DESC";
													//echo $selbmo;
													$resbmo = sqlsrv_query($conn, $selbmo);
													$i = 1;
													while($rowbmo = sqlsrv_fetch_array($resbmo)){
														$ID = $rowbmo['ID'];
														$BMO_NUMBER = $rowbmo['BMO_NUMBER'];
														$LR_ID = $rowbmo['LR_ID'];
														$BMO_DATE = date("d-m-Y", strtotime($rowbmo['BMO_DATE']));
														$ETA = date("d-m-Y", strtotime($rowbmo['ETA']));
														$ETD = date("d-m-Y", strtotime($rowbmo['ETD']));
														
														$sel_lr = "select LR_NUMBER, SHIPPER, CONSR, (select NAME from city where ID = FROM_BRANCH) as FROM_BRANCH, (select NAME from city where ID = TO_BRANCH) as TO_BRANCH from lr where ID in (".$LR_ID.")";
														$res_lr = sqlsrv_query($conn, $sel_lr);
														$SHIPPER = '';
														$LR_NUMBER = '';
														$CONSR = '';
														$FROM_BRANCH = '';
														$TO_BRANCH = '';
														$br = '<br /><br />';
														while($row_lr = sqlsrv_fetch_array($res_lr)){
															$LR_NUMBER .= $row_lr['LR_NUMBER'].$br;
															$CONSR .= $row_lr['CONSR'].$br;
															$SHIPPER .= $row_lr['SHIPPER'].$br;
															$FROM_BRANCH .= $row_lr['FROM_BRANCH'].$br;
															$TO_BRANCH .= $row_lr['TO_BRANCH'].$br;
														}
														$LR_NUMBER = rtrim($LR_NUMBER, $br);
														$CONSR = rtrim($CONSR, $br);
														$SHIPPER = rtrim($SHIPPER, $br);
														$FROM_BRANCH = rtrim($FROM_BRANCH, $br);
														$TO_BRANCH = rtrim($TO_BRANCH, $br);
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$BMO_NUMBER?></td>
													<td><?=$LR_NUMBER?></td>
													<td><?=$CONSR?></td>
													<td><?=$SHIPPER?></td>
													<td><?=$FROM_BRANCH?></td>
													<td><?=$TO_BRANCH?></td>
													<td><?=$ETA?></td>
													<td><?=$ETD?></td>
													<td><a href="print_bmo.php?id=<?=$ID?>" target="_blank" class="btn btn-primary">Print</a></td>
													<?php
														if($sess_user_type != 'READONLY'){
													?>
													<td><a href="edit_bmo.php?id=<?=$ID?>" class="btn btn-small btn-success"><i class="icon-large icon-pencil"> </i></a></td>
													<!--<td><a href="javascript:void(0);" onclick="delete_data(<?=$ID?>)" class="btn btn-small btn-success">Delete</a></td>-->
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
	function delete_data(id){
		var r=confirm("Are you sure you want to delete!");
		if (r==true){
			$.ajax({
				url: 'delete_branches.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>