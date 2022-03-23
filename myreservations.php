<?php
session_start();
//echo "<script>console.log(" ."\"". $_SESSION["username"] ."\"" . ")</script>"
?>

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="css/default.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>

<body>

  <!-- Primary Page Layout  -->

  <?php
  $p = "myreservations.php";
  include('php/navbar.php');

  ?>
  <section class="hero is-fullheight bg">
    <?php
    if (!isset($_SESSION["username"])) {
      echo '<div id="container" class="container centered">
        <div class="box">
            <h1 class="is-size-4 centeredText"><b>Inserire l\'id della propria prenotazione</b></h1>
            <br>
            <input class="input is-large centeredText" type="text" id="inputID" placeholder="es. AB123">
            <p class="help is-danger centeredText is-size-6" id="NotValidID" style="display: none;">Inserire un ID valido</p>
            <br>
            <div class="buttons centeredText">
        <button class="button is-primary" type="submit" onclick="FindReservation()">Inserisci</button> 
      </div>
        </div>
    </div>

    <div id="tbcontainer" class="container centered" style="display:none;">
        <div class="box">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Numero di persone</th>
                <th>Orario di ingresso</th>
                <th>Contatto</th>
              </tr>
            </thead>
            <tbody id="tBody">
            </tbody>
            </table>
            </div>
          </div>';
    } else {
      echo '<div id="container" class="container centered">
        <div class="box">
        <h1 class="is-size-4 centeredText"><b>Le mie prenotazioni</b></h1>
                <br>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Numero di persone</th>
                <th>Orario di ingresso</th>
                <th>Contatto</th>
              </tr>
            </thead>';
      include('php/myreservations.php');
      echo '         
    </table>
    </div>
  </div>';
    }

    ?>

      <div class="box p-5" id="form" style="display: none; margin:auto;">
        <div class="field">
          <label class="label">Nome</label>
          <div class="control">
            <?php if (isset($_SESSION["username"])) {
              echo '<label id="name">' . "&nbsp;" . GetValue("account", "name", "WHERE username='$_SESSION[username]'") . '</label>';
            } else {
              echo '<input class="input" type="text" id="name" name="name" placeholder="es. Mario Rossi" required>';
            }
            ?>
            <p class="help is-danger" id="NotValidName" style="display:none;">Inserire un nome valido.</p>
          </div>
        </div>

        <div class="field">
          <label class="label">Numero di persone</label>
          <div class="control">
            <input class="input" id="n_people" type="number" min="1" max="5" name="n_people" placeholder="Es. 4" required>
          </div>
          <p class="help is-danger" id="NaN" style="display:none;">Inserire un numero.</p>
          <p class="help is-danger" id="NotValidNumber" style="display:none;">Il numero di persone deve essere compreso tra 1 e 5.</p>
        </div>

        <div class="field">
          <label class="label">Data e ora</label>
          <div class="control">
            <input class="input" id="dtpicker" type="date" name="entrance_time" placeholder="Seleziona..." required readonly>
            <p class="help is-danger" id="NotValidDT" style="display:none;">Inserire una data e ora valida.</p>
          </div>
        </div>

        <div class="field">
          <label class="label">Contatto (mail)</label>
          <div class="control">
            <input class="input" type="email" id="contact" name="contact" placeholder="es. mariorossi@gmail.com" required>
            <p class="help is-danger" id="NotValidEmail" style="display:none;">Inserire un indirizzo mail valido.</p>
          </div>
        </div>

        <div class="buttons centeredText">
          <button class="button is-warning" type="submit" onclick="EditReservation(GetCurrentEditingID(), document.getElementById('name').textContent || document.getElementById('name').value, document.getElementById('contact').value, document.getElementById('n_people').value, document.getElementById('dtpicker').value, <?php if (isset($_SESSION['username'])) {
                                                                                                                                                                                                                                                                                                                                  echo '\'' . $_SESSION['username'] . '\'';
                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                  echo NULL;
                                                                                                                                                                                                                                                                                                                                } ?>)">Modifica!</button>
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
        <?php if (!isset($_SESSION["username"])) {
          echo '<h1 class="is-size-2">C\'è stato un errore durante la prenotazione, <a onclick="closeError(document.getElementById(\'inputContainer\'), document.getElementById(\'error\'));">riprovare</a>.</h1>';
        } else {
          echo '<h1 class="is-size-2">C\'è stato un errore durante la prenotazione, <a onclick="closeError(document.getElementById(\'tableContainer\'), document.getElementById(\'error\'));">riprovare</a>.</h1>';
        }
        ?>
      </div>
    </div>

    <div class="box p-6" id="success" style="display:none; margin:auto;">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" style="display:block; margin:auto;" preserveAspectRatio="xMidYMin" width="300" height="300" viewBox="0 0 50 50" id="Capa_1" xml:space="preserve">
        <circle style="fill:#25AE88;" cx="25" cy="25" r="25" />
        <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="  38,15 22,33 12,25 " />
      </svg>
      <div class="centeredText">
        <span>
          <h1 class="is-size-2">Modifica eseguita correttamente!</h1>
        </span>

      </div>
      <div class="centeredText">
        <a href="/Museo/" class="is-size-4">Torna alla home</a>
      </div>
    </div>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="js/miscellaneous.js"></script>
  <script src="js/myreservations.js"></script>
  <script src="js/findreservation.js"></script>
  <script>
    $("#dtpicker").flatpickr({
      enableTime: true,
      altInput: true,
      dateFormat: "Y-m-d H:i:s",
      altFormat: "j F Y, H:i",
      minDate: "today",
      maxDate: new Date().fp_incr(365)
    })
  </script>
  <!-- End Document -->
</body>

</html>