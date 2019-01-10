<?php

  // Tento soubor je součástí sign_up.php.
  // Obsluha formuláře pro registraci.

  $errors = array();
  if (isset($_POST['signup'])) {

    require_once 'form_management/validation_server.php';
    require_once 'db_control/users.php';

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    if (!validate_username($username)) {
      $errors['username'] = 'Uživatelské jméno musí obsahovat 1 - 20 znaků';
    }

    if (!validate_email($email)) {
      $errors['email'] = 'Email musí být vyplněný a obsahovat zavináč (povoleno maximálně 100 znaků)';
    }

    if (!validate_password($_POST['password'])) {
      $errors['password'] = 'Heslo musí být vyplněné';
    }

    if (count($errors) == 0) {

      $pw_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

      if (check_user($username)) {
        $errors['username'] = 'Uživatelské jméno již existuje';
      }

      if (check_email($email)) {
        $errors['email'] = 'E-mail již existuje';
      }

      if (count($errors) == 0) {
        if (add_user($username, $email, $pw_hash)) {
          $_SESSION['user'] = htmlspecialchars($username);
          header('Location: index.php');
        } else {
          header('Location: my_error.php');
        }
      }
    }
  }

  if (isset($_GET['name'])) {         // Obsluha formulářového vstupu "username" pomocí AJAXu.

    require_once 'validation_server.php';
    require_once '../db_control/users.php';

    $username = trim($_GET['name']);

    if (!validate_username($username)) {
      echo 'Uživatelské jméno musí obsahovat 1 - 20 znaků';
    } elseif (check_user($username)) {
        echo 'Uživatelské jméno již existuje';
    }
  }

  if (isset($_GET['email'])) {       // Obsluha formulářového vstupu "email" pomocí AJAXu.

    require_once 'validation_server.php';
    require_once '../db_control/users.php';

    $email = trim($_GET['email']);

    if (!validate_email($email)) {
      echo 'Email musí být vyplněný a obsahovat zavináč (povoleno maximálně 100 znaků)';
    } elseif (check_email($email)) {
        echo 'E-mail již existuje';
    }
  }

?>
