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