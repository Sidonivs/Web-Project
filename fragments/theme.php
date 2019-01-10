<!-- Formulář, který posílá na server informaci uživatelově volbě motivu (světlý/tmavý). -->
<form method="post"
  action="form_management/set_theme.php<?php if (isset($_GET['page'])) {
    echo '?page='.$_GET['page'];
  } ?>">

  <!-- Formulář je řešen jedním tlačítkem, které pomocí PHP mění svoji value a svůj nápis. -->
  <button type="submit" name="theme" class="w3-bar-item w3-right w3-button w3-hover-white"
    value="<?php
      if (isset($_COOKIE['theme'])) {
        if ($_COOKIE['theme'] == 'light') {
          echo 'dark';
        } else {
          echo 'light';
        }
      } else {
        echo 'dark';
      }
    ?>"><?php
    if (isset($_COOKIE['theme'])) {
      if ($_COOKIE['theme'] == 'light') {
        echo 'Tmavý motiv';
      } else {
        echo 'Světlý motiv';
      }
    } else {
      echo 'Tmavý motiv';
    } ?></button>

</form>
