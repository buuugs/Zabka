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
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script defer src="fa/js/all.js"></script> <!--load all styles -->
        <script src="https://kit.fontawesome.com/6745f8312b.js" crossorigin="anonymous"></script>
    </head>
    <body>
 
    <?php
ini_set('date.timezone', 'Europe/Warsaw');
setlocale(LC_ALL, 'pl_PL.UTF8');
require('config.php');


if (isset($_POST['password'])) {

    $user = $_SESSION['username'];

    $password = stripslashes($_REQUEST['password']);
    $query = "UPDATE users set password='" . md5($password) . "' WHERE username='" . $user . "'";
    $result = mysqli_query($con, $query) or die(mysqli_error());
    echo $result;
}

?>

    <div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
      <span class="navbar-toggler-icon leftmenutrigger"></span>
      <a class="navbar-brand" href="#">Zmiana hasła</a>
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
    
        </ul>
        <ul class="navbar-nav ml-md-auto d-md-flex">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-user"></i><?php echo $_SESSION['username']; ?> </a>
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
          <center>
          <h5 class="card-title">&nbsp;Zmień hasło : <b>
            </b></h5>
            <div class="card-body">
                
            <form class="form" method="post" name="login">
                   
                   <label for="password">Nowe hasło :</label><br>
                   <!-- <input type="password" id="password" name="password"> -->
                   <input type="password" id="password" class="login-input" name="password" placeholder="Haslo"/>
      <br>
      <br>
                   <div id="lower">
                   <input type="submit" value="Zmień" name="submit" class="login-button"/>
                       <!-- <input type="submit" value="Login"> -->
</center>
                   </div>
               </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  

  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
 
   
 
    </body>
    
</html>



 