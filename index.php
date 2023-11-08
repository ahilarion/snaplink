<?php
    use Dotenv\Dotenv;

    require_once __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    session_start();

    define('BASE_URL', $_ENV['APP_URL']);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script defer src="assets/js/script.js"></script>
    <title>URL Shorter</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?= BASE_URL; ?>index.php">Home</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="<?= BASE_URL; ?>index.php?pages=logout">Logout</a></li>
            <?php else: ?>
                <li><a href="<?= BASE_URL; ?>index.php?pages=login">Login</a></li>
                <li><a href="<?= BASE_URL; ?>index.php?pages=register">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
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