<?php
// sample get status sms 
$respondata=json_decode(file_get_contents('php://input'),TRUE);
if (!empty($respondata))
{
	foreach($respondata['status_respon'] as $data) 
		{
			$sendingid          = $data['sendingid'];
			$number             = $data['number'];
			$deliverystatus     = $data['deliverystatus'];
			$deliverystatustext = $data['deliverystatustext'];
			
			// here ..... insert/update ....sql....table   
		}
}
?>
