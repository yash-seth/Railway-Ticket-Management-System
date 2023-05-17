<?php
// this script will handle login

session_start();

//check if the user is already logged in
if(isset($_SESSION['admin_name']))
{
  header("location: awelcome.php");
  exit;
}
require_once "config.php";
$admin_name = $password = "";
$err = "";

// IF REQUEST METHOD IS POST
if($_SERVER['REQUEST_METHOD']=="POST")
{
  if(empty(trim($_POST['admin_name']))||empty(trim($_POST['password'])))
  {
    // need to add popups
     $err="Admin name or password field cannot be left empty!";
     $alert="<script>
                        Swal.fire({
                        title: 'Warning!',
                        text: 'Admin name or password field cannot be left empty!',
                        icon: 'error',
                        button: 'OK',
                      });
                      </script>";
                echo $alert;
  }
  else
  {
    $admin_name=trim($_POST['admin_name']);
    $password=trim($_POST['password']);
  }
  if(empty($err))
  { 
    $sql="SELECT id, admin_name,password FROM admins WHERE admin_name=?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$param_admin_name);

    $param_admin_name = $admin_name;

    //try to execute this statement

    if(mysqli_stmt_execute($stmt))
    {
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt)==1)
      {
          mysqli_stmt_bind_result($stmt,$id,$admin_name,$hashed_password);
          if(mysqli_stmt_fetch($stmt))
          {   
              if(password_verify($password,$hashed_password))
              {
                // this means the password is correct allow user to login
                session_start();
                $_SESSION["admin_name"]= $admin_name;
                $_SESSION["id"]= $id;
                $_SESSION["loggedin"] = true;

                //redirect user to welcome page
                header("location: awelcome.php");


              }
          }
      }
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
    <title>ADMIN PORTAL</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ADMIN PORTAL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">LOGIN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aregister.php">REGISTER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">LOGOUT</a>
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
    <label for="inputusername" class="form-label">Admin name</label>
    <input type="text" name="admin_name" class="form-control" id="inputusername">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>