<?php
include '../inc/config.php';

if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}

## Read value
$draw = $_POST['draw'];

## Fetch records
$empQuery = "select * from logs";
$empRecords = sqlsrv_query($con, $empQuery);
$data = array();

while ($row = sqlsrv_fetch_array($empRecords)) {
	
	$user_query = sqlsrv_query($con, "select * from users WHERE id='".$row['user_id']."'");
	$user_row = sqlsrv_fetch_array($user_query);
	
    $data[] = array(
    		"id"=>$row['id'],
    		"user_id"=>$row['user_id']."->".$user_row['nickname'],
    		"module"=>$row['module'],
			"process_id"=>$row['process_id'],
			"process"=>$row['process'],
			"date"=>$row['date']->format('Y-m-d')
    	);
}

## Response
$response = array(
    "draw" => intval($draw),
    "aaData" => $data
);

echo json_encode($response);
