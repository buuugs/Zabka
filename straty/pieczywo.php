<?php
require('../config.php');
include("../config.php");
include("../auth_session.php");
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
        <link rel="stylesheet" href="../css/css.css"/>
        <script defer src="../fa/js/all.js"></script> <!--load all styles -->
        <link href="../css/arkusz.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

        <script src="https://kit.fontawesome.com/6745f8312b.js" crossorigin="anonymous"></script>
        <style>
a:link{
  text-decoration: none!important;
  cursor: pointer;
}
</style>
    </head>
    <body>
    <?php
if (isset($_POST['sklep']))
{
$txt = "";
  foreach ($_POST as $key => $value) {
      if ($value == "")
      {
          continue;
      }
      if ($key != "sklep" && $key != "submit")
      {
          
   $txt = $txt . PHP_EOL . htmlspecialchars($key).": ".htmlspecialchars($value) . PHP_EOL;
      }
  }
  $select1 = $_POST['sklep'];
  $path = "";
  switch ($select1) {
   case $select1:
       $path = ("magazyn/". $select1 . "/" . "pieczywo/");
       break;
   case '':
    $path = "";
       break;
}
if (!file_exists($path)) {
mkdir($path, 0777, true);
}

   $uchwyt = fopen($path . date('d-m-Y') . '.txt', "a");
$zawartosc = (PHP_EOL . "Dodane przez : " . $_SESSION['username'] . " o godzinie ".  date('H:i:s') . PHP_EOL . PHP_EOL . $txt . PHP_EOL . "---------------------------------------------------------------------------" . PHP_EOL . "");

$key = "%^ZABKA-ROGI-AG1245%";
function fnEncrypt($sValue, $sSecretKey)
{
    return rtrim(
        base64_encode(
            mcrypt_encrypt(
                MCRYPT_RIJNDAEL_256,
                $sSecretKey, $sValue, 
                MCRYPT_MODE_ECB, 
                mcrypt_create_iv(
                    mcrypt_get_iv_size(
                        MCRYPT_RIJNDAEL_256, 
                        MCRYPT_MODE_ECB
                    ), 
                    MCRYPT_RAND)
                )
            ), "\0"
        );
}
  

$zaw = fnEncrypt($zawartosc, $key);
if (fwrite($uchwyt, $zaw))
{
    echo '<script>alert("[System]: Dodano starty prawidłowo.")</script>';
}
else{
    echo '<script>alert("[System]: Wystąpił błąd. Spróbuj ponownie.")</script>';
}
}


  ?>


    <div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
      <span class="navbar-toggler-icon leftmenutrigger"></span>
      <a class="navbar-brand" href="#">Straty</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav animate side-nav">
          <li class="nav-item dropdown">
        <a class="nav-link" href="../dashboard.php" title="Admin">
          <i class="fas fa-user"></i>Pracownik <i class="fas fa-user shortmenu animate"></i>
        </a>

      </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/dashboard.php" title="Cart"><i class="fas fa-user-tie"></i>Kierownik <i class="fas fa-user-tie shortmenu"></i></a>
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
            <a class="nav-link" href="../logout.php"><i class="fas fa-key"></i>Wyloguj</a>
          </li>
        </ul>
      </div>
    </nav>
    <center>
 <a href="#"><img src="../img/logo.png" width="250px"></a>
 <br>
 <br>
 <a href="index.php">Wróć</a>
</center>
<br>
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
           
                <center>
              <h5 class="card-title">Pieczywo</h5>
              <h6 class="card-subtitle mb-2 text-muted"></p>
              
              <!-- <div id="panel"> -->
              <form method="post" action="#">
        <label for="non">Użytkownik :  <?php echo $_SESSION['username']; ?> </br> <?php echo "Data : " . date('d.m.Y H:i'); ?></label>
</br>
        <label for="sklep">Sklep:</label>
        <select name="sklep" class="hbulki" id="hbulki">
        <?php
        
          $result1 = mysqli_query($con,'SELECT id, sklepy FROM `users` WHERE username="'. $_SESSION['username']  .'"');
          while($rows = mysqli_fetch_array($result1)) {
              $id = $rows[0];
              $mark=explode(',', $rows['sklepy']);
              
              foreach($mark as $out) {
                  $sklepy = $out;
                 
                  $result = mysqli_query($con,'SELECT nr_sklepu FROM `sklepy` WHERE id='. $sklepy);
                  while($rows1 = mysqli_fetch_array($result)) {
          
                      $mark1=explode(',', $rows1['nr_sklepu']);
                      
                      foreach($mark1 as $out1) {
                         
                          if (strlen($out1) > 5)
                          {
                             echo ' <option value="'.$out1. '" id="'. $out1 .'">' . $out1 . '</option>';
                          }
                }
              }
            } 
          }
          ?>
        </select>
        <?php
       
          foreach($bazap as $item)
          {
             echo '<label for="'. $item .'">'. $item  . ':</label>';
             echo '<input type="number" class="hbulki" id="hbulki" name="'.$item.'" placeholder="0" autofocus="true"/>';
          }
          ?>
        
          <input type="submit" value="Wyślij" name="submit" class="login-button"/>
       
      </form>
</center>
        <!-- </div> -->
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


 