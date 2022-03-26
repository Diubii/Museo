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
  <link rel="stylesheet" href="css/default.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>

<body>

  <!-- Primary Page Layout  -->

  <?php $p = "index.php";
  include('php/navbar.php'); ?>

  <section class="hero is-fullheight bg">

    <div class="container centered">

      <div class="box p-6">
        <!--<div class="box">-->
        <div class="centeredText">
          <h1 class="is-size-2">Benvenuti nel Sito di Prenotazioni Ufficiale del <br> <b> Museo Nazionale di Kyoto</b>!</h1>
        </div>
        <div class="block"></div>
        <div class="buttons centeredText">
          <a class="button is-large is-primary" href="reservate.php">
            <strong>Prenota qui!</strong>
          </a>
          <!--</div>-->

        </div>

        <!--<img src="https://upload.wikimedia.org/wikipedia/commons/b/bb/Kyoto_National_Museum_2009.jpg" alt="Museo di Kyoto">-->

      </div>
    </div>
  </section>

  <!-- End Document -->
</body>

</html>