<?php  
include("../inc/config.php");
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}
if(isset($_POST["id_data"]))  
 {  
      $query = "SELECT * FROM sim WHERE id='".$_POST["id_data"]."'";
      $result = sqlsrv_query($con, $query);  
	  while ($row = sqlsrv_fetch_array($result)) {
		$data = array(
    		"id"=>$row['id'],
    		"users"=>$row['users'],
    		"number"=>$row['number'],
			"operator"=>$row['operator'],
			"type"=>$row['type'],
			"short_number"=>$row['short_number'],
			"nots"=>$row['nots']
    	);
	}
echo json_encode($data);
 }  
?>