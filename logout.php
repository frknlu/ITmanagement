<?php
include("inc/config.php");
session_start();
ob_start();
$UserID = $_SESSION['UserID'];
sqlsrv_query($con,"DELETE FROM remember_me WHERE user_id='$UserID'");
unset($_SESSION['token']);
unset($_SESSION['userData']);
unset($_SESSION['Oturum']);
setcookie("RMB", 'false', time() -3600,'/');
setcookie("authority", 'false', time() -3600,'/');
setcookie("location", 'false', time() -3600,'/');
session_destroy();
header("Refresh: 0; url=login.php");
ob_end_flush();
?>