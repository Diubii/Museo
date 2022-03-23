<?php
$nav = '<nav class="navbar" role="navigation" aria-label="main navigation">
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
    <a class="navbar-item" href="reservations.php">
      Visualizza prenotazioni
    </a>

    <div class="navbar-item">
      <a class="navbar-item" href="myreservations.php">
        Gestisci prenotazioni
      </a>
    </div>

    <div class="navbar-item">
      <a class="navbar-item" href="affluence.php">
        Affluenza settimanale
      </a>
    </div>
  </div>

<div class="navbar-end">';

if (isset($_SESSION["username"]) && $p == "myaccount.php") {
    $nav .= '<div class="navbar-item">
    <div class="buttons">
        <a class="button is-warning" href="php/logout.php">
            <strong>Logout</strong>
        </a>
    </div>
    </div>';
}
else if (!isset($_SESSION["username"]) && $p == "myaccount.php") {
    $nav .= '<div class="navbar-item">
    <div class="buttons">
        <a class="button is-danger is-light" href="/Museo/">
            <strong>Non dovresti essere qui</strong>
        </a>
    </div>
    </div>';
}
else if (isset($_SESSION["username"]) && $p != "myaccount.php") {
    
    $nav .= '<div class="navbar-item">
        <div class="buttons">
            <a class="button is-primary" href="myaccount.php">
                <strong>Il mio account</strong>
            </a>
        </div>
        </div>';
} else {
    $nav .=  '<div class="navbar-item">
        <div class="buttons">
            <a class="button is-primary" href="login-signup.php">
                <strong>Login / Signup</strong>
            </a>
        </div>
        </div>';
}
$nav .= '   
</div>
</nav>';

echo $nav;
