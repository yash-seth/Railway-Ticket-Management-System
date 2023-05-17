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
    <title>DISPLAY TICKET</title>
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
          <a class="nav-link active" aria-current="page" href="#">TICKET DETAILS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="welcome.php">BACK</a>
        </li>
      </ul>
    </div>
  </div>
</nav> 
   <div class="main-div">
    <h1>HEY USER BELOW IS YOUR TICKET!!</h1>
    <div class="center-div">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>TICKET_NO</th>
                        <th>USERNAME</th>
                        <th>MOBILE_NO</th>
                        <th>TRAIN_NAME</th>
                        <th>SOURCE</th>
                        <th>DESTINATION</th>
                        <th>CLASS</th>
                        <th>DOJ</th>
                        <th>FARE</th>
                        <th>ALLOC_SEAT</th>
                        <th>DELETE</th>
                        <th>STATUS</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                    session_start();

                    include "config.php";

                    $id=$_SESSION['id'];

                    $selectquery="SELECT * FROM tickets WHERE user_id={$id}";

                    $query=mysqli_query($conn,$selectquery);

                    // getting the number of rows in the users table
                    $num = mysqli_num_rows($query);

                    if($num==0)
                    { 
                      
                      
                      echo '<script type="text/javascript">';
                      echo 'setTimeout(function () { Swal.fire("WOW!","Message!","success");';
                       echo '}, 1000);</script>';
                    
                       
                    }
                    else
                    {

                    $res=mysqli_fetch_array($query);
                    // res will give all the details about the ticket table

                    $prn=$res['PRN'];

                    if($prn!=0)
                    {
                        $status="PAID";
                    }
                    else{
                        $status="NOT PAID";
                    }

                    $sql1="SELECT * FROM users WHERE id={$id}";

                    $query1=mysqli_query($conn,$sql1);

                    $res1=mysqli_fetch_array($query1);

                    //res1 gives u all the details about the user

                    $tn=$res['train_no'];

                    $sql2="SELECT * FROM trains WHERE train_no={$tn}";

                    $query2=mysqli_query($conn,$sql2);

                    $res2=mysqli_fetch_array($query2);

                    // res2 gives u all the details about the train


                    ?>
                    <tr>
                        <td><?php echo $res['user_id'];?></td>
                        <td><?php echo $res1['username'];?></td>
                        <td><?php echo $res1['mobile_no'];?></td>
                        <td><?php echo $res2['train_name'];?></td>
                        <td><?php echo $res2['source'];?></td>
                        <td><?php echo $res2['destination'];?></td>
                        <td><?php echo $res['class'];?></td>
                        <td><?php echo $res['doj'];?></td>
                        <td><?php echo $res['fare'];?></td>
                        <td><?php echo $res['alloc_seat'];?></td>
                        <td><a href="delticket.php?ticket_no=<?php echo $res['ticket_no'];?>" data-toggle="tooltip" data-placement ="top" title="DELETE">
                        <i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        <?php
                        if($status!="PAID")
                        {
                          ?>
                          <td><?php echo $status;?><a href="payticket.php?ticket_no=<?php echo $res['ticket_no'];?>" data-toggle="tooltip" data-placement ="top" title="PAY"><i class="fa fa-money" aria-hidden="true"></i></a> </td>
                          <?php
                        }
                        else
                        {
                          ?>
                          <td><?php echo $status;?></td>
                          <?php
                        }
                      }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>
</html>