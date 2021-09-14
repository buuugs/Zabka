<?php
require('../config.php');
include("../auth_session.php");

$iskierownik = 0;
$result = mysqli_query($con,'SELECT username FROM `users` WHERE kierownik="1"');

while($rows = mysqli_fetch_array($result)) {

if ($_SESSION['username'] == $rows[0])
{
  $iskierownik = 1;

}


}
if ($iskierownik)
{
  
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
    </head>
    <body>
 
<?php
    if (isset($_POST['submit1']))
{
$txt = "";
  foreach ($_POST as $key => $value) {
      if ($value == "")
      {
          continue;
      }
      if ($key != "submit" && $key != "miesiac" )
      {
        
   $txt = $txt . PHP_EOL . htmlspecialchars($key). ":" .htmlspecialchars($value) . "\n";
      }
  }
  $select1 = "CO";


  $monthNum = date('m');
  
  // Create date object to store the DateTime format
  $dateObj = DateTime::createFromFormat('!m', $monthNum);
    
  // Store the month name to variable
  $monthName = $dateObj->format('F');
    
  // Display output
  
  
    
  $m_en = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  
  $m_pol = array("Styczen", "Luty", "Marzec", "Kwiecien", "Maj", "Czerwiec", "Lipiec", "Sierpien", "Wrzesien", "Pazdziernik", "Listopad", "Grudzien");




  
  $path = "";
  switch ($select1) {
   case $select1:
       $path = ("magazyn/". $_SESSION['sklepy'] . "/" . "grafik/");
       break;
   case '':
    $path = "";
       break;
}
if (!file_exists($path)) {
mkdir($path, 0777, true);
}
$select2 = $_POST['miesiac'];
   $uchwyt = fopen($path . $select2 . '.txt', "a");
   $uchwyt2 = ($path . $select2 . '.txt');
$zawartosc = ($txt . PHP_EOL);


if (fwrite($uchwyt, $zawartosc))
{
    echo '<script>alert("[System]: Dodano grafik prawidłowo.")</script>';
}
else{
    echo '<script>alert("[System]: Wystąpił błąd. Spróbuj ponownie.")</script>';
}
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
              <h5 class="card-title">Ustalanie grafiku na miesiąc : ( <?php
              echo $_SESSION['sklepy'] . ")";
              ?>
              </h5>
              <form method="post" action="#">
        

</form>
              <h6 class="card-subtitle mb-2 text-muted"></p>
              <table class="table" >
                <thead>
                  <tr>
                    <th scope="col">Dzień</th>
                    <?php
                   

                    function getID($name)
                    {
                      require('../config.php');
                      $result = mysqli_query($con,'SELECT id FROM `sklepy` WHERE nr_sklepu="' . $name . '"');
                      while($rows = mysqli_fetch_array($result)) {
                        return $rows[0];
                      }
                    }

                    $result = mysqli_query($con,'SELECT username FROM `users` WHERE sklepy="'. getID($_SESSION['sklepy']) .'"');

while($rows = mysqli_fetch_array($result)) {
 
 // echo $rows[0] . '</br>';
  echo ' <th scope="col">' . $rows[0] . '</th>';
}
                    ?>
                   
                  </tr>
                </thead>
                <tbody >
                <form method="post" action="#">

                <select name="miesiac" class="hbulki" id="hbulki">
          <?php
            $monthNum = date('m');
  
            // Create date object to store the DateTime format
            $dateObj = DateTime::createFromFormat('!m', $monthNum);
              
            // Store the month name to variable
            $monthName = $dateObj->format('F');
              
            // Display output
            
            
            $m_pol = array("Styczen", "Luty", "Marzec", "Kwiecien", "Maj", "Czerwiec", "Lipiec", "Sierpien", "Wrzesien", "Pazdziernik", "Listopad", "Grudzien");
            $m_en = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $workoutSlug = str_replace($m_en, $m_pol, $monthName);
  for ($m = 0; $m <=11; $m++)
  {
  $m_pol = array("Styczen", "Luty", "Marzec", "Kwiecien", "Maj", "Czerwiec", "Lipiec", "Sierpien", "Wrzesien", "Pazdziernik", "Listopad", "Grudzien");
  echo $workoutSlug;
  if ($workoutSlug == $m_pol[$m])
  {
    
  echo ' <option value="'. $m_pol[$m] . '" id="'. $m_pol[$m] .'" selected>' . $m_pol[$m] . '</option>';
 
  }
  else
  {
    echo ' <option value="'. $m_pol[$m] . '" id="'. $m_pol[$m] .'">' . $m_pol[$m] . '</option>';
  }
  }
          ?>
          </select>
<?php


function getID2($name)
{
  require('../config.php');
  $result = mysqli_query($con,'SELECT id FROM `sklepy` WHERE nr_sklepu="' . $name . '"');
  while($rows = mysqli_fetch_array($result)) {
    return $rows[0];
  }
}

for ($x = 1; $x <= date('t'); $x++) {
    echo "<tr>";
    echo '<th scope="row">'. $x .'</th>';
 

   $result = mysqli_query($con,'SELECT username FROM `users` WHERE sklepy="'. getID2($_SESSION['sklepy']) .'"');
    
    while($rows = mysqli_fetch_array($result)) {
      
       
        echo '<td><input type="text" id="zmiana" class="login-input" name="'. $rows[0] . '_' . $x . '"placeholder="X" maxlength="2" /> </td>';
      }
   
    
    echo '</tr>';
}
?>


<?php
 if (isset($_POST['sumbit2'])) {
 
 function getID3($name)
 {
   require('config.php');
   $result = mysqli_query($con,'SELECT id FROM `sklepy` WHERE nr_sklepu="' . $name . '"');
   while($rows = mysqli_fetch_array($result)) {
     return $rows[0];
   }
  }

$result = mysqli_query($con,'SELECT username FROM `users` WHERE sklepy="'. $_SESSION['sklepy'] .'"');


if (isset($_GET['miesiac'])) {
  
  $file = 'admin/magazyn/' . $_SESSION['sklepy'] . '/' . 'grafik/' . $_GET['miesiac'] . '.txt';

 
  if(!file_exists($file))
  {
    echo "<b>Grafik na ten miesiąc nie został jeszcze ułożony !</b>";
  }
  else{
    $plik = file('admin/magazyn/' . $_SESSION['sklepy'] . '/' . 'grafik/' . $_GET['miesiac'] . '.txt');
  }

        }

  

$monthNum = date('m');
$daynum = date('t');
  
$dateObj = DateTime::createFromFormat('!m', $monthNum);

$dateObjm = DateTime::createFromFormat('!t', $daynum);



$monthName = $dateObj->format('F');
$daycount = $dateObjm;


$m_en = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$m_pol = array("Styczen", "Luty", "Marzec", "Kwiecien", "Maj", "Czerwiec", "Lipiec", "Sierpien", "Wrzesien", "Pazdziernik", "Listopad", "Grudzien");
$workoutSlug = str_replace($m_en, $m_pol, $monthName);
if (isset($_GET['miesiac'])) {
 
}

function strpos_recursive($haystack, $needle, $offset = 0, &$results = array()) {               
  $offset = strpos($haystack, $needle, $offset);
  if($offset === false) {
      return $results;           
  } else {
      $results[] = $offset;
      return strpos_recursive($haystack, $needle, ($offset + 1), $results);
  }
}

function getID4($name)
{
  require('config.php');
  $result = mysqli_query($con,'SELECT id FROM `sklepy` WHERE nr_sklepu="' . $name . '"');
  while($rows = mysqli_fetch_array($result)) {
    return $rows[0];
  }
}
for ($x = 1; $x <= date('t'); $x++) {
 
  while($rows = mysqli_fetch_array($result)) {
  
  }
   
    $result = mysqli_query($con,'SELECT username FROM `users` WHERE sklepy="' . getID4($_SESSION['sklepy']) . '"');
   
    while($rows = mysqli_fetch_array($result)) {
    

      if (isset($_GET['miesiac'])) {
    
       
$file = 'admin/magazyn/' . $_SESSION['sklepy'] . '/' . 'grafik/' . $_GET['miesiac'] . '.txt';
if(file_exists($file))
{
$plik = fopen($file, "r") or exit("Blad!");
}


$searchfor = $rows[0] . '_' . $x;

if (file_exists($file)) {
 
$zawartosc = "";
  while(!feof($plik))
{
   $linia = fgets($plik);
   $zawartosc .= $linia;
}

  
 
$contents = $zawartosc;

$czy = strpos($contents,  $rows[0] . '_' . $x);

  $searchfor = $rows[0] . '_' . $x;
  
  $contents = file_get_contents($file);
  
  $pattern = preg_quote($searchfor, '/');
  
  $pattern = "/^.*$pattern.*\$/m";
 
 
  $string = $contents;
  $search = $rows[0] . '_' . $x . ":";
  $found = strpos_recursive($string, $search);
  
  if($found) {
      foreach($found as $pos) {
         
          if (substr($string, $pos, (strlen($search) -1 )) == $rows[0] . '_' . $x)
          {
              $magic = substr($string, $pos, (strlen($search) +2 ));
            $position =strpos($magic , ':');
          echo '<td class="'. $rows[0] . '_' . $x . '">' . (substr($magic, $position +1)) . '</td>';
          echo '<td><input type="text" id="zmiana" class="login-input" name="'. $rows[0] . '_' . $x . '"placeholder="X" maxlength="2" /> </td>';
      }   
    }

}



fclose($plik);


}
}
  }
   
}




 }

?>







<input type="submit" value="Zatwierdź" name="submit" id="submit1" class="login-button"/>
<input type="submit" value="Pobierz" name="submit" id="submit2" class="login-button"/>
<input type="submit" value="Usuń" name="submit" id="submit3" class="login-button"/>
</form>
                </tbody>
              </table>
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


 