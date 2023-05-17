<?php

include "config.php";

session_start();

$id=$_SESSION['id'];

$delete="DELETE FROM users WHERE id=$id";

$query=mysqli_query($conn,$delete);

if($query)
{   
    header('location:logout.php');
}

?>