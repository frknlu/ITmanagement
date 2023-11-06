<?php
include("inc/config.php");
ob_start();
session_start();

$User = $_POST['nickname'];
$Pass = hash('sha256', $_POST['pass']);
 
$CheckUser_query = sqlsrv_query($con,"SELECT * FROM users WHERE nickname='{$User}' and password='{$Pass}' ");
$CheckUser = sqlsrv_fetch_array($CheckUser_query);
 
if ( $CheckUser ) {
	
    $_SESSION["Oturum"] = "true";
    $_SESSION["user"] = $User;
    $_SESSION["pass"] = $Pass;
	$_SESSION['UserID'] = $CheckUser['id'];
	setcookie("authority", $CheckUser['authority'], time()+604801);
	setcookie("darkmode", $CheckUser['darkmode'], time()+(24*60*60));
	
if ( isset($_POST['remember-me']) ) {
$UserID = $CheckUser['id']; // Kullanıcının id'si.
$delete = sqlsrv_query($con,"DELETE FROM remember_me WHERE user_id='$UserID'");
$NewToken = bin2hex(openssl_random_pseudo_bytes(32));
$time = time()+604800;
$md = md5($_SERVER['HTTP_USER_AGENT']);
sqlsrv_query($con,"INSERT INTO remember_me (user_id, remember_token, expired_time, user_browser) VALUES ('".$UserID."', '".$NewToken."', '".$time."', '".$md."')");
setcookie("RMB", $NewToken, time() + 604801,'/');
}

header("Location:index.php");
 
}
else {
	if($User=="" or $Pass=="") {
header("Location: login.php?alert&msg=Please do not leave the username or password blank..!");
	}
	else {
header("Location: login.php?alert&msg=Username or Password Incorrect");
	}
}

//header("Location:index.php");
 
ob_end_flush();
?>