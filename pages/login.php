<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../includes/db.php';

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new DB();
        $result = $db->query("SELECT * FROM users WHERE username = '$username'");

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: /index.php');
                exit();
            }
        }

        $error = 'Username or password incorrect';
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