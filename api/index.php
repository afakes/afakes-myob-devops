<?php
include_once "app.php";

$result = array();
$result['statusCode'] = 200;
$result['endpoint'] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";

$result['authors'] = array();
$result['authors']['afakes'] = array(
    "linkedin" => "https://www.linkedin.com/in/adamfakes",
    "github" => "https://github.com/afakes",
    "portfolio" => "http://adamfakes.com/"
);


$result['code-inspection'] = array();
$result['code-inspection']['travis'] = "https://travis-ci.org/afakes/afakes-myob-devops";
$result['code-inspection']['github'] = "https://github.com/afakes/afakes-myob-devops";

$result['endpoints'] = discoverAPIs();

file_put_contents("/tmp/afakes.log", '$_SERVER = ' . print_r($_SERVER, true) . "\n", FILE_APPEND);

file_put_contents("/tmp/afakes.log", '$fred = ' . print_r($fred, true) . "\n", FILE_APPEND);


echo json_encode($result);
