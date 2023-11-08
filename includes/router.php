<?php
// Inclure vos dépendances, par exemple les fichiers de contrôleur
// Define une fonction de routage

function route($url): void
{
    switch ($url) {
        case '/':
            include 'controllers/homeController.php';
            home();
            break;
        case '/about':
            include 'controllers/aboutController.php';
            about();
            break;
        // Autres routes
        default:
            header('HTTP/1.0 404 Not Found');
            include 'views/404.php';
            break;
    }
}

// Obtenir l'URL actuelle
$url = $_SERVER['REQUEST_URI'];

// Appeler la fonction de routage avec l'URL actuelle
route($url);
?>