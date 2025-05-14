<?php 
require_once "controlleruserdata.php"; 
include('connection.php');
include('tags.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="style.css">
    <style>
        .borderimg {
            border: solid 1px black; padding: 5px 35px 5px 35px; border-radius: 5px; margin-top: 15px; margin-bottom: 15px;
        }
        .btn-primary {
            background: #3d96ff;
            border-color: #3d96ff;
        }
        .btn-primary:hover {
            background: #1577ea;
            border-color: #1577ea;
        }
        .btn-admin{
            background: #468598; 
            color: white; 
            margin-top: 15px;
        }
        .btn-admin:hover{
            background: #1e677d; 

        }

    </style>
</head>
<body>
    <div class="container" style="max-width: 500px; zoom: 110%;">
        <div style="font-size: 2rem; margin-top: 15px; margin-left: -25px;">
                   <a href="user_login.php"><button class="btn btn-light">Back</button></a>
               </div> 
        <div class="row text-center align-items-center h-100 mx-auto justify-content-center align-items-center" style="">
            <div class="login-form ">
                 <img class="img-fluid" src="img/logopng.png" width="150">
                <form action="" method="POST" autocomplete="">
                    <!-- <h2 class="text-center">Login Form</h2>
                    <p class="text-center">Login with your username and password.</p> -->
                    <?php 
                         if(isset($_POST["register"])) {
                           $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
                           $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
                           $middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
                           $email = mysqli_real_escape_string($conn, $_POST['email']);
                           $username = mysqli_real_escape_string($conn, $_POST['username']);
                           $password = mysqli_real_escape_string($conn, $_POST['password']);
                           $password = password_hash($password, PASSWORD_BCRYPT);
                           $position = mysqli_real_escape_string($conn, $_POST['position']);

                           $existingEmailQuery = mysqli_query($conn, "SELECT * FROM tbl_user_credentials WHERE email = '$email'");
                               if (mysqli_num_rows($existingEmailQuery) > 0) {
                                   echo '<label class="text-danger">Whoops! Something went wrong. &nbsp;</label>';
                                   echo '<label class="text-danger"> The Email has already been taken.</label>';
                               } 
                               else {
                            $query_insert = mysqli_query($conn, "INSERT INTO tbl_user_credentials 
                                      VALUES('', '$last_name', '$first_name','$middle_name', '$email', 
                                         '$username', '$password', '$position')");
                                    if($query_insert)
                                    {            
                                        echo '<div class="alert alert-success">Your Account is Successfully Registered</div>';
                                                    
                                    }
                         }
                        }
                    ?>
    
                    <hr/>
                    <div style="text-align: left !important;">
                    <div class="form-group" >
                        <label>Last Name:</label>
                        <input class="form-control"  type="text" name="last_name"  required >
                    </div>
                    <div class="form-group" >
                        <label>First Name:</label>
                        <input class="form-control"  type="text" name="first_name"  required >
                    </div>
                    <div class="form-group" >
                        <label>Middle Name:</label>
                        <input class="form-control"  type="text" name="middle_name"  required >
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input class="form-control" type="email" name="email" required >
                    </div>

                    <div class="form-group">
                        <label>Username:</label>
                        <input class="form-control" type="text" name="username" required>
                    </div>


                    <div class="form-group">
                        <label>Password:</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password:</label>
                        <input class="form-control" type="password" id="confirmPassword" required>
                    </div>

                    <span id="passwordMatchStatus"></span>

                    <!-- <span style="text-align: right !important; margin-top: -10px; margin-bottom: 15px; float: right;">Forgot as Password</span> -->

                    <div class="form-group">
                        <label>Position:</label>
                        <input class="form-control" type="text" name="position" required>
                    </div>
                   
                    <div class="form-group">
                        <input class="form-control button btn-primary" id="registerBtn" disabled type="submit" name="register" value="Register" >
                    </div>
                </div>


                    <a href="user_login.php">Already Registered?</a>
                
                </form>
            </div>
        </div>
    </div>
    
</body>


</html>

<script>
  var passwordInput = document.getElementById("password");
  var confirmPasswordInput = document.getElementById("confirmPassword");
  var registerBtn = document.getElementById("registerBtn");

  function validatePassword() {
     var password = passwordInput.value;
     var confirmPassword = confirmPasswordInput.value;

     if (password === confirmPassword) {
       passwordMatchStatus.textContent = "Password matches";
       passwordMatchStatus.style.color = "green";
       registerBtn.disabled = false;
     } else {
       passwordMatchStatus.textContent = "Password does not match";
       passwordMatchStatus.style.color = "red";
       registerBtn.disabled = true;
     }
   }

  passwordInput.addEventListener("input", validatePassword);
  confirmPasswordInput.addEventListener("input", validatePassword);
</script>