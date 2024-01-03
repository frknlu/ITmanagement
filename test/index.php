<html>
    <head>
        <meta http-equiv="refresh" content="30">
    </head> 
<body> 

<?php
date_default_timezone_set('Europe/Istanbul');

$host = array("10.0.1.1","127.0.0.1");
echo "<h1>Site Status  ".date("H:i:s")."</h1>";

$nowdate = date("d-m-Y");

foreach ($host as $ip){

$count="2";
$timeout="100";
$size="32";
$ttl="128";
$output=shell_exec('ping -i '.$ttl.' -l '.$size.' -w '.$timeout.' -n '.$count.' '.$ip);


if (strpos($output, 'out') !== false) {
    $status = "DOWN";
}
    elseif(strpos($output, 'expired') !== false)
{
    $status = "Network Error";
}
    elseif(strpos($output, 'data') !== false)
{
    $status = "UP";
}
else
{
    $status = "Unknown Error";
}

echo $status."<br>";
echo "<pre>$output</pre>"; 

$date = date("d-m-Y h:i:s");

$fp = fopen("status.txt", "a");
fputs($fp, "Date » $date | Location » $ip | Status » $status \r\n");
fclose($fp);


$data[] = array(
    		"location"=>$ip,
			"status"=>$status
    	);
$response = array(
    "Date" => $nowdate,
	"Time" => $date,
    "Data" => $data
);

}

$fp = fopen('data.json', 'a');
fwrite($fp, json_encode($response, JSON_PRETTY_PRINT)); 
fclose($fp);

?>

</body>
</html>