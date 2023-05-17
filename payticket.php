<?php

session_start();

include "config.php";

$ticket=$_GET['ticket_no'];
if(isset($_POST['paylater']))
{
  // the user opts to pay later
  ?>
                <script>
                swal("Good job!", "Payment UnSuccessful!", "success");
                </script>
                <?php
  header('location:welcome.php');
}
else
{

if($_SERVER['REQUEST_METHOD']=="POST")
{
    $paytype=trim($_POST['payment']);
    
    $bank=trim($_POST['bank']);

    //just insert the details into the payment table

    $insert="INSERT into payment(ticket_no,paytype,bank) values(?,?,?)";

    $stmt=mysqli_prepare($conn,$insert);

    if($stmt)
    {
        mysqli_stmt_bind_param($stmt,'sss',$param_ticket_no,$param_paytype,$param_bank);

        // set these parameters 

        $param_ticket_no=$ticket;

        $param_paytype=$paytype;

        $param_bank=$bank;
         //TRY TO EXECUTE THE QUERY
         if(mysqli_stmt_execute($stmt))
         {    
              // completed inserting the details now.. 

                // now we need to update the status in the ticket.(PRN)

                // now we need to fetch the receipt no from the payment table
                /*
                CREATE TABLE `rdbms`.`payment` ( `receipt_no` INT NOT NULL AUTO_INCREMENT , `ticket_no` INT NOT NULL , `paytype` VARCHAR(50) NOT NULL , `bank` VARCHAR(50) NOT NULL , `paid_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`receipt_no`)) ENGINE = InnoDB;
                */

                $sql5="SELECT receipt_no FROM payment WHERE ticket_no={$ticket}";

                $query5=mysqli_query($conn,$sql5);

                $res5=mysqli_fetch_array($query5);

                $prn=$res5['receipt_no'];

                $sql="UPDATE tickets set PRN=$prn WHERE ticket_no={$ticket}";

                $pas=mysqli_query($conn,$sql);
                
                // throw up a popup saying successful payment;
                ?>
                <script>
                swal("Good job!", "Payment UnSuccessful!", "success");
                </script>
                <?php
                header("location:welcome.php");
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
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
<link rel="stylesheet" href="display.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

                    </tr>
                </thead>
                <tbody>
                <?php

                    $id=$_SESSION['id'];

                    $selectquery="SELECT * FROM tickets WHERE user_id={$id}";

                    $query=mysqli_query($conn,$selectquery);

                    // getting the number of rows in the users table
                    $num = mysqli_num_rows($query);

                    $res=mysqli_fetch_array($query);
                    // res will give all the details about the ticket table

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
                    </tr>
                </tbody>
            </table>
        </div>
    <div class="container">  
      <br><br><br><br><br>
      <h3>PLease Enter details for Payment Here::</h3>
      <br>
      <form action="" method="post">
      <!--<div class="col-md-12">
        <label for="payment" class="form-label">PAYMENT TYPE</label>
        <input type="text" name="payment" class="form-control" id="payment" placeholder="Enter the payment type">
      </div>-->
      <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="payment">
      <option selected>Choose the Payment Type</option>
      <option value="GPAY">GPAY</option>
      <option value="UPI">UPI</option>
      <option value="NET BANKING">NET BANKING</option>
      <option value="CREDIT CARD">CREDIT CARD</option>
      <option value="DEBIT CARD">DEBIT CARD</option>
      <option value="PAYTM">PAYTM</option>
      <option value="OTHER">OTHER</option>
      </select>
      <div class="col-md-12">
        <label for="bank" class="form-label">BANK NAME</label>
        <input type="text" name="bank" class="form-control" id="bank" placeholder="Enter the Bank name">
      </div>
      <br>
      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck">
          <label class="form-check-label" for="gridCheck">
            I confirm to pay!
          </label>
        </div>
      <br>
      </div>
      <div class="col-12">
      <button type="submit" class="btn btn-primary">PAY</button>
      <button type="submit" name='paylater' class="btn btn-primary">PAY LATER</button>
      </div>
      </form>
    </div>
    </div>
    </div>
</body>
</html>
