<?php
//include auth_session.php file on all user panel pages
$bazawo = "";
$bazah = "";
$bazap = "";
include("../auth_session.php");
include("../config.php");
require("../config.php")
?>
<?php

if (isset($_POST['delete'])) {
    if (isset($_POST['sklep']) && isset($_POST['kajzerka']))
    {
        $rodzaj = $_POST['sklep'];
        $item = $_POST['kajzerka'];

        if ($rodzaj == "w")
        {   
            if ($bazawo != "")
            {
              foreach ($bazawo as $key => $value) {
                   array_push($woa, $value);
                                 }
        $key = array_search($item, $woa); // $key = 2;
        unset($woa[$key]);
        file_put_contents('../data/woa.txt',  '<?php $bazawo =  ' . var_export($woa, true) . ';');
            }
         }

         else if ($rodzaj == "p")
         {   
             if ($bazap != "")
             {
               foreach ($bazap as $key => $value) {
                    array_push($pia, $value);
                                  }
         $key = array_search($item, $pia); // $key = 2;
         unset($pia[$key]);
         file_put_contents('../data/pia.txt',  '<?php $bazap =  ' . var_export($pia, true) . ';');
             }
          }

         else if ($rodzaj == "h")
          {   
              if ($bazah != "")
              {
                foreach ($bazah as $key => $value) {
                     array_push($hoa, $value);
                                   }
          $key = array_search($item, $hoa); // $key = 2;
          unset($hoa[$key]);
          file_put_contents('../data/hoa.txt',  '<?php $bazah =  ' . var_export($hoa, true) . ';');
              }
           }

    }
} else if (isset($_POST['send'])) {
    
    if (isset($_POST['sklep']) && isset($_POST['kajzerka']))
    {
        $rodzaj = "";
        $item = $_POST['kajzerka'];
         $select1 = $_POST['sklep'];
         $path = "";
  switch ($select1) {
      case 'w':
        $rodzaj = "w";
        break;
      case 'p':
        $rodzaj = "p";
        break;
        case 'h':
            $rodzaj = "h";
            break;


  }
        if ($rodzaj == "w")
        {   
            if ($bazawo != "")
            {
            foreach ($bazawo as $key => $value) {
                array_push($woa, $value);
            }
        }
            //array_push($woa, $baza);
            array_push($woa, $item);
            file_put_contents('../data/woa.txt',  '<?php $bazawo =  ' . var_export($woa, true) . ';');
        }

        else if ($rodzaj == "h")
        {   
            if ($bazah != "")
            {
            foreach ($bazah as $key => $value) {
                array_push($hoa, $value);
            }
        }
            //array_push($woa, $baza);
            array_push($hoa, $item);
            file_put_contents('../data/hoa.txt',  '<?php $bazah =  ' . var_export($hoa, true) . ';');
        }

       else if ($rodzaj == "p")
        {   
            if ($bazap != "")
            {
            foreach ($bazap as $key => $value) {
                array_push($pia, $value);
            }
        }
            //array_push($woa, $baza);
            array_push($pia, $item);
            file_put_contents('../data/pia.txt',  '<?php $bazap =  ' . var_export($pia, true) . ';');
        }
    }
   

} else {
    //no button pressed
}
      
 


?>


<?php
require('../config.php');


$iskierownik = 0;
$result = mysqli_query($con,'SELECT username FROM `users` WHERE kierownik="1"');

while($rows = mysqli_fetch_array($result)) {
//echo $rows[0];
if ($_SESSION['username'] == $rows[0])
{
  $iskierownik = 1;

}


}
if ($iskierownik)
{
  //echo "<script type='text/javascript'>alert('Kierownik');</script>";
}
else
{
  header("Location: ../dashboard.php");
}
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
        <link rel="stylesheet" href="../css/arkusz.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script defer src="../fa/js/all.js"></script> <!--load all styles -->
        <script src="https://kit.fontawesome.com/6745f8312b.js" crossorigin="anonymous"></script>
    </head>
    <body>
 


    <div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
      <span class="navbar-toggler-icon leftmenutrigger"></span>
      <a class="navbar-brand" href="#">Panel Kierownika</a>
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
            <a class="nav-link" href="dashboard.php" title="Cart"><i class="fas fa-user-tie"></i>Kierownik <i class="fas fa-user-tie shortmenu"></i></a>
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
 <a href="dashboard.php">Wróć</a>
</center>
<br>
<br>
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
             
            <center>
            <div id="panel">
                <form class="form" method="post" name="hotdog" action="#">
                <label for="non">Użytkownik :  <?php echo $_SESSION['username']; echo str_repeat('&nbsp;', 5) . "Data :  " . str_repeat('&nbsp;', 2)  . date('d.m.Y H:i'); ?></label>
</br>
                <label for="sklep">Rodzaj:</label>

                <select name="sklep" class="hbulki" id="hbulki">  
                    
                <option value="p" class="hbulki" id="hbulki"> Pieczywo </option>;
                <option value="h" class="hbulki" id="hbulki"> Żabka Cafe </option>;
                <option value="w" class="hbulki" id="hbulki"> Warzywa/Owoce </option>;
</select>     
<label for="kajzerka">Nazwa:</label>
                    <input type="text" class="hbulki" id="hbulki" name="kajzerka" autofocus="true"/>
                    <div id="lower">
                    <input type="submit" value="Wyślij" name="send" class="login-button"/>
                    <input type="submit" value="Usun" name="delete" class="login-button">
                    </div>
</form>
</center>

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

 