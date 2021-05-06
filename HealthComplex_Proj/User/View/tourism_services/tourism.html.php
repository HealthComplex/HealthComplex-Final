<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Health Complex|Tourism Services</title>

    <!-- ‌‌ BootStrap  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="style.css"><link>
    <link rel="shortcut icon" type="image/png" href="../images/favicon.ico"/>
</head>
<body style="width: 100%;">
<div class="navbarContainer topNavbar">
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
        <a class="navbar-brand" href="#">
            <img src="../images/health.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            Health Complex
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Medical Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Medical</a>
                        <a class="dropdown-item" href="#">Cosmetic</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hotels</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Tourism Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="bodyContainer">

    <div class="citiesListContainer">
        <div class="citiesHeader">Tourism Cities</div>
        <div class="row">
            <div class="col-12">
                <div class="list-group" id="list-tab" role="tablist">
                    <form method="post">
                        <button type="submit" name="city" value="tehran" class="list-group-item list-group-item-action" id="list-tehran-list" data-bs-toggle="list" href="#list-tehran" role="tab" aria-controls="tehran">Tehran</button>
                        <button type="submit" name="city" value="isfahan" class="list-group-item list-group-item-action" id="list-isfahan-list" data-bs-toggle="list" href="#list-isfahan" role="tab" aria-controls="isfahan">Isfahan</button>
                        <button type="submit" name="city" value="shiraz" class="list-group-item list-group-item-action" id="list-shiraz-list" data-bs-toggle="list" href="#list-shiraz" role="tab" aria-controls="shiraz">Shiraz</button>
                        <button type="submit" name="city" value="tabriz" class="list-group-item list-group-item-action" id="list-tabriz-list" data-bs-toggle="list" href="#list-tabriz" role="tab" aria-controls="tabriz">Tabriz</button>
                        <button type="submit" name="city" value="mashhad" class="list-group-item list-group-item-action" id="list-mashhad-list" data-bs-toggle="list" href="#list-mashhad" role="tab" aria-controls="mashhad">Mashhad</button>
                        <button type="submit" name="city" value="kish" class="list-group-item list-group-item-action" id="list-kish-list" data-bs-toggle="list" href="#list-kish" role="tab" aria-controls="kish">Kish</button>
                        <button type="submit" name="city" value="qom" class="list-group-item list-group-item-action" id="list-qom-list" data-bs-toggle="list" href="#list-qom" role="tab" aria-controls="qom">Qom</button>
                        <button type="submit" name="city" value="rasht" class="list-group-item list-group-item-action" id="list-rasht-list" data-bs-toggle="list" href="#list-rasht" role="tab" aria-controls="rasht">Rasht</button>
                        <button type="submit" name="city" value="yazd" class="list-group-item list-group-item-action" id="list-yazd-list" data-bs-toggle="list" href="#list-yazd" role="tab" aria-controls="yazd">Yazd</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="cardsContainer" style="align-content: center;">

        <!--        <div class="col-2">-->
        <!--            <div class="tab-content cityHeader" id="nav-tabContent">-->
        <!--                <div class="tab-pane fade show active cityHeader" id="list-tehran" role="tabpanel" aria-labelledby="list-tehran-list">Tehran Medical Centers</div>-->
        <!--                <div class="tab-pane fade" id="list-isfahan" role="tabpanel" aria-labelledby="list-isfahan-list">Isfahan Medical Centers</div>-->
        <!--                <div class="tab-pane fade" id="list-shiraz" role="tabpanel" aria-labelledby="list-shiraz-list">Shiraz Medical Centers</div>-->
        <!--                <div class="tab-pane fade" id="list-tabriz" role="tabpanel" aria-labelledby="list-tabriz-list">Tabriz Medical Centers</div>-->
        <!--                <div class="tab-pane fade" id="list-mashhad" role="tabpanel" aria-labelledby="list-mashhad-list">Mashhad Medical Centers</div>-->
        <!--                <div class="tab-pane fade" id="list-kish" role="tabpanel" aria-labelledby="list-kish-list">Kish Medical Centers</div>-->
        <!--                <div class="tab-pane fade" id="list-qom" role="tabpanel" aria-labelledby="list-qom-list">Qom Medical Centers</div>-->
        <!--                <div class="tab-pane fade" id="list-rasht" role="tabpanel" aria-labelledby="list-rasht-list">Rasht Medical Centers</div>-->
        <!--                <div class="tab-pane fade" id="list-yazd" role="tabpanel" aria-labelledby="list-yazd-list">Yazd Medical Centers</div>-->
        <!--            </div>-->
        <!--        </div>-->
        <?php
        $city = 'tehran';
        if(isset($_POST['city']))
        {
            if($_POST['city']=="tehran")
            {
                $city='tehran';
                echo '<script type="text/javascript">document.getElementById("list-tehran-list").style.backgroundColor="#007bff"</script>';
                echo '<script type="text/javascript">document.getElementById("list-tehran-list").style.color="white"</script>';
            }
            if($_POST['city']=="isfahan")
            {
                $city='isfahan';
                echo '<script type="text/javascript">document.getElementById("list-isfahan-list").style.backgroundColor="#007bff"</script>';
                echo '<script type="text/javascript">document.getElementById("list-isfahan-list").style.color="white"</script>';
            }
            if($_POST['city']=="shiraz")
            {
                $city='shiraz';
                echo '<script type="text/javascript">document.getElementById("list-shiraz-list").style.backgroundColor="#007bff"</script>';
                echo '<script type="text/javascript">document.getElementById("list-shiraz-list").style.color="white"</script>';
            }
            if($_POST['city']=="tabriz")
            {
                $city='tabriz';
                echo '<script type="text/javascript">document.getElementById("list-tabriz-list").style.backgroundColor="#007bff"</script>';
                echo '<script type="text/javascript">document.getElementById("list-tabriz-list").style.color="white"</script>';
            }
            if($_POST['city']=="mashhad")
            {
                $city='mashhad';
                echo '<script type="text/javascript">document.getElementById("list-mashhad-list").style.backgroundColor="#007bff"</script>';
                echo '<script type="text/javascript">document.getElementById("list-mashhad-list").style.color="white"</script>';
            }
            if($_POST['city']=="kish")
            {
                $city='kish';
                echo '<script type="text/javascript">document.getElementById("list-kish-list").style.backgroundColor="#007bff"</script>';
                echo '<script type="text/javascript">document.getElementById("list-kish-list").style.color="white"</script>';
            }
            if($_POST['city']=="qom")
            {
                $city='qom';
                echo '<script type="text/javascript">document.getElementById("list-qom-list").style.backgroundColor="#007bff"</script>';
                echo '<script type="text/javascript">document.getElementById("list-qom-list").style.color="white"</script>';
            }
            if($_POST['city']=="rasht")
            {
                $city='rasht';
                echo '<script type="text/javascript">document.getElementById("list-rasht-list").style.backgroundColor="#007bff"</script>';
                echo '<script type="text/javascript">document.getElementById("list-rasht-list").style.color="white"</script>';
            }
            if($_POST['city']=="yazd")
            {
                $city='yazd';
                echo '<script type="text/javascript">document.getElementById("list-yazd-list").style.backgroundColor="#007bff"</script>';
                echo '<script type="text/javascript">document.getElementById("list-yazd-list").style.color="white"</script>';
            }

        }
        ?>
        <div class=" verdana">
            <div class="tab-content cityHeader titleContainer" id="nav-tabContent" style="text-align: center; width: 100%; position: center;">
                <div class="tab-pane fade show active cityHeader" id="list-all" role="tabpanel" aria-labelledby="list-all-list"><?php echo strtoupper($city)." 'S " ?></div>
            </div>
            <!--            <div class="titleContainer">TOP MEDICAL CENTERS-->
            <!--                <hr class="horizontalRule">-->
            <!--            </div>-->

<!--            <div class="detailContainer">Best Historical and Tourism Cities<br>– they are very popular from around the world!</div>-->
            <?php
            $query = "SELECT * FROM $city";
            $s = $pdo->prepare($query);
            $s -> execute();
            $infos = $s->fetchAll();
            if(count($infos))
            {
                $info = $infos[0];
            }

            $destination ="";
            $attraction ="";
            if(isset($info) and count($info))
            {
                $destination = $info['destination'];
                $attraction = $info['attraction'];
            }


            $cityImages = $city."images";
            $query = "SELECT * FROM $cityImages LIMIT 3";
            $s = $pdo-> prepare($query);
            $s -> execute();
            $info = $s -> fetchAll();
            if(isset($info[0]))
            {
                $image = $info[0];
            }
            if(isset($info[1]))
            {
                $image2 = $info[1];
            }
            if(isset($info[2]))
            {
                $image3 = $info[2];
            }


            $cityTours = $city."tours";
            $query="SELECT * FROM $cityTours";
            $s = $pdo-> prepare($query);
            $s -> execute();
            $tours = $s -> fetchAll();

            ?>
            <div class="boxContainer marginContainer shadowBehind">
                <!-- Slideshow container -->
                <div class="slideshow-container">

                    <!-- Full-width images with number and caption text -->
                    <div class="mySlides fade">
                        <div class="numbertext">1 / 3</div>
                        <img src="../../../images/<?php echo $cityImages?>/<?php if(isset($image) and count($image)){echo $image['filename'];} ?>" style="width:100%">
                        <div class="text"></div>
                    </div>

                    <div class="mySlides fade">
                        <div class="numbertext">2 / 3</div>
                        <img src="../../../images/<?php echo $cityImages?>/<?php if(isset($image2) and count($image2)){echo $image2['filename'];} ?>" style="width:100%">
                        <div class="text"></div>
                    </div>

                    <div class="mySlides fade">
                        <div class="numbertext">3 / 3</div>
                        <img src="../../../images/<?php echo $cityImages?>/<?php if(isset($image3) and count($image3)){echo $image3['filename'];} ?>" style="width:100%">
                        <div class="text"></div>
                    </div>

                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>
                <!-- The dots/circles -->
                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>

                <div class="citiesHeader" style="margin-top: 35px; width: 70%; margin-right: auto; margin-left: auto;text-align: left; color: #ff7043; font-family: belleza; font-size: 25px;">WHERE IS IT?!</div>
                <div style="width: 70%; margin-right: auto; margin-left: auto; margin-top: 5px;">
                    <?php
                    echo $destination;
                    ?>
                </div>
                <div class="citiesHeader" style="margin-top: 35px; width: 70%; margin-right: auto; margin-left: auto;text-align: left; color: #ff7043; font-family: belleza; font-size: 25px;">ATTRACTIONS</div>
                <div style="width: 70%; margin-right: auto; margin-left: auto; margin-top: 5px;">
                    <?php
                    echo $attraction;
                    ?>
                </div>

                <div class="citiesHeader" style="margin-top: 35px; width: 70%; margin-right: auto; margin-left: auto;text-align: left; color: #ff7043; font-family: belleza; font-size: 25px;">TOUR PLANS</div>
                <div style="width: 70%; margin-right: auto; margin-left: auto; margin-top: 5px;">
                    <div class="treatmentContainer">
                        <?php
                        if(isset($tours) and count($tours))
                        {
                            $count =0;
                            while ($count<count($tours))
                            {
                                ?>
                                <div class="treatmentCardsContainer">
                                    <?php
                                    while($count%8<5)
                                    {
                                        if($count>=count($tours))
                                        {
                                            break;
                                        }
                                        $tour = $tours[$count];

                                        ?>
                                        <button type="button" class="treatmentButton treatmentBtn"><?php echo $tour['days'] ?> Days Around <?php echo $city ?><br><?php echo $tour['cost'] ?>$</button>


                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </div>
                                <div class="treatmentCardsContainer">
                                    <?php
                                    while($count%8<=7 and $count%8>=5)
                                    {
                                        if($count>=count($tour))
                                        {
                                            break;
                                        }
                                        $tour = $tour[$count];
                                        ?>
                                        <button type="button" class="treatmentButton treatmentBtn"><?php echo $tour['days'] ?> Days Around <?php echo $city ?><br><?php echo $tour['cost'] ?>$</button>

                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>

                </div>



                </div>
            </div>

        </div>


    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript" src="script.js"></script>
</body>
</html>