<?php
session_start();
$role = $_SESSION['user_role'];
session_unset();
session_destroy();


if ($role == "Admin") {
    header("Location: login_admin.php ");
} else {
    header("Location: login_student.php ");
}


exit;
