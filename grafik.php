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
         
  <script type="text/javascript">

function SubmitForm(formId) {
 
  var select = document.getElementById('month');
var value = select.options[select.selectedIndex].value;
window.location.href = "grafik.php?miesiac=" + value + "&submit=Zatwierdź";
}
</script>
   
    </head>
    <body>
 


    <div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
      <span class="navbar-toggler-icon leftmenutrigger"></span>
      <a class="navbar-brand" href="#">Grafik</a>
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




          <form method="get" id="grafikmies" action="">

<select onchange="SubmitForm('grafikmies');" name="miesiac" id="month" class="hbulki" id="hbulki">
<?php
$monthNum = date('m');


$dateObj = DateTime::createFromFormat('!m', $monthNum);


$monthName = $dateObj->format('F');

// Display output
echo ' <option value="main" id="main" selected> Wybierz </option>';

$m_pol = array("Styczen", "Luty", "Marzec", "Kwiecien", "Maj", "Czerwiec", "Lipiec", "Sierpien", "Wrzesien", "Pazdziernik", "Listopad", "Grudzien");
$m_en = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$workoutSlug = str_replace($m_en, $m_pol, $monthName);
for ($m = 0; $m <=11; $m++)
{
$m_pol = array("Styczen", "Luty", "Marzec", "Kwiecien", "Maj", "Czerwiec", "Lipiec", "Sierpien", "Wrzesien", "Pazdziernik", "Listopad", "Grudzien");
echo $workoutSlug;
if ($workoutSlug == $m_pol[$m])
{

echo ' <option value="'. $m_pol[$m] . '" id="'. $m_pol[$m] . '">' . $m_pol[$m] . '</option>';

}
else
{
echo ' <option value="'. $m_pol[$m] . '" id="'. $m_pol[$m] . '">' . $m_pol[$m] . '</option>';
}
}
?>
</select>
<input type="submit" style="display: none;" value="Zatwierdź" name="submit" class="login-button"/>

</form>



          <h5 class="card-title">&nbsp;Grafik pracowników na miesiąc : <b>
            <?php if (isset($_GET['miesiac'])) {
            echo $_GET['miesiac']; 
          }
            else {
              echo "Wybierz miesiąc !";
              } 
              
              ?></b></h5>
            <div class="card-body" style="overflow-y: scroll; max-height:320px;">
              


            
              <table class="table" >
                <thead>
                  <tr>
                    <th scope="col">Dzień</th>
                    <?php
                    function getID3($name)
                    {
                      require('config.php');
                      $result = mysqli_query($con,'SELECT id FROM `sklepy` WHERE nr_sklepu="' . $name . '"');
                      while($rows = mysqli_fetch_array($result)) {
                        return $rows[0];
                      }
                    }
                    
                    $result = mysqli_query($con,'SELECT username FROM `users` WHERE sklepy="'. getID3($_SESSION['sklepy']) .'"');

while($rows = mysqli_fetch_array($result)) {
  
  //echo $rows[0] . '</br>';
  echo ' <th scope="col">' . $rows[0] . '</th>';
}
                    ?>
                   
                  </tr>
                </thead>
                <tbody >

<?php
 function getID2($name)
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
    echo "<tr>";
    echo '<th scope="row">' . $x . '</th>';
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
      }   
    }

}



fclose($plik);


}
}
  }
    echo '</tr>';
}






?>
                </tbody>
              </table>
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

