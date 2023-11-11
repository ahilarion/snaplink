<header class="header grid">
  <span class="header__logo"><a class="gradient-text" href="<?= BASE_URL; ?>index.php">SnapLink</a></span>
  <div class="header__container-btn">
    <?php if (isset($user) && $user->isLogged()): ?>
      <button class="secondary-btn" onclick="window.location.href='<?= BASE_URL; ?>index.php?pages=logout'">Se Déconnecter</button>
    <?php else: ?>
        <button class="secondary-btn" onclick="window.location.href='<?= BASE_URL; ?>index.php?pages=login'">Se Connecter</button>
        <button class="primary-btn" onclick="window.location.href='<?= BASE_URL; ?>index.php?pages=register'">S'inscrire</button>
    <?php endif; ?>
  </div>
</header>