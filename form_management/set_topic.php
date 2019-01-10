<?php

  // Podobně jako set_theme.php tento soubor nastavuje uživateli zvolené diskuzní téma/kategorii.
  // Zvolené téma je záměrně uchováváno v cookie, neboť tento způsob lépe vyhovuje mému konceptu diskuzního fóra
  // (diskutuje se především v rámci jednotlivých kategorií). Uživatel po přihlášení/registraci zůstane ve zvolené kategorii.

  if ($_GET['topic'] == 'none') {
    setcookie('topic', 'none', time()-31536000, '/');
  } else {
    require_once '../db_control/categories.php';
    $categories = get_categories();
    $archive = get_archive();

    if ($_GET['topic'] == $archive['id']) {  // Speciální případ pro kategorii Archiv, která se z databáze vytahuje odděleně od ostatních kategorií.
      setcookie('topic', $archive['id'], time()+14400, '/');
    } else {
      foreach ($categories as $one_cat) {
        if ($_GET['topic'] == $one_cat['id']) {
          setcookie('topic', $one_cat['id'], time()+14400, '/');
          break;
        }
      }
    }
  }

  header('Location: ../index.php');       // Návrat na index.php, kde se následně zobrazí nový obsah (podle zvolené kategorie).

?>
