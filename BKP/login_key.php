<?php
	ob_start();
	$a = session_id();
	if (!$a) {
		session_start();
	}
	$_SESSION['company_name'] = 'Qube Services';
	require_once 'conf/database.php';

	$msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
	
	if($msg == 'scc'){
		$msg = '<div style="color:green;">Your Password has been Changed!!</div>';
	}
	if (isset($_SESSION['user'])) {
		$user_name = $_SESSION['user']['user'];
		$password = $_SESSION['user']['pass'];
		$key_sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' AND password = '" . md5($password) . "'";
		$key_res = sqlsrv_query($conn, $key_sql);
		while ($row = sqlsrv_fetch_array($key_res)) {
			$secret_key = $row['SECRET_KEY'];
		}

		if($secret_key != ''){
			$initCode = $secret_key;
			$display_image = 0;
		}else{
			$initCode = randomString(15);
			$up_sql = "UPDATE users SET SECRET_KEY = '".$initCode."' WHERE user_name = '" . $user_name . "'";
			$res = sqlsrv_query($conn, $up_sql);
			$display_image = 1;
		}
		require_once 'g2f/authentication.php';
		$TimeStamp	  = Google2FA::get_timestamp();
		$secretkey 	  = Google2FA::base32_decode($initCode);
		$otp = Google2FA::oath_hotp($secretkey, $TimeStamp);	// Get current token
		if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Login'){
			$google_key = $_REQUEST['key'];
			if($otp == $google_key){
				$sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' AND password = '" . md5($password) . "'";
				$res = sqlsrv_query($conn, $sql);
				if(sqldrv_num_rows($res) > 0){
					while($rows = sqlsrv_fetch_array($res)){
						$_SESSION['user_id'] = $rows['user_id'];
						$_SESSION['user_name'] = $user_name;
						$_SESSION['first_name'] = $rows['first_name'];
						$_SESSION['email'] = $rows['email'];
						$_SESSION['for_branch'] = $rows['for_branch'];
						$_SESSION['type'] = $rows['type']; 
						header("Location:dashboard.php");
					};
				}
			}
		}else {
			$msg = '<div style="color:red;">Invalid user name or password</div>';
		}
	}else{
		header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?=$_SESSION['company_name']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link href="css/pages/signin.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
	jQuery(document).ready(function(){
		jQuery("#submit_form").validationEngine();
	});
</script>
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.html"><?=$_SESSION['company_name']?></a> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="account-container">
						<div class="content clearfix">
							<form action="" method="post" id="submit_form">
								<h1>Member Login</h1>		
								<div class="login-fields">
									<?php
										if($display_image == 1){
											$bar_image =  'http://chart.apis.google.com/chart?cht=qr&chs=100x100&chl=otpauth://totp/qubeservices?secret='.$initCode.'&chld=H|0&';
											echo '<img src = "'.$bar_image.'">';
									
										}
									?>
									<div class="field">
										<label for="password">Password:</label>
										<input type="text" class="login password-field validate[required]" placeholder="Google Authenticate Key" value="" name="key" id="password">
									</div> <!-- /password -->
								</div> <!-- /login-fields -->
								<div class="login-actions">
									<input type="submit" name="submit" id="login" value="Login" class="button btn btn-success btn-large">
								</div> <!-- .actions -->
							</form>
						</div> <!-- /content -->
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
function randomString($length = 15) {
 $str = "";
 $characters = array_merge(range('A','Z'), range('a','z'));
 $max = count($characters) - 1;
 for ($i = 0; $i < $length; $i++) {
  $rand = mt_rand(0, $max);
  $str .= $characters[$rand];
 }
 return $str;
}
require_once 'footer.php';
?>