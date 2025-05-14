<?php
session_start();
require "connection.php";

// if (!isset($_SESSION['username']) || !isset($_SESSION['otp'])) {
//     // If the user is not logged in or already verified, redirect back to login page
//     header('Location: user_login.php');
//     exit();
// }

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
        header('Location: verification_page.php'); // Redirect back to verification page
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification</title>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <h2>Enter OTP sent to your email</h2>
        <form action="verification_page.php" method="post">
            <input type="text" name="entered_otp" placeholder="Enter OTP" required>
            <button type="submit">Verify OTP</button>
        </form>
    </div>
</body>
</html>
