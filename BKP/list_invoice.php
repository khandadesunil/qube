<?php
	require_once 'header.php';
	$invoice = isset($_REQUEST['invoice']) ? $_REQUEST['invoice'] : '';
	$CUSTOMER = isset($_REQUEST['CUSTOMER']) ? $_REQUEST['CUSTOMER'] : '';
	$inv_lrs = isset($_REQUEST['inv_lrs']) ? $_REQUEST['inv_lrs'] : '';
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<script>$(document).ready(function(){ $("#menu5").addClass(" active");});</script>
						<form name="form_filter" action="invoice_export.php" method="get">
							From Date <input type="text" class="tcal" name="f_date" id="f_date" style="width:150px" readonly> &nbsp; &nbsp; 
							To Date <input type="text" class="tcal" name="t_date" id="t_date" style="width:150px" readonly> &nbsp; &nbsp; 
							<input type="submit" name="export" id="export" value="Export to Excel" class="btn btn-primary">
						</form>
						<div class="widget-content" >
							<div class="widget big-stats-container">
								<div class="widget widget-table action-table">
									<div class="widget-header">
										<i class="icon-th-list"></i>
										<h3>Generated Invoice List</h3>
										<span class="right_link"><a href="generate_invoice.php">Generate Invoice</a></span>
									</div>
									<div class="widget-content">
										<?php
											if (isset($_SESSION['alert_msg'])){echo $_SESSION['alert_msg']; unset($_SESSION['alert_msg']);}
										?>
										<table class="table table-striped table-bordered" id="search_table">
											<thead>
												<tr>
													<th>Select</th>
													<th>Invoice No.</th>
													<th>Booking No.</th>
													<th>Booking Date</th>
													<th>Customer</th>
													<th>Origin</th>
													<th>Destination</th>
													<th>No. of Packages</th>
													<th>Amount</th>
													<th>Print</th>
													<!--<th>Edit</th>-->
												</tr>
											</thead>
											<tbody>
												<?php
													$sel_inv = "select * from invoice order by invoice_date desc";
													$res_inv = sqlsrv_query($conn, $sel_inv);
													while($row_inv = sqlsrv_fetch_array($res_inv)){
														$inv_id = $row_inv['invoice_id'];
														$invoice_id = 'DLI/INV/'. (1000 + $row_inv['invoice_id']);
														$lr_ids = $row_inv['lr_ids'];
														$sel_lr = "select * from lr where ID in (".$lr_ids.") order by LR_DATE DESC";
														//echo $sel_lr;
														$res_lr = sqlsrv_query($conn, $sel_lr);
														$i = 1;
														$LR_NUMBER = '';
														$LR_DATE = '';
														$CONSR = '';
														$QUANTITY = '';
														$TOTAL = '';
														$STATUS = '';
														$CREATED_DATE = '';
														$f_br = '';
														$t_br = '';
														$GOODS_NAME = '';
														$br = '<br /><br />';
														while($row_lr = sqlsrv_fetch_array($res_lr)){
															$ID = $row_lr['ID'];
															$INVOICE = $row_lr['INVOICE'];
															$LR_NUMBER .= $row_lr['LR_NUMBER'].$br;
															$LR_DATE .= date("d-m-Y", strtotime($row_lr['LR_DATE'])).$br;
															$CONSR .= $row_lr['CONSR'].$br;
															$FROM_BRANCH = $row_lr['FROM_BRANCH'];
															$TO_BRANCH = $row_lr['TO_BRANCH'];
															$QUANTITY .= $row_lr['QUANTITY'].$br;
															$GOODS = $row_lr['GOODS'];
															$TOTAL .= $row_lr['TOTAL'].$br;
															$STATUS .= $row_lr['STATUS'].$br;
															$CREATED_DATE .= date("d-m-Y", strtotime($row_lr['CREATED_DATE'])).$br;
															
															$sel_f_branch = "select * from city where ID = " . $FROM_BRANCH;
															$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
															$row_f_br = sqlsrv_fetch_array($res_f_branch);
															$f_br .= $row_f_br['NAME'].$br;
															
															$sel_t_branch = "select * from city where ID = " . $TO_BRANCH;
															$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
															$row_t_br = sqlsrv_fetch_array($res_t_branch);
															$t_br .= $row_t_br['NAME'].$br;
															
															$sel_goods = "select * from goods where ID = ".$GOODS;
															$res_goods = sqlsrv_query($conn, $sel_goods);
															$row_goods = sqlsrv_fetch_array($res_goods);
															$GOODS_NAME .= $row_goods['NAME'].$br;
														}
														
														$LR_NUMBER = rtrim($LR_NUMBER, $br);
														$LR_DATE = rtrim($LR_DATE, $br);
														$CONSR = rtrim($CONSR, $br);
														$QUANTITY = rtrim($QUANTITY, $br);
														$TOTAL = rtrim($TOTAL, $br);
														$STATUS = rtrim($STATUS, $br);
														$CREATED_DATE = rtrim($CREATED_DATE, $br);
												?>
												<tr>
													<td><?=$i?></td>
													<td><?=$invoice_id?></td>
													<td><?=$LR_NUMBER?></td>
													<td><?=$LR_DATE?></td>
													<td><?=$CONSR?></td>
													<td><?=$f_br?></td>
													<td><?=$t_br?></td>
													<td><?=$QUANTITY?></td>
													<td><?=$TOTAL?></td>
													<td><a href="print_inv.php?inv_id=<?=$inv_id?>" target="_blank" class="btn btn-primary">Print</a></td>
													<!--<td><a class="btn btn-small btn-success" href="edit_invoice.php?inv_id=<?=$inv_id?>"><i class="icon-large icon-pencil"> </i></a></td>-->
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