<?php

/**
 * The name of the APP
 */
$appName = "afakes-myob-devops";

/**
 * get the current Software Version number as defined by the developers / code base
 * @return string
 */
function getVersionNumber() {

    $versionFilename = "version.txt";

    return file_exists($versionFilename)
        ? trim(file_get_contents("version.txt"))
        : "unknown";
}

/**
 * Get last commit from GIT
 * @return string
 */
function getLastCommit() {

    $result = exec("git log --pretty=format:'%h' -n 1");
    return $result;
}


/**
 *  get the MD5 hash from the files, including datetime, size & user, ls -lsR | md5
 * if the folder has changed in anyway we can detect this.  i.e. FileCount, FileSizes, DateTimes, file owners, file groups, e.g. all file permissions
 *
 * @return string
 */
function getCheckSum() {

    // the host we have targeted does not have MD5 command line, so we are going to use sha1sum
    $result = exec("ls -lsR .. | sha1sum");
    return $result;
}

