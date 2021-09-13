<?php
require('config.php');


session_start();
    if (isset($_POST['username'])) {
		$_SESSION['sklepy'] = $_POST['sklep'];
		function getID($name)
		{
			require('config.php');
			$result = mysqli_query($con,'SELECT id FROM `sklepy` WHERE nr_sklepu="' . $name . '"');
			while($rows = mysqli_fetch_array($result)) {
				return $rows[0];
			}
		}
			function iskierownik($name)
		{
			require('config.php');
			$result = mysqli_query($con,'SELECT kierownik FROM `users` WHERE username="' . $name . '"');
			while($rows = mysqli_fetch_array($result)) {
				return $rows[0];
			}
		}
	
		

        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);



       
        
        $result1 = mysqli_query($con,'SELECT id, sklepy FROM `users` WHERE username="'. $username  .'"');
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
                           //echo  $out1 . '</br>';
                        }
              }
            }
          } 
        }
       


		$result = mysqli_query($con,'SELECT sklepy FROM `users` WHERE username="'. $username. '"');
		$canlogin = 0;
        $founded = 0;
				while($rows = mysqli_fetch_array($result)) {
                    $mark2=explode(',', $rows['sklepy']);
                   

                    $string = getID($_POST['sklep']);
                   
foreach ($mark2 as $foundedid) {
   if ($foundedid == $string)
   {
       $founded = 1;
   }

}

		}
        if($founded == 1)
        {
           $canlogin = 1;
        }
				if ($canlogin == 1)
				{
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        
        if ($rows == 1) {
            $_SESSION['username'] = $username;
			
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Błędne hasło !</h3><br/>
                 
                  </div>";
        }
    } else {
		$message = "Nie możesz zalogować się do tego sklepu !";
echo "<script type='text/javascript'>alert('$message');</script>";
	}
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/arkusz.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="https://michalikzabka.000webhostapp.com/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="https://michalikzabka.000webhostapp.com/favicon.ico"/>
    <link rel="manifest" href="manifest.json">
    <title>Żabka - Straty</title>

</head>
<body>
    <div class="center">

<center>
 <img src="img/logo.png" width="250px">
</center>
<br />
<center>
            <div id="panel">
                <form class="form" method="post" name="login">
                <br><br>
                    <label for="username">Nazwa użytkownika:</label>
                    <br><br>
                    <input type="text" class="hbulki" id="hbulki" name="username" placeholder="Login" autofocus="true"/>
                    <!-- <input type="text" id="username" name="username"> --><br>
                    <label for="password">Hasło:</label><br><br>
                    <!-- <input type="password" id="password" name="password"> -->
                    <input type="password" id="hbulki" class="hbulki" name="password" placeholder="Haslo"/></br>
					<select name="sklep" id="hbulki" class="hbulki">
          <?php
          require('config.php');
        

         
           
            $result = mysqli_query($con,'SELECT nr_sklepu FROM `sklepy`');
            while($rows1 = mysqli_fetch_array($result)) {
    
                $mark1=explode(',', $rows1['nr_sklepu']);
                
                foreach($mark1 as $out1) {
                   
                    if (strlen($out1) > 5)
                    {
                       echo ' <option value="'.$out1. '" id="'. $out1 .'">' . $out1 . '</option>';
                    }
          }
        }
      
            ?> 
            </select>
                    <div id="lower">
                    <input type="submit" value="Login" name="submit" class="login-button"/>
                        <!-- <input type="submit" value="Login"> -->
                    </div>
                </form>
            </div>
</div>
    </div>
</center>
    <script type="text/javascript">

// if (screen.width <= 699) {
// document.location = "mobile/";
// }

</script>
</body>

</html>