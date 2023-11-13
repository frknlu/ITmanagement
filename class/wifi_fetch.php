<?php  
include("../inc/config.php");
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}
if(isset($_POST["id_data"]))  
 {  
      $query = "SELECT * FROM inventory WHERE data_type='7' and id='".$_POST["id_data"]."'";
      $result = sqlsrv_query($con, $query);  
	  while ($row = sqlsrv_fetch_array($result)) {
		$data = array(
    		"id"=>$row['id'],
    		"users"=>$row['users'],
    		"device_name"=>$row['device_name'],
			"brand"=>$row['brand'],
			"model"=>$row['model'],
			"sn"=>$row['sn'],
			"ip"=>$row['ip'],
			"mac"=>$row['mac'],
			"location"=>$row['location'],
			"firmware"=>$row['firmware'],
			"nots"=>$row['nots']
    	);
	}
echo json_encode($data);
 }  
?>