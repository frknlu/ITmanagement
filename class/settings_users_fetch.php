<?php  
include("../inc/config.php");

if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}

if(isset($_POST["id_data"]))  
 {  
      $query = "SELECT * FROM users WHERE id = '".$_POST["id_data"]."'";  
      $result = sqlsrv_query($con, $query);  
      $row = sqlsrv_fetch_array($result);  
      echo json_encode($row);  
 }  
?>