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
										<h3>Users List</h3>
										<span class="right_link"><a href="add_user.php">Add New User</a></span>
									</div>
									<?php
										if (isset($_SESSION['alert_msg'])){echo $_SESSION['alert_msg']; unset($_SESSION['alert_msg']);}
									?>
									<div class="widget-content">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>SL</th>
													<th>User Name</th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>Email</th>
													<th>For Branch</th>
													<th>Type</th>
													<th>Edit</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_user = "select * from users where USER_NAME != 'ADMIN' and status = 'ACTIVE' order by MODIFIED_DATE DESC";
													$res_user = sqlsrv_query($conn, $sel_user);
													$i = 1;
													while($row_user = sqlsrv_fetch_array($res_user)){
														$USER_ID = $row_user['USER_ID'];
														$USER_NAME = $row_user['USER_NAME'];
														$FIRST_NAME = $row_user['FIRST_NAME'];
														$LAST_NAME = $row_user['LAST_NAME'];
														$EMAIL = $row_user['EMAIL'];
														$FOR_BRANCH = $row_user['FOR_BRANCH'];
														$TYPE = $row_user['TYPE'];
														$STATUS = $row_user['STATUS'];
														$CREATED_DATE = $row_user['CREATED_DATE'];
														
														$sel_city = "select * from city where ID = ".$FOR_BRANCH;
														$res_city = sqlsrv_query($conn, $sel_city);
														$row_city = sqlsrv_fetch_array($res_city);
														$FOR_BRANCH = $row_city['NAME'];
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$USER_NAME?></td>
													<td><?=$FIRST_NAME?></td>
													<td><?=$LAST_NAME?></td>
													<td><?=$EMAIL?></td>
													<td><?=$FOR_BRANCH?></td>
													<td><?=$TYPE?></td>
													<!--<td><?=$STATUS?></td>-->
													<td><a href="edit_user.php?id=<?=$USER_ID?>" class="btn btn-small btn-success"><i class="icon-large icon-pencil"> </i></a></td>
													<td><a href="javascript:void(0);" onclick="delete_data(<?=$USER_ID?>)" class="btn btn-small btn-success">Delete</a></td>
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
				url: 'delete_users.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>