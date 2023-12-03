<?php
session_start();
include('database.php');

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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted email from the form
    $submittedEmail = $_POST['email'];

    try {
        // Prepare the SQL statement to check if the email exists in the database
        $stmt = $conn->prepare("SELECT * FROM reg_accountstbl WHERE acc_mail = :email");
        $stmt->bindParam(':email', $submittedEmail);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Email exists in the database
            $_SESSION['email'] = $submittedEmail;

            // Proceed with the logic for sending a reset link or resetting the password

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
                $otp = mt_rand(
                    100000,
                    999999
                );



                // Store the OTP in a session variable
                $_SESSION['otp'] = $otp;

                //gatepass
                $_SESSION['gatepass'] = 'forgot_login_02';



                // Email content and sending logic
                $mail->setFrom('yashica.cz3@gmail.com', 'OTP Verification');
                $mail->addAddress($submittedEmail);
                $mail->Subject = 'Your 6-digit OTP';
                $mail->Body = "Your OTP for verification is: $otp";

                // Sending email
                $mail->send();
                echo 'Email sent successfully.';

                header("Location: forgot_login_02_otp.php");
                exit(); // Ensure that subsequent code doesn't execute after redirection
            } catch (Exception $e) {
                echo "Failed to send email. Error: {$mail->ErrorInfo}";
            }

            // end of sending mail


            // You can redirect to a page for sending reset instructions
            header("Location: forgot_login_02_otp.php");
            exit();
        } else {
            // Email does not exist in the database
            $_SESSION['wrong_credentials'] = 'Email is not yet registered nor exists.';
            header("Location: forgot_login_01.php"); // Redirect back to the forgot password page
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Handle database connection or query errors
    }
} else {
    header("Location: forgot_login_01.php"); // Redirect back to the forgot password page
    exit();
}
