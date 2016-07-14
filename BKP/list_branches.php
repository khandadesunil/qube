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
										<h3>Branch List</h3>
										<span class="right_link"><a href="add_branches.php">Add New Branches</a></span>
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
													<th>Type</th>
													<!--<th>Status</th>
													<th>Created Date</th>-->
													<th>Edit</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_goods = "select * from city where status = 'A' order by NAME";
													$res_goods = sqlsrv_query($conn, $sel_goods);
													$i = 1;
													while($row_goods = sqlsrv_fetch_array($res_goods)){
														$ID = $row_goods['ID'];
														$NAME = $row_goods['NAME'];
														$TYPE = $row_goods['TYPE'];
														$STATUS = $row_goods['STATUS'];
														$CREATED_DATE = date("d-m-Y", strtotime($row_goods['CREATED_DATE']));
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$NAME?></td>
													<td><?=$TYPE?></td>
													<!--<td><?=$STATUS?></td>
													<td><?=$CREATED_DATE?></td>-->
													<td><a href="edit_branches.php?id=<?=$ID?>" class="btn btn-small btn-success"><i class="icon-large icon-pencil"> </i></a></td>
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
				url: 'delete_branches.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>