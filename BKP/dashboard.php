<?php
	require_once 'header.php';
?>
	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					<div class="span12">
						<div class="widget widget-nopad">
							<script>$(document).ready(function(){ $("#menu1").addClass(" active");});</script>
							<form name="form_filter" action="lr_export_master.php" method="get">
								<h3>Master Report - Booking</h3><br />
								From Booking Date <input type="text" class="tcal" name="f_date" id="f_date" style="width:150px" readonly> &nbsp; &nbsp; 
								To Booking Date <input type="text" class="tcal" name="t_date" id="t_date" style="width:150px" readonly> &nbsp; &nbsp; 
								<input type="submit" name="export" id="export" value="Export to Excel" class="btn btn-primary">
							</form>	
						</div>
					</div>										
				</div>										
			</div>										
		</div>										
	</div>										
										
<?php
require_once 'footer.php';
?>