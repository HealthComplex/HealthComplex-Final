<?php
if(session_status()===PHP_SESSION_NONE){session_start();}
include 'connectionDB.php';

$query = "SELECT * FROM tripplan";
$s = $pdo -> prepare($query);
$s -> execute();
$rows = $s -> fetchAll();

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
    <title>trips</title>
    <link rel="stylesheet" href="lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <script src="lib/jQuery/jquery-3.5.1.min.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <script src="lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>UserName</th>
                    <th>StartDate</th>
                    <th>EndDate</th>
                    <th>Vehicle</th>
                    <th>VIP</th>
                    <th>TotalCost</th>
                    <th>click</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(isset($rows) and count($rows)>0)
            {
                foreach($rows as $row)
                {
                    if(count($row))
                    {
                        $query = "SELECT username FROM user WHERE id=:id";
                        $s = $pdo -> prepare($query);
                        $s -> bindValue(':id',$row['iduser']);
                        $s ->execute();
                        $username = $s -> fetch();
                        echo '<tr>';
                        echo '<td>'.$username['username'].'</td>';
                        echo '<td>'.$row['startdate'].'</td>';
                        echo '<td>'.$row['enddate'].'</td>';
                        echo '<td>'.$row['vehicle'].'</td>';
                        echo '<td>'.$row['VIP'].'</td>';
                        echo '<td>'.$row['totalcost'].'</td>';
                        echo '<td><form method="POST"><input type="hidden" name="tripId" value="'.$row['id'].'" >'.'<input type="submit" name="click" value="click" class="btn-primary">'."</form></td>";
                        echo '</tr>';
                    }
                }
            }
            ?>
            </tbody>
            </thead>
            <div id="#trip"></div>
        </table>

        <?php
        if(isset($_POST['click']) and preloggedin())
        {
            if(isset($_POST['tripId']))
            {
                $query = "SELECT * FROM tripplan WHERE id=:TripId";
                $s = $pdo -> prepare($query);
                $s -> bindValue(':TripId',$_POST['tripId']);
                $s -> execute();
                $row = $s -> fetch();
                $start = $row['startdate'];
                $end =  $row['enddate'];
                $comment = $row['comment'];
                $vehicle = $row['vehicle'];
                $VIP = $row['VIP'];
                $totalCost = $row['totalcost'];

                $query = "SELECT username FROM user WHERE id=:id";
                $s = $pdo -> prepare($query);
                $s -> bindValue(':id',$row['iduser']);
                $s -> execute();
                $username = $s -> fetch();

                ?>

                <div style="margin-top: 150px;">
                    <form>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text"  id="username" value="<?php echo $username['username']; ?>" readonly>
                            <br/>
                            <label>start:</label>
                            <input type="text" value="<?php echo $start; ?>" readonly>
                            <br/>
                            <label>end:</label>
                            <input type="text" value="<?php echo $end; ?>" readonly>
                            <br/>
                            <label>totalCost:</label>
                            <input type="text" value="<?php echo $totalCost; ?>" readonly>
                            <br/>
                            <label>comment:</label>
                            <textarea type="text" value="<?php echo $comment; ?>" readonly> <?php echo $comment; ?></textarea>
                            <br/>
                            <label>Vehicle:</label>
                            <input type="text" value="<?php echo $vehicle; ?>" readonly>
                            <br/>
                            <label>VIP:</label>
                            <input type="text" value="<?php echo $VIP; ?>" readonly>
                            <br/>
        <?php

                $query = "SELECT * FROM triphospital WHERE idtrip=:TripId";
                $s = $pdo -> prepare($query);
                $s -> bindValue(':TripId',$_POST['tripId']);
                $s -> execute();
                $infos = $s -> fetchAll();


                if(isset($infos) and count($infos))
                {
                    foreach($infos as $info)
                    {
                        if(isset($info) and count($info))
                        {
                            $Hospital_city = $info['city'];
                            $Hospital_name = $info['hospital'];
                            $medicalService = $info['medicalservice'];
                            $Hospital_cost = $info['cost'];

                            ?>
                            <label>Hospital_city:</label>
                            <input type="text" value="<?php echo $Hospital_city; ?>" readonly>
                            <br/>
                            <label>Hospital_name:</label>
                            <input type="text" value="<?php echo $Hospital_name; ?>" readonly>
                            <br/>
                            <label>service:</label>
                            <input type="text" value="<?php echo $medicalService; ?>" readonly>
                            <br/>
                            <label>HospitalCost:</label>
                            <input type="text" value="<?php echo $Hospital_cost; ?>" readonly>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <?php
                        }
                    }
                }




                $query = "SELECT * FROM triphotel WHERE idtrip=:TripId";
                $s = $pdo -> prepare($query);
                $s -> bindValue(':TripId',$_POST['tripId']);
                $s -> execute();
                $infos = $s -> fetchAll();

                if(isset($infos) and count($infos))
                {
                    foreach($infos as $info)
                    {
                        if(isset($info) and count($info))
                        {
                            $hotel_city= $info['city'];
                            $hotel_name= $info['hotel'];
                            $roomplan = $info['roomplan'];
                            $numberOfTravellers = $info['number'];
                            $breakFast = $info['breakfast'];
                            $lunch = $info['lunch'];
                            $dinner = $info['dinner'];
                            $hotel_cost=$info['cost'];

                            ?>
                            <label>hotel city:</label>
                            <input type="text" value="<?php echo $hotel_city; ?>" readonly>
                            <br/>
                            <label>hotel name:</label>
                            <input type="text" value="<?php echo $hotel_name; ?>" readonly>
                            <br/>
                            <label>roomplan:</label>
                            <input type="text" value="<?php echo $roomplan; ?>" readonly>
                            <br/>
                            <label>number of travellers for this hotel:</label>
                            <input type="text" value="<?php echo $numberOfTravellers; ?>" readonly>
                            <br/>
                            <label>breakfast:</label>
                            <input type="text" value="<?php echo $breakFast; ?>" readonly>
                            <br/>
                            <label>lunch:</label>
                            <input type="text" value="<?php echo $lunch; ?>" readonly>
                            <br/>
                            <label>dinner:</label>
                            <input type="text" value="<?php echo $dinner; ?>" readonly>
                            <br/>
                            <label>hotel cost:</label>
                            <input type="text" value="<?php echo $hotel_cost; ?>" readonly>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <?php
                        }
                    }
                }




                $query = "SELECT * FROM triptourism WHERE idtrip=:TripId";
                $s = $pdo -> prepare($query);
                $s -> bindValue(':TripId',$_POST['tripId']);
                $s -> execute();
                $infos = $s -> fetchAll();


                if(isset($infos) and count($infos))
                {
                    foreach($infos as $info)
                    {
                        if(isset($info) and count($info))
                        {
                            $tour_city = $info['city'];
                            $tour_days = $info['tour'];
                            $numberOfTourTravellers = $info['number'];
                            $tour_cost = $info['cost'];

                            ?>

                            <label>tour city:</label>
                            <input type="text" value="<?php echo $tour_city; ?>" readonly>
                            <br/>
                            <label>tour days:</label>
                            <input type="text" value="<?php echo $tour_days; ?>" readonly>
                            <br/>
                            <label>number of travellers for this tour:</label>
                            <input type="text" value="<?php echo $numberOfTourTravellers; ?>" readonly>
                            <br/>
                            <label>tour cost:</label>
                            <input type="text" value="<?php echo $tour_cost; ?>" readonly>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <?php
                        }
                    }
                }


                ?>

                        </div>
                    </form>
                </div>

                <?php
            }
            echo '<script type="text/javascript">window.location.href="#trip";</script>';
        }


        ?>

        <a href="AdminPanel.php">back</a>
    </div>
</body>
</html>
