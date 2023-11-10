<?php include './components/header.php' ?>

<section class="main">
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
      <input class="primary-btn" type="submit" <?= isset($user) && $user->isLogged() ? "" : "disabled" ?> value="Gooo">
    </form>

    <form class="file-link-form" enctype="multipart/form-data" action="<?= BASE_URL; ?>index.php" method="post">
      <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
      <input type="file" name="file" id="fileInput" style="opacity: 0; position: absolute; left: -9999px;">
      <label class="file-input" for="fileInput">Choisir un fichier :
        <span id="fileName">Aucun fichier sélectionné</span></label>
      <input class="primary-btn" type="submit" name="upload" value="Gooo">
    </form>
  </div>
</section>

<section class="list">
  <!--  <table>-->
  <!--    <thead>-->
  <!--    <tr>-->
  <!--      <th>Name</th>-->
  <!--      <th>Short URL</th>-->
  <!--      <th>Click count</th>-->
  <!--      <th>isActive</th>-->
  <!--      <th>Action</th>-->
  <!--    </tr>-->
  <!--    </thead>-->
  <!--    <tbody>-->
  <!--    --><?php
  //    $shorter = new Shorter($user->getUser());
  //    $urls = $shorter->getUrls();
  //    foreach ($urls as $url) {
  //      echo "<tr>";
  //      echo "<td>". (empty($url['long_url']) ? $url['display_name'] : $url['long_url']) . "</td>";
  //      echo "<td><a href='" . $url['short_url'] . "' target='_blank'>" . $url['short_url'] . "</a></td>";
  //      echo "<td>" . $url['click_count'] . "</td>";
  //      echo "<td>" . ($url['disabled'] ? 'No' : 'Yes') . "</td>";
  //      echo "<td>";
  //      echo "<a href='" . BASE_URL . "index.php?delete=" . $url['id'] . "'>Delete</a>";
  //      echo "<a href='" . BASE_URL . "index.php?disable=" . $url['id'] . "'>Disable</a>";
  //      echo "</td>";
  //      echo "</tr>";
  //    }
  //    ?>
  <!--    </tbody>-->
  <!--  </table>-->
</section>