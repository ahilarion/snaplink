<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/includes/shorter.php';
    require_once __DIR__ . '/includes/user.php';

    global $user;
    $user = new User();
    use Dotenv\Dotenv;

    define('BASE_URL', $_ENV['APP_URL']);
    $user->verifyCredentials();


    if (isset($_GET['url']) && $user->isLogged()) {
        $longUrl = htmlspecialchars($_GET['url']);
        $shorter = new Shorter($user->getUser());
        try {
            $shortUrl = $shorter->shortenUrl($longUrl);
            echo $shortUrl;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        header('Location: index.php');
        exit();
    }

    if (isset($_GET['delete']) && $user->isLogged()) {
        $shortUrlToDelete = htmlspecialchars($_GET['delete']);
        $shorter = new Shorter($user->getUser());
        $shorter->deleteUrl($shortUrlToDelete);
        header('Location: index.php');
        exit();
    }

    if (isset($_GET['disable']) && $user->isLogged()) {
        $shortUrlToDisable = htmlspecialchars($_GET['disable']);
        $shorter = new Shorter($user->getUser());
        $shorter->disableUrl($shortUrlToDisable);
        header('Location: index.php');
        exit();
    }

    if (isset($_GET['enable']) && $user->isLogged()) {
        $shortUrlToEnable = htmlspecialchars($_GET['enable']);
        $shorter = new Shorter($user->getUser());
        $shorter->enableUrl($shortUrlToEnable);
        header('Location: index.php');
        exit();
    }

    if (isset($_FILES['file']) && $user->isLogged()) {
        $uploadedFile = $_FILES['file'];
        $shorter = new Shorter($user->getUser());
        try {
            if ($uploadedFile['size'] > 5 * 1024 * 1024) {
                throw new Exception('File size exceeds the maximum allowed size of 5 MB.');
            }
            $shorter->storeFile($uploadedFile);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        header('Location: index.php');
        exit();
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
  <img class="img-container__swirl" src="./assets/svg/Swirl.svg" alt="Swirl">
  <img class="img-container__cubes" src="./assets/svg/Cubes.svg" alt="Cubes">
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