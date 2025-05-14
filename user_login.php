<?php 
$errors = [];
$username = "";

require_once "controlleruserdata.php"; 
include('connection.php');
include('tags.php');

// Fetch data from tbl_notes
$sql = "SELECT * FROM tbl_notes ORDER BY id DESC"; // Assuming these are the column names
$result = mysqli_query($conn, $sql);

$notes = []; // Initialize an array to store notes
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $notes[] = $row; // Store each note in the array
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zhiyuan</title>
    <link rel="shortcut icon" type="x-icon" href="logo.png">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
body {
    background-image: url("pattern.svg");
    background-size: 8%; /* zoom in the background */
    background-position: center;
}


        input {
            border-radius: 10px !important;
            font-size: 2em !important;
        }

        /* Custom styles */
        .login-section {
            height: 100vh;
            display: flex;
            vertical-align: middle;
            align-items: center;
        }
        .login-form-right {
            width: 60%; /* Adjust width as needed */
            max-width: 500px; /* Set a maximum width */
            height: 90%;
            margin: auto;
            vertical-align: middle;
            padding: 50px; /* Increase padding */
            border: 1px solid #443a16;
            border-radius: 10px; /* Increase border radius */
            background-color: #000000;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Increase shadow */
            align-items: center;
        }
        .login-form {
            width: 60%; /* Adjust width as needed */
            max-width: 500px; /* Set a maximum width */
            height: 90%;
            margin: auto;
            vertical-align: middle;
            padding: 50px; /* Increase padding */
            border: 1px solid #fdf3cf;
            border-radius: 10px; /* Increase border radius */
            background-color: #fdf3cf;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Increase shadow */
            align-items: center;
        }

        .content {
            padding: 20px;
        }

        .bg-yellow {
            background-color: #A78F75 !important;
            border-color: black !important;
        }

        /* Adjust font size using relative units */
        .login-form-right label,
        .login-form-right input,
        .login-form-right .btndesign,
        .login-form-right a {
            font-size: 1.2em; /* Use relative units for font size */
        }
        .login-form-right select {
            
            font-size: 1.5em !important;
        }
        
        div.gp-letter {
        display: inline-block;
        vertical-align: middle;
        text-align: center;
}

        div.gp-letter .p1 {
        font-weight: bold;
        font-size: 30px;
        color: white;	
        font-family: "Arial", sans-serif;
}

        div.gp-letter .p2 {
        color: #ffffcc;	
        font-size: 20px;
        letter-spacing: 1px;
        margin-top: 1px;
        font-family: "Helvetica", monospace;
}

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6 login-section">
                <div class="login-form-right">
                    <!-- Box-like container for login form -->
                    <form id="loginForm" method="POST" autocomplete="">
                        <img class="img-fluid" src="logo.png" width="85">
                        <div class="gp-letter">
					</div>
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
                            <input class="form-control btndesign bg-yellow mt-4" type="submit" name="login_user" value="Login">
                        </div>

                        <center>
                            
                            <br>
                            <a class="text-white" type="submit" href="forgotpassword.php">Forgot Password?</a>
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

