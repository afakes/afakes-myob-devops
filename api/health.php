<?php
include_once "app.php";

$result = [];
$result['statusCode'] = 200;
$result['endpoint'] = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
$result['result'] = [
    'status' => "OK",
    'checksum' => getCheckSum(),
];

echo json_encode($result);
