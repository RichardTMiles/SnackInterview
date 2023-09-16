<?php

use CarbonPHP\Abstracts\Composer;
use CarbonPHP\CarbonPHP;
use CarbonPHP\Interfaces\iRest;
use SnackInterview\SnackCrate;
use SnackInterview\Tables\Users;

// Composer autoload
if (false === ($loader = include $autoloadFile = 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php')) {

    print "<h1>Failed loading Composer at ($autoloadFile). Please run <b>composer install</b>.</h1>";

    die(1);

}

Composer::$loader = $loader;

new CarbonPHP(SnackCrate::class, __DIR__ . DIRECTORY_SEPARATOR);

$randomUserName = 'example_username' . random_int(0, 1000000);

$post = [
    Users::USER_USERNAME => $randomUserName,
    Users::USER_PASSWORD => $randomUserName,
    Users::USER_SPORT => 'golf',
    Users::USER_FIRST_NAME => 'Richard',
    Users::USER_LAST_NAME => 'Miles',
    Users::USER_PROFILE_PIC => 'user_profile_pic',
    Users::USER_PROFILE_URI => $randomUserName,
    Users::USER_COVER_PHOTO => 'user_cover_photo',
    Users::USER_GENDER => 'user_gender',
    Users::USER_ABOUT_ME => 'user_about_me',
    Users::USER_RANK => 'user_rank',
    Users::USER_EMAIL => 'user_email',
    Users::USER_EMAIL_CODE => 'user_email_code',
    Users::USER_EMAIL_CONFIRMED => 'user_email_confirmed',
    Users::USER_GENERATED_STRING => 'user_generated_string',
    Users::USER_MEMBERSHIP => 'user_membership',
    Users::USER_DEACTIVATED => 'user_deactivated',
    Users::USER_IP => '0.0.0.0',
    Users::USER_EDUCATION_HISTORY => 'user_education_history',
];


// dont be shy, drop into post, I wrote it
if (false === Users::post($post)) {

    throw new Exception('Failed to create a new user.');

}

$br = '</br>';

print "Successfully created a new user ($randomUserName).$br$br";

$results = [];

if (false === Users::get($results, null, [
        iRest::SELECT => [
            Users::USER_USERNAME
        ],
        iRest::PAGINATION => [
            iRest::LIMIT => 100,
        ]
    ])) {

    throw new Exception('Failed to get users');

}


print '<pre>';

/** @noinspection ForgottenDebugOutputInspection */
var_dump($results);

print '</pre><script>console.log(' . json_encode($GLOBALS['json']) . ')</script>';