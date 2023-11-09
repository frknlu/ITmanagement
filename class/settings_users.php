<?php
include '../inc/config.php';

if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}

## Read value
$draw = $_POST['draw'];


## Fetch records
$empQuery = "select * from users";
$empRecords = sqlsrv_query($con, $empQuery);
$data = array();

while ($row = sqlsrv_fetch_array($empRecords)) {
	
	if($row['active'] == 1){
		$status = "<t style='color:green;'>Active</t>";
	}else{
		$status = "<t style='color:red;'>Closed</t>";
	}
	
	$authority_check = explode(',', $row["authority"]);
	if (in_array("1", $authority_check)) {
		$a = "[Ekle]";
	}
		if (in_array("2", $authority_check)) {
		$b = "[Düzenle]";
	}
		if (in_array("3", $authority_check)) {
		$c = "[Sil]";
	}
		if (in_array("4", $authority_check)) {
		$d = "[Görüntüle]";
	}
	
	if (in_array("5", $authority_check)) {
		$e = "[Ayarlar]";
	}
	
    $data[] = array(
    		"id"=>$row['id'],
    		"username"=>$row['nickname'],
			"authority"=>$a." ".$b." ".$c." ".$d." ".$e,
			"modified"=> "",
			"active"=>$status
    	);
}

## Response
$response = array(
    "draw" => intval($draw),
    "aaData" => $data
);

echo json_encode($response);
