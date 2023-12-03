<?php

session_start();
// Check if gatepass is not set in the session or if it's not equal to 'signup_03'
if (!isset($_SESSION['gatepass']) || $_SESSION['gatepass'] !== 'forgot_login_03') {
    header("Location: forgot_login_02.php");

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

    <!-- Use Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


</head>

<body>
    <?php include('school_header.php'); ?>

    <!-- Log In Form -->
    <div class="container col-md-10 mx-auto col-lg-5  pt-5">
        <form action="forgot_login_03a_process.php" method="post" onsubmit="return validatePassword()" class="p-4 p-md-5 border rounded-3 bg-body-tertiary h-100 ">


            <h3 class="text-center mb-5">Enter New Password</h3>

            <div class="form-floating mb-3 input-group">
                <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Password">
                <span class="input-group-text" id="basic-addon1">
                    <button class="visibility-eye" type="button" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </button>
                </span>

                <label for="floatingPassword">New Password</label>
            </div>

            <div class="form-floating mb-3 input-group">
                <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Password">
                <span class="input-group-text" id="basic-addon1">
                    <button class="visibility-eye" type="button" id="togglePassword1">
                        <i class="bi bi-eye"></i>
                    </button>
                </span>

                <label for="floatingPassword">Confirm Password</label>
            </div>


            <div class="text-center">
                <button class="w-45 btn btn-lg btn-danger me-3" type="submit">Confirm</button>

            </div>

            <hr class="my-4">
            <small class="text-body-secondary">
                Don't Have an Account? Register
                <a href="signup_01.php">
                    Here.
                </a>
            </small>
            <br>
            <small class="text-body-secondary">
                Have an Account? Sign
                <a href="login_student.php">
                    Here.
                </a>
            </small>

        </form>
    </div>

    <!-- CDN Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('pass1');

    togglePassword.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.querySelector('i').classList.toggle('bi-eye');
        this.querySelector('i').classList.toggle('bi-eye-slash');
    });


    const togglePassword1 = document.getElementById('togglePassword1');
    const passwordField1 = document.getElementById('pass2');

    togglePassword1.addEventListener('click', function() {
        const type = passwordField1.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField1.setAttribute('type', type);
        this.querySelector('i').classList.toggle('bi-eye');
        this.querySelector('i').classList.toggle('bi-eye-slash');
    });
</script>


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