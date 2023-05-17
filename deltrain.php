<?php
include "config.php";

$tno=$_GET['train_no'];

$delete = "DELETE FROM trains WHERE train_no=$tno";

$query=mysqli_query($conn,$delete);
if($query)
{ 
    header('location:disptrain.php');
}
?>