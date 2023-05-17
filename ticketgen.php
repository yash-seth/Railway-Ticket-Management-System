<?php
    session_start();

    include "config.php";

    $tno=$_GET['train_no'];

    $sql="SELECT * FROM trains WHERE train_no={$tno}";

    $showdata=mysqli_query($conn,$sql);

    $arrdata=mysqli_fetch_array($showdata);

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
      // here we need to check whether the user has already booked a ticket
        $name=$_SESSION['username'];
        
        $id=$_SESSION['id'];
        $sql1="SELECT * FROM tickets WHERE user_id={$id}";
      
        $show=mysqli_query($conn,$sql1);

        // check for the alreadu existing ticket
        $num=mysqli_num_rows($show);
        
        $res=mysqli_fetch_array($show);
        
        if($num==1)
        {
          // here the user already has a ticket booked throw an err
          header('location:welcome.php');
        }
        else
        {
      
        $tn=$_GET['train_no'];
        $tseat=$arrdata['no_of_seats'];
        $avseat=$arrdata['avlbl_seats'];
        $class=trim($_POST['class']);
        $doj=trim($_POST['doj']);
        $fare=($arrdata['distance']*0.5);
        
        if(strcasecmp($class,"general")==0)
        {
            $fare+=500;
        }
        elseif(strcasecmp($class,"sleeper")==0)
            {
                $fare+=1000;
            }
            elseif(strcasecmp($class,"AC")==0)
                {
                    $fare+=2000;
                }
       // now we need to allocate the seats

       $aseat='T'.strval($tn).'-S-'.strval($tseat-$avseat);

       // now we need to insert these data into the ticket table in the database.

       $sql2 = "INSERT INTO tickets (user_id,train_no,class,doj,fare,alloc_seat) 
               values(?,?,?,?,?,?)";
       $stmt=mysqli_prepare($conn,$sql2);
       if($stmt)
       {
           mysqli_stmt_bind_param($stmt,'ssssss',$param_userid,$param_train_no,$param_class,$param_doj,$param_fare,$param_alloc_seat);
          
   
           // set these parameters
           $param_userid=$id;

           $param_train_no=$tn;

           $param_class=$class;

           $param_doj=$doj;

           $param_fare=$fare;

           $param_alloc_seat=$aseat;

           //TRY TO EXECUTE THE QUERY
           if(mysqli_stmt_execute($stmt))
           {    
                // completed inserting the details now.. we need to display them as a ticket and ask for payment

                  // now we need to decrement the allocated seat and update in the database

                  $avseat-=1;

                  $sql3="UPDATE trains set avlbl_seats=$avseat WHERE train_no={$tn}";

                  $pas=mysqli_query($conn,$sql3);
                  
               header("location:ticket.php");
           }
           else{
               echo "Something went wrong... cannot redirect";
           }
       }
       mysqli_stmt_close($stmt);
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
   <!-- <link rel="stylesheet" href="sample.css">-->
    <title>BOOK TICKET</title>
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
          <a class="nav-link active" aria-current="page" href="#">CANCEL TICKET</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">ABOUT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="booktrain.php">BACK</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">LOGOUT</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
    <!--<img class="bg" src="bg3.jpg" alt="RAILWAY RESERVATION SYSTEM">-->
    <div class="container">
      
      <br><br><br><br><br>
      <h3>PLease Enter details for booking Here::</h3>
      <br>
      <form class="register" action="" method="post">
      <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="class">
      <option selected>Choose the class</option>
      <option value="AC">AC</option>
      <option value="Sleeper">Sleeper</option>
      <option value="General">General</option>
      </select>
      <div class="col-md-12">
        <label for="inputage" class="form-label">DOJ</label>
        <input type="date" name="doj" class="form-control" id="inputage" placeholder="Enter the Date of Journey">
      </div>
      <br>
      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck">
          <label class="form-check-label" for="gridCheck">
            I confirm booking this ticket!
          </label>
        </div>
      <br>
      </div>
      <div class="col-12">
      <button type="submit" class="btn btn-primary">BOOK TICKET</button>
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