<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../includes/db.php';

    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $email = $_POST['email'];

        $db = new DB();
        $result = $db->query("SELECT * FROM users WHERE username = '$username'");

        if ($result->num_rows === 0) {
            if ($password === $password_confirm) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $db->query("INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')");
                header('Location: index.php');
                exit();
            }
        }

        $error = 'Username already exists';
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
