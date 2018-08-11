<?php
error_reporting(0);
require('../config/config.inc.php');
global $conn;

if (isset($_POST)) {
	$stringURL = $_POST['ipServer'];
	// Tambahkan http jika belum
	if(preg_match("@^http://@i",$stringURL)) {
		$stringURL = preg_replace('@(http://)+@i','http://',$stringURL);
	} else {
		$stringURL = 'http://'.$stringURL;
	}
	$_POST['ipServer'] = $stringURL;
	// hilangkan spasi pada nomer telephone
	$_POST['phoneNumber'] = str_replace(' ', '', $_POST['phoneNumber']);
	
	$apiKey 	 = $_POST['apiKey'];
	$ipServer 	 = $_POST['ipServer'];
	$phoneNumber = $_POST['phoneNumber'];
	
	$sql = "UPDATE settings SET apiKey = '$apiKey',ipServer = '$ipServer',phoneNumber = '$phoneNumber' WHERE ID = 1";
	
	if ($conn->query($sql) === TRUE) {
		echo "Settings updated successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}