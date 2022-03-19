<?php
include('php/methods.php');

session_start();
if (!isset($_SESSION["username"])) {
  //header("Location: /Museo/");
  //die();
}
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
  <link rel="stylesheet" href="css/default.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>

<body>

  <!-- Primary Page Layout  -->

  <?php $p="myaccount.php"; include('php/navbar.php'); ?>

  <div class="card centered">

    <div class="card-content">
      <div class="media">
        <div class="media-left">
          <figure class="image is-48x48">
            <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
          </figure>
        </div>
        <div class="media-content">
          <p class="title is-4">
            <?php 
              if (isset($_SESSION["username"])) {
              echo GetValue("account", "name", "WHERE username='$_SESSION[username]'");
              } 
              else{
                echo "V̸̨̨̡̙͕̹̖̥̥̠̗͔͕̪̟̯̪̗̮̤̬̖̠̅̃́͒̾͋̏̂̿̓̑̓̔̏̐̓̆̍̄̕̕͘͘̕i̶̛̦͉̟͇͍̦̞̇̀͒́͆́̇͐̀́̉͂͊͂̐͛̈̈́̅̈́͌̕̚͜͝͠ȧ̶̦̿́̂͒̽͆͐̽̇̈́̉͘̕̕͠͝ͅ ̵̨̢̨̢̡̤̬̭̭͉̟̳̱̫̟͚͕̯͖̜̟̣̙̰̹͕̻͆̉̂́͜͜d̸̡̫͚͙̩̖̜͖̣̦̜̏̀́̑̏̈́͂̽͑̈́̎̏̾̊̈̍̎̈́̈́͘̕͜͠͝ã̶̢͚̦̹͉͎̞̳̦̳͚̮̟͍̻̼͋̊̇̓͋̊̂̇̋̈́͂̔́͘͠͠ ̷̛͉͓̣̤͇̜́̍̓̓q̴̧̢̢͍͈͔̘̻̬͓̹̮͎̬̂̇̊̔͋̈́̀͆̅̑̂̑̐̀̾̈́̄̔͊̈́͒̄̓̐͋̓̂̕͘͜͝ų̵̖͖̥̺̝͉̻͇̣̦͎̞̦̥͗̅͒̑͒͗̈͊͆͑̈́̕̚͠i̴͇͇̮͍̭̬̰̼͎̰̍̏̾̏̽͜͠ͅ";
              } 
            ?>
          </p>
          <p class="subtitle is-6">
            <?php
            if (isset($_SESSION["username"])) {        
              echo "@" . $_SESSION["username"] . " - " . GetValue("account", "role", "WHERE username='$_SESSION[username]'");
            }
            ?>
          </p>
        </div>
      </div>

      <!--<div class="content">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Phasellus nec iaculis mauris. <a>@bulmaio</a>.
        <a href="#">#css</a> <a href="#">#responsive</a>
        <br>-->
        <time>
          <?php
          if (isset($_SESSION["username"])) {
            $dt = GetValue("account", "creation_time", "WHERE username='$_SESSION[username]'");
            $dtSplit = explode(" ", $dt);
            echo "<b>Account creato il " . $dtSplit[0] . " alle " . $dtSplit[1] . "</b>";
          }
          ?>
        </time>
      </div>
      <footer class="card-footer">
    <a href="#" class="card-footer-item">Cancella account</a>
    <a href="#" class="card-footer-item">Gestisci prenotazioni</a>
    <a href="php/logout.php" class="card-footer-item">Logout</a>
  </footer>
    </div>
    


  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->

  <!-- End Document -->
</body>

</html>