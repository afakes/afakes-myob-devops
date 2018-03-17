<?php

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

$wwwFolder = "/home3/adamfake/public_html";
$repoFolder = "{$wwwFolder}/{$postBody['repository']['name']}";
logDebug("Looking for folder: {$postBody}");

// check to see if the folder exists
if (is_dir($repoFolder)) {

    // YES - already here
    logDebug("Folder DOES exist: {$repoFolder}");

    logDebug("-- PULL MASTER ");
    logDebug("------------------------------------------------------------------");
    $cmd = "cd {$repoFolder}; GIT_SSH_COMMAND='ssh -i deploy.rsa'  git pull origin master > deploy.log";
    logDebug("cmd = {$cmd}");
    $execResult = array();
    exec($cmd, $execResult);
    logDebug("-- PULL RESULT ");
    logDebug(join("\n", $execResult));



} else {

    // NO - new install
    logDebug("Folder DOES NOT exist: {$repoFolder}");

    logDebug("-- CLONE REPO ");
    logDebug("------------------------------------------------------------------");
    $cmd = "cd {$wwwFolder}; GIT_SSH_COMMAND='ssh -i deploy.rsa' git clone {$postBody['repository']['ssh_url']} > deploy.log";
    logDebug("cmd = {$cmd}");

    $execResult = array();
    exec($cmd, $execResult);
    logDebug("-- CLONE RESULT ");
    logDebug(join("\n", $execResult));

}

