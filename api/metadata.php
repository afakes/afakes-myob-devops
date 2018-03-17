<?php
include_once "app.php";

$result = array();
$result['statusCode'] = 200;
$result['endpoint'] = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
$result["myapplication"] = [
    "version" => getVersionNumber(),
    "description" => "pre-interview technical test",
    "lastcommitsha" => getLastCommit()
  ];

echo json_encode($result);
