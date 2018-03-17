<?php
echo "<pre>".print_r($_REQUEST,true)."</pre>";
file_put_contents("deploy.log", print_r($_REQUEST , true) . "\n\n", FILE_APPEND);
