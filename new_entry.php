<?php

  session_start();
  if (!isset($_SESSION['user'])) {      // Tato stránka je přístupná pouze přihlášenému uživateli.
    header('Location: index.php');
    exit;
  }

  require_once 'form_management/post_create.php';
  require_once 'db_control/categories.php';

  $categories = get_categories();

?>

<!-- Stránka s formulářem pro přidání nového příspěvku. -->
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
          <h2>Nový příspěvek</h2>
          <form id="new-entry-form" class="w3-container w3-large" method="post" action="new_entry.php">
            <select class="w3-select w3-margin-top w3-border short<?php echo add_err_class('topic', $errors); ?>"
              id="topic" name="topic_id" required>
              <option value="" disabled selected>Vyberte téma</option>
              <?php
                foreach ($categories as $one_cat) {
              ?>
              <option value="<?php echo $one_cat['id']; ?>"><?php echo htmlspecialchars($one_cat['name']); ?></option>
              <?php
                }
              ?>
            </select>
            <span id="span-topic"><?php echo error_message('topic', $errors); ?></span>

            <div class="w3-section">
              <label for="title">Nadpis</label>
              <input id="title" class="w3-input w3-border short w3-animate-input<?php echo add_err_class('title', $errors); ?>"
                type="text" name="title" maxlength="50" required pattern=".{1,50}"
                value="<?php echo check_request_param('title'); ?>">
              <span id="span-title"><?php echo error_message('title', $errors); ?></span>
            </div>

            <div class="w3-section">
              <label for="entry">Text příspěvku</label>
              <textarea id="entry" class="w3-input w3-border<?php echo add_err_class('body', $errors); ?>"
                name="entry" rows="9" maxlength="65000" required pattern=".{1,65000}"><?php echo check_request_param('entry'); ?></textarea>
              <span id="span-body"><?php echo error_message('body', $errors); ?></span>
            </div>

            <input class="w3-btn w3-white w3-border" type="submit" name="send" value="Vytvořit">
          </form>
        </div>

        <div class="w3-third w3-container">
          <img class="resize-medium" src="images/world_cartography_map.png" alt="Obrázek zeměkoule">
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
