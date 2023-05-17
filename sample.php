<?php
// this script will handle login

session_start();
include "sep.php";

//check if the user is already logged in
if(isset($_SESSION['username']))
{
  header("location: welcome.php");
  exit;
}
require_once "config.php";
$username = $password = "";
$err = "";
// IF REQUEST METHOD IS POST
if($_SERVER['REQUEST_METHOD']=="POST")
{
  if(empty(trim($_POST['username']))||empty(trim($_POST['password'])))
  {
    // need to add popups
    $alert="<script>
    Swal.fire({
      title: 'Warning!',
      text: 'Username or password field cannot be left empty!',
      icon: 'error',
      button: 'OK',
    });
    </script>";
    echo $alert;
     
  }
  else
  {
    $username=trim($_POST['username']);
    $password=trim($_POST['password']);
  }
  if(empty($err))
  { 
    $sql="SELECT id, username,password FROM users WHERE username=?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$param_username);

    $param_username = $username;

    //try to execute this statement

    if(mysqli_stmt_execute($stmt))
    {
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt)==1)
      {
          mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password);
          if(mysqli_stmt_fetch($stmt))
          {   
              if(password_verify($password,$hashed_password))
              {
                // this means the password is correct allow user to login

                $_SESSION["username"]= $username;
                $_SESSION["id"]= $id;
                $_SESSION["loggedin"] = true;

                //redirect user to welcome page
                header("location: welcome.php");
                
                
                


              }
          }
      }
    }
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="sample.css">
    
    <title>RAILWAY RESERVATION SYSTEM</title>
  </head>

  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">RAILWAY RESERVATION SYSTEM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">ABOUT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">REGISTER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="asecure.php">ADMIN</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
<img class="bg" src="bg.jpg" alt="RAILWAY RESERVATION SYSTEM">
<br><br><br><br><br>
<h3>PLease Login Here::</h3>
<br>
<form class="login" action="" method="post"> 
  <div class="col-md-12">
    <label for="inputEmail4" class="form-label">Username</label>
    <input type="text" name="username" class="form-control" id="inputEmail4">
  </div>
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
    <button type="submit" class="btn btn-primary">Log in</button>
  </div>
</form>
</div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>
