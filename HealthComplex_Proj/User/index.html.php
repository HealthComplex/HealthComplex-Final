<?php
if (session_status() === PHP_SESSION_NONE){session_start();}
include '../connectionDB.php';


if(!function_exists('topHospitals'))
{
    function topHospitals($city)
    {
        include '../connectionDB.php';
        $query = "SELECT * FROM hospitals WHERE city=:city ORDER BY rate DESC LIMIT 6 ";
        $s = $pdo -> prepare($query);
        $s -> bindValue(':city',$city);
        $s -> execute();

        $rows = $s -> fetchAll();
        return $rows;
    }
}
if(!function_exists('CityTour'))
{
    function CityTour($city)
    {
        include '../connectionDB.php';
        $query = "SELECT * FROM $city";
        $s = $pdo -> prepare ($query);
        $s -> execute();

        $info = $s -> fetch();
        return $info;
    }
}
?>
<!-- Main HTML -->
<!DOCTYPE html>
<html lang="en">

<html>
<head>
	<meta charset="UTF-8">
	<title>Health Complex</title>
	<link rel="shortcut icon" type="image/png" href="View/images/favicon.ico"/>
	<link type="text/css" rel="stylesheet" href="style.css"><link>

	<!-- ‌‌ BootStrap  -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>
	<div class="navbarContainer topNavbar">
		<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
			<a class="navbar-brand" href="#">
				<img src="View/images/health.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
				Health Complex
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
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
					<li class="nav-item">
						<a class="nav-link" href="#">Tourism Services</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./View/about_us/index.html" target="_blank">About Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./View/contact_us/index.html" target="_blank">Contact</a>
					</li>
				</ul>
				<div class="logoutContainer"><a class="logoutBtn" href="#">logout</a></div>
				<div class="getStartedContainer"><a class="getStartedBtn" href="View/register/index.php" target="_blank">Get Started Now</a></div>
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		</nav>
	</div>


	<div class="mainBackgroundContainer">
		<img src="View/images/main_background.jpg" class="mainBackground"/>
		<div class="centered comic"><b>Experience a reminiscent time at our Health Complex</b></div>
	</div>

	<div class="boxContainer verdana firstSectionContainer">
		<div class="titleContainer">Health Complex
			<hr class="horizontalRule">
		</div>

		<div class="detailContainer">the best services are presented at our Health Tourist Complex.<br>
		Medical tourism refers to people traveling abroad to obtain medical treatment. In the past, this usually referred to those who traveled from less-developed countries to major medical centers in highly developed countries for treatment unavailable at home. However, in recent years it may equally refer to those from developed countries who travel to developing countries for lower-priced medical treatments. The motivation may be also for medical services unavailable or non-licensed in the home country: There are differences between the medical agencies (FDA, EMA etc.) world-wide, whether a drug is approved in their country or not. Even within Europe, although therapy protocols might be approved by the European Medical Agency (EMA), several countries have their own review organizations (i.e. NICE by the NHS) in order to evaluate whether the same therapy protocol would be "cost-effective", so that patients face differences in the therapy protocols, particularly in the access of these drugs, which might be partially explained by the financial strength of the particular Health System.</div>
	</div>

	<div class="slideshowContainer">
		<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="View/images/slideshow1.jpg" class="newsImages" alt="...">  <!-- d-block w-100 -->
				</div>
				<div class="carousel-item">
					<img src="View/images/slideshow2.jpg" class="newsImages" alt="...">
				</div>
				<div class="carousel-item">
					<img src="View/images/slideshow3.jpg" class="newsImages" alt="...">
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>

	<div class="boxContainer verdana">
		<div class="titleContainer">TOP МEDICAL CENTERS
			<hr class="horizontalRule">
		</div>

		<div class="detailContainer">Featured and well-known medical centers <br>– they are the mostly trusted by patients for healthcare.</div>

		<div class="cityBtnContainer">
            <form method="post">
                <button type="submit" name="city" value="tehran" class="cityButton city1Btn">Tehran</button>
                <button type="submit" name="city" value="shiraz" class="cityButton city2Btn">Shiraz</button>
                <button type="submit" name="city" value="mashhad" class="cityButton city3Btn">Mashhad</button>
                <button type="submit" name="city" value="isfahan" class="cityButton city4Btn">Isfahan</button>
            </form>
		</div>

		<div class="boxContainer marginContainer">
			<div class="row row-cols-1 row-cols-md-3">
                <?php
                $city = "tehran";
                if(isset($_POST['city']))
                {
                    $city = $_POST['city'];
                }
                $rows = topHospitals($city);
                if(isset($rows))
                {
                    foreach($rows as $row)
                    {
                        if(isset($row) and count($row))
                        {
                            $name = $row['name'];
                            $comment = $row['comment'];
                            $hospitalImageTable = $name.'hospitalimages';
                            $query = "SELECT filename FROM $hospitalImageTable LIMIT 1";
                            $s = $pdo ->prepare($query);
                            $s -> execute();
                            $img = $s -> fetch();
                            if($img)
                            {
                                $img_name = $img['filename'];
                            }?>
                            <div class="col mb-4">
                                <div class="card shadowBehind">
                                    <div class="container ">
                                        <img src="../images/<?php echo $hospitalImageTable; ?>/<?php if(isset($img_name)){echo $img_name;} ?>" class="cardImage image" alt="...">
                                        <div class="middle">
                                            <form method="post" action="View/hospital_single/index.php">
                                                <input type="hidden" name="name" value="<?php echo $name?>">
                                                <input type="hidden" name="city" value="<?php echo $row['city'];?>">
                                                <button type="submit" class="showBtn" name="single_hospital" value="see more">Show</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $name; ?></h5>
                                        <p class="card-text"><?php echo $comment; ?></p>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>

			</div>
		</div>
	</div>

	<div class="treatmentContainer">

		<div class="titleContainer" style="padding-bottom: 30px;">All Specialties
			<hr class="horizontalRule">
		</div>

		<div class="treatmentCardsContainer">
			<button type="button" class="treatmentButton treatmentBtn">Addiction Treatment</button>
			<button type="button" class="treatmentButton treatmentBtn">Aesthetics</button>
			<button type="button" class="treatmentButton treatmentBtn">Allergy</button>
			<button type="button" class="treatmentButton treatmentBtn">Anaesthesiology</button>
			<button type="button" class="treatmentButton treatmentBtn">Bariatrics</button>
		</div>

		<div class="treatmentCardsContainer">
			<button type="button" class="treatmentButton treatmentBtn">Cancer Treatment</button>
			<button type="button" class="treatmentButton treatmentBtn">Cardiac Surgery</button>
			<button type="button" class="treatmentButton treatmentBtn">Cardialogy</button>
		</div>

		<div class="treatmentCardsContainer">
			<button type="button" class="treatmentButton treatmentBtn">Checkup</button>
			<button type="button" class="treatmentButton treatmentBtn">Dental Care</button>
			<button type="button" class="treatmentButton treatmentBtn">Dermatology</button>
			<button type="button" class="treatmentButton treatmentBtn">Dialysis</button>
			<button type="button" class="treatmentButton treatmentBtn">Endocrinology</button>
		</div>

		<div class="treatmentCardsContainer">
			<button type="button" class="treatmentButton treatmentBtn">Ent</button>
			<button type="button" class="treatmentButton treatmentBtn">Eye Surgery</button>
			<button type="button" class="treatmentButton treatmentBtn">Gastroenterology</button>
		</div>

		<div class="treatmentCardsContainer">
			<button type="button" class="treatmentButton treatmentBtn">General Surgery</button>
			<button type="button" class="treatmentButton treatmentBtn">Geriatrics</button>
			<button type="button" class="treatmentButton treatmentBtn">Hair Transplant</button>
			<button type="button" class="treatmentButton treatmentBtn">Hematoloty</button>
			<button type="button" class="treatmentButton treatmentBtn">Hepatology</button>
		</div>

		<div class="treatmentCardsContainer">
			<button type="button" class="treatmentButton treatmentBtn">Imaging</button>
			<button type="button" class="treatmentButton treatmentBtn">Immunology</button>
			<button type="button" class="treatmentButton treatmentBtn">Infertility Treatment</button>
		</div>

		<div class="treatmentCardsContainer">
			<button type="button" class="treatmentButton treatmentBtn">Internal Medicine</button>
			<button type="button" class="treatmentButton treatmentBtn">Nephrology</button>
			<button type="button" class="treatmentButton treatmentBtn">Neurology</button>
			<button type="button" class="treatmentButton treatmentBtn">Neurosurgery</button>
			<button type="button" class="treatmentButton treatmentBtn">Ob-Gyn</button>
		</div>

		<div class="treatmentCardsContainer">
			<button type="button" class="treatmentButton treatmentBtn">Orthopedic Surgery</button>
			<button type="button" class="treatmentButton treatmentBtn">Pediatrics</button>
			<button type="button" class="treatmentButton treatmentBtn">Plastic Surgery</button>
		</div>

		<div class="treatmentCardsContainer">
			<button type="button" class="treatmentButton treatmentBtn">Psychiatry</button>
			<button type="button" class="treatmentButton treatmentBtn">Pulmonology</button>
			<button type="button" class="treatmentButton treatmentBtn">Rehabilitation</button>
			<button type="button" class="treatmentButton treatmentBtn">Rheumatalogy</button>
			<button type="button" class="treatmentButton treatmentBtn">Robotic Surgery</button>
		</div>

		<div class="treatmentCardsContainer">
			<button type="button" class="treatmentButton treatmentBtn">Stem Cell Therapy</button>
			<button type="button" class="treatmentButton treatmentBtn">Transplantation</button>
			<button type="button" class="treatmentButton treatmentBtn">Urology</button>
			<button type="button" class="treatmentButton treatmentBtn">Vascular Surgery</button>
		</div>
	</div>


	<div class="toursimContainer">
		<div class="container my-4">

			<div class="titleContainer" style="padding-bottom: 30px;">Popular Tourism Destinations
				<hr class="horizontalRule">
			</div>

			<!--Carousel Wrapper-->
			<div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
					<li data-target="#multi-item-example" data-slide-to="1"></li>
					<li data-target="#multi-item-example" data-slide-to="2"></li>
				</ol>
				<!--Controls-->
				<div class="controls-top">
   <!--      <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
   	<a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa fa-chevron-right"></i></a> -->
   	<a class="carousel-control-prev" href="#multi-item-example" role="button" data-slide="prev">
   		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
   		<span class="sr-only">Previous</span>
   	</a>
   	<a class="carousel-control-next" href="#multi-item-example" role="button" data-slide="next">
   		<span class="carousel-control-next-icon" aria-hidden="true"></span>
   		<span class="sr-only">Next</span>
   	</a>
   </div>
   <!--/.Controls-->

   <!--Indicators-->
     <!--  <ol class="carousel-indicators">
        <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
        <li data-target="#multi-item-example" data-slide-to="1"></li>
        <li data-target="#multi-item-example" data-slide-to="2"></li>
    </ol> -->

    <!--/.Indicators-->

    <!--Slides-->

    <div class="carousel-inner" role="listbox">

    	<!--First slide-->
    	<div class="carousel-item active">

    		<div class="row">
                <?php
                $info = CityTour('shiraz');
                $comment = $info['destination'];

                ?>
    			<div class="col-md-4">
    				<div class="card mb-2">
    					<img class="card-img-top tourismDestinationImages" src="View/images/shiraz.jpg"
    					alt="Card image cap">
    					<div class="card-body">
    						<h4 class="card-title">Shiraz</h4>
    						<p class="card-text toursitDesctiption"><?php echo $comment; ?></p>
    						<a class="btn btn-primary" href="View/tourism_services/index.php">See More</a>
    					</div>
    				</div>
    			</div>

                <?php
                $info = CityTour('isfahan');
                $comment = $info['destination'];

                ?>
    			<div class="col-md-4 clearfix d-none d-md-block">
    				<div class="card mb-2">
    					<img class="card-img-top tourismDestinationImages" src="View/images/isfahan.jpeg"
    					alt="Card image cap">
    					<div class="card-body">
    						<h4 class="card-title">Isfahan</h4>
                            <p class="card-text toursitDesctiption"><?php echo $comment; ?></p>
                            <a class="btn btn-primary" href="View/tourism_services/index.php">See More</a>
    					</div>
    				</div>
    			</div>

                <?php
                $info = CityTour('tehran');
                $comment = $info['destination'];

                ?>
    			<div class="col-md-4 clearfix d-none d-md-block">
    				<div class="card mb-2">
    					<img class="card-img-top tourismDestinationImages" src="View/images/tehran.jpeg"
    					alt="Card image cap">
    					<div class="card-body">
    						<h4 class="card-title">Tehran</h4>
                            <p class="card-text toursitDesctiption"><?php echo $comment; ?></p>
                            <a class="btn btn-primary" href="View/tourism_services/index.php">See More</a>
    					</div>
    				</div>
    			</div>
    		</div>

    	</div>
    	<!--/.First slide-->

    	<!--Second slide-->
    	<div class="carousel-item">


    		<div class="row">
                <?php
                $info = CityTour('tabriz');
                $comment = $info['destination'];

                ?>
    			<div class="col-md-4">
    				<div class="card mb-2">
    					<img class="card-img-top tourismDestinationImages" src="View/images/tabriz.jpeg"
    					alt="Card image cap">
    					<div class="card-body">
    						<h4 class="card-title">Tabriz</h4>
                            <p class="card-text toursitDesctiption"><?php echo $comment; ?></p>
                            <a class="btn btn-primary" href="View/tourism_services/index.php">See More</a>
    					</div>
    				</div>
    			</div>

                <?php
                $info = CityTour('yazd');
                $comment = $info['destination'];

                ?>
    			<div class="col-md-4 clearfix d-none d-md-block">
    				<div class="card mb-2">
    					<img class="card-img-top tourismDestinationImages" src="View/images/yazd.jpeg"
    					alt="Card image cap">
    					<div class="card-body">
    						<h4 class="card-title">Yazd</h4>
                            <p class="card-text toursitDesctiption"><?php echo $comment; ?></p>
                            <a class="btn btn-primary" href="View/tourism_services/index.php">See More</a>
    					</div>
    				</div>
    			</div>

                <?php
                $info = CityTour('mashhad');
                $comment = $info['destination'];

                ?>
    			<div class="col-md-4 clearfix d-none d-md-block">
    				<div class="card mb-2">
    					<img class="card-img-top tourismDestinationImages" src="View/images/mashhad.jpeg"
    					alt="Card image cap">
    					<div class="card-body">
    						<h4 class="card-title">Mashhad</h4>
                            <p class="card-text toursitDesctiption"><?php echo $comment; ?></p>
                            <a class="btn btn-primary" href="View/tourism_services/index.php">See More</a>
    					</div>
    				</div>
    			</div>
    		</div>

    	</div>
    	<!--/.Second slide-->

    	<!--Third slide-->
    	<div class="carousel-item">

    		<div class="row">
                <?php
                $info = CityTour('qom');
                $comment = $info['destination'];

                ?>
    			<div class="col-md-4">
    				<div class="card mb-2">
    					<img class="card-img-top tourismDestinationImages" src="View/images/qom.jpeg"
    					alt="Card image cap">
    					<div class="card-body">
    						<h4 class="card-title">Qom</h4>
                            <p class="card-text toursitDesctiption"><?php echo $comment; ?></p>
                            <a class="btn btn-primary" href="View/tourism_services/index.php">See More</a>
    					</div>
    				</div>
    			</div>

                <?php
                $info = CityTour('kish');
                $comment = $info['destination'];

                ?>
    			<div class="col-md-4 clearfix d-none d-md-block">
    				<div class="card mb-2">
    					<img class="card-img-top tourismDestinationImages" src="View/images/kish.jpeg"
    					alt="Card image cap">
    					<div class="card-body">
    						<h4 class="card-title">Kish</h4>
                            <p class="card-text toursitDesctiption"><?php echo $comment; ?></p>
                            <a class="btn btn-primary" href="View/tourism_services/index.php">See More</a>
    					</div>
    				</div>
    			</div>

                <?php
                $info = CityTour('rasht');
                $comment = $info['destination'];

                ?>
    			<div class="col-md-4 clearfix d-none d-md-block">
    				<div class="card mb-2">
    					<img class="card-img-top tourismDestinationImages" src="View/images/rasht.jpeg"
    					alt="Card image cap">
    					<div class="card-body">
    						<h4 class="card-title">Rasht</h4>
                            <p class="card-text toursitDesctiption"><?php echo $comment; ?></p>
                            <a class="btn btn-primary" href="View/tourism_services/index.php">See More</a>
    					</div>
    				</div>
    			</div>
    		</div>

    	</div>
    	<!--/.Third slide-->

    </div>
    <!--/.Slides-->

</div>
<!--/.Carousel Wrapper-->


</div>
</div>


<div class="stepsContainer">
	<div class="titleContainer" style="padding-bottom: 40px;">Steps of HealthCare
		<hr class="horizontalRule">
	</div>

	<div class="stepsNumberContainer">
		<a class="stepsButton" href="#" role="button">1</a>
		<a class="stepsButton" href="#" role="button">2</a>
		<a class="stepsButton" href="#" role="button">3</a>
		<a class="stepsButton" href="#" role="button">4</a>
		<img class="stepsButton" src="View/images/health.png" style="width: 85px; height: 85px; border: none;">
	</div>
	<hr class=" hrSteps">

	<div class="stepsDescriptionContainer">
		<small style="text-align: center;">Choose the medical service<br>you need and your<br>medical center</small>
		<small style="text-align: center;">Find your hotel<br>to stay there</small>
		<small style="text-align: center;">Choose the toursim<br>services which<br>you want</small>
		<small style="text-align: center;">Find your<br>transportation methods</small>
		<small style="text-align: center;">Trip Planning<br>and treatment</small>

	</div>

	<div class="stepsDescriptionContainer" style="padding-top: 60px;">
		<button class="getStartedButton">Get Started Now</button>
	</div>
	
</div>

<div class="whyUsContainer">
	<div class="titleContainer" style="padding-bottom: 20px;">Why Us?
		<hr class="horizontalRule">
	</div>

	<div class="whyUsDetailContainer">Serving exclusively for health and care –<br>every happy patient is invaluable for us
	</div>

	<div  class="stepsDescriptionContainer">
		<small class="whyUsOptions">Best Doctors and Medical Centers</small>
		<small class="whyUsOptions">Best Tourist Services</small>
		<small class="whyUsOptions">Least Costs Accompanied by Best Services</small>
	</div>

	<div style="padding-top: 80px;">
		<small class="whyUsConclusion">Every City, Every Hotel, Every Health Care presented By Health Care Complex!</small>
	</div>

</div>

<div class="contactContainer">
	<div class="titleContainer" style="padding-bottom: 20px;">Contact Us
		<hr class="horizontalRule">
	</div>

	<div class="contactWaysContainer">
		<div style="text-align: center;"><img src="View/images/email.png" style="width: 65px; height: 46px;"><h5 style="padding-top: 14px; text-align: center;">Email</h5>
		</div>

		<div style="text-align: center;"><img src="View/images/linkedin.png" style="width: 50px; height: 49px;"><h5 style="padding-top: 14px; text-align: center;">Linkedin</h5>
		</div>

		<div style="text-align: center;"><img src="View/images/instagram.png" style="width: 50px; height: 50px;"><h5 style="padding-top: 14px; text-align: center;">Instagram</h5>
		</div>
	</div>

	<div class="maps">
		<div class="contactWaysContainer" style="padding-top: 40px;">
			<div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3239.9190608373096!2d51.35371968448909!3d35.70360933635128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e00a8bc1a7e63%3A0x61a5a909b878501!2z2K_Yp9mG2LTar9in2Ycg2LXZhti52KrbjCDYtNix24zZgQ!5e0!3m2!1sfa!2sus!4v1596370682701!5m2!1sfa!2sus"
				width="250" height="200" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
				<p class="roboto">Health Complex<br>
					District 2, Tehran Province, Iran<br>Phone: </p>
				</div>
			</div>
		</div>
	</div>

	<div class="participantsContainer">
		<div class="titleContainer" style="padding-bottom: 20px;">Our Participants
			<hr class="horizontalRule">
		</div>

		<div>
			<div class="container">
				<div class="row">
					<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
						<div class="MultiCarousel-inner">
							<div class="item partnerCards">
								<div class="partnerCards">
									<img class="lead partnersCardImage" src="View/images/erfan.jpg">
									<p style="padding-top: 30px;">Erfan Hospital</p>

								</div>
							</div>
							<div class="item partnerCards">
								<div class="partnerCards">
									<img class="lead partnersCardImage" src="View/images/mehr.jpeg">
									<p style="padding-top: 30px;">Mehr Hospital</p>

								</div>
							</div>
							<div class="item partnerCards">
								<div class="partnerCards">
									<img class="lead partnersCardImage" src="View/images/pars.jpg">
									<p style="padding-top: 30px;">Pars Hospital</p>

								</div>
							</div>
							<div class="item partnerCards">
								<div class="partnerCards">
									<img class="lead partnersCardImage" src="View/images/farabi.jpeg">
									<p style="padding-top: 30px;">Farabi Eye Hospital</p>

								</div>
							</div>
							<div class="item partnerCards">
								<div class="partnerCards">
									<img class="lead partnersCardImage" src="View/images/milad.jpeg">
									<p style="padding-top: 30px;">Milad Hospital</p>

								</div>
							</div>
							<div class="item partnerCards">
								<div class="partnerCards">
									<img class="lead partnersCardImage" src="View/images/valiasr.jpeg">
									<p style="padding-top: 30px;">Valiasr Hospital</p>

								</div>
							</div>
							<div class="item partnerCards">
								<div class="partnerCards">
									<img class="lead partnersCardImage" src="View/images/espinas_palace.jpg">
									<p style="padding-top: 30px;">Espinas Palas Hotel</p>

								</div>
							</div>
							<div class="item partnerCards">
								<div class="partnerCards">
									<img class="lead partnersCardImage" src="View/images/parsian.jpeg">
									<p style="padding-top: 30px;">Parsian Azadi Hotel</p>

								</div>
							</div>
							<div class="item partnerCards">
								<div class="partnerCards">
									<img class="lead partnersCardImage" src="View/images/ferdowsi.jpeg">
									<p style="padding-top: 30px;">Ferdowsi Grand Hotel</p>

								</div>
							</div>
							<div class="item partnerCards">
								<div class="partnerCards">
									<img class="lead partnersCardImage" src="View/images/wisteria.jpeg">
									<p style="padding-top: 30px;">Wisteria Hotel</p>

								</div>
							</div>
						</div>
						<button class="btn btn-primary leftLst"><</button>
						<button class="btn btn-primary rightLst">></button>
					</div>
				</div>

			</div>
		</div>
		<script type="text/javascript" src="script.js"></script>
	</div>

</body>

<footer class="footer">
	<div class="footerTitle">
		<h5><img src="View/images/health.png" class="logoImage"/> &nbsp;&nbsp;&nbsp;Health Complex</h5>
	</div>


	<div class="footerContainer">
		<div class="educationFooter">
			<h6>Medical Centers</h6>
			<hr style="border-width: 2px;">
			<small>Tehran</small><br>
			<small>Shiraz</small><br>
			<small>Mashhad</small><br>
			<small>Tabriz</small><br>
			<small>Isfahan</small><br>
		</div>
		<div class="acceleratorFooter">
			<h6>Medical Services</h6>
			<hr style="border-width: 2px;">
			<small>Medical</small><br>
			<small>Cosmetic</small><br>
		</div>
		<div class="internationalFooter">
			<h6>Hotels</h6>
			<hr style="border-width: 2px;">
			<small>International Hotels</small><br>
			<small>The Best Ones</small><br>

		</div>
		<div class="scientificFooter">
			<h6>Tourism Services</h6>
			<hr style="border-width: 2px;">
			<small>Tehran</small><br>
			<small>Shiraz</small><br>
			<small>Mashhad</small><br>
			<small>Tabriz</small><br>
			<small>Isfahan</small><br>
			<small>Yazd</small><br>
			<small>Qom</small><br>
			<small>Rasht</small><br>
			<small>Kish</small><br>
		</div>
		<div class="networkFooter">
			<h6>Transformation Services</h6>
			<hr style="border-width: 2px;">
			<small>Airplane</small><br>
			<small>Train</small><br>
			<small>Bus</small><br>
			<small>Luxurious Cars</small><br>
		</div>
		<div class="contactFooter">
			<h6>Contact Us</h6>
			<hr style="border-width: 2px;">
			<small>Email</small><br>
			<small>Phone</small><br>
			<small>Linkedin</small><br>
			<small>Instagram</small><br>
		</div>
	</div>

	<div><small style="color: grey">2020 ,</small><small>Health Complex</small><small style="color: grey"> Designed By </small><small> Sina Elahimanesh</small></div>
</footer>
</html>

