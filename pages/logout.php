<?php
if (isset($user) && $user->isLogged()) {
    $user->logout();
}
header('Location: index.php');
exit();
