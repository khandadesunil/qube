<?php	
	require_once 'conf/database.php';
	$sess_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
	$sess_user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
	$sess_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
	$sess_user_type = isset($_SESSION['type']) ? $_SESSION['type'] : '';
	if($sess_user_name == ''){
		header("Location:logout.php");
	}
	require_once('mail.php');
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
<link rel="stylesheet" href="css/tcal.css" type="text/css"/>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/tcal.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span><span class="icon-bar"></span> </a>
			<a class="brand" href="index.php"><?=$_SESSION['company_name']?> </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
		<?php
			if($_SESSION['user_name'] != ''){
		?>
          <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?=$sess_user_name?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="change_password.php">Change Password</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
		 <?php
			}else{
		?>
		<li class="dropdown">
		<a href="index.php" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Login<b class="caret"></b></a>
	  </li>
		<?php
			}
		 ?>
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li id="menu1"><a href="dashboard.php"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
		<?php
			if($_SESSION['type'] == 'ADMIN'){
		?>
        <li id="menu2" class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-list-alt"></i><span>Masters</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="list_customers.php">Client</a></li>
            <li><a href="list_vehicles.php">Vehicles</a></li>
            <!--<li><a href="list_drivers.php">Drivers</a></li>-->
            <li><a href="list_goods.php">Commodity</a></li>
            <!--<li><a href="list_employees.php">Employee</a></li>-->
            <li><a href="list_users.php">User</a></li>
            <li><a href="list_branches.php">Branches</a></li>
            <li><a href="list_routes.php">Route</a></li>
            <li><a href="list_rates.php">Rates</a></li>
          </ul>
        </li>
		<?php
			}
		?>
		<li id="menu3"><a href="list_lr.php"> <i class="icon-book"></i><span>Booking</span> </a></li>
		<li id="menu4"><a href="list_bmo.php"> <i class="icon-mail-forward"></i><span>BMO</span> </a></li>
		<li id="menu6"><a href="list_bmi.php" > <i class="icon-tasks"></i><span>BMI</span> </a></li>
		<li id="menu7" class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-list-alt"></i><span>Delivery</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="list_delivery.php">Delivered List</a></li>
            <li><a href="delivery.php">Pending Delivery</a></li>
          </ul>
        </li>
		<li id="menu5"><a href="list_invoice.php"><i class="icon-money"></i><span>Invoice</span> </a> </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->