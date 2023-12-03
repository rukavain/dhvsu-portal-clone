<?php include('database.php') ?>
<?php
session_start();
if (!(isset($_SESSION['user_role']))) {
    header("Location: login_student.php");
}

$isAdmin = ($_SESSION['user_role'] == 'Admin') ? true : false;

$result = null;
// Retrieve the dataId from the URL parameter if it's set and contains only numbers
if (isset($_GET['dataId'])) {
    $dataId = $_GET['dataId'];

    // Check if $dataId contains only numbers
    if (ctype_digit($dataId)) {
        // Database connection (include your database.php file or establish the connection here)
        include('database.php'); // Adjust this according to your database connection setup

        try {
            // Check if $dataId exists in the schedule_list table
            $stmt_schedule = $conn->prepare("SELECT * FROM schedule_list WHERE id = :dataId");
            $stmt_schedule->bindParam(':dataId', $dataId);
            $stmt_schedule->execute();

            $rowCount_schedule = $stmt_schedule->rowCount();

            // Check if $dataId exists in the registered_participants_tbl table's event_id column
            $stmt_participants = $conn->prepare("SELECT * FROM registered_participants_tbl WHERE event_id = :dataId");
            $stmt_participants->bindParam(':dataId', $dataId);
            $stmt_participants->execute();
            // Store all fetched records in a variable using fetchAll()
            $fetchedRecords = $stmt_participants->fetchAll(PDO::FETCH_ASSOC);
            $rowCount_participants = $stmt_participants->rowCount();

            // Check if $dataId exists in schedule_list table and registered_participants_tbl table
            if ($rowCount_schedule > 0) {
                //echo "Data-id exists in the schedule_list table: " . htmlspecialchars($dataId);
                // Check if $dataId exists in registered_participants_tbl table
                if ($rowCount_participants > 0) {
                    //echo "Data-id exists in the registered_participants_tbl table: " . htmlspecialchars($dataId);
                    // Proceed with additional logic here if needed


                    //para sa loob na ng table to , ung reiterating
                    // Prepare the SQL query
                    $sql = "SELECT reg.acc_fname, reg.acc_lname, reg.acc_mail, reg.acc_gender, evt.title
                                            FROM registered_participants_tbl AS rp
                                            INNER JOIN reg_accountstbl AS reg ON rp.stud_id = reg.acc_id
                                            INNER JOIN schedule_list AS evt ON rp.event_id = evt.id AND rp.event_id = $dataId";

                    // Prepare the statement
                    $stmt = $conn->prepare($sql);

                    // Execute the statement
                    $stmt->execute();

                    // Fetch records
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    //echo "Data-id has 0 Participants";
                    // Additional logic if $dataId does not exist in the participants table
                }
            } else {
                echo "<script> 
                    alert('Data-id does not exist in the schedule_list table.'); 
                    window.location.href = 'dashboard_01.php';
                </script>";
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    } else {

        // Handle the case where dataId is not numeric
        echo "<script> 
                    alert('Invalid data-id parameter. It should contain only numeric characters.'); 
                    window.location.href = 'dashboard_01.php';
                </script>";
    }
} else {

    // Handle the case where dataId parameter is not present in the URL
    echo "<script> 
                    alert('No data-id parameter received.'); 
                    window.location.href = 'dashboard_01.php';
                </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b9d712cc5d.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="sidebar-dashboard/css/style.css" />
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Poppins;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
    </style>
</head>

<body class="bg-light">
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="bg-danger">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-dark">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4 pt-5 h-100 d-flex flex-column justify-content-between">
                <div>
                    <h1><a href="dashboard_01.php" class="logo">
                        <img class="img-fluid" src="./images/logo.png" alt="">
                    </a></h1>
                    <ul class="list-unstyled components mb-5">
                        <li>
                            <a href="dashboard_04_announcement.php">Announcement</a>
                        </li>

                        <?php if ($isAdmin) {
                            echo <<< HTML
                                            <li>
                                                <a href="signup_admin_01.php">Register New Admin</a>
                                            </li>
                                            <li>
                                                <a href="dashboard_05_create_announcement.php">Create Announcements</a>
                                            </li>
                                    HTML;
                        } ?>
                        <li>
                            <a href="dashboard_01.php">Calendar Event</a>
                        </li>
                        <!-- Add more sidebar links as needed -->
                    </ul>
                </div>

                <div>
                    <ul class="list-unstyled components">
                        <li>
                            <a href="logout_01.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
        <!-- PUT INCLUDE FILE HERE -->
        <?php include("dashboard_06a_viewParticipants-tab.php"); ?>
        <!-- END OF PUT INCLUDE FILE HERE -->

    </div>

</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./js/script.js"></script>
<script src="sidebar-dashboard/js/jquery.min.js"></script>
<script src="sidebar-dashboard/js/popper.js"></script>
<script src="sidebar-dashboard/js/bootstrap.min.js"></script>
<script src="sidebar-dashboard/js/main.js"></script>

</html>