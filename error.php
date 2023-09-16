<?php

use CarbonPHP\Abstracts\Composer;
use CarbonPHP\CarbonPHP;
use CarbonPHP\Error\ThrowableHandler;
use SnackInterview\SnackCrate;

// Composer autoload
if (false === ($loader = include $autoloadFile = 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php')) {

    print "<h1>Failed loading Composer at ($autoloadFile). Please run <b>composer install</b>.</h1>";

    die(1);

}

Composer::$loader = $loader;

ThrowableHandler::start();

// the following is a test of the error handler

throw new Exception('This is a test');

/*try {
    throw new Exception('This is a try catch example');
} catch (Throwable $e) {
    ThrowableHandler::generateLogAndExit($e);
}*/

// (new CarbonPHP(SnackCrate::class, __DIR__ . DIRECTORY_SEPARATOR))();





