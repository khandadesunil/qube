<?php
	require_once 'header.php';
?>
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
										<h3>Vehicles List</h3>
										<span class="right_link"><a href="add_vehicles.php">Add New Vehicles</a></span>
									</div>
									<?php
										if (isset($_SESSION['alert_msg'])){echo $_SESSION['alert_msg']; unset($_SESSION['alert_msg']);}
									?>
									<div class="widget-content">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>SL</th>
													<th>Number</th>
													<th>Name</th>
													<th>Model</th>
													<th>Owner Name</th>
													<!--<th>Engine Number</th>
													<th>Chasis Number</th>
													<th>Roadtax Exp</th>
													<th>Ins Exp.</th>
													<th>Status</th>
													<th>Created Date</th>-->
													<th>Edit</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_vehicle = "select * from vehicle where status = 'A'";
													$res_vehicle = sqlsrv_query($conn, $sel_vehicle);
													$i = 1;
													while($row_vehicle = sqlsrv_fetch_array($res_vehicle)){
														$ID = $row_vehicle['ID'];
														$VEH_NUMBER = $row_vehicle['VEH_NUMBER'];
														$VEH_NAME = $row_vehicle['VEH_NAME'];
														$MODEL = $row_vehicle['MODEL'];
														$OWNER_NAME = $row_vehicle['OWNER_NAME'];
														$LOAD_CAPACITY = $row_vehicle['LOAD_CAPACITY'];
														$OWN_TYPE = $row_vehicle['OWN_TYPE'];
														$ENGINE_NUMBER = $row_vehicle['ENGINE_NUMBER'];
														$CHASIS_NUMBER = $row_vehicle['CHASIS_NUMBER'];
														$ROADTAX_EXP = $row_vehicle['ROADTAX_EXP'];
														$INS_EXP = $row_vehicle['INS_EXP'];
														$STATUS = $row_vehicle['STATUS'];
														$CREATED_DATE = $row_vehicle['CREATED_DATE'];
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$VEH_NUMBER?></td>
													<td><?=$VEH_NAME?></td>
													<td><?=$MODEL?></td>
													<td><?=$OWNER_NAME?></td>
													<!--<td><?=$ENGINE_NUMBER?></td>
													<td><?=$CHASIS_NUMBER?></td>
													<td><?=$ROADTAX_EXP?></td>
													<td><?=$INS_EXP?></td>
													<td><?=$STATUS?></td>
													<td><?=$CREATED_DATE?></td>-->
													<td><a href="edit_vehicles.php?id=<?=$ID?>" class="btn btn-small btn-success"><i class="icon-large icon-pencil"> </i></a></td>
													<td><a href="javascript:void(0);" onclick="delete_data(<?=$ID?>)" class="btn btn-small btn-success">Delete</a></td>
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
				url: 'delete_vehicles.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>