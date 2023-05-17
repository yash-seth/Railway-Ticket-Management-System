<?php

include "config.php";

$tno=$_GET['train_no'];

$sql="SELECT * FROM trains WHERE train_no={$tno}";

$showdata=mysqli_query($conn,$sql);

$arr_data = mysqli_fetch_array($showdata);

$status="";
if($_SERVER['REQUEST_METHOD']=="POST")
{  
    $tn = $_GET['train_no'];
    $train_name=$_POST['train_name'];
    $source=$_POST['source'];
    $destination=$_POST['destination'];
    $arr_time=$_POST['arr_time'];
    $dep_time=$_POST['dep_time'];
    $distance=$_POST['distance'];
    $no_of_seats=$_POST['no_of_seats'];
    $avlbl_seats=$_POST['avlbl_seats'];
 
    $query="UPDATE trains set train_name='$train_name',source='$source',destination='$destination',
            arr_time='$arr_time',dep_time='$dep_time',distance=$distance,no_of_seats=$no_of_seats,avlbl_seats=$avlbl_seats
            WHERE train_no=$tn";
    $res= mysqli_query($conn,$query);

    if($res){
        ?>
        <script>
                alert("data updated properly"); 
        </script>
        <?php 
    }
    else
    {  
        ?>
        <script>
                alert("data not updated properly");
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
    <title>UPDATE TRAINS</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ADMIN MANAGEMENT SYSTEM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">UPDATE TRAINS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addtrain.php">ADD TRAINS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display.php">BACK</a>
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
      <h3>PLease Modify details Here::</h3>
      <br>
      <form class="register" action="" method="post">
      <div class="col-md-12">
        <label for="inputusername" class="form-label">TRAIN_NAME</label>
        <input type="text" name="train_name" class="form-control" value="<?php echo $arr_data['train_name'];?>" id="inputusername" placeholder="Enter the Train name">
      </div>
      <div class="col-md-12">
        <label for="inputage" class="form-label">SOURCE</label>
        <input type="text" name="source" class="form-control" value="<?php echo $arr_data['source'];?>" id="inputage" placeholder="Enter the Source">
      </div>
      <div class="col-md-12">
        <label for="inputgender" class="form-label">DESTINATION</label>
        <input type="text" name="destination" class="form-control" value="<?php echo $arr_data['destination'];?>" id="inputgender" placeholder="Enter the Destination">
      </div>
      <div class="col-md-12">
        <label for="inputmobileno" class="form-label">ARRIVAL TIME</label>
        <input type="time" name="arr_time" class="form-control" value="<?php echo $arr_data['arr_time'];?>" id="inputmobileno" placeholder="Enter your Arrival Time">
      </div>
      <div class="col-md-12">
        <label for="inputdeptime" class="form-label">DEPARTURE TIME</label>
        <input type="time" name="dep_time" class="form-control" value="<?php echo $arr_data['dep_time'];?>" id="inputdeptime" placeholder="Enter your Departure Time">
      </div>
      <div class="col-md-12">
        <label for="inputdist" class="form-label">DISTANCE</label>
        <input type="int" name="distance" class="form-control" value="<?php echo $arr_data['distance'];?>" id="inputdist" placeholder="Enter the Distance">
      </div>
      <div class="col-md-12">
        <label for="inputseat" class="form-label">NO_OF_SEATS</label>
        <input type="int" name="no_of_seats" class="form-control" value="<?php echo $arr_data['no_of_seats'];?>" id="inputseat" placeholder="Enter the number of seats">
      </div>
      <div class="col-md-12">
        <label for="inputPassword4" class="form-label">AVAILABLE_SEATS</label>
        <input type="int" name="avlbl_seats" class="form-control" value="<?php echo $arr_data['avlbl_seats'];?>" id="inputPassword4" placeholder="Enter the Available seats">
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
      <button type="submit" class="btn btn-primary">UPDATE TRAIN</button>
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