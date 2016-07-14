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
										<h3>Route List</h3>
										<span class="right_link"><a href="add_routes.php">Add New Route</a></span>
									</div>
									<?php
										if(isset($_SESSION['alert_msg'])){echo $_SESSION['alert_msg']; unset($_SESSION['alert_msg']);}
									?>
									<div class="widget-content">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>SL</th>
													<th>Source</th>
													<th>Destination</th>
													<th>Type</th>
													<th>Via</th>
													<!--<th>Status</th>
													<th>Created Date</th>-->
													<th>Edit</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_route = "select ID, CREATED_DATE, (select NAME from city where ID = SOURCE) AS SOURCE, 
																(select NAME from city where ID = DESTINATION) AS DESTINATION, TYPE, VIA, STATUS from route where status = 'Active'";
													$res_route = sqlsrv_query($conn, $sel_route);
													$i = 1;
													while($row_route = sqlsrv_fetch_array($res_route)){
														$ID = $row_route['ID'];
														$SOURCE = $row_route['SOURCE'];
														$DESTINATION = $row_route['DESTINATION'];
														$TYPE = $row_route['TYPE'];
														$VIA = $row_route['VIA'];
														$sel_city = "select * from city where ID in (".$VIA.")";
														$res_city = sqlsrv_query($conn, $sel_city);
														$cities = '';
														while($row_city = sqlsrv_fetch_array($res_city)){
															$cities .= $row_city['NAME']. ', ';
														}
														$cities = rtrim($cities, ', ');
														$STATUS = $row_route['STATUS'];
														$CREATED_DATE = $row_route['CREATED_DATE'];
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$SOURCE?></td>
													<td><?=$DESTINATION?></td>
													<td><?=$TYPE?></td>
													<td><?=$cities?></td>
													<!--<td><?=$STATUS?></td>
													<td><?=$CREATED_DATE?></td>-->
													<td><a href="edit_routes.php?id=<?=$ID?>" class="btn btn-small btn-success"><i class="icon-large icon-pencil"> </i></a></td>
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
				url: 'delete_routes.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>