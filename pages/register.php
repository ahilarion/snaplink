<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../includes/user.php';

    $message = '';

    if(isset($_POST['register']) && isset($user) && !$user->isLogged()) {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_confirm = htmlspecialchars($_POST['password_confirm']);

        $user = new User();
        try {
            $user->register($username, $password, $password_confirm, $email);
            header('Location: index.php?pages=login');
            exit();
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
    } else if (isset($user) && $user->isLogged()) {
        header('Location: index.php');
        exit();
    }
?>

<?php include './components/header.php' ?>

<section class="section-form wrapper">
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
      <?php if (!empty($message)):?>
          <p class="error-message"><?= $message; ?></p>
      <?php endif; ?>
  </div>
</section>

<style>
    .error-message {
        color: red;
        font-size: 1.2rem;
        margin-top: 1rem;
    }
</style>