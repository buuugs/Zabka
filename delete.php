<?php
$name = $_GET['name'];
unlink($name);
header("Location: straty.php");
?>