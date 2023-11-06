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
$empRecords = sqlsrv_query($con, "select * from employee WHERE hide='0'");
$data = array();

while ($row = sqlsrv_fetch_array($empRecords)) {
	
	$department_q = sqlsrv_query($con, "select * from department WHERE id='".$row['department']."'");
	$department_row = sqlsrv_fetch_array($department_q);
	$department = $department_row["name"];
	
	/* $date = date("d/m/Y", strtotime($row["birthday"])); */
	
    $data[] = array(
    		"id"=>$row['id'],
    		"name"=>$row['name'],
			"surname"=>$row['surname'],
			"mail"=>$row['mail'],
			"phone"=>$row['phone'],
			"title"=>$row['title'],
			"department"=>$department
    	);
}

## Response
$response = array(
    "draw" => intval($draw),
    "aaData" => $data
);

echo json_encode($response);
