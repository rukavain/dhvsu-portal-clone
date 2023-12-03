<?php require_once('dashboard_00_db-connect.php') ?>
<link rel="icon" type="image/png" href="announcement-form/images/icons/favicon.ico" />
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="announcement-form/vendor/bootstrap/css/bootstrap.min.css" />
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="announcement-form/fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="announcement-form/vendor/animate/animate.css" />
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="announcement-form/vendor/css-hamburgers/hamburgers.min.css" />
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="announcement-form/vendor/select2/select2.min.css" />
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="announcement-form/css/util.css" />
<link rel="stylesheet" type="text/css" href="announcement-form/css/main.css" />
<!--===============================================================================================-->

<div class="container-contact1 h-100 vh-100">
    <div class="contact1-pic js-tilt" data-tilt>
        <img src="announcement-form/images/img-01.png" alt="IMG" />
    </div>

    <form class="contact1-form validate-form" action="dashboard_05b_process.php" method="post">
        <span class="contact1-form-title"> Announce News or Events </span>

        <div class="wrap-input1 validate-input">
            <input class="input1" type="text" name="title" placeholder="Title" required />
            <span class="shadow-input1"></span>
        </div>

        <div class="wrap-input1 validate-input">
            <textarea class="input1" name="description" placeholder="Description" required></textarea>
            <span class="shadow-input1"></span>
        </div>

        <div class="wrap-input1 validate-input">
            <label for="">Start Date</label>
            <input class="input1" type="datetime-local" name="dateStart" placeholder="Start Date" required />
            <span class="shadow-input1"></span>
        </div>

        <div class="wrap-input1 validate-input">
            <label for="">End Date</label>
            <input class="input1" type="datetime-local" name="dateEnd" placeholder="End Date" required>
            <span class="shadow-input1"></span>
        </div>



        <div class="container-contact1-form-btn">
            <button class="contact1-form-btn" type="submit">
                <span>
                    Publish
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                </span>
            </button>
            <button type="reset" class="contact1-form-btn">
                <span>
                    Clear
                </span>
            </button>
        </div>
    </form>
</div>
<!--===============================================================================================-->
<script src="announcement-form/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="announcement-form/vendor/bootstrap/js/popper.js"></script>
<script src="announcement-form/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="announcement-form/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="announcement-form/vendor/tilt/tilt.jquery.min.js"></script>
<script>
    $(".js-tilt").tilt({
        scale: 1.3,
    });
</script>

<!--===============================================================================================-->
<script src="announcement-form/js/main.js"></script>