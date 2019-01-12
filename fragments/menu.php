<?php
  // Toto menu bude vygenerováno pro nepřihlášeného uživatele.
  require_once 'db_control/categories.php';
  $categories = get_categories();
  $archive = get_archive();
?>

<!-- Responzivita - je zajištěna postupným skrýváním položek na vrchní liště a jejich zobrazením na postranním menu,
které je na menších obrazovkách možné otevírat a zavírat => je tak věnováno co nejvíce prostoru samotnému obsahu fóra. -->

<!-- Vrchní lišta -->
<header id="my-top-menu" class="w3-top">
  <div class="w3-bar w3-top w3-left-align w3-xlarge <?php if (isset($_COOKIE['theme'])) {
    if ($_COOKIE['theme'] == 'dark') {
      echo 'w3-theme-l4';
    } else {
      echo 'w3-theme';
    }
  } else {
    echo 'w3-theme';
  } ?>">
    <button class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-xlarge w3-theme-l1"
      type="button" onclick="w3_open()" title="Více">
      <i class="fas fa-bars"></i>
    </button>

    <?php require_once 'fragments/theme.php'; ?>

    <a href="form_management/set_topic.php?topic=none" class="w3-bar-item w3-button my-theme">
      <img class="resize-small" src="images/ferrum_logo.png" alt="Logo Ferrum"> <em class="my-blue">Ferrum</em>
    </a>
    <a href="about.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">O stránce</a>
    <a href="sign_in.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Přihlášení</a>
    <a href="sign_up.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Registrace</a>
  </div>
</header>

<!-- Postranní menu -->
<nav id="my-sidebar" class="w3-sidebar w3-bar-block w3-collapse w3-xlarge w3-animate-left <?php if (isset($_COOKIE['theme'])) {
  if ($_COOKIE['theme'] == 'dark') {
    echo 'w3-theme-l1';
  } else {
    echo 'w3-theme-l5';
  }
} else {
  echo 'w3-theme-l5';
} ?>">
  <button class="w3-button w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large"
    type="button" onclick="w3_close()" title="Zavřít">
    <i class="fas fa-times"></i>
  </button>

  <h3 class="w3-bar-item w3-hide-large bold">Vítejte</h3>
  <a href="about.php" class="w3-bar-item w3-button w3-hide-large w3-hover-black">O stránce</a>
  <a class="w3-bar-item w3-button w3-hover-black w3-hide-large w3-hide-medium" href="sign_in.php">Přihlášení</a>
  <a class="w3-bar-item w3-button w3-hover-black w3-hide-large" href="sign_up.php">Registrace</a>

  <h3 class="w3-bar-item bold">Diskuzní témata</h3>
  <form action="form_management/set_topic.php" method="get">
    <?php
      foreach ($categories as $one_cat) {       // Zobrazení kategorií - počet se může měnit.
    ?>
    <button type="submit" name="topic" class="w3-bar-item w3-button w3-hover-black"
      value="<?php echo $one_cat['id']; ?>"><?php echo htmlspecialchars($one_cat['name']); ?></button>
    <?php
      }
    ?>
    <button type="submit" name="topic" class="w3-bar-item w3-button w3-hover-black w3-border-top"
      value="<?php echo $archive['id']; ?>"><?php echo htmlspecialchars($archive['name']); ?></button>
  </form>
</nav>

<!-- Efekt "Overlay" (překrytí), který je vidět po otevření postranního menu na menší obrazovce. -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" id="my-overlay"></div>
