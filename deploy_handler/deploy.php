<?php

$wwwFolder = "/home3/adamfake/public_html/staging";
$pathToDeployKey = "{$wwwFolder}/deploy/deploy.rsa";

function logDebug($msg = "") {
    file_put_contents("deploy.log", print_r($msg , true) . "\n\n", FILE_APPEND);
}

$postBody = json_decode(file_get_contents( 'php://input'), true);
// logDebug($postBody);

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

$repoFolder = "{$wwwFolder}/{$postBody['repository']['name']}";
logDebug("Looking for folder: {$repoFolder}");

// check to see if the folder exists
if (is_dir($repoFolder)) {
    // YES - already here
    logDebug("-- PULL MASTER {$postBody['repository']['name']} ---> {$repoFolder}");
    $cmd = "cd {$repoFolder}; git pull origin master";
    exec($cmd);
} else {
    // NO - new install
    logDebug("-- CLONE REPO {$postBody['repository']['full_name']}.git ---> {$repoFolder}");
    $cmd = "cd {$wwwFolder}; git clone 'ext::ssh -i {$pathToDeployKey} git@github.com %S {$postBody['repository']['full_name']}.git'";
    exec($cmd);
}

