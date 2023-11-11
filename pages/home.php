<?php include './components/header.php' ?>

<section class="main wrapper">
  <div class="main__container">
    <h1 class="gradient-text">Raccourcissez vos looongs liens :)</h1>
    <p>SnapLink est un service de raccourcissement d'URL efficace et facile à utiliser qui rationalise votre expérience
       en
       ligne.</p>

    <input id="checkbox_toggle" type="checkbox" class="check">
    <div class="checkbox">
      <label class="slide" for="checkbox_toggle">
        <label class="toggle" for="checkbox_toggle"></label>
        <label class="text" for="checkbox_toggle"><img src="./assets/svg/link.svg" alt="link"> URL</label>
        <label class="text" for="checkbox_toggle"><img src="./assets/svg/file.svg" alt="link"> Fichiers</label>
      </label>
    </div>

    <form class="shorter-link-form show">
      <input type="text" name="url" id="url" placeholder="Entrez votre URL">
        <?php if (isset($user) && $user->isLogged()): ?>
            <input class="primary-btn" type="submit" value="Gooo">
        <?php else: ?>
            <input class="primary-btn" type="submit" style="opacity: 0.5" value="Gooo" disabled>
        <?php endif; ?>
    </form>

    <form class="file-link-form" enctype="multipart/form-data" action="<?= BASE_URL; ?>index.php" method="post" onsubmit="return checkFileSize()">
      <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
      <input type="file" name="file" id="fileInput" style="opacity: 0; position: absolute; left: -9999px;" size="60">
      <label class="file-input" for="fileInput">Choisir un fichier :
        <span id="fileName">Aucun fichier sélectionné</span></label>
      <?php if (isset($user) && $user->isLogged()): ?>
        <input class="primary-btn" type="submit" name="submit" value="Gooo">
      <?php else: ?>
        <input class="primary-btn" type="submit" style="opacity: 0.5" name="submit" value="Gooo" disabled>
      <?php endif; ?>
    </form>
  </div>
</section>

<?php if (isset($user) && $user->isLogged()): ?>
<section class="list wrapper">
  <table>
    <thead>
    <tr>
      <th>URL Court</th>
      <th>Redirection vers</th>
      <th>Nombre de clics</th>
      <th>Status</th>
      <th>On / Off</th>
      <th>Supprimer</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($user) && $user->isLogged()) {
      $shorter = new Shorter($user->getUser());
      $urls = $shorter->getUrls();
      foreach ($urls as $url) {
        echo "<tr>";
        echo "<td><a href='" . $url['short_url'] . "' target='_blank'>" . $url['short_url'] . "</a></td>";
        echo "<td>" . (empty($url['long_url']) ? $url['display_name'] : $url['long_url']) . "</td>";
        echo "<td>" . $url['click_count'] . "</td>";
        echo "<td>" . ($url['disabled'] ? 'Non' : 'Oui') . "</td>";
        if ($url['disabled'] === '0')
            echo "<td><a href='" . BASE_URL . "index.php?disable=" . $url['uuid'] . "'>Désactiver</a></td>";
        else
            echo "<td><a href='" . BASE_URL . "index.php?enable=" . $url['uuid'] . "'>Activer</a></td>";
        echo "<td><a href='" . BASE_URL . "index.php?delete=" . $url['uuid'] . "'>Supprimer</a></td>";
        echo "</tr>";
      }
    }
    ?>
    </tbody>
  </table>
</section>
<?php endif; ?>

<script>
    function checkFileSize() {
        const input = document.getElementById('fileInput');
        if (input.files.length > 0) {
            const fileSize = input.files[0].size;
            const maxSize = 5 * 1024 * 1024;

            if (fileSize > maxSize) {
                alert('Error: File size exceeds the maximum allowed size of 5 MB.');
                return false;
            }
        }
        return true;
    }
</script>
