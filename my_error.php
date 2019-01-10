<?php session_start(); ?>

<!-- Stránka s chybovou hláškou. -->
<!DOCTYPE html>
<html lang="cs">

<?php
  require_once 'fragments/head.html';
  require_once 'utilities.php';
?>

<body class="<?php echo check_dark_theme('w3-theme-dark', ''); ?>">

  <?php
    if (isset($_SESSION['user'])) {
      require_once 'fragments/menu-user.php';
    } else {
      require_once 'fragments/menu.php';
    }
  ?>

  <div class="w3-main my-container shift-right">
    <main class="my-main">

      <div class="w3-row w3-padding-64">
        <article class="w3-twothird w3-container">
          <h2>Error</h2>
          <p>Omlouváme se, něco se nepodařilo.</p>
          <p>Pokud vás tento error omezuje v používání stránek, kontaktujte prosím webmastera: zdenekotrly@gmail.com</p>
          <a class="w3-button w3-border" href="form_management/set_topic.php?topic=none">Zpět na hlavní stránku</a>
        </article>

        <div class="w3-third w3-container">
          <img class="resize-medium" src="images/ferrum_logo.png" alt="Logo Ferrum">
        </div>
      </div>

    </main>

    <?php
      require_once 'fragments/footer.html';
    ?>

  </div>

  <script src="js/sidebar.js"></script>

</body>
</html>
