<?php
if (session_status() === PHP_SESSION_NONE){session_start();}
include '../../../../connectionDB.php';
include '../../../SecurityFunctions.php';
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
unsetMedicalSessions();

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
        <script src="../../../../lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
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
                            2- Choose ِYour Medical Service:
                        </div>
                        <div id="CurrentCost" > 0$ </div>

                    </div>
                    <hr class="detailHorizontalRule">
                    <select id="citySelector" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="margin-top: 20px; width: 60%;  border-radius: 7px; text-align: center; vertical-align: center; height: 35px;">
                        <option value="default" style="width: 100%;" selected>Select Medical Service City</option>
                        <option value="tehran">Tehran</option>
                        <option value="isfahan">Isfahan</option>
                        <option value="shiraz">Shiraz</option>
                        <option value="tabriz">Tabriz</option>
                        <option value="mashhad">Mashhad</option>
                        <option value="kish">Kish</option>
                        <option value="qom">Qom</option>
                        <option value="rasht">Rasht</option>
                        <option value="yazd">Yazd</option>
                    </select>


                    <div style="display: flex; justify-content: space-between; width: 80%; margin: auto; padding-top: 10px;">

                        <div style="width: 48%;">
                            <select id="hospitalSelector" class="form-select selectForm" aria-label="Default select example">
                                <option value="default" selected>Select Hospital</option>
                                <option value="1">One</option>
                            </select>
                        </div>

                        <div style="width: 48%;">
                            <select  id="medicalSelector" class="form-select selectForm" aria-label="Default select example">
                                <option value="default" selected>Select Medical Service</option>
                                <option value="1">One</option>

                            </select>
                        </div>
                        <input type="hidden" id="cost" value="">
                        <input type="hidden" id="counter" name="Counter" value="0">
                    </div>

                    <div class="col-auto my-6" style="margin-top:60px;">
                        <input type="button" class="addTourBtn btn btn-success" style="width:80%;" onclick="addMedicalServiceButton()" value="Add Medical Service">
                        <script>
                            var counter = 0;
                            function addMedicalServiceButton() {
                                console.log("add medical service clicked")
                                var container = document.getElementById("medicalCardsContainer")
                                // var city = document.getElementById("citySelector").value
                                var city = document.getElementById("citySelector").value
                                var hospital = document.getElementById("hospitalSelector").value
                                var medical = document.getElementById("medicalSelector").value
                                var cost = document.getElementById("cost").value

                                if (city==='default' || hospital==='default' || medical==='default') {
                                    return null
                                }
                                var card = document.createElement("div")
                                card.innerHTML = ` <div id="medicalCardsContainer" style="padding-top: 40px;">
                    <div class="listCard shadowBehind">

                        <div>
                            <div class="cardText">City</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">`+city+`</div>
                            <input type="hidden" name="hospitalcity${counter}" value="`+city+`">

                        </div>
                        <div>
                            <div class="cardText">Hospital</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">`+hospital+`</div>
                            <input type="hidden" name="hospital${counter}" value="`+hospital+`">
                        </div>
                        <div>
                            <div class="cardText">Medical Services</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">`+medical+`</div>
                            <input type="hidden" name="medicalservice${counter}" value="`+medical+`">
                        </div>
                        <div>
                            <div class="cardText">Expenses</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">`+cost+`</div>
                            <input type="hidden" name="hospitalcost${counter}" value="`+cost+`">
                        </div>

                        <div class="trashBtnContainer">
                            <input type="button" class="btTxt trashBtn" onclick="removeMedicalServiceButton(this)">
                </div>
        </div>

    </div> `

                                counter = counter+1;
                                $("#counter").val(counter);
                                container.appendChild(card);
                            }

                            document.getElementsByClassName("trashBtn").addEventListener("click", function() {
                                par = elem.parentNode.parentNode
                                //make total cost with js for delete item???
                                //
                                //
                                //
                                //

                                par.remove()
                                console.log("remove")
                            });

                        </script>
                    </div>

                    <div id="medicalCardsContainer" style="padding-top: 40px;">
                        <div class="listCard shadowBehind">
                            <div>
                                <div class="cardText">City</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">Tehran</div>
                            </div>
                            <div>
                                <div class="cardText">Hospital</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">Erfan Hospital</div>
                            </div>
                            <div>
                                <div class="cardText">Medical Services</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">Cancer Treatment</div>
                            </div>
                            <div>
                                <div class="cardText">Expenses</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">800$</div>
                            </div>

                            <div class="trashBtnContainer">
                                <input type="button" class="btTxt trashBtn" onclick="removeMedicalServiceButton(this)">
                                <script>
                                    function removeMedicalServiceButton(elem) {
                                        par = elem.parentNode.parentNode
                                        par.remove()
                                        console.log("remove")
                                    }
                                </script>
                            </div>
                        </div>
                    </div>


                    <div style="margin-top: 80px; width: 80%; margin-right: auto; margin-left: auto;">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                        </div>

                        <div style="margin-top: 40px; display: flex; justify-content: space-between;">
                            <input  class="btn btn-primary" style="width:100px; height: 45px; border-bottom-left-radius: 15px; border-top-left-radius: 15px;" onclick="location.href = '../index.html.php';" value="Back">
                            <div style="margin-bottom: 25px;">Step 2/5</div>
                            <input class="btn btn-primary" style="width:100px; height: 45px; border-bottom-right-radius: 15px; border-top-right-radius: 15px;" type="submit" name="step2" value="Next">
                        </div>
                    </div>

                </form>

            </div>


            <!--        <img src="images/tehran_header.png" style="width: 100%; height: 200px; bottom: 0;"/>-->
        </div>

    </div>
    <script type="text/javascript">
        $('#citySelector').change(function(){
            var city = $(this).val();
            if(city!='')
            {
                $.ajax({
                    type: 'POST',
                    url: "../functions.php",
                    data: {city:city},
                    dataType : 'json',
                    success:function (response)
                    {
                        $("#hospitalSelector").empty();
                        $("#medicalSelector").empty();
                        $("#hospitalSelector").append("<option value=''></option>");
                        var length = response.length;

                        for(var i=0;i<length;i++)
                        {
                            var name = response[i]['name'];
                            $("#hospitalSelector").append("<option value='"+name+"'>"+name+"</option>");
                        }
                    }
                });
            }
        });
    </script>

    <script type="text/javascript">

        $('#hospitalSelector').change(function(){
            var hospital = $(this).val();
            if(hospital!='')
            {
                $.ajax({
                    type: 'POST',
                    url: "../functions.php",
                    data: {hospital:hospital},
                    dataType : 'json',
                    success:function (response)
                    {
                        $("#medicalSelector").empty();
                        $("#medicalSelector").append("<option value=''></option>");
                        var length = response.length;
                        for(var i=0;i<length;i++)
                        {
                            var service = response[i]['medicalServices'];
                            $("#medicalSelector").append("<option value='"+service+"'>"+service+"</option>");
                        }
                    }
                });
            }
        });
    </script>

    <script type="text/javascript">
        $('#medicalSelector').change(function(){
            var service = $(this).val();
            var hospital = $("#hospitalSelector").val();
            if(service!='')
            {

                $.ajax({
                    type: 'POST',
                    url: "../functions.php",
                    data: {hospital:hospital , service:service},
                    dataType : 'json',
                    success:function (response)
                    {
                        $("#cost").val(response[0]['cost']);
                    },

                });
            }
        });
    </script>
    </body>

    </html>

<?php
    if(isset($_POST['step2']))
    {
        $counter = $_POST['Counter'];
        $_SESSION['medicalCounter'] = $counter;
        for($i =0;$i<$counter;$i++)
        {
            if(isset($_POST['hospitalcity'.$i]) and isset($_POST['hospital'.$i]) and isset($_POST['medicalservice'.$i]) and isset($_POST['hospitalcost'.$i]))
            {
                $_SESSION['hospitalcity'.$i] = $_POST['hospitalcity'.$i];
                $_SESSION['hospital'.$i] = $_POST['hospital'.$i];
                $_SESSION['medicalservice'.$i] = $_POST['medicalservice'.$i];
                $_SESSION['hospitalcost'.$i] = $_POST['hospitalcost'.$i];
            }
        }
        echo '<script type="text/javascript">window.location.href="../Step_3/index.html.php";</script>';
        //include 'test.php';
        //echo '<script type="text/javascript">window.location.href="test.php";</script>';

    }

    //var_dump($_POST);

}


?>
