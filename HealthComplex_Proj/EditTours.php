<?php
include 'connectionDB.php';
include 'SecurityFunctions.php';

if(session_status()===PHP_SESSION_NONE){session_start();};

if(!preloggedin())
{
    unsetSessions();
    show_message('please login again.');
    echo '<script type="text/javascript">window.location.href="loginAdmin.php";</script>';
    show_message('please login again.');
}
else{
    ?>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>edit tours</title>
        <link rel="stylesheet" href="lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
        <script src="lib/jQuery/jquery-3.5.1.min.js"></script>
        <script src="lib/popper/popper.min.js"></script>
        <script src="lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <form method="post">
                <label for="city">choose a city:</label>
                    <select name ="city">
                        <option value="tehran">tehran</option>
                        <option value="isfahan">isfahan</option>
                        <option value="shiraz">shiraz</option>
                        <option value="tabriz">tabriz</option>
                        <option value="mashhad">mashhad</option>
                        <option value="kish">kish</option>
                        <option value="qom">qom</option>
                        <option value="rasht">rasht</option>
                        <option value="yazd">yazd</option>
                    </select>
                <input type="submit" name="click" value="select">
            </form>
            <a href="AdminPanel.php">back</a>
            <?php
            if(isset($_POST['click']) and $_POST['click']=="select" and preloggedin())
            {
                $city = htmlProtection($_POST['city']);
                $_SESSION['city'] = $city;

                $query = "SELECT * FROM $city";
                $s = $pdo -> prepare($query);
                $s -> execute();
                $row = $s -> fetch();

                ?>
                <form method="post">
                    <label for="whereTo">Where To:</label>
                    <textarea name="destination" id="whereTo" value="<?php if(isset($row['destination'])){echo $row['destination'];}?> " style="width: 400px;height: 300px;" ">
                    <?php
                    if(isset($row['destination'])){echo $row['destination'];}
                    ?>
                    </textarea>
                    <label for="attraction">Attraction:</label>
                    <textarea name ="attraction" id="attraction" value="<?php if(isset($row['attraction'])){echo $row['attraction'];}?>" style="width: 400px;height: 300px;" >
                        <?php
                        if(isset($row['attraction'])){echo $row['attraction'];}
                        ?>
                    </textarea>
                    <input type="hidden" name="isFilled" value="<?php if(isset($row['destination']) and $row['destination']!=""){echo "true";}else{echo 'false';} ?>">

                    <input type="submit" name="editTour" value="editTour">
                </form>

                <a href="AddCityTours.php">set cityTours</a>
                <br>
                <a href="AddCityImages.php">add city images</a>
                </div>
                <?php

            }
            ?>
        </div>
    </body>
    </html>
<?php

}

if(isset($_POST['editTour']) and preloggedin() and $_SESSION['city']){
    $city = $_SESSION['city'];
    $dest = trim(htmlProtection($_POST['destination']));
    $attract = trim(htmlProtection($_POST['attraction']));
    $isFilledAlready = $_POST['isFilled'];
    if($isFilledAlready=='false')
    {
        $query ="INSERT INTO $city SET destination=:destination , attraction=:attraction";
    }
    else{
        $query = "UPDATE $city SET destination=:destination , attraction=:attraction WHERE TRUE";
    }
    $s = $pdo -> prepare($query);
    $s -> bindValue(':destination' , $dest);
    $s -> bindValue(':attraction' ,$attract);
    $s -> execute();
}


