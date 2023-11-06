<?php
include("../inc/config.php");

ob_start();
session_start();
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}

## Read value
$draw = $_POST['draw'];

## Fetch records
$empRecords = sqlsrv_query($con, "select * from department WHERE hide='0'");
$data = array();

while ($row = sqlsrv_fetch_array($empRecords)) {
	

    $data[] = array(
    		"id"=>$row['id'],
    		"name"=>$row['name']
    	);
}

## Response
$response = array(
    "draw" => intval($draw),
    "aaData" => $data
);

echo json_encode($response);
