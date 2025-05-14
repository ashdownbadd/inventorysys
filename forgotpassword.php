<?php
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

// Initialize variables
$email = "";
$errors = array();
$showOTPField = false;
$showPasswordField = false;

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted for sending OTP
    if (isset($_POST['send_otp'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        // Check if email exists in the database
        $query = "SELECT * FROM tbl_admin_credentials WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // Generate OTP
            $otp = mt_rand(100000, 999999);
            // Store OTP in session
            $_SESSION['otp'] = $otp;
            // Store OTP in database
            $update_query = "UPDATE tbl_admin_credentials SET otp='$otp' WHERE email='$email'";
            mysqli_query($conn, $update_query);
            // Send OTP to email
            if (sendOTP($email, $otp, $mail)) {
                // Display a message indicating that OTP has been sent
                $message = "OTP has been sent to your email.";
                $showOTPField = true; // Show OTP field
            } else {
                $errors['email'] = "Error sending OTP. Please try again.";
            }
        } else {
            $errors['email'] = "Email not found. Please enter a valid email.";
        }
    }

    // Check if the form is submitted for OTP verification and password reset
    if (isset($_POST['verify_otp'])) {
        $entered_otp = mysqli_real_escape_string($conn, $_POST['otp']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        // Retrieve OTP from the database for the entered email
        $query = "SELECT otp FROM tbl_admin_credentials WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_otp = $row['otp'];
            // Check if entered OTP matches the one stored in the database
            if ($entered_otp === $stored_otp) {
                // OTP verified, proceed with password reset
                $showPasswordField = true; // Show password fields
            } else {
                $errors['otp'] = "Invalid OTP. Please try again.";
            }
        } else {
            $errors['email'] = "Email not found. Please enter a valid email.";
        }
    }

    // Check if the form is submitted for password reset
    if (isset($_POST['reset_password'])) {
        // Validate and reset password
        $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        if ($new_password === $confirm_password) {
            // Passwords match, proceed with updating the password
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE tbl_admin_credentials SET password='$hashed_password' WHERE email='$email'";
            if (mysqli_query($conn, $update_query)) {
                // Password updated successfully
                $success_message = "Congrats, you changed the password!";
                // You may redirect the user to the login page or display a success message
                // header('Location: login.php');
                // exit();
            } else {
                $errors['password'] = "Error updating password. Please try again.";
            }
        } else {
            $errors['password'] = "Passwords do not match.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>

    <link rel="shortcut icon" type="x-icon" href="GP.png">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("pattern.svg");
            background-size: 8%;
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
            width: 60%;
            /* Adjust width as needed */
            max-width: 500px;
            /* Set a maximum width */
            height: 95%;
            margin: auto;
            padding: 40px;
            /* Increase padding */
            border: 1px solid #443a16;
            border-radius: 10px;
            /* Increase border radius */
            background-color: black;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            /* Increase shadow */
        }

        .login-form {
            width: 60%;
            /* Adjust width as needed */
            max-width: 500px;
            /* Set a maximum width */
            height: 95%;
            margin: auto;
            padding: 50px;
            /* Increase padding */
            border: 1px solid #fdf3cf;
            border-radius: 10px;
            /* Increase border radius */
            background-color: #fdf3cf;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            /* Increase shadow */
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
            font-size: 1.2em;
            /* Use relative units for font size */
        }


        .login-form-right select {
            background-color: #fdf3cf;
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
            <!-- Your left section content -->
            <div class="col-md-6 left-section login-section">
                <!-- Display notes here -->
                <div class="notes-container">
                    <!-- Table to display notes -->
                </div>
            </div>
            <!-- Your right section content -->
            <div class="col-md-6 login-section">
                <div class="login-form-right">
                    <form id="loginForm" method="POST" autocomplete="">
                        <img class="img-fluid" src="img/logo.png" width="85">
                        <div class="gp-letter">
                        </div>
                        <br><br>
                        <?php if (isset($success_message)): ?>
                            <!-- Display success message -->
                            <div class="alert alert-success">
                                <?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (count($errors) > 0): ?>
                            <!-- Display errors -->
                            <div class="alert alert-danger">
                                <?php foreach ($errors as $error): ?>
                                    <p><?php echo $error; ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($message)): ?>
                            <!-- Display success message -->
                            <div class="alert alert-success">
                                <p><?php echo $message; ?></p>
                            </div>
                        <?php endif; ?>
                        <br><br>
                        <b>
                            <h2 class="text-white mb-3">Forgot Password</h2>
                        </b>
                        <div class="form-group">
                            <label for="email" class="text-white mb-4">Email:</label>
                            <input class="form-control" type="email" name="email" required value="<?php echo $email; ?>">
                        </div>
                        <?php if (!$showOTPField && !$showPasswordField): ?>
                            <!-- Button to send OTP -->
                            <button class="form-control btn btn-primary mt-4" type="submit" name="send_otp">SEND OTP</button>
                        <?php endif; ?>
                        <?php if ($showOTPField): ?>
                            <!-- Form field for OTP -->
                            <div class="form-group">
                                <label for="otp" class="text-white mb-4 mt-4">OTP:</label>
                                <input class="form-control" type="text" name="otp">
                            </div>
                            <!-- Button to verify OTP -->
                            <button class="form-control btn btn-primary mt-4" type="submit" name="verify_otp">VERIFY</button>
                        <?php endif; ?>
                        <?php if ($showPasswordField): ?>
                            <!-- Form fields for password reset -->
                            <div class="form-group">
                                <label for="new_password" class="text-white mb-4">New Password:</label>
                                <input class="form-control" type="password" name="new_password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="text-white mb-4">Confirm New Password:</label>
                                <input class="form-control" type="password" name="confirm_password">
                                <?php if (isset($errors['password'])): ?>
                                    <!-- Display error message for password mismatch -->
                                    <p class="text-danger"><?php echo $errors['password']; ?></p>
                                <?php endif; ?>
                            </div>
                            <!-- Button to reset password -->
                            <button class="form-control btn btn-primary mt-4" type="submit" name="reset_password">Reset Password</button>
                        <?php endif; ?>

                        <br><br>
                        <center>
                            <!-- Link to login page -->
                            <a class="text-white" href="user_login.php">Already have an account? Login.</a>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    function updateFormAction() {
        var userType = document.getElementById('user_type').value;
        var loginForm = document.getElementById('loginForm');
        if (userType === 'Admin') {
            loginForm.action = 'user_login.php';
        } else if (userType === 'User') {
            loginForm.action = 'user_login.php';
        }
    }
</script>