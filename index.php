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
	unset($_SESSION['user']);
	
	if (isset($_REQUEST['login'])) {
		$user_name = $_REQUEST['user_name'];
		$password = $_REQUEST['password'];
		$sql = "SELECT user_id, user_name, first_name, email, for_branch, password, type FROM users WHERE user_name = '" . $user_name . "' AND password = '" . md5($password) . "'";
		$res = sqlsrv_query($conn, $sql);
		$row = sqlsrv_fetch_array($res);
		if($row['user_name'] != '' && $row['password'] != ''){
			$_SESSION['user'] = array('user'=>$user_name,'pass'=>$password);
			/*Comment below code*/
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_name'] = $user_name;
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['for_branch'] = $row['for_branch'];
			$_SESSION['type'] = $row['type']; 
			header("Location:dashboard.php");
			/*Comment above code*/
			//header("Location:login_key.php");
		}else {
			$msg = '<div style="color:red;">Invalid user name or password</div>';
		}
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
									<p>Please provide your details</p>
									<div class="field">
										<label for="user_name">user_name</label>
										<input type="text" class="login username-field validate[required]" placeholder="user name" value="" name="user_name" id="user_name" >
									</div> <!-- /field -->
									<div class="field">
										<label for="password">Password:</label>
										<input type="password" class="login password-field validate[required]" placeholder="Password" value="" name="password" id="password">
									</div> <!-- /password -->
								</div> <!-- /login-fields -->
								<div class="login-actions">
									<input type="submit" name="login" id="login" value="Login" class="button btn btn-success btn-large">
								</div> <!-- .actions -->
							</form>
						</div> <!-- /content -->
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
require_once 'footer.php';
?>