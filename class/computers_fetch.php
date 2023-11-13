<?php  
include("../inc/config.php");
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}
if(isset($_POST["id_data"]))  
 {  
      $query = "SELECT * FROM inventory WHERE data_type='1' and id='".$_POST["id_data"]."'";
      $result = sqlsrv_query($con, $query);  
	  while ($row = sqlsrv_fetch_array($result)) {
		$data = array(
    		"id"=>$row['id'],
    		"users"=>$row['users'],
    		"device_name"=>$row['device_name'],
			"brand"=>$row['brand'],
			"model"=>$row['model'],
			"sn"=>$row['sn'],
			"os"=>$row['os'],
			"office"=>$row['office'],
			"licence"=>$row['licence'],
			"antivirus"=>$row['antivirus'],
			"ad"=>$row['ad'],
			"cpu"=>$row['cpu'],
			"ram"=>$row['ram'],
			"hdd"=>$row['hdd'],
			"ip"=>$row['ip'],
			"mac"=>$row['mac'],
			"location"=>$row['location'],
			"nots"=>$row['nots']
    	);
	}
echo json_encode($data);
 }  
?>