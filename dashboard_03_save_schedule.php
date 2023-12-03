<?php
require_once('database.php');
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script> alert('Error: No data to save.'); location.replace('./dashboard_01.php') </script>";
    $conn = null;
    exit;
}
extract($_POST);


// Check if 'allday' is set
$allday = isset($_POST['allday']) ? $_POST['allday'] : 0;

// Prepare data for insertion or update
$id = isset($_POST['id']) ? $_POST['id'] : null;
$title = htmlspecialchars($_POST['title']);
$description = htmlspecialchars($_POST['description']);
$start_datetime = htmlspecialchars($_POST['start_datetime']);
$end_datetime = htmlspecialchars($_POST['end_datetime']);

if (empty($id)) {
    $sql = "INSERT INTO `schedule_list` (`title`,`description`,`start_datetime`,`end_datetime`) VALUES (:title, :description, :start_datetime, :end_datetime)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':start_datetime', $start_datetime);
    $stmt->bindParam(':end_datetime', $end_datetime);
} else {
    $sql = "UPDATE `schedule_list` SET `title` = :title, `description` = :description, `start_datetime` = :start_datetime, `end_datetime` = :end_datetime WHERE `id` = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':start_datetime', $start_datetime);
    $stmt->bindParam(':end_datetime', $end_datetime);
    $stmt->bindParam(':id', $id);
}

try {
    $stmt->execute();
    echo "<script> alert('Schedule Successfully Saved.'); location.replace('./dashboard_01.php') </script>";
} catch (PDOException $e) {
    echo "<pre>";
    echo "An Error occurred.<br>";
    echo "Error: " . $e->getMessage() . "<br>";
    echo "SQL: " . $sql . "<br>";
    echo "</pre>";
}

$conn = null; // Close the connection