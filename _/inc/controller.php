<?php

require_once('global.php');

ob_start();
session_start();

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_SCHEMA);

if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class controller {
  public static function header($arg = []) {
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=APP_BASE?>/_/css/app.css">
    <link rel="shortcut icon" href="https://dave.cnf.io/favicon.ico" />
    <title><?=empty($arg['title']) ? '' : $arg['title'] . ' - '?>Steve&rsquo;s Demo App</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="<?=APP_BASE?>/">Steve&rsquo;s Demo App</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item<?=$arg['nav']=='home' ? ' active' : ''?>">
            <a class="nav-link" href="<?=APP_BASE?>/">Home</a>
          </li>
          <li id="mod_nav" class="nav-item<?=$arg['nav']=='mod' ? ' active' : ''?>"<?=empty($_COOKIE['u']) || !empty($_SESSION['mod_access']) ? ' style="display:none;"' : ''?>>
            <a class="nav-link" href="<?=APP_BASE?>/mod/">Moderate</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <h1><img class="img-fluid" id="cnfio-logo" src="https://d3r1vvs66lg0fx.cloudfront.net/app-1003/721c3dd380092e78649435fbc8612a9a.png" alt="conferences i/o" /></h1>
<?php
  }
  public static function footer($arg = []) {
?>
    </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://www.gstatic.com/firebasejs/5.10.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.10.0/firebase-functions.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.10.0/firebase-database.js"></script>
  <script src="<?=APP_BASE?>/_/js/app.js?<?=rand()?>"></script>
  <script>
   // Initialize Firebase
   var config = {
     apiKey: "AIzaSyC11-xi0k4kK73xJggmF0cY9amP5aIFdqY",
     authDomain: "conf-demo-8540f.firebaseapp.com",
     databaseURL: "https://conf-demo-8540f.firebaseio.com",
     projectId: "conf-demo-8540f",
     storageBucket: "conf-demo-8540f.appspot.com",
     messagingSenderId: "853490055246"
   };
   firebase.initializeApp(config);
   <?=empty($_COOKIE['u']) ? '' : "var uid = '".addslashes($_COOKIE['u'])."';"?>
   <?=empty($_SESSION['mod_access']) ? '' : 'var access_mod = true;'?>
  </script>
  </body>
</html>
<?php
  }
}
?>
