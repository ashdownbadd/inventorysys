<?php 
require_once "controlleruserdata.php"; 
include('connection.php');
include('tags.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffc805;
        }

        input {
            background-color: #fdf3cf !important;
            border-color: #fdf3cf !important;
            border-radius: 10px !important;
            font-size: 2em !important;
        }

        /* Custom styles */
        .login-section {
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-form-right {
            width: 80%; /* Adjust width as needed */
            max-width: 500px; /* Set a maximum width */
            height: 90%;
            margin: auto;
            padding: 40px; /* Increase padding */
            border: 1px solid #443a16;
            border-radius: 10px; /* Increase border radius */
            background-color: #443a16;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Increase shadow */
        }
        .login-form {
            width: 80%; /* Adjust width as needed */
            max-width: 500px; /* Set a maximum width */
            height: 90%;
            margin: auto;
            padding: 40px; /* Increase padding */
            border: 1px solid #fdf3cf;
            border-radius: 10px; /* Increase border radius */
            background-color: #fdf3cf;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Increase shadow */
        }


        .left-section {
            background-color: #fdf3cf;
        }
        .content {
            padding: 20px;
        }

        .bg-yellow {
            background-color: #ffc805 !important;
            border-color: #ffc805 !important;
        }

        /* Adjust font size using relative units */
        .login-form-right label,
        .login-form-right input,
        .login-form-right .btndesign,
        .login-form-right a {
            font-size: 1.2em; /* Use relative units for font size */
        }


        .login-form-right select {
            background-color: #fdf3cf;
            font-size: 1.5em !important;
        }

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 left-section login-section">
                <div class="login-form">
                    <!-- Your content on the left side -->
                    <h2>Note:</h2>
                </div>
            </div>
            <div class="col-md-6 login-section">
                <div class="login-form-right">
                    <!-- Box-like container for login form -->
                    <form id="loginForm" method="POST" autocomplete="" action="user_login.php">
                        <img class="img-fluid" src="img/logopng.png" width="80">
                        <label class="text-white">GRATIFY PROJECTS</label>
                        <br><br>
                        <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center" style="font-size: 1.5em;">
                                <?php
                                foreach($errors as $showerror){
                                    echo $showerror;
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                        <br><br>
                        <div class="form-group">
                            <label for="username" class="text-white mb-4">Username:</label>
                            <input class="form-control" type="text" name="username"  required value="<?php echo $username ?>">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-white mb-4 mt-4">Password:</label>
                            <input class="form-control" type="password" name="password"  required password = "user_password".encode('utf-8')>
                        </div>
                       
                       <div class="form-group">
                                   <label for="password" class="text-white mb-4 mt-4">User Type:</label>
                                   <select id="userType" class="form-control btndesign" onchange="updateFormAction()">
                                       <option value="Admin">Admin</option>
                                       <option value="User">User</option>
                                   </select>
                               </div>
                        <div class="form-group">
                            <input class="form-control btndesign bg-yellow mt-4" type="submit" name="login_user" value="Login">
                        </div>

                        <center>
                            <a class="text-white" href="registration.php">Don't have an account? Register to us.</a>
                            <br>
                            <a class="text-white" href="forgotpassword.php">Forgot Password.</a>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script>
    function updateFormAction() {
           var userType = document.getElementById("userType").value;
           var form = document.getElementById("loginForm");

           if (userType === "Admin") {
               form.action = "admin_login.php"; // Change this to the appropriate admin page URL
           } else if (userType === "User") {
               form.action = "admin/user_dashboard.php"; // Change this to the appropriate user page URL
           }
       }
       
       // Call the function on page load to set the initial form action
       window.onload = updateFormAction;
    </script>