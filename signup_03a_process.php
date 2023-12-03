<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acc_role = 'Student';
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $usermail = $_SESSION['usermail'];
    $password = $_POST['pass1'];
    $gender = $_POST['gender'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO reg_accountstbl (acc_role, acc_gender, acc_fname, acc_lname, acc_mail, acc_pass) 
        VALUES (:acc_role, :acc_gender, :fname, :lname, :email, :password)");
        $stmt->bindParam(':acc_role', $acc_role);
        $stmt->bindParam(':acc_gender', $gender);
        $stmt->bindParam(':fname', $firstName);
        $stmt->bindParam(':lname', $lastName);
        $stmt->bindParam(':email', $usermail);
        $stmt->bindParam(':password', $hashedPassword);

        $stmt->execute();

        echo "New record inserted successfully";
        $conn = null; // Close the connection

        header("Location: login_student.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect the user back if this url is not accessed via post method
    header("Location: signup_03_afterotp.php");
    exit();
}
