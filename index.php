<?php

  session_start();
  if (isset($_GET['logout'])) {     // Odhlásí uživatele.
    session_unset();
    session_destroy();
  }

  require_once 'db_control/posts.php';
  require_once 'utilities.php';
  require_once 'db_control/categories.php';

  if (isset($_GET['del']) and isset($_SESSION['user'])) {     // Pokud uživatel klikl na tlačítko "smazat", zde proběhne smazání.
    $post_to_del = get_post_by_id((int)$_GET['del']);
    if ((htmlspecialchars_decode($_SESSION['user']) == $post_to_del['username']) or (htmlspecialchars_decode($_SESSION['user']) == 'admin')) {
      if (!del_post((int)$_GET['del'])) {
        header('Location: my_error.php');
        exit;
      }
    }
  }

  $categories = get_categories();
  $archive = get_archive();
  array_push($categories, $archive);

  if (isset($_GET['page'])) {
    $page_num = (int)$_GET['page'];  // Nastaví číslo stránky na hodnotu $_GET['page'], pokud není k dispozici, nastaví defaultně na 1.
  } else {
    $page_num = 1;
  }
  $offset = 3*($page_num - 1);

  if (isset($_COOKIE['topic'])) {
    foreach ($categories as $one_cat) {
      if ($_COOKIE['topic'] == $one_cat['id']) {
        $posts = get_posts_by_cat((int)$one_cat['id'], $offset);    // Vytáhne z databáze příspěvky tématu uloženém v $_COOKIE['topic'].
        $current_cat = $one_cat;
        break;
      }
    }
  }

  if (!isset($posts)) {
    $posts = get_posts_by_date($offset);    // Pokud není zadané žádné téma, vytáhne všechny příspěvky seřazené podle data.
  }

?>

<!DOCTYPE html>
<html lang="cs">

<?php
  require_once 'fragments/head.html';     // Hlava html dokumentu
?>

<body class="<?php echo check_dark_theme('w3-theme-dark', ''); // Nastavení motivu ?>">

  <?php
    if (isset($_SESSION['user'])) {       // Přihlášený uživatel má jiné menu, než nepřihlášený.
      require_once 'fragments/menu-user.php';
    } else {
      require_once 'fragments/menu.php';
    }
  ?>

  <!-- Hlavní obsah stránky (main) a patička. Oboje je potřeba posunout doprava kvůli postrannímu menu. -->
  <div class="w3-main my-container shift-right">
    <main class="my-main">
      <div class="w3-padding-32">

        <h1 class="my-margin-top w3-center"><?php if (isset($_COOKIE['topic'])) {
            echo htmlspecialchars($current_cat['name']);
          } else {
            echo 'Hlavní stránka';
          } ?></h1>

        <?php
          foreach ($posts as $one_post) {       // Cyklus zobrazí všechny dostupné příspěvky.
        ?>

        <article class="w3-row w3-container w3-padding-32">
          <h2 class="my-blue"><?php echo htmlspecialchars($one_post['title']); ?></h2>
          <ul>
            <li>Autor: <?php echo htmlspecialchars($one_post['username']); ?></li>
            <li>Téma: <?php echo htmlspecialchars($one_post['name']); ?></li>
            <li>Datum: <?php echo htmlspecialchars($one_post['dateCreated']); ?></li>
          </ul>
          <p class="format"><?php echo htmlspecialchars($one_post['body']); ?></p>

          <?php
            if (isset($_SESSION['user']) and ((htmlspecialchars_decode($_SESSION['user']) == $one_post['username']) or (htmlspecialchars_decode($_SESSION['user']) == 'admin'))) {
              // Tlačítko smazat se zobrazí pouze autorovi příspěvku, nebo Administrátorovi.
          ?>

          <!-- Tlačítko "smazat" -->
          <a class="w3-button w3-black w3-border" href="?del=<?php
              echo $one_post['id'];
              if (isset($_GET['page'])) {
                echo '&page='.$_GET['page'];
              }
            ?>">Smazat</a>

        <?php
            }
        ?>
        </article>
        <?php
          }
        ?>

      </div>

      <?php
        require_once 'fragments/pagination.php';      // Stránkování
      ?>

    </main>

    <?php
      require_once 'fragments/footer.html';           // Patička html dokumentu
    ?>

  </div>

  <script src="js/sidebar.js"></script> <!-- Script, který obstarává správné fungování postranního menu při zobrazení na menších obrazovkách. -->

</body>
</html>
