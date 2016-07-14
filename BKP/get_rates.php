<?php
	require_once 'conf/database.php';
	$data = '<tr><td>
			<select class="select span3" name="SRC[]">
				<option value="">Select</option>';
					$sel_f_branch = "select * from city where type != 'DELIVERY' order by NAME";
					$res_f_branch = sqlsrv_query($conn, $sel_f_branch);
					while($r_f_branch = sqlsrv_fetch_array($res_f_branch)){
						$f_br_id = $r_f_branch["ID"];
						$f_br_name = $r_f_branch["NAME"];
	$data .= '				<option value="'.$f_br_id.'">'.$f_br_name.'</option>';
					}
	$data .= '</select></td><td>
			<select class="select span3" name="DEST[]">
				<option value="">Select</option>';
					$sel_t_branch = "select * from city where type != 'BOOKING' order by NAME";
					$res_t_branch = sqlsrv_query($conn, $sel_t_branch);
					while($r_t_branch = sqlsrv_fetch_array($res_t_branch)){
						$t_br_id = $r_t_branch["ID"];
						$t_br_name = $r_t_branch["NAME"];
	$data .= '<option value="'.$t_br_id.'">'.$t_br_name.'</option>';
					}
	$data .= '</select>
		</td>
		<td><input type="text" name="MIN_RATE[]" value="" class="span2"></td>
		<td><input type="text" name="RATE[]" value="" class="span2"></td>
	</tr>';
	echo $data;
?>