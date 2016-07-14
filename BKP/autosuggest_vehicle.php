<?php
if(isset($_REQUEST['act']) && $_REQUEST['act'] =='autoSuggestUser' && isset($_REQUEST['queryString'])) {
   require_once 'conf/database.php';   
   //if($db){
  	$string = '';
		$queryString = $_REQUEST['queryString'];
		$query = "select * from vehicle WHERE VEH_NUMBER like'" .$queryString . "%' order by VEH_NUMBER";
		//echo $query;		
		$resource = sqlsrv_query($conn, $query);
		if($resource && sqlsrv_num_rows($resource) > 0) {
		$string.= '<ul>';
			while($result = mysql_fetch_object($resource)){
				$string.= '<li onClick="fillId(\''.addslashes($result->VEH_NUMBER).'\');
										fill(\''.addslashes($result->VEH_NUMBER).'\');">'.$result->VEH_NUMBER. '</li>';
			}
		$string.= '</ul>';
		} else {
			$string.= '<li>No Record found</li>';
		}
		echo $string;		
		exit;
}
?>