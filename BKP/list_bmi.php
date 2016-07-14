<?php
	require_once 'header.php';
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<script>$(document).ready(function(){ $("#menu6").addClass(" active");});</script>
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>BMI List</h3>
										<?php
											if($sess_user_type != 'READONLY')
												echo '<span class="right_link"><a href="add_bmi.php">Add BMI</a></span>';
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
													<th>Customer</th>
													<th>Booking No.</th>
													<th>Booking Date</th>
													<th>BMI No.</th>
													<th>BMI Date</th>
													<th>Origin</th>
													<th>Destination</th>
													<!--<th>Edit</th>
													<th>Delete</th>-->
												</tr>
											</thead>
											<tbody>
												<?php
													$selbmo = "select * from process where STATUS = 'BMI' order by BMO_DATE DESC";
													//echo $selbmo;
													$resbmo = sqlsrv_query($conn, $selbmo);
													$i = 1;
													while($rowbmo = sqlsrv_fetch_array($resbmo)){
														$ID = $rowbmo['ID'];
														$LR_ID = $rowbmo['LR_ID'];
														$BMI_NUMBER = $rowbmo['BMI_NUMBER'];
														$BMO_NUMBER = str_replace(",", "<br /><br />", $rowbmo['BMO_NUMBER']);
														$BMO_DATE = date("d-m-Y", strtotime($rowbmo['BMO_DATE']));
														$BMI_DATE = date("d-m-Y", strtotime($rowbmo['BMI_DATE']));
														
														$sel_lr = "select LR_NUMBER, LR_DATE, CONSR, (select NAME from city where ID = FROM_BRANCH) as FROM_BRANCH, (select NAME from city where ID = TO_BRANCH) as TO_BRANCH 
																	from lr where ID in (".$LR_ID.")";
														$res_lr = sqlsrv_query($conn, $sel_lr);
														$CONSR = '';
														$LR_NUMBER = '';
														$LR_DATE = '';
														$FROM_BRANCH = '';
														$TO_BRANCH = '';
														$br = '<br /><br />';
														while($row_lr = sqlsrv_fetch_array($res_lr)){
															$CONSR .= $row_lr['CONSR'].$br;
															$LR_NUMBER .= $row_lr['LR_NUMBER'].$br;
															$LR_DATE .= $row_lr['LR_DATE'].$br;
															$FROM_BRANCH .= $row_lr['FROM_BRANCH'].$br;
															$TO_BRANCH .= $row_lr['TO_BRANCH'].$br;
														}
														$CONSR = rtrim($CONSR, $br);
														$LR_NUMBER = rtrim($LR_NUMBER, $br);
														$LR_DATE = rtrim($LR_DATE, $br);
														$FROM_BRANCH = rtrim($FROM_BRANCH, $br);
														$TO_BRANCH = rtrim($TO_BRANCH, $br);
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$CONSR?></td>
													<td><?=$LR_NUMBER?></td>
													<td><?=$LR_DATE?></td>
													<td><?=$BMI_NUMBER?></td>
													<td><?=$BMI_DATE?></td>
													<td><?=$FROM_BRANCH?></td>
													<td><?=$TO_BRANCH?></td>
													<!--<td><a href="print_bmi.php?id=<?=$ID?>" class="btn btn-small btn-success"><i class="icon-large icon-pencil"> </i></a></td>
													<td><a href="javascript:void(0);" onclick="delete_data(<?=$ID?>)" class="btn btn-small btn-success">Delete</a></td>-->
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