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
										<h3>Drivers List</h3>
										<span class="right_link"><a href="add_drivers.php">Add New Drivers</a></span>
									</div>
									<?php
										if (isset($_SESSION['alert_msg'])){echo $_SESSION['alert_msg']; unset($_SESSION['alert_msg']);}
									?>
									<div class="widget-content">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>SL</th>
													<th>Name</th>
													<th>Mobile</th>
													<th>DL Number</th>
													<th>DL Expiry</th>
													<th>Contact Person Name</th>
													<th>Contact Person No.</th>
													<th>Edit</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_drivers = "select * from driver where status = 'A'";
													$res_drivers = sqlsrv_query($conn, $sel_drivers);
													$i = 1;
													while($row_drivers = sqlsrv_fetch_array($res_drivers)){
														$ID = $row_drivers['ID'];
														$NAME = $row_drivers['NAME'];
														$MOBILE = $row_drivers['MOBILE'];
														$DL_NUMBER = $row_drivers['DL_NUMBER'];;
														$DL_EXP = date("d-m-Y", strtotime($row_drivers['DL_EXP']));
														$CON_NAME = $row_drivers['CON_NAME'];;
														$CON_CONTACT = $row_drivers['CON_CONTACT'];;
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$NAME?></td>
													<td><?=$MOBILE?></td>
													<td><?=$DL_NUMBER?></td>
													<td><?=$DL_EXP?></td>
													<td><?=$CON_NAME?></td>
													<td><?=$CON_CONTACT?></td>
													<td><a href="edit_drivers.php?id=<?=$ID?>" class="btn btn-small btn-success"><i class="icon-large icon-pencil"> </i></a></td>
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
				url: 'delete_drivers.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>