<?php

include "config.php";

session_start();

$ids=$_SESSION['id'];

$sql="SELECT * FROM users WHERE id={$ids}";

$showdata=mysqli_query($conn,$sql);

$arr_data = mysqli_fetch_array($showdata);

$status="";
if($_SERVER['REQUEST_METHOD']=="POST")
{  
    $id = $_SESSION['id'];
    $username=$_POST['username'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $mobile_no=$_POST['mobile_no'];
    $email=$_POST['email'];

    $query="UPDATE users set username='$username',dob='$dob',gender='$gender',
            mobile_no='$mobile_no',email='$email'
            WHERE id=$id";
    $res= mysqli_query($conn,$query);

    if($res){
        ?>
        <script>
                alert("profile updated properly"); 
        </script>
        <?php 
        header('location:welcome.php');
    }
    else
    {  
        ?>
        <script>
                alert("profile not updated properly");
        </script>
        <?php
        
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
    <title> USER PROFILE PAGE</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MANAGE PROFILE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">UPDATE PROFILE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">DELETE PROFILE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">LOGOUT</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
      
    <img class="bg" src="bg3.jpg" alt="RAILWAY RESERVATION SYSTEM">
    <div class="container">
      
      <br><br><br><br><br>
      <h3>PLease UPDATE PROFILE Here::</h3>
      <br>
      <form class="register" action="" method="post">
      <div class="col-md-12">
        <label for="inputusername" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $arr_data['username'];?>" id="inputusername" placeholder="Enter the username">
      </div>
      <div class="col-md-12">
        <label for="inputage" class="form-label">DOB</label>
        <input type="date" name="dob" class="form-control" value="<?php echo $arr_data['dob'];?>" id="inputage" placeholder="Enter the DOB">
      </div>
      <div class="col-md-12">
        <label for="inputgender" class="form-label">Gender</label>
        <input type="text" name="gender" class="form-control" value="<?php echo $arr_data['gender'];?>" id="inputgender" placeholder="Enter the gender">
      </div>
      <div class="col-md-12">
        <label for="inputmobileno" class="form-label">Mobile No.:</label>
        <input type="text" name="mobile_no" class="form-control" value="<?php echo $arr_data['mobile_no'];?>" id="inputmobileno" placeholder="Enter your Mobile number">
      </div>
      <div class="col-md-12">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo $arr_data['email'];?>" id="inputEmail4" placeholder="Enter your email">
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
      <button type="submit" class="btn btn-primary">UPDATE</button>
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