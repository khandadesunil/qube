<?php
	require_once 'conf/database.php';
	require_once 'number_conversion.php';
	
	$inv_id = isset($_REQUEST['inv_id']) ? $_REQUEST['inv_id'] : '';
	$ID = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	if($inv_id != ''){
		$sel_inv = "select * from invoice where invoice_id = ".$inv_id;
		$res_inv = sqlsrv_query($conn, $sel_inv);
		$row_inv = sqlsrv_fetch_array($res_inv);
		$lr_ids = $row_inv['lr_ids'];
		$sel_lr = "select * from lr where ID in (".$lr_ids.")";
		$res_lr = sqlsrv_query($conn, $sel_lr);
		$row_lr = sqlsrv_fetch_array($res_lr);
		$CONSR = $row_lr['CONSR'];
		
		$LR_DATE = date("d-m-Y", strtotime($row_inv['invoice_date']));
		$sel_cust = "select * from customer where CONSIGN_NAME = '".$CONSR."'";
		$res_cust = sqlsrv_query($conn, $sel_cust);
		$row_cust = sqlsrv_fetch_array($res_cust);
		$CONSE_ADDRESS = $row_cust['ADDRESS'];
		$PAN = $row_cust['PAN'];
		$CST = $row_cust['CST'];
	}else{
		$sel_lr = "select * from lr where ID in (".$ID.")";
		$res_lr = sqlsrv_query($conn, $sel_lr);
		$row_lr = sqlsrv_fetch_array($res_lr);
		$CONSR = $row_lr['CONSR'];
		$LR_DATE = date("d-m-Y", strtotime($row_lr['LR_DATE']));
		$CONSE_ADDRESS = $row_lr['CONSE_ADDRESS'];
		$sel_cust = "select * from customer where CONSIGN_NAME = '".$CONSR."'";
		$res_cust = sqlsrv_query($conn, $sel_cust);
		$row_cust = sqlsrv_fetch_array($res_cust);
		$PAN = $row_cust['PAN'];
		$CST = $row_cust['CST'];
		$lr_ids = $ID;
	}
?>
<style>table {border-collapse: collapse;}table, tr, th { border: 0px solid black;height:20px;}tr{font-size:12px;font-family:"Arial";font-weight:600;}table{border:0.1px solid;}td{padding:5px;}</style>
	<table width="700" border="1" cellspacing="0" cellpadding="0">
		<tr style="border:0px;">
			<td colspan="6" style="border:0px;"><img src="img/logo.jpg" width="685"></td>
		</tr>
		<tr style="height:60px;">
			<th colspan="5"><h3><u>Invoice</u></h3></th>
		</tr>
		<tr style="height:110px;">
			<td colspan="2" style="border:0px solid !important;">To, <br /><?=$CONSR. '<br />'. $CONSE_ADDRESS?><br /></td>
			<td colspan="3" align="right" style="border:0px solid !important;">Invoice No: <?=$inv_id = 'DLI/INV/' . (1000 + $inv_id)?><br />Quote Ref:<br />Date : <?=$LR_DATE?></td>
		</tr>
		<tr style="background-color:silver;height:50px;">
			<th width="40">SL No.</th>
			<th>Particular</th>
			<th>Service</th>
			<th width="90">Booking Date</th>
			<th width="70">Amount</th>
		</tr>
		</style>
		<?php
			$sel_lr = "select * from lr where ID in (".$lr_ids.")";
			//echo $sel_lr;
			$res_lr = sqlsrv_query($conn, $sel_lr);
			$i = 1;
			$tot = 0;
			$gtot = 0;
			while($row_lr = sqlsrv_fetch_array($res_lr)){
				$LR_DATE = date("d-m-Y", strtotime($row_lr['LR_DATE']));
				$LR_NUMBER = $row_lr['LR_NUMBER'];
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
				$SHIPPER = $row_lr['SHIPPER'];
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
				$CHARGED_RATE = $row_lr['CHARGED_RATE'];
				$FREIGHT = $row_lr['FREIGHT'];
				$TOTAL = $row_lr['TOTAL'];
				$EXP_DEL_DATE = $row_lr['EXP_DEL_DATE'];
				$REMARKS = $row_lr['REMARKS'];
				$STATUS = $row_lr['STATUS'];
				$CREATED_BY = $row_lr['CREATED_BY'];
				$CREATED_DATE = $row_lr['CREATED_DATE'];
				$SERVICE_TAX = '0.00';
				$GRAND_TOTAL = $TOTAL + $SERVICE_TAX;
				$tot = $tot + $TOTAL;
				$gtot = $gtot + $GRAND_TOTAL;
				$sel_goods = "select * from goods where ID = '".$GOODS."'";
				$res_goods = sqlsrv_query($conn, $sel_goods);
				$r_goods = sqlsrv_fetch_array($res_goods);
				$GOODS = $r_goods['NAME'];
		?>
		<tr style="height:40px;">
			<td><?=$i?></td>
			<td><?=$GOODS.' ('.$LR_NUMBER.')<br /> Shipper : '.$SHIPPER?></td>
			<td><?=$DELIVERY_AT.'<br />Volume : '.$QUANTITY?></td>
			<td><?=$LR_DATE?></td>
			<td align="right" style="padding-right:5px;"><?=$TOTAL?></td>
		</tr>
		<?php
			$i = $i + 1;
			}
		?>
		<tr style="height:40px;">
			<td></td>
			<td></td>
			<td></td>
			<td align="right">Total</td>
			<td align="right" style="padding-right:5px;"><?=$tot?></td>
		</tr>
		<tr style="height:40px;">
			<td></td>
			<td></td>
			<td></td>
			<td align="right">Service Tax</td>
			<td align="right" style="padding-right:5px;"><?=$SERVICE_TAX?></td>
		</tr>
		<tr style="height:40px;">
			<td></td>
			<td></td>
			<td></td>
			<td align="right">Grand Total</td>
			<td align="right" style="padding-right:5px;"><?=$gtot?></td>
		</tr>
	</table><br />
	<table width="700" border="0" cellspacing="0" cellpadding="0" style="border:1px solid !important;">
		<tr>
			<td style="border:0px solid !important;">
				Rupees:<br /><?=convert_number_to_words(strtoupper($gtot))?><br /><br /><br /><br />
				PAN No: AAACQ3346G<br />
				Service Tax No: TEMPB1458XSB001<br />
				Reg No: U60200MH2013PTC251157<br /><br /><br />
			</td>
			<td colspan="2" align="right" style="border:0px solid !important;">For Qube Services Pvt. Ltd.<br /><br /><br /><br />Authorized Signatory<br /><br /><br /></td>
		</tr>
		<tr style="height:60px;">
			<td colspan="3" align="center" style="border:0px solid !important;">
				Declaration : We declare that this invoice shows the actual price of all the services
				described and that all the particulars are true and correct
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