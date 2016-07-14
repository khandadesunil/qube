<?php

ob_start();

/* if( isset($_SESSION['login_name']) && $_SESSION['login_name'] ! = "") {
  session_start();
  session_unregister('login_name');
  session_unregister('password');
  session_destroy();
  } */
session_start();
session_destroy();
$_SESSION['password'] = '';
$_SESSION['username'] = '';
header("Location:index.php");
?>
