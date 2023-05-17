<?php
   require_once "config.php";
   include "sep.php";
   $username = $password = $confirm_password="";
   $username_err = $password_err = $confirm_password_err="";

   if($_SERVER['REQUEST_METHOD']=="POST"){
        // CHECK IF USERNAME IS EMPTY
        if(empty(trim($_POST["username"])))
        {
            $username_err="Username cannot be empty";
            $alert="<script>
                        Swal.fire({
                        title: 'Warning!',
                        text: 'Username cannot be empty!',
                        icon: 'error',
                        button: 'OK',
                      });
                      </script>";
                echo $alert;
                //header("location:register.php");
        }
        else
        {
            $sql="SELECT id from users WHERE username=?";
            $stmt=mysqli_prepare($conn,$sql);
            if($stmt)
            {
                mysqli_stmt_bind_param($stmt,"s",$param_username);

                //set the value of param username
                $param_username=trim($_POST['username']);

                //try to execute this statement

                if(mysqli_stmt_execute($stmt))
                {
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)==1)
                    {
                        $username_err="This username is already taken!";
                        $alert="<script>
                        Swal.fire({
                        title: 'Warning!',
                        text: 'This username is already taken!',
                        icon: 'error',
                        button: 'OK',
                      });
                      </script>";
                      echo $alert;
                      //header("location:register.php");
                    }
                    else{
                        $username=trim($_POST['username']);
                    }
                }
                else{
                    echo "something went wrong!";
                }
            }
        }
       mysqli_stmt_close($stmt);
   

  // check for the password
  if(empty(trim($_POST['password']))){
      $password_err="Password cannot be empty!";
      $alert="<script>
                        Swal.fire({
                        title: 'Warning!',
                        text: 'Password cannot be empty!',
                        icon: 'error',
                        button: 'OK',
                      });
                      </script>";
                echo $alert;
                //header("location:register.php");
      
  }
  elseif(strlen(trim($_POST['password']))<5){
      $password_err="Minimum length of the password nust be 5 characters";
      $alert="<script>
                        Swal.fire({
                        title: 'Warning!',
                        text: 'Minimum length of the password nust be 5 characters',
                        icon: 'error',
                        button: 'OK',
                      });
                      </script>";
                echo $alert;
                //header("location:register.php");
  }
  else
  {
      $password = trim($_POST['password']);
  }

  //check for confirm password field

  if(trim($_POST['password']) != (trim($_POST['confirm_password']))){
    $password_err="Passwords should match";
    $alert="<script>
                        Swal.fire({
                        title: 'Warning!',
                        text: 'Passwords should match',
                        icon: 'error',
                        button: 'OK',
                      });
                      </script>";
    echo $alert;
    //header("location:register.php");
}
$dob=trim($_POST['dob']);
$gender=trim($_POST['gender']);
$mobile_no=trim($_POST['mobile_no']);
$email=trim($_POST['email']);
if(str_ends_with($email,"@gmail.com")==false)
{
  $alert="<script>
                        Swal.fire({
                        title: 'Warning!',
                        text: 'Invalid email address!',
                        icon: 'error',
                        button: 'OK',
                      });
                      </script>";
    echo $alert;
   
}


// if there were no errors , go ahead and insert into the database
if(empty($username_err)&&empty($password_err)&&empty($confirm_password_err))
{
    $sql = "INSERT INTO users (username,dob,gender,mobile_no,email,password) values(?,?,?,?,?,?)";
    $stmt=mysqli_prepare($conn,$sql);
    if($stmt)
    {
        mysqli_stmt_bind_param($stmt,'ssssss',$param_username,$param_dob,$param_gender,$param_mobile_no,$param_email,$param_password);

        // set these parameters

        $param_username = $username;

        $param_dob=$dob;

        $param_gender=$gender;

        $param_mobile_no=$mobile_no;

        $param_email=$email;
        // hashing the password
        $param_password = password_hash($password,PASSWORD_DEFAULT);

        
        
        //TRY TO EXECUTE THE QUERY
        if(mysqli_stmt_execute($stmt))
        {   
            header("location:sample.php");
        }
        else{
            echo "Something went wrong... cannot redirect";
            header("location:register.php");
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
    <title>REGISTER</title>
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
          <a class="nav-link active" aria-current="page" href="#">REGISTER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">ABOUT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sample.php">LOGIN/BACK</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
    <img class="bg" src="bg3.jpg" alt="RAILWAY RESERVATION SYSTEM">
    <div class="container">
      
      <br><br><br><br><br>
      <h3>PLease Register Here::</h3>
      <br>
      <form class="register" action="" method="post">
      <div class="col-md-12">
        <label for="inputusername" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="inputusername" placeholder="Enter the username">
      </div>
      <div class="col-md-12">
        <label for="inputage" class="form-label">DOB</label>
        <input type="date" name="dob" class="form-control" id="inputage" placeholder="Enter the DOB">
      </div>
      <div class="col-md-12">
        <label for="inputgender" class="form-label">Gender</label>
        <input type="text" name="gender" class="form-control" id="inputgender" placeholder="Enter the gender">
      </div>
      <div class="col-md-12">
        <label for="inputmobileno" class="form-label">Mobile No.:</label>
        <input type="text" name="mobile_no" class="form-control" id="inputmobileno" placeholder="Enter your Mobile number">
      </div>
      <div class="col-md-12">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="text" name="email" class="form-control" id="inputEmail4" placeholder="Enter your email">
      </div>
      <div class="col-md-12">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Enter the password">
      </div>
      <div class="col-md-12">
        <label for="inputPassword4" class="form-label">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control" id="inputPassword4" placeholder="Enter the password again">
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
      <button type="submit" class="btn btn-primary">Register</button>
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