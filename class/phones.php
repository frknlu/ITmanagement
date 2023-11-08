<?php
include("../inc/config.php");

ob_start();
session_start();
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}

## Read value
$draw = $_POST['draw'];

$empRecords = sqlsrv_query($con, "select * from phones WHERE hide='0'");
$data = array();

while ($row = sqlsrv_fetch_array($empRecords)) {
	
	//$kayit_tarih = date('d-m-Y', strtotime($row["kayit_tarih"]));

	$user_query = sqlsrv_query($con, "select * from employee WHERE id='".$row['users']."'");
	$user_row = sqlsrv_fetch_array($user_query);	
	$users = $user_row['name']." ".$user_row['surname'];

    $data[] = array(
    		"id"=>$row['id'],
    		"users"=>$users,
    		"number"=>$row['number'],
			"brand"=>$row['brand'],
			"model"=>$row['model'],
			"sn"=>$row['sn'],
			"type"=>$row['type'],
			"short_number"=>$row['short_number'],
			"color"=>$row['color'],
			"imeil"=>$row['imeil'],
			"memory"=>$row['memory'],
			"nots"=>$row['nots']
    	);
		
$users = "Null";		
		
}

## Response
$response = array(
    "draw" => intval($draw),
    "aaData" => $data
);

echo json_encode($response);
