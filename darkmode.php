<?php
include("inc/config.php");
ob_start();
session_start();
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}
if($_COOKIE["darkmode"] == "dark"){
setcookie("darkmode", "light", time()+(24*60*60)); 
sqlsrv_query($con,"UPDATE users SET darkmode='light' where id='".$_SESSION['UserID']."' ");
}else{ 
setcookie("darkmode", "dark", time()+(24*60*60)); 
sqlsrv_query($con,"UPDATE users SET darkmode='dark' where id='".$_SESSION['UserID']."' ");
}
?>