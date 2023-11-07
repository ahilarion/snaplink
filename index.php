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
        $db = new DB();
        $result = $db->query("SELECT * FROM urls");
        while ($row = $result->fetch_assoc()) {
            echo $row['id'] . ' ' . $row['url'] . '<br>';
        }
        $db->close();
    ?>
</body>
</html>