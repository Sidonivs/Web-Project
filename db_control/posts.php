<?php

  // Tento soubor obsahuje funkce, které obstarávají přístup (zápis/čtení/mazání) k databázové tabulce "posts" (příspěvky).

  require_once 'common.php';

  // Tabulka posts má sloupce: id (primární klíč, generován automaticky), titulek, tělo příspěvku,
  // id kategorie (cizí klíč), id uživatele (cizí klíč) a datum (+ čas) přidání (generován funkcí NOW()).
  // Více informací o rozvržení tabulek lze najít přímo v databázi (jméno databáze: kotrlzde).
  function add_post($title, $body, $cat_id, $user) {
    $link = connect_db();

    $stmt = $link->prepare("INSERT INTO posts (title, body, fkCategory, fkUser, dateCreated)
      VALUES (:title, :body, :catid, (SELECT id FROM users WHERE username = :user), NOW())");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':body', $body);
    $stmt->bindParam(':catid', $cat_id);
    $stmt->bindParam(':user', $user);

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

  function get_posts_by_date($offset) {
    /* Funkce slouží k získání příspěvků seřazených podle data vytvoření
       a limitovaných pomocí offsetu (speciální hodnota, která vypočítává z čísla stránky
       a počtu položek na stránku (v tomto případě 3)).
       Tato funkce se využívá k získání obsahu pro Hlavní stránku. */
    $link = connect_db();

    $stmt = $link->prepare("SELECT posts.id, title, body, dateCreated, users.username, categories.name
      FROM posts JOIN users ON (posts.fkUser = users.id) JOIN categories ON (posts.fkCategory = categories.id)
      ORDER BY dateCreated DESC LIMIT :offset, 3");
    $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);

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

  function get_posts_by_cat($cat_id, $offset) {      // Získá příspěvky podobně jako předchozí funkce, avšak pouze z dané kategorie.
    $link = connect_db();

    $stmt = $link->prepare("SELECT posts.id, title, body, dateCreated, users.username, categories.name
      FROM posts JOIN users ON (posts.fkUser = users.id) JOIN categories ON (posts.fkCategory = categories.id)
      WHERE categories.id = :catid ORDER BY dateCreated DESC LIMIT :offset, 3");
    $stmt->bindValue(":catid", $cat_id, PDO::PARAM_INT);
    $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);

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

  function get_post_by_id($post_id) {        // Vrátí právě jeden příspěvek, který odpovídá danému id.
    $link = connect_db();

    $stmt = $link->prepare("SELECT posts.id, title, body, dateCreated, users.username, categories.name
      FROM posts JOIN users ON (posts.fkUser = users.id) JOIN categories ON (posts.fkCategory = categories.id)
      WHERE posts.id = :postid");
    $stmt->bindValue(":postid", $post_id, PDO::PARAM_INT);

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

  function get_num_of_posts_by_cat($cat_id) {       // Vrátí počet příspěvků dané kategorie.
    $link = connect_db();

    if ($cat_id == 'none') {                        // V případě, že $cat_id == "none" vrátí počet všech příspěvků.
      $stmt = $link->prepare("SELECT COUNT(*) AS num_of_posts FROM posts");
    } else {
      $stmt = $link->prepare("SELECT COUNT(*) AS num_of_posts FROM posts
        JOIN categories ON (posts.fkCategory = categories.id) WHERE categories.id = :catid");
      $stmt->bindValue(":catid", $cat_id, PDO::PARAM_INT);
    }

    if ($stmt->execute()) {
      $num_of_posts = $stmt->fetch();
      $stmt = null;
      $link = null;
      return (int)$num_of_posts['num_of_posts'];
    } else {
      $stmt = null;
      $link = null;
      header('Location: my_error.php');
    }
  }

  function del_post($post_id) {            // Vymaže právě jeden post, který odpovídá danému id.
    $link = connect_db();

    $stmt = $link->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->bindParam(':id', $post_id);

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
