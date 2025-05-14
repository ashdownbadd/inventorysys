<?php
session_start();
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the entered OTP matches the one sent via email
    $enteredOTP = mysqli_real_escape_string($conn, $_POST['entered_otp']);
    $storedOTP = $_SESSION['otp']; // Retrieve the OTP sent via email (you need a database field to store this)

    if ($enteredOTP == $storedOTP) {
        $_SESSION['is_verified'] = true; // Mark the user as verified
        header('Location: admin/admin_dashboard.php'); // Redirect to the dashboard
        exit();
    } else {
        $_SESSION['error'] = "Incorrect OTP. Entered: $enteredOTP";
        header('Location: verification.php'); // Redirect back to verification page
        exit();
    }
}
?>
<style>
body {
        background-image:url("bckgnd.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        }
        .login-section {
            height: 90vh;
            display: flex;
            vertical-align: right;
            align-items: center;
        }
    
        .login-form-right {
            width: 30%; /* Adjust width as needed */
            max-width: 350px; /* Set a maximum width */
            height: 20%;
            vertical-align: right;
            padding: 50px; /* Increase padding */
            border: 1px solid #443a16;
            margin-left: 785px;
            border-radius: 10px; /* Increase border radius */
            background-color: #443a16;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Increase shadow */
            align-items: center;
        }

.alert {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
    padding: .75rem 1.25rem;
    align-items: center;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
}

h2 {
    font-size: 15px;
    margin-bottom: 20px;
    margin-left: 40px;
    align-items: center;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    
}

input[type="text"] {
    width: 80%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button {
    padding: 10px 20px;
    background-color: #ffc805;
    color: #fff;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #ffc805;
}

/* Responsive styles */
@media (max-width: 768px) {
    .container {
        width: 80%;
    }
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Verification</title>

    <!-- Custom fonts for this template-->
    <link rel="shortcut icon" type="x-icon" href="GP.png">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>
<body>
    <div class="col-md-6 login-section">
    <div class="login-form-right">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <h2>Enter code:</h2>
        <form action="verification.php" method="post">
            <input type="text" name="entered_otp" placeholder="Enter code" required>
            <button type="submit">Verify</button>
        </form>
    </div>
</body>
</html>
