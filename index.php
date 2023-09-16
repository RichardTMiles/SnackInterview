<?php

use CarbonPHP\Abstracts\Composer;
use CarbonPHP\CarbonPHP;
use SnackInterview\SnackCrate;

// Composer autoload
if (false === ($loader = include $autoloadFile = 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php')) {

    print "<h1>Failed loading Composer at ($autoloadFile). Please run <b>composer install</b>.</h1>";

    die(1);

}

Composer::$loader = $loader;

(new CarbonPHP(SnackCrate::class, __DIR__ . DIRECTORY_SEPARATOR))();

