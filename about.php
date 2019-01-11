<?php session_start(); ?>

<!-- Stránka s popisem fóra. -->
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
        <article class="w3-twothird w3-container">  <!-- Dvě třetiny obsahu zabírá text. -->
          <h2>O stránce</h2>
          <p>Vítejte na stránkách diskuzního fóra Ferrum. Název je latinský a do češtiny se překládá jako železo.
            To má v periodické tabulce prvků zkratku Fe.</p>
          <p>Tyto stránky slouží jako můj semestrální projekt na předmět základy webových aplikací,
            který se vyučuje na Fakultě elektrotechnické ČVUT v Praze.</p>
          <p>Diskuzní fórum mohou využívat všichni uživatelé Celosvětové sítě (World Wide Web).
            Registrace i používání je zdarma. Fórum bude fungovat dokud jej bude podporovat školní server.</p>
          <p>V případě, že najdete na mých stránkách jakoukoli chybu, prosím nahlaste mi ji co nejrychleji na můj email:
            zdenekotrly@gmail.com</p>
        </article>

        <div class="w3-third w3-container">  <!-- Jednu třetinu obsahu zabírá obrázek (logo). -->
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
