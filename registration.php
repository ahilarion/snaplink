<?php
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new PDO("mysql:host=localhost:8889;dbname=shortcut-url", "root", "root");

    $checkQuery = "SELECT COUNT(*) FROM users WHERE email = ?";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->execute([$email]);
    $userExists = $checkStmt->fetchColumn();

    if ($userExists == 0) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $db->prepare($insertQuery);
        
        if ($stmt->execute([$email, $hashedPassword])) {
            header("Location: index.php");
            exit();
        } else {
            
        }
    } else {

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    
</body>
</html>
    <h2>Inscription</h2>
    <form method="post" action="">
        <label for="email">Adresse e-mail:</label>
        <input type="email" name="email" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br>

        <input type="submit" name="register" value="S'inscrire">
    </form>
</body>
</html>
