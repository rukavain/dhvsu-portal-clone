<?php
session_start();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['inputted_otp'])) {
        $enteredOTP = $_POST['inputted_otp']; // Get the entered 6-digit OTP from the form

        // Check if OTP is set in the session
        if (isset($_SESSION['otp'])) {
            $storedOTP = $_SESSION['otp']; // Get the stored OTP from the session

            // Verify if entered OTP matches the stored OTP
            if ($enteredOTP == $storedOTP) {
                // OTP matched, perform actions (e.g., allow access, redirect, etc.)
                echo "OTP Verified!"; // Replace this with your logic
                $_SESSION['gatepass'] = 'signup_03';

                // Clear or unset the OTP from the session after verification (optional)
                unset($_SESSION['otp']);
                header("Location: signup_03_afterotp.php");
                exit();
            } else {
                // Incorrect OTP entered
                echo 'wrong otp entered';
                $_SESSION['wrongOTP'] = 'Incorrect OTP entered. Please try again.';
                header("Location: signup_02_otp.php");
                exit();
            }
        } else {
            // OTP not found in the session
            echo "OTP not found. Please generate a new OTP."; // Handle when OTP is not found
        }
    } else {
        // 'inputted_otp' field not set in the POST request
        echo "Invalid input data."; // Handle invalid input data
    }
} else {
    // Redirect or handle for invalid request method (GET request instead of POST)
    echo 'invalid request method';
    header("Location: signup_02_otp.php");
    exit();
}
