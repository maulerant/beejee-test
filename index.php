<?php

define('DEBUG', true);

require(__DIR__ . '/vendor/autoload.php');

$config = require(__DIR__ . '/src/Configs/main.php');
$local = require(__DIR__ . '/src/Configs/main-local.php');

print_r(array_merge($config, $local));
