<?php
include("../inc/config.php");

ob_start();
session_start();
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}

## Read value
$draw = $_POST['draw'];

$empRecords = sqlsrv_query($con, "select * from printers WHERE hide='0'");
$data = array();

while ($row = sqlsrv_fetch_array($empRecords)) {
	
	//$kayit_tarih = date('d-m-Y', strtotime($row["kayit_tarih"]));

	$user_query = sqlsrv_query($con, "select * from employee WHERE id='".$row['users']."'");
	$user_row = sqlsrv_fetch_array($user_query);	
	$users = $user_row['name']." ".$user_row['surname'];
									
    $data[] = array(
    		"id"=>$row['id'],
    		"users"=>$users,
    		"device_name"=>$row['device_name'],
			"brand"=>$row['brand'],
			"model"=>$row['model'],
			"sn"=>$row['sn'],
			"ip"=>'<a href="https://'.$row['ip'].'" target="_blank" >'.$row['ip'].'</a>',
			"mac"=>$row['mac'],
			"place"=>$row['place'],
			"toner"=>$row['toner'],
			"toner_q"=>$row['toner_q'],
			"nots"=>$row['nots']
    	);

$sim = "";		
$users = "Null";		
		
}

## Response
$response = array(
    "draw" => intval($draw),
    "aaData" => $data
);

echo json_encode($response);
