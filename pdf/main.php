<?php
	require('html2fpdf.php');
	function generatePDF($file, $strContent){
		$pdf=new HTML2FPDF();
		$pdf->AddPage();
						
		if ($strContent != '') {
			$pdf->WriteHTML($strContent);
			$pdf->Output($file);
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			unlink($file);
			exit;
		}
	}
	$strContent = "
				This is html test '".$_REQUEST['testing']."'
				";
	
	generatePDF('test.pdf', $strContent);
?>