<?php
function token()
{
    $token = mt_rand(0,9999).substr(time(),-4).substr(microtime(),2,6).mt_rand(1000,9999).NOW_TIME;
    return sha1($token);
}
