<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/includes/shorter.php';
    require_once __DIR__ . '/includes/user.php';

    global $user;
    $user = new User();
    use Dotenv\Dotenv;
    define('BASE_URL', $_ENV['APP_URL']);

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

    $user->verifyCredentials();

    if (isset($_GET['url']) && $user->isLogged()) {
        $url = htmlspecialchars($_GET['url']);
        $shorter = new Shorter($user->getUser());
        $shortUrl = $shorter->shortenUrl($url);
    }

    if (isset($_GET['delete'])) {
        $shortUrlToDelete = htmlspecialchars($_GET['delete']);
        $shorter = new Shorter($user->getUser());
        $shorter->deleteUrl($shortUrlToDelete);
        header('Location: index.php');
        exit();
    }

    if (isset($_GET['path'])) {
        $shortUrl = BASE_URL . $_GET['path'];
        $shorter = new Shorter();
        $shorter->redirect($shortUrl);
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
  <title>SnapLink</title>
</head>
<body>
<div class="img-container">
  <img class="img-container__swirl" src="./assets/img/Swirl.png" alt="Swirl">
  <img class="img-container__cubes" src="./assets/img/Cubes.png" alt="Cubes">
</div>

<?php

$url = $_GET['pages'] ?? '/';

switch ($url) {
  case '/':
    require __DIR__ . '/pages/home.php';
    break;
  case 'login':
    require __DIR__ . '/pages/login.php';
    break;
  case 'register':
    require __DIR__ . '/pages/register.php';
    break;
  case 'logout':
    require __DIR__ . '/pages/logout.php';
    break;
  default:
    require __DIR__ . '/pages/404.php';
    break;
}
?>
</body>
</html>