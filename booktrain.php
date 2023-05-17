<?php
 include "config.php";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
<link rel="stylesheet" href="display.css">
    <title>SEARCH TRAINS</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SEARCH TRAINS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">TRAIN DETAILS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="welcome.php">BACK</a>
        </li>
      </ul>
    </div>
  </div>
</nav> 
<br><br><br>
<div class="container">
<h1>ENTER THE DETAILS HERE::</h1>

<form action="" method="post">

      <?php 
      
      //get the distinct source and destination from the database.
      $sel="SELECT * FROM trains";

      $que=mysqli_query($conn,$sel);

      $dsource=array();

      $ddes=array();
      $i=0;
      while($r=mysqli_fetch_array($que))
      {
         if($i==0)
         {
           array_push($dsource,$r["source"]);
           array_push($ddes,$r["destination"]);
         }
         else
         {
           // iterate thru the array and check whether it is already present
           // if yes then don't push else push
           $f1=0;
           $f2=0;
           
           for($j=0;$j<count($dsource);$j++)
           {
                if(strcmp($dsource[$j],$r['source'])==0)
                {
                      $f1=1;
                }
                if($f1==1)
                break;
                else
                array_push($dsource,$r['source']);
          }

          for($j=0;$j<count($ddes);$j++)
           {
                if(strcmp($ddes[$j],$r['destination'])==0)
                {
                      $f2=1;
                }
                if($f2==1)
                break;
                else
                array_push($ddes,$r['destination']);
          }

         }
         ++$i;

      }
      
      ?>
      <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="from">
      <option selected>Choose the source</option>
      <?php 
      for($i=0;$i<count($dsource);$i++)
      {
        
      echo"<option value=\"$dsource[$i]\">$dsource[$i]</option>";
      }
      ?>
      </select>
      <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="to">
      <option selected>Choose the destination</option>
      <?php 
      for($i=0;$i<count($ddes);$i++)
      {
        
      echo"<option value=\"$ddes[$i]\">$ddes[$i]</option>";
      }
      ?>
      </select>
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
      <button type="submit" name ="search" class="btn btn-primary">Search Trains</button>
      </div>
      </form> 
      </div>
    <div class="main-div">
    <h1>List of trains for the given query!</h1>
    <div class="center-div">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>TRAIN_NO</th>
                        <th>TRAIN_NAME</th>
                        <th>SOURCE</th>
                        <th>DESTINATION</th>
                        <th>ARR_TIME</th>
                        <th>DEP_TIME</th>
                        <th>NO_OF_SEATS</th>
                        <th>AVLBL_SEATS</th>
                        <th>BOOK TICKET</th>


                    </tr>
                </thead>
                <tbody>
                <?php

                    if(isset($_POST['search']))
                    {
                    $to=$from=$date="";
                    $from=trim($_POST['from']);
                    $to=trim($_POST['to']);
                    $selectquery="SELECT * FROM trains where source='$from' AND destination='$to'";

                    $query=mysqli_query($conn,$selectquery);

                    while($res = mysqli_fetch_array($query))
                    { 
                        ?>
                    <tr>
                        <td><?php echo $res['train_no'];?></td>
                        <td><?php echo $res['train_name'];?></td>
                        <td><?php echo $res['source'];?></td>
                        <td><?php echo $res['destination'];?></td>
                        <td><?php echo $res['arr_time'];?></td>
                        <td><?php echo $res['dep_time'];?></td>
                        <td><?php echo $res['no_of_seats'];?></td>
                        <td><?php echo $res['avlbl_seats'];?></td>
                        <td><a href="ticketgen.php?train_no=<?php echo $res['train_no'];?>" data-toggle="tooltip" data-placement ="top" title="BOOK TICKET"><i class="fa fa-book" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php
                    }
                   
                }
                    ?>
                    
                
                
                </tbody>
            </table>
        </div>
    </div>
    </div>
    
</body>
</html>