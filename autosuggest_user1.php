<?php
if(isset($_REQUEST['act']) && $_REQUEST['act'] =='autoSuggestUser' && isset($_REQUEST['queryString'])) {
   require_once 'conf/database.php';   
   //if($db){
  	$string = '';
		$queryString = $_REQUEST['queryString'];
		$query = "select c.CONSIGN_NAME, c.MOBILE, c.EMAIL, city.NAME, c.ADDRESS 
				from customer as c 
				inner join city on c.CITY = city.ID 
				WHERE c.CONSIGN_NAME like'" .$queryString . "%' order by c.CONSIGN_NAME";
		//echo $query;		
		$resource = sqlsrv_query($conn, $query, array(), array("Scrollable" => 'static'));
		if($resource && sqlsrv_num_rows($resource) > 0) {
		$string.= '<ul>';
			while($result = sqlsrv_fetch_object($resource)){
				$string.= '<li onClick="fillId1(\''.addslashes($result->CONSIGN_NAME).'\', \''.addslashes($result->MOBILE).'\', \''.addslashes($result->ADDRESS).'\');
										fill1(\''.addslashes($result->CONSIGN_NAME).'\', \''.addslashes($result->MOBILE).'\', \''.addslashes($result->ADDRESS).'\');">'.$result->CONSIGN_NAME. ','. $result->NAME .'</li>';
			}
		$string.= '</ul>';
		} else {
			$string.= '<li>No Record found</li>';
		}
		echo $string;		
		exit;
}
?>