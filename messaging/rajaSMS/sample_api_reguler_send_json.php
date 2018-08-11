<?php
require_once('api_sms_class_reguler_json.php'); // class  
ob_start();
// setting 
$apikey      = 'your_apikey'; // api key 
$ipserver    = 'http://your_server_sms_ip'; // url server sms 
$callbackurl = 'http://your_url_for_get_auto_update_status_sms'; // url callback get status sms 

// create header json  
$senddata = array(
	'apikey' => $apikey,  
	'callbackurl' => $callbackurl, 
	'datapacket'=>array()
);

// create detail data json 
// data 1
$number1='6281xxx';
$message1='Message 1';
$sendingdatetime1 =""; 
array_push($senddata['datapacket'],array(
	'number' => trim($number1),
	'message' => urlencode(stripslashes(utf8_encode($message1))),
	'sendingdatetime' => $sendingdatetime1));
	
// data 2
$number2='081xxx';
$message2='Message 2';
$sendingdatetime2 ="2017-01-01 23:59:59";
array_push($senddata['datapacket'],array(
	'number' => trim($number2),
	'message' => urlencode(stripslashes(utf8_encode($message2))),
	'sendingdatetime' => $sendingdatetime2));
	
// class sms 
$sms = new sms_class_reguler_json();
$sms->setIp($ipserver);
$sms->setData($senddata);
$responjson = $sms->send();
header('Content-Type: application/json');
echo $responjson;
?>
