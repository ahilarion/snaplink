<?php

require_once 'vendor/autoload.php';
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
    $message = $e->getMessage();
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="dist/css/style.css">
    <script defer src="dist/js/script.js"></script>
    <title>SnapLink - Redirection</title>
</head>
<body>
<h1>
    <?php
    if (isset($message)) {
        if ($message === "URL disabled") {
            echo "Cette URL a été désactivée par son propriétaire !";
        } else if ($message === "URL not found") {
            echo "Cette URL n'existe pas !";
        } else {
            echo $message;
        }
    }
    ?>
</h1>
<button class="primary-btn" onclick="window.location.href='<?= BASE_URL; ?>'">Retour au site</button>
</body>
</html>
<style>
    body {
        background-color: #212121;
    }
    h1 {
        color: #fff;
        text-align: center;
        margin-top: 20%;
    }
    button {
        display: block;
        margin: 0 auto;
    }
    .primary-btn {
        background-color: #212121;
        color: #fff;
        border: 1px solid #fff;
    }
</style>