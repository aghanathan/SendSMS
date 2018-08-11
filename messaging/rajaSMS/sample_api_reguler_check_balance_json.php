<?php
require_once('api_sms_class_reguler_json.php'); // class  
ob_start();
// setting 
$apikey      = 'your_apikey'; // api key 
$ipserver    = 'http://your_server_sms_ip'; // url server sms 

// create header json  
$senddata = array(
	'apikey' => $apikey
);
$sms = new sms_class_reguler_json();
$sms->setIp($ipserver); 
$sms->setData($senddata);
$resnponjson = $sms->balance();
header('Content-Type: application/json');
echo $resnponjson;
?>
