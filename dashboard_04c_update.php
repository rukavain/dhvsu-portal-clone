<?php require_once('dashboard_00_db-connect.php') ?>
<?php
// if (!(isset($_SESSION['user_role']))) {
//     header("Location: login_student.php");
// }

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Establish your database connection (replace with your connection details)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dhvsu";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare a statement to check if the provided ID exists in the database
        $stmt = $conn->prepare("SELECT * FROM announcement_tbl WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // ID exists in the database
            $id = $result['id'];
            $title = $result['title'];
            $description = $result['description'];
            $start_date = $result['start_date'];
            $end_date = $result['end_date'];
        } else {
            // ID does not exist in the database
            echo "<script>alert('Invalid ID Parameter');</script>";
            header('location: dashboard_04_announcement.php');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No 'id' parameter found in the URL.";
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
            font-family: Apple Chancery, cursive;
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

<body class="bg-light vh-100 h-100">
    <div class="wrapper d-flex align-items-stretch vh-100 h-100">
        <nav class="bg-danger" id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-dark">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4 pt-5">
                <h1><a href="index.html" class="logo">
                    <img class="img-fluid" src="./images/logo.png" alt="">
                </a></h1>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="dashboard_04_announcement.php">Announcement</a>
                    </li>
                    <li>
                        <a href="dashboard_05_create_announcement.php">Create Announcements</a>
                    </li>
                    <li>
                        <a href="dashboard_01.php">Calendar Event</a>
                    </li>
                </ul>

                <div class="mb-5"></div>
            </div>
        </nav>
        <!-- PUT INCLUDE FILE HERE -->
        <?php include("dashboard_04c1.php"); ?>
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