<?php
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new PDO("mysql:host=localhost:8889;dbname=shortcut-url", "root", "root");
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
    } else {
        $error = "Adresse e-mail ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    
</body>
</html>
<body>
    <h2>Connexion</h2>
    <?php if (isset($error)) { echo '<p style="color:red;">' . $error . '</p>'; } ?>
    <form method="post" action="login.php">
        <label for="email">Adresse e-mail:</label>
        <input type="email" name="email" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br>

        <input type="submit" name="login" value="Se connecter">
    </form>
</body>
</html>
