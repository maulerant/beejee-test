<?php

define('DEBUG', true);
define('ROOT_PATH', __DIR__);

require(__DIR__ . '/vendor/autoload.php');

$config = require(__DIR__ . '/src/BeeJee/Configs/main.php');
$local = require(__DIR__ . '/src/BeeJee/Configs/main-local.php');

$app = new BeeJee\App(array_merge($config, $local));
$app->run();