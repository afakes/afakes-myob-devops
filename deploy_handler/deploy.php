<?php
$postBody = file_get_contents( 'php://input' );
file_put_contents("deploy.log", print_r($postBody , true) . "\n\n", FILE_APPEND);

