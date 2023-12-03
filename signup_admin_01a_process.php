<?php
// Start a PHP session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the email from the form
    $usermail = $_POST['usermail'];

    $_SESSION['gatepass'] = 'signup_admin_02';
    $_SESSION['usermail'] = $usermail;
} else {
    // Redirect the user back if this url is not accessed via post method
    header("Location: signup_admin_01.php");
    exit();
}



require 'vendor/autoload.php'; // Path to your PHPMailer autoload.php file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

// Your Gmail OAuth2 credentials
$clientId = '21581254991-vsdg3pb7dgccj95qglnkslojm3ncqkke.apps.googleusercontent.com';
$clientSecret = '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';
$refreshToken = '1//04y0t_CH_uAFmCgYIARAAGAQSNwF-L9IrEvtdE3DW8TT60kfeo71crQj73pXWMlQ_Tw0WZ5WciorL3qq6uEOaJA_twvuxOWgG0BA'; // Replace with your actual refresh token



$mail = new PHPMailer(true);

try {
    // SMTP configuration for Gmail with OAuth 2.0
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->AuthType = 'XOAUTH2';
    $mail->Username = 'yashica.cz3@gmail.com'; // Your Gmail email address
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port = 587; // Port number

    // Set OAuth2 authentication
    $provider = new Google([
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
    ]);

    $mail->setOAuth(
        new OAuth([
            'provider' => $provider,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'refreshToken' => $refreshToken,
            'userName' => 'yashica.cz3@gmail.com', // Your Gmail email address
        ])
    );

    // Generating 6-digit OTP
    $otp = mt_rand(100000, 999999);



    // Store the OTP in a session variable
    $_SESSION['otp'] = $otp;



    // Email content and sending logic
    $mail->setFrom('yashica.cz3@gmail.com', 'OTP Verification');
    $mail->addAddress($usermail);
    $mail->Subject = 'Your 6-digit OTP';
    $mail->Body = "Your OTP for verification is: $otp";

    // Sending email
    $mail->send();
    echo 'Email sent successfully.';

    header("Location: signup_admin_02_otp.php");
    exit(); // Ensure that subsequent code doesn't execute after redirection
} catch (Exception $e) {
    echo "Failed to send email. Error: {$mail->ErrorInfo}";
}
