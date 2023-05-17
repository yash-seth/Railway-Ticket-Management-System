// this page scripts the logout page of the website
<?php

session_start();
$_SESSION=array();
session_destroy();
header("location: sample.php");


?>