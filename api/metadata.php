<?php
/**
 * API to return metadata about this application
 */
include_once "app.php";

$result = array();
$result['statusCode'] = 200;
$result['endpoint'] = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
$result["myapplication"] = array(
    "version" => getVersionNumber(),
    "description" => "pre-interview technical test",
    "lastcommitsha" => getLastCommit()
);

echo json_encode($result);
