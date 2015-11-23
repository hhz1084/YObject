<?php
include_once 'App.php';
$str = <<<EOT
    123456
EOT;

echo Crypt::DeCrypt(Crypt::EnCrypt($str, 'ss'),'xx');