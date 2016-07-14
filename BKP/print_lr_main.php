<?php
	require_once 'conf/database.php';
	require_once 'number_conversion.php';
	
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	$sel_lr = "select * from lr where ID = ".$ID;
	//echo $sel_lr;
	$res_lr = sqlsrv_query($conn, $sel_lr);
	$row_lr = sqlsrv_fetch_array($res_lr);
	$LR_NUMBER = $row_lr['LR_NUMBER'];
	$LR_DATE = date("d-m-Y", strtotime($row_lr['LR_DATE']));
	$LR_TYPE = $row_lr['LR_TYPE'];
	$FROM_BRANCH = $row_lr['FROM_BRANCH'];
	$TO_BRANCH = $row_lr['TO_BRANCH'];
	$CONSR = $row_lr['CONSR'];
	$CONSR_MOBILE = $row_lr['CONSR_MOBILE'];
	$CONSR_EMAIL = $row_lr['CONSR_EMAIL'];
	$CONSE = $row_lr['CONSE'];
	$CONSE_MOBILE = $row_lr['CONSE_MOBILE'];
	$CONSE_EMAIL = $row_lr['CONSE_EMAIL'];
	$CONSE_ADDRESS = $row_lr['CONSE_ADDRESS'];
	$DELIVERY_AT = $row_lr['DELIVERY_AT'];
	$SHIPMENT_REC_DATE = $row_lr['SHIPMENT_REC_DATE'];
	$BMO_BY = $row_lr['BMO_BY'];
	$BMO_DATE = $row_lr['BMO_DATE'];
	$BMI_BY = $row_lr['BMI_BY'];
	$BMI_DATE = $row_lr['BMI_DATE'];
	$INVOICE = $row_lr['INVOICE'];
	$DELIVERY_DATE = $row_lr['DELIVERY_DATE'];
	$GOODS = $row_lr['GOODS'];
	$QUANTITY = $row_lr['QUANTITY'];
	$NO_OF_PKGS = $row_lr['NO_OF_PKGS'];
	$SHIPPER = $row_lr['SHIPPER'];
	$CHARGED_RATE = $row_lr['CHARGED_RATE'];
	$FREIGHT = $row_lr['FREIGHT'];
	$TOTAL = $row_lr['TOTAL'];
	$EXP_DEL_DATE = date("d-m-Y", strtotime($row_lr['EXP_DEL_DATE']));
	$REMARKS = $row_lr['REMARKS'];
	$STATUS = $row_lr['STATUS'];
	$CREATED_BY = $row_lr['CREATED_BY'];
	$CREATED_DATE = $row_lr['CREATED_DATE'];
	$SERVICE_TAX = '0.00';
	$GRAND_TOTAL = $TOTAL + $SERVICE_TAX;
	
	$sel_f_branch = "select * from city where ID = " . $FROM_BRANCH;
	$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
	$row_f_br = sqlsrv_fetch_array($res_f_branch);
	$FROM_BRANCH = $row_f_br['NAME'];
	
	$sel_t_branch = "select * from city where ID = " . $TO_BRANCH;
	$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
	$row_t_br = sqlsrv_fetch_array($res_t_branch);
	$TO_BRANCH = $row_t_br['NAME'];
	
	$sel_goods = "select * from goods where ID = '".$GOODS."'";
	$res_goods = sqlsrv_query($conn, $sel_goods);
	$r_goods = sqlsrv_fetch_array($res_goods);
	$GOODS = $r_goods['NAME'];
?>
<style>table {border-collapse: collapse;}table, tr, th { border: 0px solid black;height:20px;}tr{font-size:12px;font-family:"Arial";font-weight:600;}table{border:0.1px solid;}td{padding:5px;}</style>
	<table width="700" border="1" cellspacing="0" cellpadding="0">
		<tr style="border:0px;">
			<td colspan="3" style="border:0px;"><img src="img/logo.jpg" width="685"></td>
		</tr>
		<tr>
			<th colspan="3" style="height:80px;"><h3><u>Booking /Consignment Note</u></h3></th>
		</tr>
		<tr style="height:40px;">
			<th style="background-color:silver;"><u>Booking No</u></th>
			<th colspan="2" style="background-color:silver;"><u>Booking Date</u></th>
			<!--<th style="background-color:silver"><u>Pickup Ref No</u></th>-->
		</tr>
		<tr style="height:40px;">
			<th><?=$LR_NUMBER?></th>
			<th><?=$LR_DATE?></th>
			<th>&nbsp;</th>
		</tr>
		<tr>
			<th colspan="3">
				<table width="100%" border="1" cellspacing="0" cellpadding="0">
					<tr>
						<td width="90">Consignor</td>
						<td><?=$CONSR?></td>
						<td width="90">Payment Type</td>
						<td><?=$LR_TYPE?></td>
					</tr>
					<tr>
						<td>Consignee</td>
						<td><?=$CONSE?></td>
						<td>Service Type</td>
						<td><?=$DELIVERY_AT?></td>
					</tr>
					<tr>
						<td>Origin</td>
						<td><?=$FROM_BRANCH?></td>
						<td>Commodity</td>
						<td><?=$GOODS?></td>
					</tr>
					<tr>
						<td>Destination</td>
						<td><?=$TO_BRANCH?></td>
						<td>Volume</td>
						<td><?=$QUANTITY?></td>
					</tr>
					<tr>
						<td>Shipper</td>
						<td><?=$SHIPPER?></td>
						<td>Declared Value</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>No of Packages</td>
						<td><?=$NO_OF_PKGS?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<!--<tr style="height:90px;">
						<th colspan="2" width="50%"><h3><u>Consignor</u></h3></th>
						<th colspan="2"><h3><u>Payment Type</u></h3></th>
					</tr>-->
					<tr>
						<td width="100">Received</td>
						<td><?=$LR_DATE?></td>
						<td width="100">Transport Charge</td>
						<td align="right"><?=$GRAND_TOTAL?> &nbsp; &nbsp; </td>
					</tr>
					<tr>
						<td>Delivery Date</td>
						<td><?=$EXP_DEL_DATE?></td>
						<td>Pickup Charge</td>
						<td align="right">0.00 &nbsp; &nbsp; </td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>Delivery Charge</td>
						<td align="right">0.00 &nbsp; &nbsp; </td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>Misc Charge</td>
						<td align="right">0.00 &nbsp; &nbsp; </td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>Service Charge</td>
						<td align="right">0.00 &nbsp; &nbsp; </td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>Invoice Amount</td>
						<td align="right"><?=$GRAND_TOTAL?> &nbsp; &nbsp; </td>
					</tr>
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr style="height:90px;">
						<td colspan="3"><u>Remarks</u></br />
							<?=$REMARKS?>
						</td>
					</tr>
					<tr style="height:40px;background-color:#ea6c23;color:fff;">
						<th width="33%">STORAGE</th>
						<th width="33%">DOCUMENT DIGITIZATION</th>
						<th width="33%">LOGISTICS</th>
					</tr>
					<tr>
						<th colspan="3" style="height:70px;">Qube Services Pvt. Ltd. C-23 & 24, Sant Ram Road, Near Post Office, Asola, Fatepur Beri, New Delhi - 110 074</th>
					</tr>
				</table>
			</th>
		</tr>
	</table>