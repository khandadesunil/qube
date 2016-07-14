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
										<h3>Client List</h3>
										<span class="right_link"><a href="add_customers.php">Add New Client</a></span>
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
													<th>City</th>
													<th>Contact Person</th>
													<th>Mobile</th>
													<th>Email</th>
													<th>Edit</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_goods = "select * from customer where STATUS = 'A' ORDER BY CONSIGN_NAME ASC";
													//echo $sel_goods;
													$res_goods = sqlsrv_query($conn, $sel_goods);
													$i = 1;
													while($row_cust = sqlsrv_fetch_array($res_goods)){
														$ID = $row_cust['ID'];
														$CONSIGN_NAME = $row_cust['CONSIGN_NAME'];
														$MOBILE = $row_cust['MOBILE'];
														$EMAIL = $row_cust['EMAIL'];
														$CITY = $row_cust['CITY'];
														$CON_NAME = $row_cust['CON_NAME'];
														$CST = $row_cust['CST'];
														$STATUS = $row_cust['STATUS'];
														$CREATED_DATE = date("d-m-Y", strtotime($row_cust['CREATED_DATE']));
														
														$sel_city = "select * from city where ID = ".$CITY;
														$res_city = sqlsrv_query($conn, $sel_city);
														$r_city = sqlsrv_fetch_array($res_city);
														$CITY = $r_city['NAME'];
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$CONSIGN_NAME?></td>
													<td><?=$CITY?></td>
													<td><?=$CON_NAME?></td>
													<td><?=$MOBILE?></td>
													<td><?=$EMAIL?></td>
													<td><a href="edit_customers.php?id=<?=$ID?>" class="btn btn-small btn-success"><i class="icon-large icon-pencil"> </i></a></td>
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
				url: 'delete_customers.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>