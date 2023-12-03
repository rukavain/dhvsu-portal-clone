<?php
include('database.php');
// if (!(isset($_SESSION['user_role']))) {
//     header("Location: login_student.php");
// }

try {

    // Retrieve form data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start_date = $_POST['dateStart'];
        $end_date = $_POST['dateEnd'];

        // Prepare SQL statement
        $sql = "INSERT INTO announcement_tbl (title, description, start_date, end_date) 
        VALUES (:title, :description, :start_date, :end_date)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);

        // Execute the prepared statement
        $stmt->execute();

        // Redirect after successful insertion (you can modify the location as needed)
        header('Location: dashboard_04_announcement.php');
        exit(); // Ensure that subsequent code does not execute after redirection
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
