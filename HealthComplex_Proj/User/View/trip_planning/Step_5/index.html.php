<?php

if (session_status() === PHP_SESSION_NONE){session_start();}
include '../../../../connectionDB.php';
include '../../../SecurityFunctions.php';

if(!function_exists('unsetTripSessions'))
{
    function unsetTripSessions()
    {
        if(isset($_SESSION['start']) and $_SESSION['end'])
        {
            unset($_SESSION['start']);
            unset($_SESSION['end']);
        }
    }
}

if(!function_exists('unsetMedicalSessions'))
{
    function unsetMedicalSessions()
    {
        if(isset($_SESSION['medicalCounter']))
        {
            for($i=0;$i<$_SESSION['medicalCounter'];$i++)
            {
                if(isset($_SESSION['hospitalcity'.$i]))
                {
                    unset($_SESSION['hospitalcity'.$i]);
                }
                if(isset($_SESSION['hospital'.$i]))
                {
                    unset($_SESSION['hospital'.$i]);
                }
                if(isset($_SESSION['medicalservice'.$i]))
                {
                    unset($_SESSION['medicalservice'.$i]);
                }
                if(isset($_SESSION['hospitalcost'.$i]))
                {
                    unset($_SESSION['hospitalcost'.$i]);
                }
            }
        }
        unset($_SESSION['medicalCounter']);
    }
}

if(!function_exists('unsetTourSessions'))
{
    function unsetTourSessions()
    {
        if(isset($_SESSION['tourCounter']))
        {
            for($i=0;$i<$_SESSION['tourCounter'];$i++)
            {
                if(isset($_SESSION['tourcity'.$i]))
                {
                    unset($_SESSION['tourcity'.$i]);
                }
                if(isset($_SESSION['tourdays'.$i]))
                {
                    unset($_SESSION['tourdays'.$i]);
                }
                if(isset($_SESSION['tourNumTraveller'.$i]))
                {
                    unset($_SESSION['tourNumTraveller'.$i]);
                }
                if(isset($_SESSION['tourCost'.$i]))
                {
                    unset($_SESSION['tourCost'.$i]);
                }
            }
            unset($_SESSION['tourCounter']);
        }
    }
}

if(!function_exists('unsetHotelSession'))
{
    function unsetHotelSession()
    {
        if(isset($_SESSION['hotelCounter']))
        {
            for($i=0;$i<$_SESSION['hotelCounter'];$i++)
            {
                if(isset($_SESSION['hotelcity'.$i]))
                {
                    unset($_SESSION['hotelcity'.$i]);
                }
                if(isset($_SESSION['hotelname'.$i]))
                {
                    unset($_SESSION['hotelname'.$i]);
                }
                if(isset($_SESSION['room'.$i]))
                {
                    unset($_SESSION['room'.$i]);
                }
                if(isset($_SESSION['HotelnumberOfTravellers'.$i]))
                {
                    unset($_SESSION['HotelnumberOfTravellers'.$i]);
                }
                if(isset($_SESSION['breakfast'.$i]))
                {
                    unset($_SESSION['breakfast'.$i]);
                }
                if(isset($_SESSION['lunch'.$i]))
                {
                    unset($_SESSION['lunch'.$i]);
                }
                if(isset($_SESSION['dinner'.$i]))
                {
                    unset($_SESSION['dinner'.$i]);
                }
                if(isset($_SESSION['hotelCost'.$i]))
                {
                    unset($_SESSION['hotelCost'.$i]);
                }
            }
            unset($_SESSION['hotelCounter']);
        }
    }
}
if(preloggedin('../../../../connectionDB.php'))
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Health Complex|Plan Your Trip</title>

        <!-- ‌‌ BootStrap  -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link type="text/css" rel="stylesheet" href="../style.css"><link>
        <link rel="shortcut icon" type="image/png" href="../../images/favicon.ico"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <title>Plan Your Trip</title>
    </head>
    <body>
    <div class="backgroundImage">

        <div class="aboutUsContainer">
            <div class="aboutTitle sadgan">Plan Your Trip!
                <hr class="horizontalRule">
            </div>


            <div class="aboutBody iranSans" style="padding-top:0px; margin-right:5%; margin-left:5%;">
                <form method="post">

                    <div class="detailsTitle sadgan" style="padding-top: 50px;">
                        <div>
                            5- Choose ِYour Transportation Methods:
                        </div>
                        <div>
                            0 $
                        </div>
                    </div>
                    <hr class="detailHorizontalRule">


                    <div style="display: flex; justify-content: space-between; width: 80%; margin: auto; padding-top: 10px; margin-top: 20px;" >

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="plane" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Plane
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="train">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Train
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" value="bus">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Bus
                            </label>
                        </div>
                    </div>

                    <div class="form-check form-switch" style="margin-top: 40px;">
                        <input name="vip" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">VIP Service</label>
                    </div>



                    <div>
                        <div class="form-floating" style="padding-top: 65px;">
                            <textarea name="comment" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Comments</label>
                        </div>
                    </div>



                    <div style="margin-top: 80px;  width: 80%; margin-right: auto; margin-left: auto;">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>

                        <div style="margin-top: 40px; display: flex; justify-content: space-between;">
                            <input  class="btn btn-primary" style="width:100px; height: 45px; border-bottom-left-radius: 15px; border-top-left-radius: 15px;" onclick="location.href = '../Step_4/index.html.php';" value="Back">
                            <div style="margin-bottom: 25px;">Step 5/5</div>
                            <input  class="btn btn-primary" style="width:100px; height: 45px; border-bottom-right-radius: 15px; border-top-right-radius: 15px; visibility: hidden;" value="Next">
                        </div>

                    </div>

                    <div class="col-auto my-10" style="margin-top:60px;">
                        <input type="submit" class="btn btn-primary" style="width:80%;" name="submitTrip" value="submit">
                    </div>

                </form>

            </div>


            <!--        <img src="images/tehran_header.png" style="width: 100%; height: 200px; bottom: 0;"/>-->
        </div>

    </div>
    </body>
    </html>
<?php
    if(isset($_POST['submitTrip']))
    {
        $vip=false;
        if(isset($_POST['vip']))
        {
            $vip = true;
        }
        else{
            $vip = false;
        }
        if(isset($_POST['flexRadioDefault']) and isset($_POST['comment']))
        {
            if(isset($_SESSION['UserUsername']) and isset($_SESSION['UserPassword']))
            {
                $username = $_SESSION['UserUsername'];
                $password = $_SESSION['UserPassword'];
                $query = "SELECT * FROM user WHERE username=:username AND password=:password";
                $s = $pdo-> prepare($query);
                $s -> bindValue(':username',$username);
                $s -> bindValue(':password',$password);
                $s -> execute();
                $result = $s -> fetch();

                $UserId = $result['id'];

                if(isset($_SESSION['start']) and isset($_SESSION['end']) and $_POST['flexRadioDefault'])
                {
                    $totalCost = 0;
                    $start = $_SESSION['start'];
                    $end = $_SESSION['end'];
                    $vehicle = $_POST['flexRadioDefault'];


                    //insertion to trip plans table
                    $comment= $_POST['comment'];
                    $query = "INSERT INTO tripplan (iduser,startdate,enddate,comment,vehicle,VIP) VALUES (:iduser,:start,:end,:comment,:vehicle,:vip)";
                    $s = $pdo -> prepare($query);
                    $s -> bindValue(':iduser',$UserId);
                    $s -> bindValue(':start',$start);
                    $s -> bindValue(':end',$end);
                    $s -> bindValue(':comment',$comment);
                    $s -> bindValue(':vehicle',$vehicle);
                    $s -> bindValue(':vip',$vip);
                    $s -> execute();

                    //get trip id from trip plan table
                    $query ="SELECT * FROM tripplan WHERE iduser=:iduser AND startdate=:start AND enddate=:end AND comment=:comment AND vehicle=:vehicle AND VIP=:vip";
                    $s = $pdo -> prepare($query);
                    $s -> bindValue(':iduser',$UserId);
                    $s -> bindValue(':start',$start);
                    $s -> bindValue(':end',$end);
                    $s -> bindValue(':comment',$comment);
                    $s -> bindValue(':vehicle',$vehicle);
                    $s -> bindValue(':vip',$vip);
                    $s ->execute();
                    $result = $s ->fetch();
                    $TripId = $result['id'];

                    if(isset($_SESSION['medicalCounter']))
                    {
                        $counter = $_SESSION['medicalCounter'];
                        for($i=0;$i<$counter;$i++)
                        {
                            if(isset($_SESSION['hospitalcity'.$i]) and isset($_SESSION['hospital'.$i]) and isset($_SESSION['medicalservice'.$i]) and isset($_SESSION['hospitalcost'.$i]))
                            {
                                $HospitalCity = $_SESSION['hospitalcity'.$i];
                                $HospitalName = $_SESSION['hospital'.$i];
                                $HospitalService = $_SESSION['medicalservice'.$i];
                                $HospitalCost = $_SESSION['hospitalcost'.$i];

                                $totalCost = $totalCost +$HospitalCost;

                                $query = "INSERT INTO triphospital (idtrip , city ,hospital , medicalservice , cost) VALUES (:idtrip , :city ,:hospital ,:medicalservice ,:cost)";
                                $s = $pdo -> prepare($query);
                                $s -> bindValue(':idtrip',$TripId);
                                $s -> bindValue('city',$HospitalCity);
                                $s -> bindValue(':hospital',$HospitalName);
                                $s -> bindValue(':medicalservice',$HospitalService);
                                $s -> bindValue(':cost',$HospitalCost);
                                $s -> execute();

                            }
                        }
                    }

                    if(isset($_SESSION['tourCounter']))
                    {
                        $counter = $_SESSION['tourCounter'];
                        for($i=0;$i<$counter;$i++)
                        {
                            if(isset($_SESSION['tourcity'.$i]) and isset($_SESSION['tourdays'.$i]) and isset($_SESSION['tourNumTraveller'.$i]) and isset($_SESSION['tourCost'.$i]))
                            {
                                $tourCity = $_SESSION['tourcity'.$i];
                                $tourDays = $_SESSION['tourdays'.$i];
                                $tourNumTraveller = $_SESSION['tourNumTraveller'.$i];
                                $tourCost = $_SESSION['tourCost'.$i];

                                $totalCost = $totalCost +$tourCost;

                                $query ="INSERT INTO triptourism (idtrip , city , tour , number , cost) VALUE (:idtrip,:tourcity,:tour,:travellerNums ,:tourcost)";
                                $s = $pdo -> prepare($query);
                                $s -> bindValue(':idtrip',$TripId);
                                $s -> bindValue(':tourcity',$tourCity);
                                $s -> bindValue(':tour',$tourDays);
                                $s -> bindValue(':travellerNums',$tourNumTraveller);
                                $s -> bindValue(':tourcost',$tourCost);
                                $s -> execute();

                            }
                        }
                    }

                    if(isset($_SESSION['hotelCounter']))
                    {
                        $counter = $_SESSION['hotelCounter'];
                        for($i=0;$i<$counter;$i++)
                        {
                            if(isset($_SESSION['hotelcity'.$i]) and isset($_SESSION['hotelname'.$i]) and isset($_SESSION['room'.$i]) and isset($_SESSION['HotelnumberOfTravellers'.$i]) and isset($_SESSION['breakfast'.$i]) and isset($_SESSION['lunch'.$i]) and isset($_SESSION['dinner'.$i]) and isset($_SESSION['hotelCost'.$i]))
                            {
                                $hotelCity = $_SESSION['hotelcity'.$i];
                                $hotelName = $_SESSION['hotelname'.$i];
                                $room = $_SESSION['room'.$i];
                                $hotelNumTraveller =$_SESSION['HotelnumberOfTravellers'.$i];
                                $hotelBreakfast =$_SESSION['breakfast'.$i];
                                $hotelLunch =$_SESSION['lunch'.$i];
                                $hotelDinner =$_SESSION['dinner'.$i];
                                $hotelCost =$_SESSION['hotelCost'.$i];

                                $totalCost = $totalCost +$hotelCost;

                                $query ="INSERT INTO triphotel ( idtrip , city , hotel , roomplan  , number , breakfast , lunch , dinner , cost ) VALUES (:idtrip,:hotelcity,:hotelname,:room,:numberOfTravellers,:breakfast,:lunch,:dinner,:cost)";
                                $s = $pdo -> prepare($query);
                                $s -> bindValue(':idtrip',$TripId);
                                $s -> bindValue(':hotelcity',$hotelCity);
                                $s -> bindValue(':hotelname',$hotelName);
                                $s -> bindValue(':room',$room);
                                $s -> bindValue(':numberOfTravellers',$hotelNumTraveller);
                                $s -> bindValue(':breakfast',$hotelBreakfast);
                                $s -> bindValue(':lunch',$hotelLunch);
                                $s -> bindValue(':dinner',$hotelDinner);
                                $s -> bindValue(':cost',$hotelCost);
                                $s -> execute();
                            }
                        }
                    }

                    $query = "UPDATE tripplan SET totalcost=:totalcost WHERE id=:idtrip";
                    $s = $pdo -> prepare($query);
                    $s -> bindValue(':totalcost',$totalCost);
                    $s -> bindValue(':idtrip',$TripId);
                    $s -> execute();
                }
            }
        }
        unsetTripSessions();
        unsetMedicalSessions();
        unsetHotelSession();
        unsetTourSessions();
    }
}
?>
