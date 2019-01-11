<?php

  session_start();
  if (!isset($_SESSION['user']) or ($_SESSION['user'] != 'admin')) {
    header('Location: index.php');
    exit;
  }

  require_once 'form_management/topic_manage.php';
  require_once 'db_control/categories.php';

  $categories = get_categories();

?>

<!DOCTYPE html>
<html lang="cs">

<?php
  require_once 'fragments/head.html';
  require_once 'utilities.php';
?>

<body class="<?php echo check_dark_theme('w3-theme-dark', ''); ?>">

  <?php
    require_once 'fragments/menu-user.php';
  ?>

  <div class="w3-main shift-right my-container">
    <main class="my-main">

      <div class="w3-row w3-padding-64">
        <div class="w3-twothird w3-container">
          <h2>Přidat téma</h2>
          <form id="add-topic-form" class="w3-container w3-large" method="post" action="edit_topics.php">

            <div class="w3-section">
              <label for="topic-name">Název</label>
              <input id="topic-name" class="w3-input w3-border short w3-animate-input<?php echo add_err_class('new-topic', $errors); ?>"
                type="text" name="new-topic" required
                value="<?php echo check_request_param('new-topic'); ?>">
              <span id="span-new-topic"><?php echo error_message('new-topic', $errors); ?></span>
            </div>

            <input class="w3-btn w3-white w3-border" type="submit" value="Přidat">
          </form>
        </div>

        <div class="w3-third w3-container">
          <img class="resize-medium" src="images/world_cartography_map.png" alt="Obrázek zeměkoule">
        </div>

        <div class="w3-twothird w3-container">
          <h2>Odebrat téma</h2>
          <form id="del-topic-form" class="w3-container w3-large" method="post" action="edit_topics.php">

            <select class="w3-select w3-section w3-margin-top w3-border short<?php echo add_err_class('topic', $errors); ?>"
              id="topic" name="del-topic-id" required>
              <option value="" disabled selected>Vyberte téma</option>
              <?php
                foreach ($categories as $one_cat) {
              ?>
              <option value="<?php echo $one_cat['id']; ?>"><?php echo htmlspecialchars($one_cat['name']); ?></option>
              <?php
                }
              ?>
            </select>
            <span id="span-del-topic"><?php echo error_message('topic', $errors); ?></span>
            <br>
            <input class="w3-btn w3-white w3-border" type="submit" value="Odebrat">
            <p>Pozor: Po odebrání tématu budou všechny příspěvky které se v něm nacházejí přesunuty do archivu.</p>
          </form>
        </div>

      </div>
    </main>

    <?php
      require_once 'fragments/footer.html';
    ?>

  </div>

  <script src="js/sidebar.js"></script>
  <script src="js/validation_client.js"></script>

</body>
</html>
