<?php
if (session_status() === PHP_SESSION_NONE){session_start();}
include '../../../../connectionDB.php';
include '../../../SecurityFunctions.php';
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
unsetHotelSession();
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
                            4- Choose ِYour Hotel to Stay:
                        </div>
                        <div>
                            0 $
                        </div>
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
                            <select id="hotelSelector" class="form-select selectForm" aria-label="Default select example">
                                <option value="default" selected>Select Hotel</option>
                                <option value="1">One</option>
                            </select>
                        </div>

                        <div style="width: 48%;">
                            <select id="roomSelector" class="form-select selectForm" aria-label="Default select example">
                                <option value="default" selected>Select Your Room Plan</option>
                                <option value="1">One</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="cost" value="">
                    <input type="hidden" id="counter" name="Counter" value="0">

                    <div style="display: flex; justify-content: space-between; margin-top: 30px; width: 50%; margin-right: auto; margin-left: auto;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Breakfast
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Lunch
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Dinner
                            </label>
                        </div>
                    </div>


                    <div style="margin-top: 20px; margin-bottom: 30px;">
                        <label for="points" class="formLabel">Number of Travellers</label><br>
                        <div>
                            <div style="width: 95%; padding-left: 20px;">
                                <input type="number" id="points" name="points" step="1" class="formInput" min="0" max="20" value="0" style="width: 40%;"><br>
                            </div>
                            <div class="col-auto my-6" style="margin-top:60px;">
                                <input type="button" class="addTourBtn btn btn-success" style="width:80%;" onclick="addHotelButton()" value="Add Hotel">
                                <script>
                                    var counter =0;
                                    function addHotelButton() {
                                        console.log("add hotel clicked")
                                        var container = document.getElementById("hotelCardsContainer")

                                        var city = document.getElementById("citySelector").value
                                        var hotel = document.getElementById("hotelSelector").value
                                        var room = document.getElementById("roomSelector").value
                                        var arr = room.split(',');
                                        var beds = arr[0];
                                        var nights = arr[1];
                                        var cost = arr[2];
                                        var num = document.getElementById("points").value
                                        var breakfast = $("#flexCheckChecked").prop('checked');
                                        if(breakfast){
                                            breakfast = true;
                                        }
                                        else if(!breakfast)
                                        {
                                            breakfast = false;
                                        }
                                        var lunch = $("#flexCheckChecked2").prop('checked');
                                        var dinner = $("#flexCheckDefault").prop('checked');
                                        if (city==='default' || hotel==='default' || room==='default' || num==="0") {
                                            return null
                                        }
                                        var card = document.createElement("div")
                                        card.innerHTML = ` <div class="listCard shadowBehind">
                        <div>
                            <div class="cardText">City</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">${city}</div>
                            <input type="hidden" name="hotelcity${counter}" value="${city}">
                        </div>
                        <div>
                            <div class="cardText">Hotel</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">${hotel}</div>
                            <input type="hidden" name="hotelname${counter}" value="${hotel}">
                        </div>
                        <div>
                            <div class="cardText">Room PLan</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">${beds} beds , ${nights} nights</div>
                            <input type="hidden" name="room${counter}" value="${nights}Nights${beds}Beds">
                            <input type="hidden" name="HotelnumberOfTravellers${counter}" value="${num}">
                        </div>
                        <input type="hidden" name="breakfast${counter}" value="${breakfast}">
                        <input type="hidden" name="lunch${counter}" value="${lunch}">
                        <input type="hidden" name="dinner${counter}" value="${dinner}">

                        <div>
                            <div class="cardText">Expenses</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">${cost} $</div>
                            <input type="hidden" name="hotelCost${counter}" value="${cost}">
                        </div>

                        <div class="trashBtnContainer">
                            <input type="button" class="btTxt trashBtn" onclick="removeHotelButton(this)">
                        </div>
                    </div> `

                                        counter = counter+1;
                                        $("#counter").val(counter);
                                        container.appendChild(card)
                                    }

                                    document.getElementsByClassName("trashBtn").addEventListener("click", function() {
                                        par = elem.parentNode.parentNode
                                        par.remove()
                                        console.log("remove")
                                    });

                                </script>
                            </div>
                        </div>

                    </div>



                    <div id="hotelCardsContainer" style="padding-top: 40px;">
                        <div class="listCard shadowBehind">
                            <div>
                                <div class="cardText">City</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">Tehran</div>
                            </div>
                            <div>
                                <div class="cardText">Hotel</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">Espinas Palace</div>
                            </div>
                            <div>
                                <div class="cardText">Room PLan</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">2 Beds, 3 Nights</div>
                            </div>
                            <div>
                                <div class="cardText">Expenses</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">900$</div>
                            </div>

                            <div class="trashBtnContainer">
                                <input type="button" class="btTxt trashBtn" onclick="removeHotelButton(this)">
                                <script>
                                    function removeHotelButton(elem) {
                                        par = elem.parentNode.parentNode
                                        par.remove()
                                        console.log("remove")
                                    }
                                </script>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 80px;  width: 80%; margin-right: auto; margin-left: auto;">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
                        </div>

                        <div style="margin-top: 40px; display: flex; justify-content: space-between;">
                            <input  class="btn btn-primary" style="width:100px; height: 45px; border-bottom-left-radius: 15px; border-top-left-radius: 15px;" onclick="location.href = '../Step_3/index.html.php';" value="Back">
                            <div style="margin-bottom: 25px;">Step 4/5</div>
                            <input type="submit" name="step4" class="btn btn-primary" style="width:100px; height: 45px; border-bottom-right-radius: 15px; border-top-right-radius: 15px;"  value="Next">
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
                    data: {hotelcity:city},
                    dataType : 'json',
                    success:function (response)
                    {
                        $("#hotelSelector").empty();
                        $("#roomSelector").empty();
                        $("#hotelSelector").append("<option value=''></option>");
                        var length = response.length;

                        for(var i=0;i<length;i++)
                        {
                            var name = response[i]['name'];
                            $("#hotelSelector").append("<option value='"+name+"'>"+name+"</option>");
                        }
                    }
                });
            }
        });
    </script>

    <script type="text/javascript">
        $('#hotelSelector').change(function(){
            var hotelname = $(this).val();
            var hotelcity = $("#citySelector").val();
            if(hotelname!='')
            {
                $.ajax({
                    type: 'POST',
                    url: "../functions.php",
                    data: {hotelname:hotelname ,hotelcity:hotelcity},
                    dataType : 'json',
                    success:function (response)
                    {
                        $("#roomSelector").empty();
                        $("#roomSelector").append("<option value=''></option>");
                        var length = response.length;

                        for(var i=0;i<length;i++)
                        {
                            var beds = response[i]['beds'];
                            var nights = response[i]['nights'];
                            var cost = response[i]['cost'];
                            $("#roomSelector").append("<option value='"+beds+","+nights+","+cost+"'> beds:"+beds+", nights:"+nights+", cost:"+cost+"</option>");
                        }
                    }
                });
            }
        });
    </script>
    </body>
    </html>
<?php
}
if(isset($_POST['step4']))
{
    $counter = $_POST['Counter'];
    $_SESSION['hotelCounter'] = $counter;
    for($i=0;$i<$counter;$i++)
    {
        if(isset($_POST['hotelcity'.$i]) and isset($_POST['hotelname'.$i]) and isset($_POST['room'.$i]) and isset($_POST['HotelnumberOfTravellers'.$i]) and isset($_POST['breakfast'.$i]) and isset($_POST['lunch'.$i]) and isset($_POST['dinner'.$i]) and isset($_POST['hotelCost'.$i]))
        {
            $_SESSION['hotelcity'.$i] = $_POST['hotelcity'.$i];
            $_SESSION['hotelname'.$i] = $_POST['hotelname'.$i];
            $_SESSION['room'.$i] = $_POST['room'.$i];
            $_SESSION['HotelnumberOfTravellers'.$i] = $_POST['HotelnumberOfTravellers'.$i];
            $_SESSION['breakfast'.$i] = $_POST['breakfast'.$i];
            $_SESSION['lunch'.$i] = $_POST['lunch'.$i];
            $_SESSION['dinner'.$i] = $_POST['dinner'.$i];
            $_SESSION['hotelCost'.$i] = $_POST['hotelCost'.$i];
        }
    }
    echo '<script type="text/javascript">window.location.href="../Step_5/index.html.php";</script>';
}

?>
