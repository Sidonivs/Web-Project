<?php

  // Tento soubor obsahuje funkce, které obstarávají přístup (zápis/čtení) k databázové tabulce "users" (uživatelé).

  require_once 'common.php';

  function add_user($username, $email, $password) {           // Přidá uživatele.
    $link = connect_db();

    $stmt = $link->prepare("INSERT INTO users (username, email, password)
      VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $stmt = null;
      $link = null;
      return true;
    } else {
      $stmt = null;
      $link = null;
      return false;
    }
  }

  function check_user($username) {           // Kontroluje zda dané uživatelské jméno (které je unikátní) v databázi již existuje.
    $link = connect_db();

    $stmt = $link->prepare("SELECT CASE WHEN :username = (SELECT username FROM users WHERE username = :username) THEN 1
      ELSE 0 END FROM users LIMIT 0, 1");
    $stmt->bindValue(":username", $username, PDO::PARAM_STR);
    if ($stmt->execute()) {
      $case = $stmt->fetch();
      $stmt = null;
      $link = null;
      if ($case[0] == '1') {
        return true;                           // Funkce vrátí true, pokud takového uživatele našla.
      } elseif ($case[0] == '0') {
        return false;                          // V opačném případě vrátí false
      }
    } else {
      $stmt = null;
      $link = null;
      header('Location: my_error.php');        // Došlo-li behem komunikace s databází k problému,
                                               // funkce nevrací nic a přesměruje uživatele na stránku s errorem.
    }
  }

  function check_email($email) {               // Podobná jako předchozí funkce, akorát kontroluje existenci emailu (který je také unikátní).
    $link = connect_db();

    $stmt = $link->prepare("SELECT CASE WHEN :email = (SELECT email FROM users WHERE email = :email) THEN 1
      ELSE 0 END FROM users LIMIT 0, 1");
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    if ($stmt->execute()) {
      $case = $stmt->fetch();
      $stmt = null;
      $link = null;
      if ($case[0] == '1') {
        return true;
      } elseif ($case[0] == '0') {
        return false;
      }
    } else {
      $stmt = null;
      $link = null;
      header('Location: my_error.php');
    }
  }

  function get_password($username) {        // Funkce vrátí heslo (osolený hash) daného uživatele (podle uživatelského jména),
                                            // nebo false pokud takového uživatele nenalezne.
    $link = connect_db();

    $stmt = $link->prepare("SELECT password FROM users WHERE username = :username");
    $stmt->bindValue(":username", $username, PDO::PARAM_STR);
    if ($stmt->execute()) {
      $password = $stmt->fetch();           // PDO funkce fetch vrací false, pokud SQL dotazu neodpovídají žádná data.
      $stmt = null;
      $link = null;
      if (isset($password['password'])) {   // Heslo bylo nalezeno.
        return $password['password'];
      } else {
        return false;                       // Heslo nebylo nalezeno.
      }
    } else {
      $stmt = null;
      $link = null;
      header('Location: my_error.php');
    }
  }

  /* Speciální uživatelé:
  1) Administrátor
    jméno: admin
    heslo: MyAdmin486
  2) běžný testovací uživatel
    jméno: test
    heslo: test
  */
?>
