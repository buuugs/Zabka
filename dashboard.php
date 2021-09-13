<?php
require('config.php');
include("auth_session.php");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/css.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/6745f8312b.js" crossorigin="anonymous"></script>
        <script defer src="fa/js/all.js"></script> <!--load all styles -->
       <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> 
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/6745f8312b.js" crossorigin="anonymous"></script>

       
    </head>
    <body>
 


    <div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
      <span class="navbar-toggler-icon leftmenutrigger"></span>
      <a class="navbar-brand" href="#">Panel Pracownika</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav animate side-nav">
          <li class="nav-item dropdown">
        <a class="nav-link" href="dashboard.php" title="Admin">
          <i class="fas fa-user"></i>Pracownik <i class="fas fa-user shortmenu animate"></i>
        </a>

      </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/dashboard.php" title="Cart"><i class="fas fa-user-tie"></i>Kierownik <i class="fas fa-user-tie shortmenu"></i></a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="#" title="Comment"><i class="fas fa-user-friends"></i> Comment <i class="fas fa-user-friends shortmenu animate"></i></a>
          </li> -->
        </ul>
        <ul class="navbar-nav ml-md-auto d-md-flex">
        
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-user"></i><?php echo $_SESSION['username']; ?> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="haslo.php"><i class="fas fa-user"></i>Zmień Hasło</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fas fa-key"></i>Wyloguj</a>
          </li>
        </ul>
      </div>
    </nav>
    <center>
 <a href="#"><img src="img/logo.png" width="250px"></a>
</center>
<br>
<br>
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
            <center>
            <a href="grafik.php">
              <h5 class="card-title">Grafik</h5>
              <h6 class="card-subtitle mb-2 text-muted"></p>
              <img src="img/calendar.png" style="max-width:249px; max-height:151px;"></img></br></br>
              <a href="grafik.php" class="card-link">Sprawdź grafik pracowników <br></a></a>
</center>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <center>
              <a href="straty/index.php">
            <h5 class="card-title">Straty</h5>
              <h6 class="card-subtitle mb-2 text-muted"></p>
              <img src="img/trash.png" style="max-width:249px; max-height:151px;"></img></br></br>
              <a href="straty/index.php" class="card-link">Dodaj starty do systemu</a></a>
</center>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
            <center>
              <?php
$searchfor = "";
$contents = $_SESSION['sklepy'];

$pattern = preg_quote($searchfor, '/');

$pattern = "/^.*$pattern.*\$/m";
$sklepinfo = "";
if(preg_match_all($pattern, $contents, $matches)){

   $variable = implode("\n", $matches[0]);
$position =strpos($variable , ' - Z');

   $sklepinfo = substr($variable, $position + 4);
}



             echo '<h5 class="card-title"  style="height:20px;">Sklep: Z' . $sklepinfo . '</h5>';
echo '</br>';
              
              include_once 'simple_html_dom.php';
             


              
              $html = file_get_html("https://www.zabka.pl/znajdz-sklep/sklep/ID0" . $sklepinfo);
             // $DOM = new DOMDocument();
              //$DOM->loadHTML($html);
             // $xpath = new DomXPath($DOM);
              $classname = 'locator-details__title';
              echo $html->find("address[class=text -lead]", 0);
              echo $html->find("p[class=text]", 0);
              ?>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
 
   
  <script>
      $(document).ready(function () {
  $('.leftmenutrigger').on('click', function (e) {
    $('.side-nav').toggleClass("open");
    $('#wrapper').toggleClass("open");
    e.preventDefault();
  });
});
</script>
    </body>
    
</html>

<!------ Include the above in your HEAD tag ---------->

 