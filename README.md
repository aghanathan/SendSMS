# SendSMS
### Contoh Penggunaan SMS API (dengan Raja-Sms) :beer: :beer: :beer:

- [x] Check Balance (Saldo & Expiration Date)
- [x] Update Settings (API Key, IP Server & Recipient Number)
- [x] Send SMS/Text Message
- [x] Message Log/History

## Demo
- Youtube

## Contoh Penggunaan
```php
<?php
error_reporting(0);
require('../config/config.inc.php');
require_once('../rajaSMS/api_sms_class_reguler_json.php'); // class

if (isset($_POST)) {
	global $conn;

	$sql = "SELECT * FROM settings WHERE ID = 1";
	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
		$apiKey = $row["apiKey"];
		$ipServer = $row["ipServer"];
		$number = $row["phoneNumber"];
	}

	$callBackurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // url callback get status sms 

	// create header json  
	$sendData = array(
		'apikey' => $apiKey,  
		'callbackurl' => $callBackurl, 
		'datapacket'=>array()
	);
	
	$message = $_POST['message'];
	
	array_push($sendData['datapacket'],array(
				'number' => trim($number),
				'message' => urlencode(stripslashes(utf8_encode($message))),
				'sendingdatetime' => ""));

	// class sms 
	$sms = new sms_class_reguler_json();
	$sms->setIp($ipServer);
	$sms->setData($sendData);
	$responJson = $sms->send();
	$parseJson = json_decode($responJson, true);
	$getStatus = $parseJson['sending_respon'][0]['globalstatustext'];
	if (addMessageLog($number, $message, $getStatus)) {
		echo $getStatus;
	} else {
		echo "Error While Updating Message History";
	}
}

function addMessageLog($toNumber, $message, $status) {
	global $conn;
	$sql = "INSERT INTO messagelog (toNumber, message, status) VALUES ('$toNumber', '$message', '$status')";
	if ($conn->query($sql)) {
		return true;
	} else {
		return false;
	}

	$conn->close();
}
```
