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

    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/Museo/">
                <b>IL MUSEO DI KYOTO</b>
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="prenotazioni.php">
          Visualizza prenotazioni
        </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
            Più
          </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
              Modifica prenotazione
            </a>
                        <a class="navbar-item">
              Cancella prenotazione
            </a>
                    </div>
                </div>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary" href="prenota.php">
                            <strong>Prenota!</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container centered">
    <div class="box">
    <table class="table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Numero di persone</th>
          <th>Orario di ingresso</th>
          <th>Contatto</th>
        </tr>
      </thead>
      <?php include('php/visualizzaprenotazioni.php'); ?>
    </table>
    </div>
    </div>

    <!-- End Document -->
</body>

</html>