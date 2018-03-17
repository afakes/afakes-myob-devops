<?php

$pathToDeployKey = "/home3/adamfake/public_html/deploy/deploy.rsa";

function logDebug($msg = "") {
    file_put_contents("deploy.log", print_r($msg , true) . "\n\n", FILE_APPEND);
}

$postBody = json_decode(file_get_contents( 'php://input'), true);
logDebug($postBody);

if ($postBody == null) {
    logDebug("Payload is null");
    exit();
}

if (!array_key_exists('repository', $postBody)) {
    logDebug("Payload does not contain: repository");
    exit();
}

if (!array_key_exists('name', $postBody['repository'])) {
    logDebug("Payload does not conteint: repository.name");
    exit();
}

$wwwFolder = "/home3/adamfake/public_html";
$repoFolder = "{$wwwFolder}/{$postBody['repository']['name']}";
logDebug("Looking for folder: {$postBody}");

// check to see if the folder exists
if (is_dir($repoFolder)) {

    // YES - already here
    logDebug("Folder DOES exist: {$repoFolder}");

    logDebug("-- PULL MASTER ");
    logDebug("------------------------------------------------------------------");
    $cmd = "cd {$repoFolder}; git pull origin master";
    logDebug("cmd = {$cmd}");
    $execResult = array();
    exec($cmd, $execResult);
    logDebug("-- PULL RESULT ");
    logDebug(join("\n", $execResult));

} else {

    // NO - new install
    logDebug("Folder DOES NOT exist: {$repoFolder}");

    logDebug("-- CLONE REPO ");
    $cmd = "cd {$wwwFolder}; git clone 'ext::ssh -i {$pathToDeployKey} git@github.com %S {$postBody['repository']['full_name']}.git'";
    logDebug("cmd = {$cmd}");
    $execResult = array();
    exec($cmd, $execResult);
    logDebug("-- CLONE RESULT ");
    logDebug(join("\n", $execResult));

}

