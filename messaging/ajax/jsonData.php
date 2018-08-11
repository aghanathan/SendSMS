<?php
error_reporting(0);
require('../config/config.inc.php');
global $conn;

$sql = "SELECT * FROM messagelog";
$result = $conn->query($sql);

$rows = array();

while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

$json_data = array(
            "iTotalRecords"		    => intval( $rows ),
            "iTotalDisplayRecords"  => intval( $rows ),
            "aaData"                => $rows
        );

echo json_encode($json_data);