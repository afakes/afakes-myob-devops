<?php
include_once "app.php";

file_put_contents("/tmp/afakes.log", '$result  = ' . print_r($result , true) . "\n", FILE_APPEND);

$result = [];
$result['statusCode'] = 200;
$result['endpoint'] = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
$result['message'] = "Hello World";

echo json_encode($result);
