<?php

  // Tento soubor obsahuje funkci na každý vstup uživatele, který je nutné zvalidovat.
  // V názvu funkce je vždy aktuálně validovaný vstup (input).

  function validate_username($username) {
    if ((strlen($username) > 0) and (strlen($username) <= 20)) {
      return true;
    } else {
      return false;
    }
  }

  function validate_email($email) {
    if ((strlen($email) > 0) and (strlen($email) <= 100) and (strrpos($email, '@') != false)) {
      return true;
    } else {
      return false;
    }
  }

  function validate_password($password) {
    if ((strlen($password) > 0) and (strlen($password) <= 20)) {
      return true;
    } else {
      return false;
    }
  }

  function validate_topic($topic) {
    require_once 'db_control/categories.php';
    $categories = get_categories();

    foreach ($categories as $one_cat) {
      if ($topic == $one_cat['id']) {
        return true;
      }
    }
    return false;
  }

  function validate_title($title) {
    if ((strlen($title) > 0) and (strlen($title) <= 50)) {
      return true;
    } else {
      return false;
    }
  }

  function validate_body($body) {
    if ((strlen($body) > 0) and (strlen($body) <= 65000)) {
      return true;
    } else {
      return false;
    }
  }

  function validate_cat_name($name) {    // Tato funkce validuje formulář přidání nové kategorie (dostupný pouze administrátorovi).
    if ((strlen($name) > 0) and (strlen($name) <= 20)) {
      return true;
    } else {
      return false;
    }
  }

?>
