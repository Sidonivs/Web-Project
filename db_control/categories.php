<?php

  // Tento soubor obsahuje funkce, které obstarávají přístup (zápis/čtení/mazání) k databázové tabulce "categories" (kategorie).

  require_once 'common.php';

  function add_category($cat_name) {        // Přidá novou kategorii se jmémen hodnoty proměnné $cat_name.
    $link = connect_db();

    $stmt = $link->prepare("INSERT INTO categories (name) VALUES (:name)");
    $stmt->bindParam(':name', $cat_name);                 // Ochrana proti SQL Injection.

    if ($stmt->execute()) {
      $stmt = null;
      $link = null;
      return true;              // Kategorie byla úspěšně přidána.
    } else {
      $stmt = null;
      $link = null;
      return false;             // Kategorie nebyla přidána.
    }
  }

  function get_categories() {        // Vrátí všechny kategorie (s výjimkou speciální kategorie Archiv (id = 15)).
    $link = connect_db();

    $stmt = $link->prepare("SELECT * FROM categories WHERE id != 15");
    if ($stmt->execute()) {
      $rows = array();
      while ($row = $stmt->fetch()) {
        array_push($rows, $row);
      }
      $stmt = null;
      $link = null;
      return $rows;
    } else {
      $stmt = null;
      $link = null;
      header('Location: my_error.php');
    }
  }

  function get_archive() {           // Vrátí speciální kategorii Archiv.
    $link = connect_db();

    $stmt = $link->prepare("SELECT * FROM categories WHERE id = 15");

    if ($stmt->execute()) {
      $row = $stmt->fetch();
      $stmt = null;
      $link = null;
      return $row;
    } else {
      $stmt = null;
      $link = null;
      header('Location: my_error.php');
    }
  }

  function del_category($cat_id) {          // Vymaže z databáze kategorii o určitém id.
    $link = connect_db();

    $stmt = $link->prepare("UPDATE posts SET fkCategory = 15 WHERE fkCategory = :catid;
      DELETE FROM categories WHERE id = :catid");
    $stmt->bindValue(':catid', $cat_id, PDO::PARAM_INT);

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

?>
