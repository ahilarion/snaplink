<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/db.php';

if (isset($_POST['register'])) {
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

<?php include './components/header.php' ?>

<section class="section-form">
  <div class="form-container">
    <h1>S'inscrire</h1>
    <form class="form" action="<?= BASE_URL; ?>index.php?pages=register" method="post">
      <div class="form__fields">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" required>
      </div>
      <div class="form__fields">
        <label for="email">Votre e-mail</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="form__fields">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>
      </div>
      <div class="form__fields">
        <label for="password_confirm">Confirmez votre mot de passe</label>
        <input type="password" name="password_confirm" id="password_confirm" required>
      </div>
      <button class="primary-btn" type="submit" name="register">S'inscrire</button>
    </form>
  </div>
</section>