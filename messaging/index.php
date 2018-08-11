<?php
error_reporting(0);
require('./config/config.inc.php');
global $conn;

$sql = "SELECT * FROM settings WHERE ID = 1";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
	$apiKey = $row["apiKey"];
	$ipServer = $row["ipServer"];
	$number = $row["phoneNumber"];
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<style>
label.title { 
	font-weight: bold;
	color:#333;
}

label.error { 
	color:red;
}

small { font-style: italic; }
</style>
<title>:: Raja SMS API ::</title>
</head>
<body>
<div class="container" style="margin-top:50px;">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col"><img src="./images/RajaSmsLogo.png" alt="logo"></div>
				<div class="col">
					<div class="row">
						<div class="col">
							<label class="title">Saldo</label>
						</div>
						<div class="col" id="txtSaldo"></div>
					</div>
					<div class="w-100"></div>
					<div class="row">
						<div class="col">
							<label class="title">Expired</label>
						</div>
						<div class="col" id="txtExpired"></div><div id="expiredbadge"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:10px;">
		<div class="col-md-6" id="notification"></div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<form id="submitSettingForm" method="POST" action="./ajax/updateSettings.php">
						<div class="form-group">
							<label class="title">Raja-SMS API Key</label>
							<input type="text" class="form-control" name="apiKey" id="apiKey" value="<?php echo $apiKey; ?>" placeholder="Masukkan raja-sms API Key">
							<small class="form-text text-muted"><a href="https://raja-sms.com/register" target="_blank">Register</a> <b>raja-sms.com</b> untuk mendapatkan API KEY</small>
							<small class="form-text text-muted"><b>Informasi:</b> API KEY ,Silahkan login ke Sms Server, menu api information</small>
						</div>
						<div class="form-group">
							<label class="title">Raja-SMS Url/IP Server</label>
							<input type="text" class="form-control" name="ipServer" id="ipServer" value="<?php echo $ipServer; ?>" placeholder="Masukkan IP Server">
							<small class="form-text text-muted">Misal <b>http://45.76.156.114</b> atau <b>45.76.156.114</b></small>
						</div>
						<div class="form-group">
							<label class="title">Nomer HandPhone Penerima</label>
							<input type="text" class="form-control" name="phoneNumber" id="phoneNumber" value="<?php echo $number; ?>" placeholder="Nomer HandPhone Anda">
							<small class="form-text text-muted">Misal <b>6285216427652</b> (62 untuk kode negara <b>Indonesia</b>)</small>
						</div>
						<button type="button" id="btnSave" class="btn btn-primary">Save Changes</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<form id="submitMessageForm" method="POST" action="./ajax/sendSms.php">
						<div class="form-group">
							<label class="title">Isi Pesan</label>
							<textarea class="form-control" name="message" id="message" rows="3" placeholder="Ketik Pesan Anda"></textarea>
							<small class="form-text text-muted">Maksimal 1600 Karakter<br>Special Karakter Dihitung 2 Karakter</small>
						</div>
						<button type="button" id="btnSend" class="btn btn-primary">Test Kirim SMS</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:30px;">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<table class="table" id="messageLog" class="table table-striped table-bordered">
					  <thead>
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">To</th>
						  <th scope="col">Message</th>
						  <th scope="col">Date</th>
						  <th scope="col">Status</th>
						</tr>
					  </thead>
					  <tfoot>
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">To</th>
						  <th scope="col">Message</th>
						  <th scope="col">Date</th>
						  <th scope="col">Status</th>
						</tr>
					  </tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	// Check Balance
	checkBalance();
	
	// Show Table
	$('#messageLog').DataTable( {
		language: {
			url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
		},
		"paging": true,        
        "info": true,
		"pageLength" : 10,
		"processing": true,
        "serverSide": true,
		"ajax": "ajax/jsonData.php",
        "columns": [
            { "data": "ID" },
            { "data": "toNumber" },
            { "data": "message" },
            { "data": "sendDate" },
            { "data": "status" }
        ],
		dom: 'Bfrtip',
        buttons: [ 'copy', 'csv', 'excel', 'pdf',
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
	});

	// validate settings form on keyup and submit
	$("#submitSettingForm").validate({
		rules: {
			apiKey: "required",
			ipServer: "required",
			phoneNumber: {
						required: true,
						number:true
					}
		},
		messages: {
			apiKey: "Mohon masukkan raja-sms API Key",
			ipServer: "Mohon masukkan IP Server",
			phoneNumber: {
						required: "Mohon masukkan nomer HandPhone Anda",
						number:"Mohon untuk mengisi hanya berupa angka"
					}
		}
	});
	
	$('#btnSave').on('click', function() {
		if ($("#submitSettingForm").valid()) {
			updateSettings();
		}
	});
	
	// validate send message form on keyup and submit
	$("#submitMessageForm").validate({
		rules: { message: "required"},
		messages: { message: "Mohon isi pesan yang akan dikirim"}
	});
	
	$('#btnSend').on('click', function() {
		if ($("#submitMessageForm").valid()) {
			sendTextMessage();
			checkBalance();
			$('#message').val(''); // Clear TextArea
			$('#messageLog').dataTable().fnDestroy();
			table = $('#messageLog').dataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "ajax/jsonData.php",
				"columns": [
					{ "data": "ID" },
					{ "data": "toNumber" },
					{ "data": "message" },
					{ "data": "sendDate" },
					{ "data": "status" }
				]
			});
		}
	});
});

function checkBalance() {
	$.ajax({
		type: 'POST', 
		url: './ajax/checkBalance.php',
		dataType: 'json',
		success: function(jsonData){
			// console.log(jsonData);
			var respondata = JSON.stringify(jsonData);
			respondata = $.parseJSON(respondata);
			$('#txtSaldo').html(respondata.balance_respon[0].Balance);
			$('#txtExpired').html(respondata.balance_respon[0].Expired);
			var expireDate = new Date(respondata.balance_respon[0].Expired).getTime();
			var todayDate = new Date().getTime();
			if (expireDate > todayDate) {
				$('#txtExpired').html('<span class="badge badge-danger">'+respondata.balance_respon[0].Expired+'</span>');
			} else {
				$('#txtExpired').html('<span class="badge badge-secondary">'+respondata.balance_respon[0].Expired+'</span>');
			}
		}
	});
}

function updateSettings() {	
	var form = $("#submitSettingForm")[0];	
	var formData = new FormData(form);
    $.ajax({
        type: 'POST',
        url: "./ajax/updateSettings.php",
        data: formData,
		cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
			$('#notification').html('<div class="alert alert-success" role="alert">'+response+'</div>');
        }
    });
}

function sendTextMessage() {
	var form = $("#submitMessageForm")[0];	
	var formData = new FormData(form);
    $.ajax({
        type: 'POST',
        url: "./ajax/sendSms.php",
        data: formData,
		cache: false,
        contentType: false,
        processData: false,
        success: function (status) {
			console.log(status);
			if (status == "Success"){
				$('#notification').html('<div class="alert alert-success" role="alert">Message sent successfully</div>');
			} else {
				$('#notification').html('<div class="alert alert-danger" role="alert">Error: '+status+'</div>');
			}
        }
    });
}
</script>
</body>
</html>