<?php
session_start();
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
  <link rel="stylesheet" href="css/default.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>

<body>

  <!-- Primary Page Layout  -->

  <?php $p = "reservations.php";
  include('php/navbar.php'); ?>

  <section class="hero is-fullheight bg">
    <div class="container centered">
      <div class="box">
        <h1 class="is-size-4 centeredText"><b>Tutte le prenotazioni</b></h1>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Numero di persone</th>
              <th>Orario di ingresso</th>
              <th>Contatto</th>
            </tr>
          </thead>
          <?php include('php/reservations.php'); ?>
        </table>
      </div>
    </div>
  </section>

  <!-- End Document -->
</body>

</html>