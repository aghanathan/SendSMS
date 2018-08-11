<?php
date_default_timezone_set('Asia/Jakarta');

$db_username        = 'root'; //MySql database username
$db_password        = ''; //MySql dataabse password
$db_name            = 'dbrajasms'; //MySql database name
$db_host            = 'localhost'; //MySql hostname or IP

$conn = mysqli_connect($db_host,$db_username,$db_password,$db_name);
// Check connection
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
?>