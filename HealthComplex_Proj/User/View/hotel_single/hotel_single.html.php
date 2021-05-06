
<?php
if(isset($_POST['singleHotel']) and $_POST['singleHotel'] == "see more")
{
    $name = $_POST['name'];
    $city = $_POST['city'];

    $query = "SELECT * FROM hotels WHERE name=:name AND city=:city";
    $s = $pdo -> prepare($query);
    $s -> bindValue(':name',$name);
    $s -> bindValue(':city',$city);
    $s -> execute();

    $rows = $s->fetchAll();
    if(count($rows)==1)
    {
        $row = $rows[0];
        $name = $row['name'];
        $comment = $row['comment'];
        $address = "<br>".$row['address'];
        $phone = "<br>".$row['phone'];
        $rate = $row['rate'];
        $city = "<br>".$row['city'];
    }
    $hotelImageTable = $name."hotelimages";
    $query = "SELECT * FROM $hotelImageTable LIMIT 8";
    $s = $pdo -> prepare($query);
    $s -> execute();
    $rows = $s -> fetchAll();
    if(isset($rows) and count($rows)==1)
    {
        $row = $rows[0];
        if(count($row))
        {
            $image = $row['filename'];
        }
    }

    $hotelRoomPlans = $name."hotelroomplans";
    $query = "SELECT * FROM $hotelRoomPlans";
    $s = $pdo -> prepare($query);
    $s -> execute();
    $rooms = $s -> fetchAll();

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Health Complex|Hotel</title>

        <!-- ‌‌ BootStrap  -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

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
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Hotels</a>
                    </li>
                    <li class="nav-item">
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



        <div class="cardsContainer mainBackgroundContainer" style="align-content: center;">

            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php
                    if(isset($rows) and count($rows))
                    {
                        $counter = 1;
                        foreach($rows as $row)
                        {
                            if(isset($row) and count($row))
                            {
                                if($counter ==1)
                                {
                                    ?>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $counter-1; ?>"  aria-current="true" class="active" aria-label="Slide <?php echo $counter ?>"></button>

                                    <?php
                                }else{
                                ?>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $counter-1; ?>"  aria-current="true" aria-label="Slide <?php echo $counter ?>"></button>
                    <?php
                                }
                            }
                            $counter = $counter +1;
                        }
                    }
                    ?>
                    <!--<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>-->
                </div>
                <div class="carousel-inner">
                     <?php
                    if(isset($rows) and count($rows))
                    {
                        $counter = 1;
                        foreach($rows as $row)
                        {
                            if(isset($row) and count($row))
                            {
                                if($counter ==1)
                                {
                                    ?>
                                    <div class="carousel-item active " data-bs-interval="5000">
                                        <img src="../../../images/<?php echo $hotelImageTable?>/<?php if(isset($row)){echo $row['filename'];}?>" class="d-block w-100" alt="...">
                                    </div>
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class="carousel-item " data-bs-interval="5000">
                                        <img src="../../../images/<?php echo $hotelImageTable?>/<?php if(isset($row)){echo $row['filename'];}?>" class="d-block w-100" alt="...">
                                    </div>
                                    <?php
                                }

                            }
                            $counter = $counter +1;
                        }
                    }
                     ?>
                    <!--<div class="carousel-item active" data-bs-interval="5000">
                        <img src="../images/espinas_palace.jpg" class="mainBackground" class="d-block w-100" alt="...">
                    </div>



                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="../images/espinas_palace.jpg" class="mainBackground" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="../images/espinas_palace.jpg" class="mainBackground" class="d-block w-100" alt="...">
                    </div>-->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!--            <div class="titleContainer">TOP MEDICAL CENTERS-->
            <!--                <hr class="horizontalRule">-->
            <!--            </div>-->

            <!--            <div class="detailContainer">Best Historical and Tourism Cities<br>– they are very popular from around the world!</div>-->

            <div class="boxContainer marginContainer shadowBehind">

                <div class="citiesHeader" style="margin-top: 0px; width: 70%; margin-right: auto; margin-left: auto;text-align: center; color: #66bb6a; font-family: belleza; font-size: 33px; font-weight: bold;">
                    <?php echo strtoupper($name)." HOTEL" ?>
                    <div style="margin-top: 20px; display: flex; justify-content: center;">
                        <?php
                        for($i=0;$i<$rate;$i++)
                        {
                            ?>
                            <img src="images/star_hotel.png" class="stars">
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="citiesHeader" style="margin-top: 25px; width: 70%; margin-right: auto; margin-left: auto;text-align: left; color: #ff7043; font-family: belleza; font-size: 25px;">ABOUT IT?!</div>
                <div style="width: 70%; margin-right: auto; margin-left: auto; margin-top: 5px;">
                    <?php
                    echo $comment;
                    echo '<br>';
                    echo "Address:".$address."<br>";
                    echo "Phone:".$phone;
                    ?>
                </div>
                <div class="citiesHeader" style="margin-top: 35px; width: 70%; margin-right: auto; margin-left: auto;text-align: left; color: #ff7043; font-family: belleza; font-size: 25px;">ROOM PLANS</div>


                <div style="width: 70%; margin-right: auto; margin-left: auto; margin-top: 5px;">
                    <div class="treatmentContainer">
                        <?php
                        if(isset($rooms) and count($rooms))
                        {
                            $count =0;
                            while ($count<count($rooms))
                            {
                                ?>
                                <div class="treatmentCardsContainer">
                                    <?php
                                    while($count%8<5)
                                    {
                                        if($count>=count($rooms))
                                        {
                                            break;
                                        }
                                        $room = $rooms[$count];

                                        ?>
                                        <button type="button" class="treatmentButton treatmentBtn"><?php echo $room['beds']; ?> Beds,<?php echo $room['nights'] ?> Nights(VIP)<br><?php echo $room['cost']; ?>$</button>


                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </div>
                                <div class="treatmentCardsContainer">
                                    <?php
                                    while($count%8<=7 and $count%8>=5)
                                    {
                                        if($count>=count($rooms))
                                        {
                                            break;
                                        }
                                        $room = $rooms[$count];
                                        ?>
                                        <button type="button" class="treatmentButton treatmentBtn"><?php echo $room['beds']; ?> Beds,<?php echo $room['nights'] ?> Nights(VIP)<br><?php echo $room['cost']; ?>$</button>

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
<?php
}

?>


