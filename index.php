<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/includes/shorter.php';

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    session_start();

    define('BASE_URL', $_ENV['APP_URL']);

    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }

    if (isset($_GET['url']) && isset($user)) {
        $url = $_GET['url'];
        $shorter = new Shorter($user);
        $shorter->shortenUrl($url);
    }

    if (isset($_GET['path'])) {
        $shortUrl = BASE_URL . $_GET['path'];
        $shorter = new Shorter();
        $shorter->redirect($shortUrl);
    }
    /**     
     * if (isset($_GET['delete'])) {
     * $shortUrlToDelete = $_GET['delete'];
     * $shorter = new Shorter($user);
     * $shorter->deleteUrl($shortUrlToDelete);
     * header('Location: index.php');
     * exit();
     * }
    
     * if (isset($_GET['disable'])) {
     * $shortUrlToDisable = $_GET['disable'];
     * $shorter = new Shorter($user);
     * $shorter->disableUrl($shortUrlToDisable);
     * header('Location: index.php');
     * exit();
     * }

     * if (isset($_FILES['file'])) {
     *     $uploadedFile = $_FILES['file'];
     *    $shorter = new Shorter($user);
     *     $fileName = $shorter->storeFile($uploadedFile, '');
     *     echo "File uploaded successfully. Stored as: $fileName";
     * }
    */
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
            <?php if (isset($user)): ?>
                <li><a href="<?= BASE_URL; ?>index.php?pages=logout">Logout</a></li>
            <?php else: ?>
                <li><a href="<?= BASE_URL; ?>index.php?pages=login">Login</a></li>
                <li><a href="<?= BASE_URL; ?>index.php?pages=register">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <form>
        <input type="text" name="url" id="url" placeholder="Enter your URL">
        <input type="submit" <?= isset($user) ? "" : "disabled" ?> value="Shorter">
    </form>
    <table>
        <thead>
            <tr>
                <th>Long URL</th>
                <th>Short URL</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (isset($user)) {
                    $shorter = new Shorter($user);
                    $urls = $shorter->getUrls();
                    foreach ($urls as $url) {
                        echo "<tr><td>{$url['long_url']}</td><td><a href='{$url['short_url']}'target=_BLANK>{$url['short_url']}</a></td></tr>";
                    }
                    /** 
                     * foreach ($urls as $url) {
                     * $shorter = new Shorter($user);
                     * $clicCount = $shorter->getClicCount($url['short_url']);
                     * echo "<tr><td>{$url['long_url']}</td><td><a href='{$url['short_url']}' target='_blank'>{$url['short_url']}</a></td><td>$clicCount</td>";
                     * echo "<td><a href='index.php?disable={$url['short_url']}'>Disable</a></td>";
                     * echo "<td><a href='index.php?delete={$url['short_url']}'>Delete</a></td></tr>";
                     * }
                    */
                }
            ?>
        </tbody>
    </table>
    <!--
    <form enctype="multipart/form-data" action="
        <?= BASE_URL; ?>
        index.php" method="post">
        <input type="file" name="file" id="file">
        <input type="submit" name="upload" value="Upload">
    </form>
    -->
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