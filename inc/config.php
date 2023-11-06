<?php
$serverName = "DESKTOP-QPTEL22\SQLEXPRESS"; //mssql server name buraya gelecek.
$connectionInfo = array( "Database"=>"danet_it"); //db name buraya gelecek.
$con = sqlsrv_connect($serverName, $connectionInfo);

error_reporting(0);
 /*
if ($con) {
 echo "Connection Successfull <hr>";
}else{
 echo "Connection Failed! <hr>";
 die(print_r(sqlsrv_errors(), true));
}*/


   function seo($s) {
	$tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',' ',',','?');
	$eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','');
	$s = str_replace($tr,$eng,$s);
	$s = strtolower($s);
	$s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
	$s = preg_replace('/\s+/', '-', $s);
	$s = preg_replace('|-+|', '-', $s);
	$s = preg_replace('/#/', '', $s);
	$s = str_replace('.', '', $s);
	$s = str_replace('&', 'and', $s);
	$s = trim($s, '-');
	return $s;
}

	$wurl = "";
	
	$settings_query = sqlsrv_query($con,"SELECT * FROM settings where id='1'");
	$settings = sqlsrv_fetch_array($settings_query);

	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}	

if ( !isset($_SESSION['Oturum']) || $_SESSION['Oturum'] != 'true' ) {
	
  if ( isset($_COOKIE['RMB']) and $_COOKIE['RMB'] != 'false' ) {
 
$CookieToken = $_COOKIE['RMB'];
$Browser     = md5($_SERVER['HTTP_USER_AGENT']); 
$time        = time();

$remember_query = sqlsrv_query($con,"SELECT * FROM remember_me WHERE remember_token='{$CookieToken}' and user_browser='$Browser' and expired_time > $time ");
$query = sqlsrv_fetch_array($remember_query);
	
if ($query) {
 
$CookieUser = $query['user_id'];
 
$CheckUser2_query = sqlsrv_query($con,"SELECT * FROM users WHERE id='{$CookieUser}' ");
$CheckUser2 = sqlsrv_fetch_array($CheckUser2_query);

if ( $CheckUser2 ) {
    $_SESSION["Oturum"] = "true";
    $_SESSION["user"] = $CheckUser2["nickname"];
	$_SESSION["pass"] = $CheckUser2["password"];
	$_SESSION['UserID'] = $CheckUser2["id"];
	setcookie("authority", $CheckUser2['authority'], time()+604801);
	setcookie("darkmode", $CheckUser2['darkmode'], time()+(24*60*60));
} else {
  $_SESSION["Oturum"] = "false";
  setcookie("RMB", 'false', time() -3600,'/');
  setcookie("authority", 'false', time() -3600,'/');
  header("Location:login.php");
  exit;
}
 
} else {
  $_SESSION["Oturum"] = "false";
  setcookie("RMB", 'false', time() -3600,'/');
  setcookie("authority", 'false', time() -3600,'/');
  header("Location:login.php");
  exit;
}
 
}

}
?>