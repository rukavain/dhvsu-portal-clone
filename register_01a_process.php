<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventID = $_POST['regid'];
    $studentID = $_POST['studentid'];

    try {
        // Check if the combination of studentID and eventID already exists in the table
        $stmt_check = $conn->prepare("SELECT COUNT(*) AS count_records FROM registered_participants_tbl WHERE stud_id = :studentID AND event_id = :eventID");
        $stmt_check->bindParam(':studentID', $studentID);
        $stmt_check->bindParam(':eventID', $eventID);
        $stmt_check->execute();
        $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

        // If the count of records is 0 (no existing record), proceed with insertion
        if ($result['count_records'] == 0) {
            // Prepare the SQL statement for insertion
            $stmt_insert = $conn->prepare("INSERT INTO registered_participants_tbl (stud_id, event_id) VALUES (:studentID, :eventID)");
            $stmt_insert->bindParam(':studentID', $studentID);
            $stmt_insert->bindParam(':eventID', $eventID);
            $stmt_insert->execute();

            echo "<script> 
                    alert('You have successfully registered for this event.'); 
                    window.location.href = 'dashboard_01.php';
                </script>";
        } else {

            echo "<script> 
                    alert('This student is already registered for this event.'); 
                    window.location.href = 'dashboard_01.php';
                </script>";
        }
    } catch (PDOException $e) {
        // Error handling for database operation
        echo "Error: " . $e->getMessage();
    }
}
