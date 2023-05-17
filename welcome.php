<?php

session_start();
include "sep.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{  
    header("location: sample.php");
}
else
{ 
  
  $alert="<script>
  Swal.fire({
  title: 'Good Job!',
  text: 'LoggedIn successfully!',
  icon: 'success',
  button: 'OK',
  });
  </script>";
  echo $alert;
  
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Welcome Page</title>
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
          <a class="nav-link" aria-current="page" href="booktrain.php">SEARCH TRAINS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">ABOUT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dticket.php">VIEW TICKET</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">LOGOUT</a>
        </li>
      </ul>
    </div>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav ml">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome ". $_SESSION['username']?></a>
      <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="updatepro.php">UPDATE PROFILE</a></li>
            <li><a class="dropdown-item" href="delpro.php">DELETE ACCOUNT</a></li>
      </ul>
      </li>
      </ul>
  </div>  
  </div>
</nav>

    <div class="container">
      <br><br><br><br><br>
      <h3>Welcome <?php echo $_SESSION['username']?> ! Login Successful !</h3>
      <br>
      <ol class="list-group list-group-numbered">
        <li class="list-group-item">UPDATE PROFILE</li>
        <li class="list-group-item">DELETE ACCOUNT</li>
        <li class="list-group-item">SEARCH FOR TRAINS</li>
        <li class="list-group-item">BOOK TICKETS</li>
        <li class="list-group-item">CANCEL TICKET</li>
      </ol>
      <br>
      <h3>You can access all the above mentioned functionalities in the navbar at the top!</h3>
      
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
