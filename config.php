<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    
   $con = mysqli_connect("localhost","root","","zabka");
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $woa = array();
   include 'data/woa.txt';
    $pia = array();
    include 'data/pia.txt';
    $hoa = array();
   include 'data/hoa.txt';
    // Check connection

?>