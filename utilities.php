<?php

  // Tento soubor obsahuje pomocné funkce.
  // Slouží především k lepší čitelnosti a menší redundanci (opakování) stejného kódu.

  function check_request_param($http_param) { // Kontroluje, zda nebylo formulářové pole již odesláno,
                                              // pokud ano, předvyplní jej předchozími hodnotami od uživatele.
    if (isset($_POST[$http_param])) {
      return htmlspecialchars($_POST[$http_param]);
    } else {
      return '';
    }
  }

  function check_dark_theme($css_class1, $css_class2) {   // Kontroluje, jaký je aktuálně zvolený motiv.
    if (isset($_COOKIE['theme'])) {
      if ($_COOKIE['theme'] == 'dark') {
        return $css_class1;     // Pokud je tmavý motiv, vrátí parametr 1.
      }
    }
    return $css_class2;         // Pokud je světlý motiv, vrátí parametr 2.
  }

  function error_message($error_name, $errors) {    // Pokud došlo při vyplňování formuláře k chybě, vrátí chybovou hlášku.
    if (isset($errors[$error_name])) {
      return $errors[$error_name];
    }
  }

  function add_err_class($input_name, $errors) {    // Pokud došlo při vyplňování formuláře k chybě,
                                                    // vrátí červený rámeček (pro pole, ve kterém nastala chyba).
    if (isset($errors[$input_name]) or isset($errors['wrong_input'])) {
      return ' w3-border-red';
    }
  }

?>
