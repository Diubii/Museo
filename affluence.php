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
  <link rel="stylesheet" href="css/default.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>

<body onload="ShowChart(document.querySelector('#dtpicker')._flatpickr.selectedDates[0])">

  <!-- Primary Page Layout  -->

  <?php $p = "index.php";
  include('php/navbar.php'); ?>

  <section class="hero is-fullheight bg">


  <div class="box" style="margin: auto; width: 40%">
  <input class="input is-size-4" value="<?php echo date("Y-m-d")?>" id="dtpicker" type="date" name="entrance_time" placeholder="Seleziona..." required readonly>
  <div class="block"></div>
  <canvas aria-checked="false" id="chart"></canvas>
  </div>

  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="js/affluence.js"></script>
  <script>
    $("#dtpicker").flatpickr({
      altInput: true,
      dateFormat: "Y-m-d",
      altFormat: "j F Y",
      minDate: "today",
      maxDate: new Date().fp_incr(365),
      onChange: function(){
          ShowChart(this.selectedDates[0]);
      }
    })
  </script>
  <!-- End Document -->
</body>

</html>