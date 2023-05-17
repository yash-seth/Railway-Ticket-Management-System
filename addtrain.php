<?php
   require_once "config.php";
   $train_name ="";
   $train_name_err ="";
   $source ="";
   $source_err ="";
   $destination ="";
   $destination_err ="";
   $arr_time="";
   $dep_time="";
   $distance=0;
   $no_of_seats=0;
   $avlbl_seats=0;

   if($_SERVER['REQUEST_METHOD']=="POST"){
        // CHECK IF TrainNAME IS EMPTY
        if(empty(trim($_POST["train_name"])))
        {
            $train_name_err="Train name cannot be empty";
        }
        else
        {
            $sql="SELECT train_name from trains WHERE train_name=?";
            $stmt=mysqli_prepare($conn,$sql);
            if($stmt)
            {
                mysqli_stmt_bind_param($stmt,"s",$param_train_name);

                //set the value of param username
                $param_train_name=trim($_POST['train_name']);

                //try to execute this statement

                if(mysqli_stmt_execute($stmt))
                {
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)==1)
                    {
                        $train_name_err="This Train name is already taken!";
                    }
                    else{
                        $train_name=trim($_POST['train_name']);
                    }
                }
                else{
                    echo "something went wrong!";
                }
            }
        }
       mysqli_stmt_close($stmt);
   

  // check for the password
  if(empty(trim($_POST['source']))){
      $source_err="Source cannot be empty!";
  }
  else
  {
      $source = trim($_POST['source']);
  }

  if(empty(trim($_POST['destination']))){
    $destination_err="destination cannot be empty!";
  }
  else
    {
    $destination = trim($_POST['destination']);
    }


$arr_time=trim($_POST['arr_time']);
$dep_time=trim($_POST['dep_time']);
$distance=trim($_POST['distance']);
$no_of_seats=trim($_POST['no_of_seats']);
$avlbl_seats=trim($_POST['avlbl_seats']);

// if there were no errors , go ahead and insert into the database
if(empty($train_name_err)&&empty($source_err)&&empty($destination_err))
{
    $sql = "INSERT INTO trains (train_name,source,destination,arr_time,dep_time,distance,no_of_seats,avlbl_seats) values(?,?,?,?,?,?,?,?)";
    $stmt=mysqli_prepare($conn,$sql);
    if($stmt)
    {
        mysqli_stmt_bind_param($stmt,'ssssssss',$param_train_name,$param_source,$param_destination,$param_arr_time,$param_dep_time,$param_distance,$param_no_of_seats,$param_avlbl_seats);

        // set these parameters

        $param_train_name = $train_name;

        $param_source=$source;

        $param_destination=$destination;

        $param_arr_time=$arr_time;

        $param_dep_time=$dep_time;
        
        $param_distance=$distance;

        $param_no_of_seats=$no_of_seats;

        $param_avlbl_seats=$avlbl_seats;
        
        //TRY TO EXECUTE THE QUERY
        if(mysqli_stmt_execute($stmt))
        {
            header("location:awelcome.php");
        }
        else{
            echo "Something went wrong... cannot redirect";
        }
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

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
    <title>ADD TRAINS</title>
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
          <a class="nav-link active" aria-current="page" href="#">ADD TRAINS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="disptrain.php">MANAGE TRAINS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="awelcome.php">BACK</a>
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
      <h3>PLease Enter details Here::</h3>
      <br>
      <form class="register" action="" method="post">
      <div class="col-md-12">
        <label for="inputusername" class="form-label">TRAIN_NAME</label>
        <input type="text" name="train_name" class="form-control" id="inputusername" placeholder="Enter the Train name">
      </div>
      <div class="col-md-12">
        <label for="inputage" class="form-label">SOURCE</label>
        <input type="text" name="source" class="form-control" id="inputage" placeholder="Enter the Source">
      </div>
      <div class="col-md-12">
        <label for="inputgender" class="form-label">DESTINATION</label>
        <input type="text" name="destination" class="form-control" id="inputgender" placeholder="Enter the Destination">
      </div>
      <div class="col-md-12">
        <label for="inputmobileno" class="form-label">ARRIVAL TIME</label>
        <input type="time" name="arr_time" class="form-control" id="inputmobileno" placeholder="Enter your Arrival Time">
      </div>
      <div class="col-md-12">
        <label for="inputdeptime" class="form-label">DEPARTURE TIME</label>
        <input type="time" name="dep_time" class="form-control" id="inputdeptime" placeholder="Enter your Departure Time">
      </div>
      <div class="col-md-12">
        <label for="inputdist" class="form-label">DISTANCE</label>
        <input type="int" name="distance" class="form-control" id="inputdist" placeholder="Enter the Distance">
      </div>
      <div class="col-md-12">
        <label for="inputseat" class="form-label">NO_OF_SEATS</label>
        <input type="int" name="no_of_seats" class="form-control" id="inputseat" placeholder="Enter the number of seats">
      </div>
      <div class="col-md-12">
        <label for="inputPassword4" class="form-label">AVAILABLE_SEATS</label>
        <input type="int" name="avlbl_seats" class="form-control" id="inputPassword4" placeholder="Enter the Available seats">
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
      <button type="submit" class="btn btn-primary">ADD TRAIN</button>
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