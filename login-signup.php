<!DOCTYPE html>
<html lang="it">

<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Museo di Kyoto</title>
  <meta name="description" content="">
  <meta name="author" content="Alessandro Giuseppe Gioia">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="css/default.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>

<body>

  <!-- Primary Page Layout  -->

  <?php $p = "login-signup.php";
  include('php/navbar.php'); ?>

  <section class="hero is-fullheight bg">
    <div class="container centered" id="signupForm" style="display:none;">
      <div class="box">
        <div class="field">
          <label class="label">Nome</label>
          <div class="control">
            <input class="input" type="text" id="SignupName" name="SignupName" placeholder="es. Mario Rossi" required>
            <p class="help is-danger" id="SignupNotValidName" style="display:none;">Inserire un nome valido.</p>
          </div>
        </div>

        <div class="field">
          <label class="label">Username</label>
          <div class="control">
            <input class="input" type="text" id="SignupUsername" name="SignupUsername" placeholder="es. SuperMario" required>
            <p class="help is-danger" id="SignupNotValidUsername" style="display:none;">Inserire uno username valido.</p>
            <p class="help is-danger" id="SignupAlreadyTakenName" style="display:none;">Questo username è già stato preso.</p>
          </div>
        </div>

        <div class="field">
          <label class="label">Password</label>
          <div class="control">
            <input class="input" type="password" id="SignupPassword" name="SignupPassword" required>
            <p class="help is-danger" id="SignupNotValidPassword" style="display:none;">Inserire una password con minimo 8 caratteri e massimo 32 caratteri.</p>
          </div>
        </div>

        <span class="centeredText">
          <p>Hai già un account? </p><a onclick="SwitchForms();">Loggati!</a>
        </span>

        <div class="block"></div>

        <div class="buttons centeredText">
          <button class="button is-primary" type="submit" onclick="Signup(document.getElementById('SignupName').value, document.getElementById('SignupUsername').value, document.getElementById('SignupPassword').value)">Registrati!</button>
        </div>
      </div>
    </div>

      <div class="box"id="loginForm" style="display:block; margin: auto;">

        <div class="field">
          <label class="label">Username</label>
          <div class="control">
            <input class="input" type="text" id="LoginUsername" name="LoginUsername" placeholder="es. SuperMario" required>
            <p class="help is-danger" id="LoginWrongUsername" style="display:none;">Questo utente non esiste.</p>
          </div>
        </div>

        <div class="field">
          <label class="label">Password</label>
          <div class="control">
            <input class="input" type="password" id="LoginPassword" name="LoginPassword" required>
            <p class="help is-danger" id="LoginWrongPassword" style="display:none;">Password errata.</p>
          </div>
        </div>

        <span class="centeredText">
          <p>Non hai un account? </p><a onclick="SwitchForms();">Registrati!</a>
        </span>
        <div class="block"></div>
        <div class="buttons centeredText">
          <button class="button is-primary" type="submit" onclick="Login(document.getElementById('LoginUsername').value, document.getElementById('LoginPassword').value)">Loggati!</button>
        </div>
      </div>
    </div>

    <div class="box p-6" id="error" style="display:none; margin:auto;">
      <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 122.88 122.88">
        <defs>
          <style>
            .cls-1 {
              fill: #f44336;
              fill-rule: evenodd;
            }
          </style>
        </defs>
        <title>close-red</title>
        <path class="cls-1" d="M61.44,0A61.44,61.44,0,1,1,0,61.44,61.44,61.44,0,0,1,61.44,0ZM74.58,36.8c1.74-1.77,2.83-3.18,5-1l7,7.13c2.29,2.26,2.17,3.58,0,5.69L73.33,61.83,86.08,74.58c1.77,1.74,3.18,2.83,1,5l-7.13,7c-2.26,2.29-3.58,2.17-5.68,0L61.44,73.72,48.63,86.53c-2.1,2.15-3.42,2.27-5.68,0l-7.13-7c-2.2-2.15-.79-3.24,1-5l12.73-12.7L36.35,48.64c-2.15-2.11-2.27-3.43,0-5.69l7-7.13c2.15-2.2,3.24-.79,5,1L61.44,49.94,74.58,36.8Z" />
      </svg>
      <div class="centeredText">
        <span>
          <h1 class="is-size-2" id="errorText"></h1><a class="is-size-2" onclick="closeError(document.getElementById('signupForm'), document.getElementById('error'));">riprovare</a>
        </span>
      </div>
    </div>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="node_modules/js-sha256/src/sha256.js"></script>
  <script src="js/login-signup.js"></script>
  <script src="js/miscellaneous.js"></script>
  <!-- End Document -->
</body>

</html>