<?php
if (session_status() === PHP_SESSION_NONE){session_start();}
include '../../../../connectionDB.php';
include '../../../SecurityFunctions.php';

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

unsetTourSessions();
if(preloggedin('../../../../connectionDB.php'))
{
    $counter = 0;
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
                            3- Choose ِYour Tourism Services:
                        </div>
                        <div>
                            0 $
                        </div>
                    </div>
                    <hr class="detailHorizontalRule">

                    <div style="display: flex; justify-content: space-between; width: 80%; margin: auto; padding-top: 10px;">

                        <div style="width: 48%;">
                            <select id="citySelector" class="form-select selectForm" aria-label="Default select example">
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
                        </div>

                        <div style="width: 48%;">
                            <select id="tourismSelector" class="form-select selectForm" aria-label="Default select example">
                                <option value="default" selected>Select Tourism Service</option>
                                <option value="1">One</option>

                            </select>
                        </div>
                        <input type="hidden" id="cost" value="">
                        <input type="hidden" id="counter" name="Counter" value="0">
                    </div>

                    <div style="margin-top: 20px; margin-bottom: 30px;">
                        <label for="points" class="formLabel">Number of Travellers</label><br>
                        <div>
                            <div style="width: 95%; padding-left: 20px;">
                                <input type="number" id="points" name="points" step="1" class="formInput" min="0" max="20" value="0" style="width: 40%;"><br>
                            </div>
                            <div class="col-auto my-6" style="margin-top:60px;">
                                <input type="button" class="addTourBtn btn btn-success" style="width:80%;" onclick="addTourButton()" value="Add Tour">
                                <script>
                                    var counter = 0;
                                    function addTourButton() {
                                        console.log("add tour clicked")
                                        var container = document.getElementById("tourCardsContainer")

                                        var city = document.getElementById("citySelector").value
                                        var tourism = document.getElementById("tourismSelector").value
                                        var arr = tourism.split(",");
                                        var day = arr[0];

                                        var num = document.getElementById("points").value
                                        var cost = arr[1];

                                        if (city==='default' || tourism==='default' || num==="0") {
                                            alert("fill all of the form");
                                            return null
                                        }
                                        cost = parseInt(cost);
                                        num = parseInt(num);
                                        cost = cost * num;
                                        var card = document.createElement("div");
                                        card.innerHTML = ` <div class="listCard shadowBehind">
                        <div>

                            <div class="cardText">City</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">${city}</div>
                            <input type="hidden" name="tourcity${counter}" value="`+city+`">
                        </div>
                        <div>
                            <div class="cardText">Tourism Services</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">${day} days around ${city}</div>
                            <input type="hidden" name="tourdays${counter}" value="`+day+`">
                        </div>
                        <div>
                            <div class="cardText">Num</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">${num}</div>
                            <input type="hidden" name="tourNumTraveller${counter}" value="`+num+`">
                        </div>
                        <div>
                            <div class="cardText">Expenses</div>
                            <hr class="detailHorizontalRule">
                            <div class="cardText2">${cost} $</div>
                            <input type="hidden" name="tourCost${counter}" value="`+cost+`">
                        </div>

                        <div class="trashBtnContainer">
                            <input type="button" class="btTxt trashBtn" onclick="removeTourismServiceButton(this)">
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
                    <div id="tourCardsContainer" style="padding-top: 40px;">
                        <div class="listCard shadowBehind">
                            <div>
                                <div class="cardText">City</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">Tehran</div>
                            </div>
                            <div>
                                <div class="cardText">Tourism Services</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">1 Day Around City</div>
                            </div>
                            <div>
                                <div class="cardText">Num</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">3</div>
                            </div>
                            <div>
                                <div class="cardText">Expenses</div>
                                <hr class="detailHorizontalRule">
                                <div class="cardText2">200$</div>
                            </div>

                            <div class="trashBtnContainer">
                                <input type="button" class="btTxt trashBtn" onclick="removeTourismServiceButton(this)">
                                <script>
                                    function removeTourismServiceButton(elem) {
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
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                        </div>

                        <div style="margin-top: 40px; display: flex; justify-content: space-between;">
                            <input  class="btn btn-primary" style="width:100px; height: 45px; border-bottom-left-radius: 15px; border-top-left-radius: 15px;" onclick="location.href = '../Step_2/index.html.php';" value="Back">
                            <div style="margin-bottom: 25px;">Step 3/5</div>
                            <input name="step3" type="submit" class="btn btn-primary" style="width:100px; height: 45px; border-bottom-right-radius: 15px; border-top-right-radius: 15px;" value="Next">
                        </div>

                    </div>
                    <input type="text" id="test" value="">
                </form>

            </div>


            <!--        <img src="images/tehran_header.png" style="width: 100%; height: 200px; bottom: 0;"/>-->
        </div>


    </div>
    <script>
        $('#citySelector').change(function(){
            var city = $(this).val();
            if(city!="")
            {
                $.ajax({
                    type: 'POST',
                    url: "../functions.php",
                    data: {tourcity:city},
                    dataType : 'json',
                    success:function (response)
                    {
                        $("#tourismSelector").empty();
                        $("#tourismSelector").append("<option value=''></option>");
                        var length = response.length;

                        for(var i=0;i<length;i++)
                        {
                            var days = response[i]['days'];
                            var cost = response[i]['cost'];
                            $("#tourismSelector").append("<option value='"+days+","+cost+"'> days:"+days+", cost:"+cost+"</option>");
                        }
                    },

                });
            }
        });
    </script>
    </body>

    </html>
    <?php
}

if(isset($_POST['step3']))
{
    $counter = $_POST['Counter'];
    $_SESSION['tourCounter'] = $counter;
    for($i=0;$i<$counter;$i++)
    {
        if(isset($_POST['tourcity'.$i]) and isset($_POST['tourdays'.$i]) and isset($_POST['tourNumTraveller'.$i]) and isset($_POST['tourCost'.$i]))
        {
            $_SESSION['tourcity'.$i] =$_POST['tourcity'.$i];
            $_SESSION['tourdays'.$i] =$_POST['tourdays'.$i];
            $_SESSION['tourNumTraveller'.$i] =$_POST['tourNumTraveller'.$i];
            $_SESSION['tourCost'.$i] =$_POST['tourCost'.$i];
        }
    }
    echo '<script type="text/javascript">window.location.href="../Step_4/index.html.php";</script>';
}

?>

