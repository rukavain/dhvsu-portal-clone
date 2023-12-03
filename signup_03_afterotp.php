<?php

session_start();

// Check if gatepass is not set in the session or if it's not equal to 'signup_03'
if (!isset($_SESSION['gatepass']) || $_SESSION['gatepass'] !== 'signup_03') {
    header("Location: signup_02_otp.php");

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

<body class="bg-image" style="--bs-bg-opacity: .5; background-image: url('./images/login-background.jpg'); height:auto; width:auto;">
    <?php include('school_header.php'); ?>

    <!-- Log In Form -->
    <div class="container col-md-10 mx-auto col-lg-5  pt-5">
        <form action="signup_03a_process.php" method="post" onsubmit="return validatePassword()" class="p-4 p-md-5 border rounded-3 bg-body-tertiary h-100 ">


            <h3 class="text-center mb-2">Sign Up</h3>

            <div class="form-floating mt-4 mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="First Name" name="fname" required>
                <label for="floatingInput">First Name</label>
            </div>

            <div class="form-floating mt-4 mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Last Name" name="lname" required>
                <label for="floatingInput">Last Name</label>
            </div>


            <div class="form-floating mt-4 mb-3">
                <input type="password" class="form-control" id="pass1" placeholder="Password" name="pass1" required>
                <label for="floatingInput">Password</label>
            </div>

            <div class="form-floating mt-4 mb-3">
                <input type="password" class="form-control" id="pass2" placeholder="Confirm Password" name="pass2" required>
                <label for="floatingInput">Confirm Password</label>
            </div>

            <div class="form-floating mt-4 mb-3 text-center">
                <div class="form-check form-check-inline me-5">
                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" required>
                    <label class="form-check-label" for="inlineRadio1">MALE</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" required>
                    <label class="form-check-label" for="inlineRadio2">FEMALE</label>
                </div>

            </div>



            <div class="text-center">
                <button class="w-45 btn btn-lg btn-danger me-3" type="submit">Confirm</button>
            </div>

            <hr class="my-4">


            <small class="text-body-secondary">
                Have an Account? Sign
                <a href="login_student.php">
                    Here.
                </a>
            </small>
            <br>
            <small class="text-body-secondary">

                <a href="forgot_login_01.php">
                    Forgot Password?
                </a>
            </small>

        </form>
    </div>

    <!-- CDN Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


<script>
    function validatePassword() {
        var pass1 = document.getElementById('pass1').value;
        var pass2 = document.getElementById('pass2').value;

        if (pass1 !== pass2) {
            alert("Passwords do not match!");
            return false; // Prevent form submission if passwords don't match
        }

        return true; // Proceed with form submission if passwords match
    }
</script>

</html>