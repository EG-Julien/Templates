<?php
date_default_timezone_set('Europe/Paris');
require '../vendor/autoload.php';
require '../config.php';

$app = new \Slim\Slim([
    'templates.path' => 'views',
    'mode' => 'development',
]);

@session_start();

try {
    $DB = new PDO('mysql:dbname=' . $dbname . ';host=' . $dbhost . ';charset=utf8', "$dbuser", "$dbpassword");
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (Exception $e) {
    die($e);
}

\App\Controllers\Controller::setDB($DB);

$app->get('/', \App\Controllers\HomeCtrl::class . "Home");

$app->run();