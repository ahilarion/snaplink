<header class="header grid">
  <span class="header__logo"><a class="gradient-text" href="<?= BASE_URL; ?>index.php">SnapLink</a></span>
  <div class="header__container-btn">
    <?php if (isset($user) && $user->isLogged()): ?>
      <button class="secondary-btn"><a href="<?= BASE_URL; ?>index.php?pages=logout">Se déconnecter</a></button>
    <?php else: ?>
      <button class="secondary-btn"><a href="<?= BASE_URL; ?>index.php?pages=login">Se connecter</a></button>
      <button class="primary-btn"><a href="<?= BASE_URL; ?>index.php?pages=register">S'inscrire</a></button>
    <?php endif; ?>
  </div>
</header>