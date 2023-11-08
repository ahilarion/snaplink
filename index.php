<?php
    require_once 'vendor/autoload.php';
    require_once 'includes/db.php';
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
    <?php
    $url = $_SERVER['REQUEST_URI'];

    switch ($url) {
        case '/':
            include 'pages/home.php';
            break;
        default:
            header('HTTP/1.0 404 Not Found');
            include 'pages/404.php';
            break;
    }
    ?>
</body>
</html>