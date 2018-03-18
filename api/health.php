<?php
include_once "app.php";

$result = array();
$result['statusCode'] = 200;
$result['endpoint'] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
$result['result'] = array(
    'status' => "OK",
    'checksum' => getCheckSum(),
    'host' => getTargetHostStats()
);

echo json_encode($result);
