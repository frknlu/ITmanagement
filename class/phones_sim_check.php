<?php  
include("../inc/config.php");
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}
if(isset($_POST["sim"]))  
 {  
      $query = "SELECT * FROM sim WHERE id='".$_POST["sim"]."'";
      $result = sqlsrv_query($con, $query);  
	  $row = sqlsrv_fetch_array($result);
	  echo "";
 }
?>