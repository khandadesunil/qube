<?php
	require_once 'conf/database.php';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	
	$sel_ts = "select * from process where ID = ".$ID;
	$res_ts = sqlsrv_query($conn, $sel_ts);
	$row_ts = sqlsrv_fetch_array($res_ts);
	$BMO_NUMBER = $row_ts['BMO_NUMBER'];
	$DRIVER_NAME = $row_ts['DRIVER_NAME'];
	$VEHICLE = $row_ts['VEHICLE'];
	$LR_ID = $row_ts['LR_ID'];
	$STATUS = $row_ts['STATUS'];
	$BMO_DATE = $row_ts['BMO_DATE'];
	$FROM_BRANCH = $row_ts['FROM_BRANCH'];
	$TO_BRANCH = $row_ts['TO_BRANCH'];

	$sel_f_branch = "select * from city where ID = '".$FROM_BRANCH."'";
	$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
	$row_f_branch = sqlsrv_fetch_array($res_f_branch);
	$FB = $row_f_branch['NAME'];
	
	$sel_t_branch = "select * from city where ID = '".$TO_BRANCH."'";
	$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
	$row_t_branch = sqlsrv_fetch_array($res_t_branch);
	$TB = $row_t_branch['NAME'];
?>
<style>table {border-collapse: collapse;}table, tr, th { border: 0px solid black;height:20px;}tr{font-size:12px;font-family:"Arial";font-weight:600;}table{border:0.1px solid;}td{padding:5px;}</style>
	<table width="700" border="1" >
		<tr>
			<td>
				<table width="700" border="1" style="border:0px;">
					<tr style="border:0px;">
						<td colspan="9" style="border:0px;"><img src="img/logo.jpg" width="685"></td>
					</tr>
					<tr>
						<td colspan="9" align="center"><br /><h4>Branch Manifest Outward</h4></td>
					</tr>
					<tr style="height:70px;">
						<th colspan="9">
							<div style="float:left;width:230px;">Manifest No. <br /><br /> <?=$BMO_NUMBER?></div>
							<div style="float:left;width:230px;">Trip Sheet Date <br /><br /> <?=date("d-m-Y", strtotime($BMO_DATE))?></div>
							<div style="float:left;width:230px;">Scheduled Date <br /><br /> <?=date("d-m-Y", strtotime($BMO_DATE))?></div>
						</th>
					</tr>
					<tr style="height:50px;">
						<td colspan="9">
							<div style="float:left;width:340px;">From : <?=$FB?></div>
							<div style="float:left;width:340px;">To : <?=$TB?></div>
						</td>
					</tr>
					<tr style="height:50px;">
						<th style="background-color:silver">Consignor</th>
						<th style="background-color:silver">NOP</th>
						<th style="background-color:silver">Booking No.</th>
						<th style="background-color:silver">Consignee</th>
						<th style="background-color:silver">Wt/Vol</th>
						<th style="background-color:silver">Shipper</th>
						<th style="background-color:silver">Origin</th>
						<th style="background-color:silver">Destination</th>
					</tr>
					<?php	
						$sel_lr = "select * from lr where ID IN (". $LR_ID .")";
						//echo $sel_lr;
						$res_lr = sqlsrv_query($conn, $sel_lr);
						$i = 1;
						$PAIDqty = 0;
						$TOBEBILLEDqty = 0;
						$TOPAYqty = 0;
						while($row_lr = sqlsrv_fetch_array($res_lr)){	
							$D_LR_NUMBER = $row_lr['LR_NUMBER'];
							$D_LR_DATE = $row_lr['LR_DATE'];
							$D_LR_TYPE = $row_lr['LR_TYPE'];
							$D_FROM_BRANCH = $row_lr['FROM_BRANCH'];
							$D_TO_BRANCH = $row_lr['TO_BRANCH'];
							$D_CONSR = $row_lr['CONSR'];
							$D_CONSR_MOBILE = $row_lr['CONSR_MOBILE'];
							$D_CONSR_EMAIL = $row_lr['CONSR_EMAIL'];
							$D_CONSE = $row_lr['CONSE'];
							$D_CONSE_MOBILE = $row_lr['CONSE_MOBILE'];
							$D_CONSE_EMAIL = $row_lr['CONSE_EMAIL'];
							$D_CONSE_ADDRESS = $row_lr['CONSE_ADDRESS'];
							$D_DELIVERY_AT = $row_lr['DELIVERY_AT'];
							$D_SHIPMENT_REC_DATE = $row_lr['SHIPMENT_REC_DATE'];
							$D_BMO_BY = $row_lr['BMO_BY'];
							$D_BMO_DATE = $row_lr['BMO_DATE'];
							$D_BMI_BY = $row_lr['BMI_BY'];
							$D_BMI_DATE = $row_lr['BMI_DATE'];
							$D_INVOICE = $row_lr['INVOICE'];
							$D_DELIVERY_DATE = $row_lr['DELIVERY_DATE'];
							$D_GOODS = $row_lr['GOODS'];
							$D_QUANTITY = $row_lr['QUANTITY'];
							$D_NO_OF_PKGS = $row_lr['NO_OF_PKGS'];
							$D_CHARGED_RATE = $row_lr['CHARGED_RATE'];
							$D_FREIGHT = $row_lr['FREIGHT'];
							$D_TOTAL = $row_lr['TOTAL'];
							$D_EXP_DEL_DATE = $row_lr['EXP_DEL_DATE'];
							$D_REMARKS = $row_lr['REMARKS'];
							$D_SHIPPER = $row_lr['SHIPPER'];
							$D_STATUS = $row_lr['STATUS'];
							$D_CREATED_BY = $row_lr['CREATED_BY'];
							$D_BMO_DATE = $row_lr['BMO_DATE'];
							
							if($D_LR_TYPE == 'PAID')
								$PAIDqty = $PAIDqty + $D_QUANTITY;
							if($D_LR_TYPE == 'TO BE BILLED')
								$TOBEBILLEDqty = $TOBEBILLEDqty + $D_QUANTITY;
							if($D_LR_TYPE == 'TO PAY')
								$TOPAYqty = $TOPAYqty + $D_QUANTITY;
							/*$sel_consr = "select * from customer where ID = ". $D_CONSR;
							$res_consr = sqlsrv_query($sel_consr);
							$row_consr = sqlsrv_fetch_array($res_consr);
							$CONSR_NAME = $row_consr['CONSIGN_NAME'];
							
							$sel_conse = "select * from customer where ID = ". $D_CONSE;
							$res_conse = sqlsrv_query($sel_conse);
							$row_conse = sqlsrv_fetch_array($res_conse);
							$CONSE_NAME = $row_consr['CONSIGN_NAME'];*/
							
							$sel_f_branch = "select * from city where ID = ".$D_FROM_BRANCH;
							$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
							$row_f_branch = sqlsrv_fetch_array($res_f_branch);
							$F_NAME = $row_f_branch['NAME'];
							
							$sel_t_branch = "select * from city where ID = ".$D_TO_BRANCH;
							$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
							$row_t_branch = sqlsrv_fetch_array($res_t_branch);
							$T_NAME = $row_t_branch['NAME'];
					?>
					<tr style="height:40px;">
						<td><?=$D_CONSR?></td>
						<td><?=$D_NO_OF_PKGS?></td>
						<td><?=$D_LR_NUMBER?></td>
						<td><?=$D_CONSE?></td>
						<td><?=$D_QUANTITY?></td>
						<td><?=$D_SHIPPER?></td>
						<td><?=$F_NAME?></td>
						<td><?=$T_NAME?></td>
					</tr>
					<?php
						$i = $i + 1;;
						}
					?>
				</table><br />
				<table  width="700" border="0">
					<tr style="height:60px;">
						<td>Pay Mode</td>
						<td>Total Weight</td>
						<td>Total Volume</td>
						<td>Total Articles</td>
					</tr>
					<tr>
						<td>PAID</td>
						<td>0</td>
						<td><?=$PAIDqty?></td>
						<td>0</td>
					</tr>
					<tr>
						<td>TO BE BILLED</td>
						<td>0</td>
						<td><?=$TOBEBILLEDqty?></td>
						<td>0</td>
					</tr>
					<tr>
						<td>TO PAY</td>
						<td>0</td>
						<td><?=$TOPAYqty?></td>
						<td>0</td>
					</tr>
					<tr>
						<td colspan="4"><hr /></td>
					</tr>
					<tr>
						<td>Total</td>
						<td>0</td>
						<td><?=($PAIDqty + $TOBEBILLEDqty + $TOPAYqty)?></td>
						<td>0</td>
					</tr>
					<tr>
						<td colspan="4"><hr /></td>
					</tr>
					<tr style="height:150px;">
						<td colspan="3">Vehicle No. : <?=$VEHICLE?><br /><br />Driver(s) : <?=$DRIVER_NAME?><br /><br />Remarks : <?=$D_REMARKS?></td>
						<td>DC Value<br /><br /><br /><br /><br />For QUBE Services Pvt Ltd</td>
					</tr>
					<tr style="height:40px;background-color:#ea6c23;color:fff;">
						<th width="33%">STORAGE</th>
						<th width="33%">DOCUMENT DIGITIZATION</th>
						<th colspan="2" width="33%">LOGISTICS</th>
					</tr>
					<tr>
						<th colspan="4" style="height:70px;">Qube Services Pvt. Ltd. C-23 & 24, Sant Ram Road, Near Post Office, Asola, Fatepur Beri, New Delhi - 110 074</th>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<script>
//window.print();
</script>