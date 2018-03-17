<?php

$appName = "afakes-myob-devops";

function getVersionNumber() {
    return trim(file_get_contents("version.txt"));
}

function getLastCommit() {
    $result = exec("git log --pretty=format:'%h' -n 1");
    return $result;
}


