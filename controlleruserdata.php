<?php 
session_start();
require "connection.php";

// Initialize variables
$username = "";
$email = "";
$name = "";
$errors = array();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

require 'vendor/phpmailer/PHPMailer/src/Exception.php';
require 'vendor/phpmailer/PHPMailer/src/PHPMailer.php';
require 'vendor/phpmailer/PHPMailer/src/SMTP.php';



// Define PHPMailer instance
$mail = new PHPMailer(true);

// Set email configuration (you can move these to a separate file)
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'jinparkinson@gmail.com';
$mail->Password = 'qtlx vmci xfkk hrpx';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Function to send OTP email
function sendOTP($userEmail, $otp, $mail) {
  $mail->setFrom('jinparkinson@gmail.com', 'Mailer');
  $mail->addAddress($userEmail);
  $mail->Subject = "Your Login OTP for Gratify Projects";
  $mail->Body = "Your login OTP is: $otp. Please enter this code to verify your login.";

  try {
    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }
}

$errors = []; // Initialize errors array

    //if user click verification code submit button
    if (isset($_POST["login"])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $check_username_admin_ = "SELECT * FROM tbl_admin_credentials WHERE username = '$username'";
        $res_admin = mysqli_query($conn, $check_username_admin);
    
        if (mysqli_num_rows($res) > 0) {
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass_admin = $fetch['password'];
            if (password_verify($password, $fetch_pass_admin)) {
                $_SESSION['username'] = $username;
                // Generate a random verification code
                $verificationCode = mt_rand(100000, 999999);
                $_SESSION['verification_code'] = $verificationCode;
                // Redirect to the verification page
                header('Location: verification_page.php');
                exit();
            } else {
                $errors['username'] = "Incorrect username or password!";
            }
        } else {
            $errors['username'] = "Incorrect username or password!";
        }
    }

// Handle form submission
else if (isset($_POST["login_user"])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the username exists in admin credentials
    $check_username_admin = "SELECT * FROM tbl_admin_credentials WHERE username = '$username'";
    $res_admin = mysqli_query($conn, $check_username_admin);

    if (mysqli_num_rows($res_admin) > 0) {
        // If the username exists in admin credentials, verify the password
        $fetch_admin = mysqli_fetch_assoc($res_admin);
        $fetch_pass_admin = $fetch_admin['password'];

        
        if (password_verify($password, $fetch_pass_admin)) {
            $_SESSION['username'] = $username;
      
            // Redirect to the admin dashboard
            header("Location: admin/admin_dashboard.php");
            exit();
        } else {
            $errors[] = "Incorrect username or password!";
        }
    } else {
        // Check if the username exists in user credentials
        $check_username_user = "SELECT * FROM tbl_user_credentials WHERE username = '$username'";
        $res_user = mysqli_query($conn, $check_username_user);

        if (mysqli_num_rows($res_user) > 0) {
            // If the username exists in user credentials, verify the password
            $fetch_user = mysqli_fetch_assoc($res_user);
            $fetch_pass_user = $fetch_user['password'];

            if (password_verify($password, $fetch_pass_user)) {
                $_SESSION['username'] = $username;
            
                // Redirect to the user dashboard
                header("Location: user/user_dashboard.php");
                exit();
            } else {
                $errors[] = "Incorrect username or password!";
            }
        } 
    }
}


// Verify OTP (move to separate verification page)
if (isset($_POST["verify_otp"])) {
    $enteredOtp = mysqli_real_escape_string($conn, $_POST['otp']);

    if ($enteredOtp === $_SESSION['otp']) {
        // $_SESSION['is_verified'] = true;
        // ... Redirect or grant access ...
    } else {
        $errors['otp'] = "Invalid OTP! Please try again.";
    }
}

// If login now button click
if (isset($_POST['login-now'])) {
    header('Location: user_login.php');
}

?>