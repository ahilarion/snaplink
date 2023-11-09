<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../includes/user.php';

    if(isset($_POST['register']) && isset($user) && !$user->isLogged()) {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_confirm = htmlspecialchars($_POST['password_confirm']);

        $user = new User();
        try {
            $user->register($username, $password, $password_confirm, $email);
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
    <h1>Register</h1>
    <form action="<?= BASE_URL; ?>index.php?pages=register" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <label for="password_confirm">Password Confirm</label>
        <input type="password" name="password_confirm" id="password_confirm" required>
        <input type="submit" name="register" value="Register">
    </form>
    <a href="<?= BASE_URL; ?>index.php?pages=login">Login</a>
</div>
