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
										<h3>Rates List</h3>
										<span class="right_link"><a href="add_rates.php">Add New Rates</a></span>
									</div>
									<?php
										if (isset($_SESSION['alert_msg'])){echo $_SESSION['alert_msg']; unset($_SESSION['alert_msg']);}
									?>
									<div class="widget-content">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>SL</th>
													<th>Goods</th>
													<th>Origin</th>
													<th>Destination</th>
													<th>Minimum Charge</th>
													<th>Charge</th>
													<th>Edit</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_goods = "select * from rates";
													$res_goods = sqlsrv_query($conn, $sel_goods);
													$i = 1;
													while($row_goods = sqlsrv_fetch_array($res_goods)){
														$ID = $row_goods['ID'];
														$GOODS = $row_goods['GOODS'];
														$SRC = $row_goods['SRC'];
														$DEST = $row_goods['DEST'];
														$RATE = $row_goods['RATE'];
														$MIN_RATE = $row_goods['MIN_RATE'];
														$CREATED_DATE = $row_goods['CREATED_DATE'];
														
														$sel_g = "select * from goods where ID = ".$GOODS;
														$res_g = sqlsrv_query($conn, $sel_g);
														$row_g = sqlsrv_fetch_array($res_g);
														$gg = $row_g['NAME'];
														
														$sel_f_branch = "select * from city where ID = " . $SRC;
														$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
														$row_f_br = sqlsrv_fetch_array($res_f_branch);
														$f_br = $row_f_br['NAME'];
														
														$sel_t_branch = "select * from city where ID = " . $DEST;
														$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
														$row_t_br = sqlsrv_fetch_array($res_t_branch);
														$t_br = $row_t_br['NAME'];
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$gg?></td>
													<td><?=$f_br?></td>
													<td><?=$t_br?></td>
													<td><?=$MIN_RATE?></td>
													<td><?=$RATE?></td>
													<td><a href="edit_rates.php?id=<?=$ID?>" class="btn btn-small btn-success"><i class="icon-large icon-pencil"> </i></a></td>
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
				url: 'delete_rates.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>