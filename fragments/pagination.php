<!-- Stránkování -->
<nav id="pagination" class="w3-center w3-xlarge w3-padding-32 w3-bar">

  <!-- Tlačítko předchozí -->
  <a class="w3-button w3-border<?php
      echo check_dark_theme(' w3-hover-white', ' w3-hover-black');
      if ((int)$page_num <= 1) {
        echo ' w3-disabled';
      } ?>"
    href="<?php if ((int)$page_num > 1) {
        $prev_page_num = $page_num - 1;
        echo '?page='.(string)$prev_page_num;
      } ?>" title="Předchozí">
    <i class="fas fa-angle-double-left"></i> <!-- Syntaxe Font Awesome předepisuje použití elementu <i>. -->
  </a>

  <!-- Tlačítko další -->
  <a class="w3-button w3-border<?php
      echo check_dark_theme(' w3-hover-white', ' w3-hover-black');
      if ((int)$page_num >= $max_page_num) {
        echo ' w3-disabled';
      } ?>"
    href="<?php if ((int)$page_num < $max_page_num) {
        $next_page_num = $page_num + 1;
        echo '?page='.(string)$next_page_num;
      } ?>" title="Další">
    <i class="fas fa-angle-double-right"></i>
  </a>

  <?php
    if ($max_page_num < 1) {
      $max_page_num = 1;
    }
  ?>

  <p class="w3-large">Stránka: <?php echo (string)$page_num.'&sol;'.(string)$max_page_num; ?></p>

</nav>
