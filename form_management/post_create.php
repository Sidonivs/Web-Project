<?php

  // Tento soubor je součástí new_entry.php a má na starosti kontrolu a přidání nového příspěvku.

  $errors = array();              // Pole, které bude obsahovat případné errory.
  if (isset($_POST['send'])) {

    require_once 'form_management/validation_server.php';   // Budou potřeba funkce, které validují vstup uživatele na straně serveru.
    require_once 'db_control/posts.php';                    // Tento soubor pracuje s tabulkou posts v databázi.

    $title = trim($_POST['title']);

    if (!validate_title($title)) {
      $errors['title'] = 'Nadpis musí obsahovat 1 - 50 znaků';
    }

    if (!validate_body($_POST['entry'])) {
      $errors['body'] = 'Příspěvek musí obsahovat 1 - 65000 znaků';
    }

    if (!isset($_POST['topic_id']) or !validate_topic($_POST['topic_id'])) {
      $errors['topic'] = 'Vyberte prosím téma z nabídky';
    }

    if (count($errors) == 0) {
      if (add_post($title, $_POST['entry'], $_POST['topic_id'], htmlspecialchars_decode($_SESSION['user']))) {
        header('Location: index.php');          // Přidání příspěvku proběhlo úspěšně.
      } else {
        header('Location: my_error.php');       // Vyskytl se problém s databází.
      }
    }
  }

?>
