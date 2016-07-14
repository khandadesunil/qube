<?php
	require_once 'header.php';
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<script>$(document).ready(function(){ $("#menu7").addClass(" active");});</script>
							<!--<form name="form_filter" action="lr_export.php" method="get">
								From Booking Date <input type="text" class="tcal" name="f_date" id="f_date" style="width:150px" readonly> &nbsp; &nbsp; 
								To Booking Date <input type="text" class="tcal" name="t_date" id="t_date" style="width:150px" readonly> &nbsp; &nbsp; 
								<input type="submit" name="export" id="export" value="Export to Excel" class="btn btn-primary">
							</form>	-->
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Delivered List</h3>
									</div>
									<?php
										if (isset($_SESSION['alert_msg'])){echo $_SESSION['alert_msg']; unset($_SESSION['alert_msg']);}
									?>
									<div class="widget-content">
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>SL</th>
													<th>Booking No.</th>
													<th>Booking Date</th>
													<th>Customer</th>
													<th>Shipper</th>
													<th>Origin</th>
													<th>Destination</th>
													<th>No. of Packages</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_lr = "select lr.*, CONVERT(VARCHAR(10), lr.LR_DATE,105) as LR_DATE from lr where lr.STATUS = 'Delivered' order by lr.LR_DATE DESC";
													//echo $sel_lr;
													$res_lr = sqlsrv_query($conn, $sel_lr);
													$i = 1;
													while($row_lr = sqlsrv_fetch_array($res_lr)){
														$ID = $row_lr['ID'];
														$LR_NUMBER = $row_lr['LR_NUMBER'];
														$LR_DATE = $row_lr['LR_DATE'];
														$CONSR = $row_lr['CONSR'];
														$FROM_BRANCH = $row_lr['FROM_BRANCH'];
														$TO_BRANCH = $row_lr['TO_BRANCH'];
														$QUANTITY = $row_lr['QUANTITY'];
														$NO_OF_PKGS = $row_lr['NO_OF_PKGS'];
														$GOODS = $row_lr['GOODS'];
														$SHIPPER = $row_lr['SHIPPER'];
														$STATUS = $row_lr['STATUS'];
														$CREATED_DATE = $row_lr['CREATED_DATE'];
														
														$sel_f_branch = "select * from city where ID = " . $FROM_BRANCH;
														$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
														$row_f_br = sqlsrv_fetch_array($res_f_branch);
														$f_br = $row_f_br['NAME'];
														
														$sel_t_branch = "select * from city where ID = " . $TO_BRANCH;
														$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
														$row_t_br = sqlsrv_fetch_array($res_t_branch);
														$t_br = $row_t_br['NAME'];
														
														$sel_goods = "select * from goods where ID = ".$GOODS;
														$res_goods = sqlsrv_query($conn, $sel_goods);
														$row_goods = sqlsrv_fetch_array($res_goods);
														$GOODS_NAME = $row_goods['NAME'];
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$LR_NUMBER?></td>
													<td><?=$LR_DATE?></td>
													<td><?=$CONSR?></td>
													<td><?=$SHIPPER?></td>
													<td><?=$f_br?></td>
													<td><?=$t_br?></td>
													<td><?=$NO_OF_PKGS?></td>
													<td><?=$STATUS?></td>
													<td><a href="print_dr.php?id=<?=$ID?>" target="_blank" class="btn btn-primary">Print</a></td>
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
				url: 'delete_lr.php',
				data: { id: id},
				success: function(data) {}
			});
			setInterval("location.reload()", 1000);
		}else{} 
	}
</script>