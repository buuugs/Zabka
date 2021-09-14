<?php
require('../config.php');
include("../auth_session.php");

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script defer src="../fa/js/all.js"></script> <!--load all styles -->
        <script src="https://kit.fontawesome.com/6745f8312b.js" crossorigin="anonymous"></script>

        <style>
.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 50%;
  border: none;
  text-align: center;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 18px;
  display: none;
  width: 50%;
  overflow: hidden;
  background-color: #f1f1f1;
}
</style>

    </head>
    <body>
 <?php
  require('../config.php');
$result = mysqli_query($con,'SELECT username FROM `users`');

while($rows = mysqli_fetch_array($result)) {

    if (isset($_POST[$rows[0]]))
    {
        $sql = "DELETE FROM `users` WHERE `users`.`username` = '" .$rows[0]. "'";
        echo $sql;
        if ($con->query($sql) === TRUE) {
            echo "Record deleted successfully";
          } else {
            echo "Error deleting record: " . $con->error;
          }

    }
}
 ?>
    <?php



  // When form submitted, insert values into the database.
  $sklepy = "";
  $kierownikk = "";
  $sklepydobazy = "";
  if (isset($_REQUEST['username'])) {
      require('../config.php');
      if( isset($_REQUEST['skleps']) && is_array($_REQUEST['skleps']) ) {

          $cbCount = count($_REQUEST['skleps']);
          
           foreach($_REQUEST['skleps'] as $skleps) {

            echo "<script type='text/javascript'>alert('$skleps');</script>";
            $test =  'SELECT id FROM `sklepy` WHERE nr_sklepu="'.$skleps.'"';
            echo $test;
              $qe = mysqli_query($con, 'SELECT id FROM `sklepy` WHERE nr_sklepu="'.$skleps.'"');
              while($mem = mysqli_fetch_array($qe)) {

                echo "<script type='text/javascript'>alert('$mem[0]');</script>";
                
                  $sklepydobazy = $sklepydobazy . $mem[0]. ",";
               

                 }
                // echo "FIRST - " . $sklepydobazy;

           }
     // echo '<br /> ' . $sklepy;
          
    
         
       }
       else{
           echo 'Błąd';
       }
       $sklepydobazy = substr(trim($sklepydobazy), 0, -1);
       
      // removes backslashes
     // $sklepydobazy = mysqli_real_escape_string($con, $sklepydobazy);
     if (isset($_REQUEST['meme']))
     {
     $kierownikk = stripslashes($_REQUEST['meme']);
     if ($kierownikk == "yes")
     {
      $kierownikk = 1;
     }
  }
     else{
$kierownikk = 0;
     }
      $username = stripslashes($_REQUEST['username']);
      //escapes special characters in a string
      $username = mysqli_real_escape_string($con, $username);
      // $email    = stripslashes($_REQUEST['email']);
      // $email    = mysqli_real_escape_string($con, $email);
      $password = stripslashes($_REQUEST['password']);
      $password = mysqli_real_escape_string($con, $password);
      $create_datetime = date("Y-m-d H:i:s");
     // echo " <br/ > SECOND - " . $sklepydobazy;
      $query    = "INSERT into `users` (username, password, sklepy, create_datetime, kierownik) VALUES ('$username', '" . md5($password) . "', '$sklepydobazy', '$create_datetime', '$kierownikk')";
      
      $result = mysqli_query($con, $query);


      if ($result) {

  


        
          echo "<div class='form'>
                <h3>Zarejestrowano !</h3><br/>
                
                </div>";
      } else {
         
          echo "<div class='form'>
                <h3>Brakujące Pola</h3><br/>
                
                </div>";
      }
  } else {
  }



?>

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
            <button type="button" class="collapsible">Rejestracja Pracownika</button>
<div class="content">
            <form class="form" action="" method="post">
      <center>  <h1 class="login-title">Rejestracja Pracownika</h1> </center>
        <input type="text" class="username" id="username" name="username" placeholder="Nazwa pracownika" required />
</br><input type="password" id="password" class="password" name="password" placeholder="haslo"><br>
        <p> Obsługa sklepu : </p>
          <?php
          require('../config.php');
        
            function getID($name)
            {
                require('../config.php');
                $result = mysqli_query($con,'SELECT id FROM `users` WHERE username="' . $name . '"');
                while($rows = mysqli_fetch_array($result)) {
                    return $rows[0];
                }
            }
        
            $kierownik = 1;
               
            if($kierownik > 0)
            {
         $result = mysqli_query($con,'SELECT nr_sklepu FROM `sklepy`');

        while($rows = mysqli_fetch_array($result)) {
            
         $mark=explode(',', $rows['nr_sklepu']);
         
         foreach($mark as $out) {
            
          echo ' <input type="checkbox" class="hbulki" name="skleps[]" id="'. $out .'" value="' . $out . '">' . $out . '</input><br />';

            }
        }
    }
   
            ?> 
            <br />
            
          <div id="lower">
        <input type="submit" name="submit" value="Zarejestruj" class="login-button">
</div>
    </form>
</div>
</br>
</br>
    <button type="button" class="collapsible">Zarejestrowani Pracownicy</button>
<div class="content">
    <br>
    <form class="form" action="" method="post">
<?php
require('../config.php');

        $result = mysqli_query($con,'SELECT username FROM `users`');

        while($rows = mysqli_fetch_array($result)) {

        
            echo '' . $rows[0] . ' <input type="submit" value="Usuń" name="'. $rows[0] .'" class="login-button"/> <a href="zarzadzanie.php?pracownik=' . $rows[0] . '"> Edytuj </a></br></br>';
        
    }
    
        ?>
        </form>
</div>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
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
