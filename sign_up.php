<?php
  session_start();
  require_once 'form_management/user_create.php';
?>

<!-- Stránka s formulářem pro registraci. -->
<!DOCTYPE html>
<html lang="cs">

<?php
  require_once 'fragments/head.html';
  require_once 'utilities.php';
?>

<body class="<?php echo check_dark_theme('w3-theme-dark', ''); ?>">

  <?php
    require_once 'fragments/menu.php';
  ?>

  <div class="w3-main shift-right my-container">
    <main class="my-main">

      <div class="w3-row w3-padding-64">
        <div class="w3-twothird w3-container">
          <h2>Registrace</h2>
          <form id="signup-form" class="w3-container w3-large" method="post" action="sign_up.php">
            <div class="w3-section">
              <label for="name">Uživatelské jméno</label>
              <input class="w3-input short w3-animate-input<?php echo add_err_class('username', $errors); ?>"
                id="name" type="text" name="username" placeholder="Jméno nebo přezdívka" required
                value="<?php echo check_request_param('username'); ?>">
              <span id="name-err"><?php echo error_message('username', $errors); ?></span>
            </div>

            <div class="w3-section">
              <label for="email">E-Mail</label>
              <input class="w3-input short w3-animate-input<?php echo add_err_class('email', $errors); ?>"
                id="email" type="email" name="email" placeholder="example@domain.com" required
                value="<?php echo check_request_param('email'); ?>">
              <span id="email-err"><?php echo error_message('email', $errors); ?></span>
            </div>

            <div class="w3-section">
              <label for="pw">Heslo</label>
              <input class="w3-input short w3-animate-input<?php echo add_err_class('password', $errors); ?>"
                id="pw" type="password" name="password" placeholder="********" required>
              <span id="pw-err"><?php echo error_message('password', $errors); ?></span>
            </div>

            <input id="submit-btn" class="w3-btn w3-white w3-border w3-xlarge" type="submit" name="signup" value="Registrovat">
          </form>
        </div>

        <div class="w3-third w3-container">
          <img class="resize-medium" src="images/ferrum_logo.png" alt="Logo Ferrum">
        </div>
      </div>

    </main>

    <?php
      require_once 'fragments/footer.html';
    ?>

  </div>

  <script src="js/sidebar.js"></script>
  <script src="js/AJAX.js"></script>
  <script src="js/validation_client.js"></script>

</body>
</html>
