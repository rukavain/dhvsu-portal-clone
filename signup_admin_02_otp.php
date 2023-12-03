<?php

session_start();
// Check if gatepass is not set in the session or if it's not equal to 'signup_03'
if (!isset($_SESSION['gatepass']) || $_SESSION['gatepass'] !== 'signup_admin_02') {
    header("Location: signup_admin_01.php");

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b9d712cc5d.js" crossorigin="anonymous"></script>
    <!-- CDN Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="css/login.css" />

</head>

<body>
    <?php include('school_header.php'); ?>

    <!-- Log In Form -->
    <div class="container col-md-10 mx-auto col-lg-5  pt-5">
        <form action="signup_admin_02a_process.php" method="post" class="p-4 p-md-5 border rounded-3 bg-body-tertiary h-100 ">


            <h3 class="text-center mb-2">Confirm your Identity</h3>
            <h6 class="text-secondary mt-3">We have sent an OTP to your email:</h6>

            <div class="form-floating mt-4 mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="username" name="inputted_otp">
                <label for="floatingInput">Enter 6-digit OTP</label>
            </div>


            <div class="text-center">
                <button class="w-45 btn btn-lg btn-danger me-3" type="submit">Verify</button>

            </div>

            <hr class="my-4">


        </form>
    </div>

    <!-- CDN Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>



</html>