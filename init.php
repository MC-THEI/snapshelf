<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "autoload.php";
use App\App\Container;
$container = new Container();

function html(string $str) {
    return htmlentities($str, ENT_QUOTES, 'UTF-8');

}