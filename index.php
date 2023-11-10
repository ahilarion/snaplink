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
        try {
            $shortUrl = $shorter->shortenUrl($url);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    if (isset($_GET['delete'])) {
        $shortUrlToDelete = htmlspecialchars($_GET['delete']);
        $shorter = new Shorter($user->getUser());
        $shorter->deleteUrl($shortUrlToDelete);
        header('Location: index.php');
        exit();
    }

    if (isset($_GET['disable'])) {
        $shortUrlToDisable = htmlspecialchars($_GET['disable']);
        $shorter = new Shorter($user->getUser());
        $shorter->disableUrl($shortUrlToDisable);
        header('Location: index.php');
        exit();
    }

    if (isset($_GET['enable'])) {
        $shortUrlToEnable = htmlspecialchars($_GET['enable']);
        $shorter = new Shorter($user->getUser());
        $shorter->enableUrl($shortUrlToEnable);
        header('Location: index.php');
        exit();
    }

    if (isset($_FILES['file'])) {
        $uploadedFile = $_FILES['file'];
        $shorter = new Shorter($user->getUser());
        try {
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
    <link rel="stylesheet" href="assets/css/styles.css">
    <script defer src="assets/js/script.js"></script>
    <title>URL Shorter</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?= BASE_URL; ?>index.php">Home</a></li>
            <?php if ($user->isLogged()): ?>
                <li><a href="<?= BASE_URL; ?>index.php?pages=logout">Logout</a></li>
            <?php else: ?>
                <li><a href="<?= BASE_URL; ?>index.php?pages=login">Login</a></li>
                <li><a href="<?= BASE_URL; ?>index.php?pages=register">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <form>
        <input type="text" name="url" id="url" placeholder="Enter your URL">
        <input type="submit" <?= $user->isLogged() ? "" : "disabled" ?> value="Shorter">
    </form>
    <form enctype="multipart/form-data" action="<?= BASE_URL; ?>index.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
        <input type="file" name="file" id="file">
        <input type="submit" name="upload" value="Upload">
    </form>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Short URL</th>
                <th>Click count</th>
                <th>isActive</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($user->isLogged()) {
                $shorter = new Shorter($user->getUser());
                $urls = $shorter->getUrls();
                foreach ($urls as $url) {
                    echo "<tr>";
                    echo "<td>" . (empty($url['long_url']) ? $url['display_name'] : $url['long_url']) . "</td>";
                    echo "<td><a href='" . $url['short_url'] . "' target='_blank'>" . $url['short_url'] . "</a></td>";
                    echo "<td>" . $url['click_count'] . "</td>";
                    echo "<td>" . ($url['disabled'] ? 'No' : 'Yes') . "</td>";
                    echo "<td>";
                    echo "<a href='" . BASE_URL . "index.php?delete=" . $url['uuid'] . "'>Delete</a>";
                    echo "<a href='" . BASE_URL . "index.php?" . ($url['disabled'] ? 'enable=' : 'disable=') . $url['uuid'] . "'>" . ($url['disabled'] ? 'Enable' : 'Disable') . "</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

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