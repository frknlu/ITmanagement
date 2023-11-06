<?php  
include("../inc/config.php");
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}
if(isset($_POST["id_data"]))  
 {  
      $query = "SELECT * FROM employee WHERE id='".$_POST["id_data"]."'";
      $result = sqlsrv_query($con, $query);  
	  while ($row = sqlsrv_fetch_array($result)) {
		$data = array(
    		"id"=>$row['id'],
    		"name"=>$row['name'],
    		"surname"=>$row['surname'],
			"mail"=>$row['mail'],
			"title"=>$row['title'],
			"phone"=>$row['phone'],
			"department"=>$row['department'],
			"start_date"=>$row['start_date']->format('Y-m-d'),
			"end_date"=>$row['end_date']
    	);
	}
echo json_encode($data);
 }  
?>