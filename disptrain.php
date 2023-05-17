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
    <title>Display users</title>
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
          <a class="nav-link active" aria-current="page" href="#">TRAIN DETAILS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="awelcome.php">BACK</a>
        </li>
      </ul>
    </div>
  </div>
</nav>  
    <div class="main-div">
    <h1>List of trains from the database is as follows!</h1>
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
                        <th>UPDATE</th>
                        <th>DELETE</th>


                    </tr>
                </thead>
                <tbody>
                <?php

                    include "config.php";

                    $selectquery="SELECT * FROM trains";

                    $query=mysqli_query($conn,$selectquery);

                    // getting the number of rows in the users table
                    $num = mysqli_num_rows($query);

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
                        <td><a href="updatetrain.php?train_no=<?php echo $res['train_no'];?>" data-toggle="tooltip" data-placement ="top" title="UPDATE"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
                        <td><a href="deltrain.php?train_no=<?php echo $res['train_no'];?>" data-toggle="tooltip" data-placement ="top" title="DELETE"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php
                    }

                    ?>
                    
                
                
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>
</html>