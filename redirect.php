<?php

require_once 'vendor/autoload.php';
require_once 'includes/user.php';
require_once 'includes/shorter.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('BASE_URL', $_ENV['APP_URL']);

$shorter = new Shorter();
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

try {
    $shorter->redirect($currentUrl);
} catch (Exception $e) {
    echo $e->getMessage();
}