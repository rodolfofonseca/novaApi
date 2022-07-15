<?php
ignore_user_abort(true);
ini_set('memory_limit', '-1');
set_time_limit(0);
error_reporting(E_ALL & ~E_DEPRECATED);
require_once 'funcoes.php';
require_once 'bootstrap.php';

function check_ordering($order){
    if($order == 'true'){
        return (bool) true;
    }else if($order == 'false'){
        return (bool) false;
    }
}
?>