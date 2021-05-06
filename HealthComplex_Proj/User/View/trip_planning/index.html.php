<?php
if (session_status() === PHP_SESSION_NONE){session_start();}
include '../../../connectionDB.php';
include '../../SecurityFunctions.php';
if(!function_exists('show_message'))
{
    function show_message($message){
        ?>
        <div class="alert alert-info alert-dismissible" role="alert" style="position: fixed; top: 0px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo $message; ?>
        </div>
        <?php
    }
}
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
unsetTripSessions();

if(preloggedin('../../../connectionDB.php'))
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

        <script src="../../../lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

        <link type="text/css" rel="stylesheet" href="style.css"><link>
        <link rel="shortcut icon" type="image/png" href="../images/favicon.ico"/>

        <script src="../../libs/jquery-3.5.1.js"></script>
        <script src="../request.js"></script>
        <script>
            data=sendAjaxRequest("GET","http://localhost//HealthComplex_Project/Controller/mainController.php/authUser",null);
            if(data!="ok") window.location.replace("../../index.html");
        </script>

        <title>Plan Your Trip</title>

    </head>
    <body>
    <div class="backgroundImage">

        <div class="aboutUsContainer">
            <div class="aboutTitle sadgan">Plan Your Trip!
                <hr class="horizontalRule">
            </div>


            <div class="aboutBody iranSans" style="padding-top:40px; margin-right:5%; margin-left:5%;">
                <form method="post">

                    <div class="form-group row" style="margin-top:25px;">
                        <label for="inputUsername3" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputUsername3" placeholder="Username" name="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                        </div>
                    </div>


                    <div class="detailsTitle1 sadgan">1- Choose Time of Your Trip:
                        <hr class="detailHorizontalRule">
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 80%; margin: auto; padding-top: 30px;">
                        <div>
                            <label for="start">Start Date:</label>
                            <input type="date" id="start" name="start">
                        </div>

                        <div>
                            <label for="end">End Date:</label>
                            <input type="date" id="end" name="end">
                        </div>
                    </div>

                    <div style="margin-top: 100px; width: 80%; margin-right: auto; margin-left: auto;">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                        </div>

                        <div style="margin-top: 40px; display: flex; justify-content: space-between;">
                            <input  class="btn btn-primary" style="width:100px; height: 45px; border-bottom-left-radius: 15px; border-top-left-radius: 15px; visibility: hidden;" value="Back">
                            <div style="margin-bottom: 25px;">Step 1/5</div>
                            <input name="step1" type="submit"  class="btn btn-primary" style="width:100px; height: 45px; border-bottom-right-radius: 15px; border-top-right-radius: 15px;"  value="Next">
                        </div>

                    </div>

                </form>

            </div>


            <!--        <img src="images/tehran_header.png" style="width: 100%; height: 200px; bottom: 0;"/>-->
        </div>


    </div>
    </body>
    </html>
    <?php
    if(isset($_POST['step1']) and $_POST['step1']=="Next")
    {
        $username = htmlProtection($_POST['username']);
        $password = htmlProtection($_POST['password']);
        $start = htmlProtection($_POST['start']);
        $end = htmlProtection($_POST['end']);

        if($_SESSION['UserUsername']==$username and $_SESSION['UserPassword']==$password and isset($start) and $start!="" and isset($end) and $end!="")
        {
            $_SESSION['start'] = $start;
            $_SESSION['end'] = $end;
            echo '<script type="text/javascript">window.location.href="./Step_2/index.html.php";</script>';
        }
        else{
            show_message("please fill the form completely.");
        }

    }
}
else{
    unsetUserSession();
    ?>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <script src="../../../lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
        </head>
    </html>
<?php
    show_message("ypur session has been expired. please login again and try again.");
    //bre be login ?????
    //
    //
    //

}



?>

