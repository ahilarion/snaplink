<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../includes/user.php';

    if (isset($_POST['login']) && isset($user) && !$user->isLogged()) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        try {
            $user->login($username, $password);
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else if (isset($user) && $user->isLogged()) {
        header('Location: index.php');
        exit();
    }
?>
<div>
    <h1>Login</h1>
    <form action="<?= BASE_URL; ?>index.php?pages=login" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" name="login" value="Login">
    </form>
    <a href="<?= BASE_URL; ?>index.php?pages=register">Register</a>
</div>