<?php
session_start();
if (isset($_COOKIE['cookieStudentEmail']) && isset($_COOKIE['cookieStudentPassword'])) {
    $cookieStudentEmail = $_COOKIE['cookieStudentEmail'];
    $cookieStudentPassword = $_COOKIE['cookieStudentPassword'];
} else {
    $cookieStudentEmail = "";
    $cookieStudentPassword = "";
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
    <div class="container col-md-10 mx-auto col-lg-5  float-end me-5 pe-5 login_form pt-5">
        <form action="login_01a_process.php" method="post" class="p-4 p-md-5 border rounded-3 bg-body-tertiary h-100 border border-danger border-2">

            <h3 class="text-center mb-2">Student Login</h3>

            <div class="form-floating mt-4 mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="username" name="usermail" required value="<?= $cookieStudentEmail ?>">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required value="<?= $cookieStudentPassword ?>">
                <label for="floatingPassword">Password</label>
            </div>
            <!-- Start of Error Notif -->
            <?php
            if (isset($_SESSION['wrong_credentials'])) {
            ?>
                <div class="alert alert-danger rounded-5 text-center py-2">
                    <small><strong>Failed:</strong> <?= $_SESSION['wrong_credentials'] ?></small>
                </div>

            <?php
                session_destroy();
            }
            ?>
            <!-- End of Error Notif -->
            <div class="form-check">
                <input class="form-check-input border shadow" type="checkbox" name="rememberMeStudent" id="rememberMe">
                <label class="form-check-label" for="rememberMe">
                    Remember Me
                </label>
            </div>
            <br>
            <div class="text-center">
                <input type="hidden" name="acc_role" value="Student">
                <button class="w-45 btn btn-lg btn-danger me-3" type="submit">Sign In</button>
                <button class="w-45 btn btn-lg btn-outline-danger" type="button" onclick="goAdminLogin()">Admin Login</button>
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
    function goAdminLogin() {
        // Redirect
        window.location.href = 'login_admin.php';
    }
</script>

</html>