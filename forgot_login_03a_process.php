<?php
session_start();
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the pass from the form
    $newPass = $_POST['pass1'];
    $usermail = $_SESSION['email'];
    $hashedPassword = password_hash($newPass, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("UPDATE reg_accountstbl SET acc_pass = :password WHERE acc_mail = :email");

        // Bind parameters
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $usermail);

        $stmt->execute();

        echo "Updated Successfully";
        $conn = null; // Close the connection

        header("Location: login_student.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect the user back if this url is not accessed via post method
    header("Location: forgot_login_03_newpass.php");
    exit();
}
