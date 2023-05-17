<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" />
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
          <a class="nav-link active" aria-current="page" href="#">USER DETAILS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="awelcome.php">BACK</a>
        </li>
      </ul>
    </div>
  </div>
</nav>  
    <div class="main-div">
    <h1>List of users from the database is as follows!</h1>
    <div class="center-div">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>USERNAME</th>
                        <th>DOB</th>
                        <th>GENDER</th>
                        <th>MOBILE_NO</th>
                        <th>EMAIL</th>
                        <th>REGD_AT</th>

                    </tr>
                </thead>
                <tbody>
                <?php

                    include "config.php";

                    $selectquery="SELECT * FROM users";

                    $query=mysqli_query($conn,$selectquery);

                    // getting the number of rows in the users table
                    $num = mysqli_num_rows($query);

                    while($res = mysqli_fetch_array($query))
                    {
                        ?>
                    <tr>
                        <td><?php echo $res['id'];?></td>
                        <td><?php echo $res['username'];?></td>
                        <td><?php echo $res['dob'];?></td>
                        <td><?php echo $res['gender'];?></td>
                        <td><?php echo $res['mobile_no'];?></td>
                        <td><?php echo $res['email'];?></td>
                        <td><?php echo $res['regd_at'];?></td>
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
