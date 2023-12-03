<?php
// if (!(isset($_SESSION['user_role']))) {
//     header("Location: login_student.php");
// }


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dhvsu";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully.";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
