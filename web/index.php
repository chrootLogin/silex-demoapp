<?php

$loader = require_once __DIR__ . '/../app/autoload.php';

/** @var Silex\Application $app */
$app = require_once __DIR__.'/../app/bootstrap.php';

$app->run();