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
										<h3>User List</h3>
										<span class="right_link"><a href="add_employees.php">Add New User</a></span>
									</div>
									<div class="widget-content">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>SL</th>
													<th>Name</th>
													<th>Date of Joining</th>
													<th>Department</th>
													<th>Gender</th>
													<th>Blood Group</th>
													<th>Mother Tounge</th>
													<th>PAN</th>
													<!--<th>Status</th>
													<th>Created Date</th>-->
													<th>Edit</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_employees = "select * from employee where status = 'A'";
													$res_employees = sqlsrv_query($conn, $sel_employees);
													$i = 0;
													while($row_employees = sqlsrv_fetch_array($res_employees)){
														$ID = $row_employees['ID'];
														$NAME = $row_employees['NAME'];
														$DOJ = $row_employees['DOJ'];
														$DEPARTMENT = $row_employees['DEPARTMENT'];
														$GENDER = $row_employees['GENDER'];
														$BLOOD = $row_employees['BLOOD'];
														$LANGUAGE = $row_employees['LANGUAGE'];
														$PAN = $row_employees['PAN'];
														$STATUS = $row_employees['STATUS'];
														$CREATED_DATE = $row_employees['CREATED_DATE'];
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$NAME?></td>
													<td><?=$DOJ?></td>
													<td><?=$DEPARTMENT?></td>
													<td><?=$GENDER?></td>
													<td><?=$BLOOD?></td>
													<td><?=$LANGUAGE?></td>
													<td><?=$PAN?></td>
													<!--<td><?=$STATUS?></td>
													<td><?=$CREATED_DATE?></td>-->
													<td><a href="edit_employees.php?id=<?=$ID?>" class="btn btn-small btn-success"><i class="icon-large icon-pencil"> </i></a></td>
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
				url: 'delete_employees.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>