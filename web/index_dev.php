<?php

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['SERVER_ADDR'], array('10.10.10.10'))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

$loader = require_once __DIR__ . '/../app/autoload.php';

$env = 'dev';
$debug = true;

/** @var Silex\Application $app */
$app = require_once __DIR__.'/../app/bootstrap.php';

$app->run();