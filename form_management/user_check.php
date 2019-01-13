<?php

  // Tento soubor je součástí sign_in.php.
  // Obsluha formuláře pro přihlášení.

  $errors = array();
  if (isset($_POST['signin'])) {

    require_once 'form_management/validation_server.php';
    require_once 'db_control/users.php';

    if (!validate_username($_POST['username'])) {
      $errors['username'] = 'Uživatelské jméno musí obsahovat 1 - 20 znaků';
    }

    if (!validate_password($_POST['password'])) {
      $errors['password'] = 'Heslo musí obsahovat 1 - 20 znaků';
    }

    if (count($errors) == 0) {

      $pw = get_password($_POST['username']);

      if ($pw) {        // Pokud tato podmínka neprojde znamená to, že funkce get_password() vrátila false,
                        // z čehož vyplývá, že pro zadané uživatelské jméno neexistuje žádné heslo (tedy ani uživatel)
        if (password_verify($_POST['password'], $pw)) {
          $_SESSION['user'] = htmlspecialchars($_POST['username']);

          header('Location: index.php');
          exit;
        } else {
          $errors['wrong_input'] = 'Špatné uživatelské jméno nebo heslo'; // Z bezpečnostních důvodů neoznamuji uživateli, který údaj zadal špatně.
        }
      } else {
        $errors['wrong_input'] = 'Špatné uživatelské jméno nebo heslo';
      }
    }
  }

?>
