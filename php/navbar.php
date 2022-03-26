<?php
$nav = '<nav class="navbar" role="navigation" aria-label="main navigation">
<div class="navbar-brand">
  <a class="navbar-item" href="/">
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


      <a class="navbar-item" href="myreservations.php">
        Gestisci prenotazioni
      </a>



      <a class="navbar-item" href="affluence.php">
        Affluenza settimanale
      </a>

  </div>

<div class="navbar-end">
<div class="navbar-item">
    <div class="buttons">
        <a class="button is-dark" href="https://github.com/Diubii/Museo">
            <strong><i class="fab fa-github"></i>&nbsp; GitHub</strong>
        </a>
    </div>
    </div>';

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
</nav>
<script>document.addEventListener(\'DOMContentLoaded\', () => {

  // Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll(\'.navbar-burger\'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach( el => {
      el.addEventListener(\'click\', () => {

        // Get the target from the "data-target" attribute
        const target = el.dataset.target;
        const $target = document.getElementById(target);

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle(\'is-active\');
        $target.classList.toggle(\'is-active\');

      });
    });
  }

});</script>';

echo $nav;
