<?php

  // Tento soubor obstarává formulář změny motivu (světlý/tmavý) a nastavuje cookie podle hodnot poslaných formulářem (metodou POST).

  if ($_POST['theme'] == 'light') {
    setcookie('theme', 'light', time()+7200, '/');
  } elseif ($_POST['theme'] == 'dark') {
    setcookie('theme', 'dark', time()+7200, '/');
  }

  if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);   // Přesměrování uživatele zpět na stránku na které klikl na tlačítko změny motivu.
  } else {
    if (isset($_GET['page'])) {        // Pokud není HTTP_REFERER dostupný, bude uživatel automaticky přesměrován na index.php.
      header('Location: ../index.php?page='.$_GET['page']);
    } else {
      header('Location: ../index.php');
    }
  }

?>
