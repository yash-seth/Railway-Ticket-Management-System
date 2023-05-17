<?php

require_once "config.php";
include "sep.php";
$pass="";
$err="";
$asp="12345";
// IF REQUEST METHOD IS POST
if($_SERVER['REQUEST_METHOD']=="POST")
{
  if(empty(trim($_POST['password'])))
  {
    // need to add popups
     $err="password field cannot be left empty!";
     $alert="<script>
                        Swal.fire({
                        title: 'Warning!',
                        text: 'password field cannot be left empty!',
                        icon: 'error',
                        button: 'OK',
                      });
                      </script>";
                echo $alert;
  }
  else{
      //compare the password with the admin security password;
      $pass=trim($_POST['password']);
      if(strcmp($pass,$asp)!=0)
      {
          $err="Password Invalid";
          $alert="<script>
          Swal.fire({
          title: 'Warning!',
          text: 'Password Invalid',
          icon: 'error',
          button: 'OK',
        });
        </script>";
        echo $alert;
          
      }
      else{
          header("location: alogin.php");
      }
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="sample.css">
    <title>ADMIN SECURITY GATEWAY</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ADMIN SECURITY GATEWAY</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">VALIDATION</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="sample.php">BACK</a>
        </li>
      </ul>
    </div>
  </div>
</nav>   

<div class="container">
<img class="bg" src="bg.jpg" alt="RAILWAY RESERVATION SYSTEM">
<br><br><br><br><br>
<h3>PLease Enter the ADMIN SECURITY PASSWORD Here::</h3>
<br>
<form class="validate" action="" method="post"> 
  <div class="col-md-12">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="inputPassword4">
  </div>
  <br>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
    <br>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">VALIDATE</button>
  </div>
</form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>