<?php

$appName = "afakes-myob-devops";

function getVersionNumber() {
    return trim(file_get_contents("version.txt"));
}

function getLastCommit() {
    return "abc57858585";
}

