<?php  
include("../inc/config.php");
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}
if(isset($_POST["id_data"]))  
 {  
      $query = "SELECT * FROM department WHERE id='".$_POST["id_data"]."'";
      $result = sqlsrv_query($con, $query);  
	  while ($row = sqlsrv_fetch_array($result)) {
		$data = array(
    		"id"=>$row['id'],
    		"name"=>$row['name']
    	);
	}
echo json_encode($data);
 }  
?>