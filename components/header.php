<?php
$currentPage = $_GET['pages'] ?? 'home';
?>

<header class="header grid wrapper">
    <span class="header__logo"><a class="gradient-text" href="<?= BASE_URL; ?>index.php">SnapLink</a></span>
    <div class="header__container-btn">
        <?php if (isset($user) && $user->isLogged()): ?>
            <button class="secondary-btn" onclick="window.location.href='<?= BASE_URL; ?>index.php?pages=logout'">Se Déconnecter</button>
        <?php else: ?>
            <?php if ($currentPage === 'login'): ?>
                <button class="secondary-btn" onclick="window.location.href='<?= BASE_URL; ?>index.php?pages=register'">S'inscrire</button>
            <?php elseif ($currentPage === 'register'): ?>
                <button class="secondary-btn" onclick="window.location.href='<?= BASE_URL; ?>index.php?pages=login'">Se connecter</button>
            <?php else: ?>
                <button class="secondary-btn" onclick="window.location.href='<?= BASE_URL; ?>index.php?pages=login'">Se connecter</button>
                <button class="primary-btn" onclick="window.location.href='<?= BASE_URL; ?>index.php?pages=register'">S'inscrire</button>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</header>