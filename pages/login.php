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
      header('Location: index.php');
      exit();
    }
  }

  $error = 'Username or password incorrect';
}
?>

<?php include './components/header.php' ?>

<section class="section-form">
  <div class="form-container">
    <h1>Se connecter</h1>
    <form class="form" action="<?= BASE_URL; ?>index.php?pages=login" method="post">
      <div class="form__fields">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" required>
      </div>
      <div class="form__fields">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>
      </div>
      <button class="primary-btn" type="submit" name="register">Se connecter</button>
    </form>
  </div>
</section>