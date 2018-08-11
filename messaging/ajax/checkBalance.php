<?php
error_reporting(0);
require('../config/config.inc.php');
require_once('../rajaSMS/api_sms_class_reguler_json.php'); // class
global $conn;

$sql = "SELECT * FROM settings WHERE ID = 1";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $apiKey = $row["apiKey"];
	$ipServer = $row["ipServer"];
}

$conn->close();

// create header json  
$senddata = array(
	'apikey' => $apiKey
);
$sms = new sms_class_reguler_json();
$sms->setIp($ipServer); 
$sms->setData($senddata);
$resnponjson = $sms->balance();
echo $resnponjson;
