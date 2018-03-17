<?php
echo "<pre>".print_r($_POST,true)."</pre>";
file_put_contents("deploy.log", print_r($_POST , true) . "\n\n", FILE_APPEND);

