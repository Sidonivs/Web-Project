<?php

  // Tento soubor je součástí edit_topics.php.
  // Obsluha formulářů pro úpravu kategorií/témat.

  $errors = array();
  if (isset($_POST['new-topic'])) {         // Formulář pro přidání kategorie.

    require_once 'form_management/validation_server.php';
    require_once 'db_control/categories.php';

    $new_cat_name = trim($_POST['new-topic']);

    if (!validate_cat_name($new_cat_name)) {
      $errors['new-topic'] = 'Název tématu musí obsahovat 1 - 20 znaků';
    }

    if (count($errors) == 0) {
      if (add_category($new_cat_name)) {
        header('Location: index.php');
      } else {
        $errors['new-topic'] = 'Takové téma již existuje';
      }
    }
  } elseif (isset($_POST['del-topic-id'])) {        // Formulář pro odstranění kategorie.

    require_once 'form_management/validation_server.php';
    require_once 'db_control/categories.php';

    if (!validate_topic($_POST['del-topic-id'])) {
      $errors['topic'] = 'Vyberte prosím téma z nabídky';
    }

    if (count($errors) == 0) {
      if (del_category((int)$_POST['del-topic-id'])) {
        header('Location: index.php');
      } else {
        header('Location: my_error.php?a='.$_POST['del-topic-id']);
      }
    }
  }

?>
