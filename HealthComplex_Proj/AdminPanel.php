<?php
if (session_status() === PHP_SESSION_NONE){session_start();}
include 'connectionDB.php';
include 'SecurityFunctions.php';
if(!preloggedin())
{
    unsetSessions();
    show_message('please login again.');
    echo '<script type="text/javascript">window.location.href="loginAdmin.php";</script>';
    show_message('please login again.');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>admin panel</title>
        <link rel="stylesheet" href="lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
        <script src="lib/jQuery/jquery-3.5.1.min.js"></script>
        <script src="lib/popper/popper.min.js"></script>
        <script src="lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <a href ="AddHotel.php">add a new hotel</a>
        <br>
        <a href ="AddHospital.php">add a new hospital</a>
        <br>
        <a href="edithotel.php">edit a hotel</a>
        <br>
        <a href="editHospital.php">edit a hospital</a>
        <br>
        <a href="EditTours.php">edit tours</a>
        <br>
        <a href="Trips.php">see trips</a>
    </body>
</html>
