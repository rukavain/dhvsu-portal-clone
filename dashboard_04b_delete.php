<?php
session_start();
include("database.php");
// if (!(isset($_SESSION['user_role']))) {
//     header("Location: login_student.php");
// }


$id = $_GET['id'];

// Prepare the DELETE statement
$sql = "DELETE FROM announcement_tbl WHERE id = :id";
$stmt = $conn->prepare($sql);

// Bind the parameter
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Execute the query
$stmt->execute();
header('location: dashboard_04_announcement.php');
