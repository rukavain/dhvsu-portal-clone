<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the submitted email and password from the form
    $submittedEmail = $_POST['usermail'];
    $submittedPassword = $_POST['password'];
    $submittedAccRole = $_POST['acc_role'];


    try {
        // Prepare the SQL statement to retrieve the user's data from the database
        $stmt = $conn->prepare("SELECT * FROM reg_accountstbl WHERE acc_mail = :email AND acc_role = :acc_role");

        $stmt->bindParam(':email', $submittedEmail);
        $stmt->bindParam(':acc_role', $submittedAccRole);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the submitted password against the stored hashed password
            if (password_verify($submittedPassword, $user['acc_pass'])) {
                // Passwords match, login successful
                $_SESSION['user_id'] = $user['acc_id']; // You can store the user's ID in the session for future use
                $_SESSION['user_role'] = $user['acc_role'];
                $_SESSION['user_regEvents'] = getEventIdsForCurrentUser($conn);

                //if successful login, then store sa cookie
                if (isset($_REQUEST['rememberMeStudent'])) {
                    if ($submittedAccRole == "Admin") {
                        setcookie('cookieAdminEmail', $_REQUEST['usermail'], time() + 3600, "/");
                        setcookie('cookieAdminPassword', $_REQUEST['password'], time() + 3600, "/");
                    } elseif ($submittedAccRole == "Student") {
                        setcookie('cookieStudentEmail', $_REQUEST['usermail'], time() + 3600, "/");
                        setcookie('cookieStudentPassword', $_REQUEST['password'], time() + 3600, "/");
                    }
                } else {
                    if ($submittedAccRole == "Admin") {
                        setcookie('cookieAdminEmail', $_REQUEST['usermail'], time() - 1, "/");
                        setcookie('cookieAdminPassword', $_REQUEST['password'], time() - 1, "/");
                    } else {
                        setcookie('cookieStudentEmail', $_REQUEST['usermail'], time() - 1, "/");
                        setcookie('cookieStudentPassword', $_REQUEST['password'], time() - 1, "/");
                    }
                }


                header("Location: dashboard_01.php"); // Redirect to the dashboard or logged-in area
                exit();
            } else {
                // Incorrect password
                $_SESSION['wrong_credentials'] = 'Incorrect email or password';
                // Redirect the user back to the previous page
                if (isset($_SERVER['HTTP_REFERER'])) {
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                } else {
                    // Redirect to a default page if HTTP_REFERER is not set
                    header("Location: login_student.php");
                }
                exit();
            }
        } else {
            // User not found with the provided email
            $_SESSION['wrong_credentials'] = 'User not found';
            // Redirect the user back to the previous page
            if (isset($_SERVER['HTTP_REFERER'])) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
            } else {
                // Redirect to a default page if HTTP_REFERER is not set
                header("Location: login_student.php");
            }
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Handle database connection or query errors
    }
}


function getEventIdsForCurrentUser($conn)
{
    $eventIds = array();

    try {
        // Retrieve records where stud_id matches the current user's ID
        $stmt = $conn->prepare("SELECT event_id FROM registered_participants_tbl WHERE stud_id = :userId");
        $userId = $_SESSION['user_id'];
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        // Fetch all event_id values and store them in an array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $eventIds[] = $row['event_id'];
        }
    } catch (PDOException $e) {
        // Handle errors here
        echo "Error: " . $e->getMessage();
    }

    return $eventIds;
}
