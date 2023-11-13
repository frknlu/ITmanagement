<?php
include("../inc/config.php");

ob_start();
session_start();
if ( $_SESSION['Oturum'] != 'true' ) { 
 header("Location:login.php");
}

## Read value
$draw = $_POST['draw'];

$empRecords = sqlsrv_query($con, "select * from inventory WHERE data_type='1' and hide='0'");
$data = array();

while ($row = sqlsrv_fetch_array($empRecords)) {
	
	//$kayit_tarih = date('d-m-Y', strtotime($row["kayit_tarih"]));

	$user_query = sqlsrv_query($con, "select * from employee WHERE id='".$row['users']."'");
	$user_row = sqlsrv_fetch_array($user_query);	
	$users = $user_row['name']." ".$user_row['surname'];

		  if($row['licence'] == "1"){$licence = "Var"; }else{$licence = "Yok"; }
		  if($row['ad'] == "1"){$ad = "Var"; }else{$ad = "Yok"; }
		  if($row['antivirus'] == "1"){$antivirus = "Var"; }else{$antivirus = "Yok"; }
		  
    $data[] = array(
			"users"=> $users,
			"device_name"=> $row['device_name'],
			"brandmodel"=> $row['brand']." ".$row['model'],
			"sn"=> $row['sn'],
			"os"=> $row['os'],
			"office"=> $row['office'],
			"licence"=> $licence,
			"ad"=> $ad,
			"cpuramhdd"=> $row['cpu']." ".$row['ram']." ".$row['hdd'],
			"ipmac"=> $row['ip']." ".$row['mac'],
			"location"=> $row['location'],
			"nots"=> $row['nots'],
			"id"=>$row['id']
    	);
		
$users = "Null";		
		
}

## Response
$response = array(
    "draw" => intval($draw),
    "aaData" => $data
);

echo json_encode($response);
