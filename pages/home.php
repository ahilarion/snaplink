<?php include './components/header.php' ?>

<form>
  <input type="text" name="url" id="url" placeholder="Enter your URL">
  <input type="submit" <?= isset($user) ? "" : "disabled" ?> value="Shorter">
</form>