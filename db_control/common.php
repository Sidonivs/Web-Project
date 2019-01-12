<?php

  // Společný soubor pro všechny tabulky databáze (categories, users a posts).
  // Funkce connect_db() vytvoří spojení s databází a využívají ji všechny PHP funkce, které s databází přímo komunikují.
  /*
  function connect_db() {
    // Pro komunikaci PHP s databází MySQL je v tomto projektu použita knihovna PDO (dokumentace/manuál: http://php.net/manual/en/book.pdo.php)
    $conStr = "mysql:host=wa.toad.cz;dbname=kotrlzde";
    $link = new PDO($conStr, 'kotrlzde', 'webove aplikace', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

    if ($link) {
      return $link;
    } else {
      header('Location: my_error.php');
    }
  }
  */

  function connect_db() {
    // Pro komunikaci PHP s databází MySQL je v tomto projektu použita knihovna PDO (dokumentace/manuál: http://php.net/manual/en/book.pdo.php)
    $conStr = "mysql:host=localhost;dbname=mycms";
    $link = new PDO($conStr, 'AppUser', 'IFnEiCoJFJp2o1xa', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

    if ($link) {
      return $link;
    } else {
      header('Location: my_error.php');       // Nepodařilo se připojit k databázi.
    }
  }

?>
