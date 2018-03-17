<?php
function logDebug($msg = "") {
    file_put_contents("deploy.log", print_r($msg , true) . "\n\n", FILE_APPEND);
}

$postBody = json_decode(file_get_contents( 'php://input'), true);
// logDebug($postBody);

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
    $cmd = "cd {$repoFolder}; git pull origin master";  //TODO:  update this to the branch name ?
    logDebug("cmd = {$cmd}");

} else {
    // NO - new install
    logDebug("Folder DOES NOT exist: {$repoFolder}");
    $cmd = "cd {$wwwFolder}; git clone {$postBody['repository']['ssh_url']}";
    logDebug("cmd = {$cmd}");
    exit();
}


