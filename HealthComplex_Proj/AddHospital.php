<?php
include 'connectionDB.php';
include 'SecurityFunctions.php';
if (session_status() === PHP_SESSION_NONE){session_start();}
if(!preloggedin())
{
    unsetSessions();
    show_message('please login again.');
    echo '<script type="text/javascript">window.location.href="loginAdmin.php";</script>';
    show_message('please login again.');
}
?>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <title>add hospital</title>
        <link rel="stylesheet" href="lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
        <script src="lib/jQuery/jquery-3.5.1.min.js"></script>
        <script src="lib/popper/popper.min.js"></script>
        <script src="lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" style="margin-top: 100px;">
            <h5>after creating the hospital, you can add medical services or images for this hospital in edit hospital part from admin panel .</h5>
            <form method="POST">
                <div class="form-group">
                    <label for="HospitalName">name of hospital:</label>
                    <input type="text" name="hospitalname" id="HospitalName" value="">
                    <br/>
                    <label for="HospitalComment">comment for hospital:</label>
                    <textarea type="text" name="hospitalcomment" id="HospitalComment" style="width: 400px;height: 300px;" value=""></textarea>
                    <br/>
                    <label for="HospitalAddress">address of hospital:</label>
                    <input type="text" name="hospitaladdress" id="HospitalAddress" value="">
                    <br/>
                    <label for="HospitalPhone">phone of hospital:</label>
                    <input type="text" name="hospitalphone" id="HospitalPhone" value="">
                    <br/>
                    <label for="Rate">rate of hospital:</label>
                    <input type="radio" name="hospitalrate" id="Rate" value="1">
                    <input type="radio" name="hospitalrate" id="Rate" value="2">
                    <input type="radio" name="hospitalrate" id="Rate" value="3">
                    <input type="radio" name="hospitalrate" id="Rate" value="4">
                    <input type="radio" name="hospitalrate" id="Rate" value="5">
                    <br/>
                    <label for="city">choose a city:</label>
                    <select name ="hospitalcity">
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
                    <input type="submit" name="addhospital" value="add">

                </div>
            </form>
        </div>
    </body>
</html>

<?php

if(isset($_POST['addhospital']) and $_POST['addhospital']!= null and preloggedin())
{
    $name = htmlProtection($_POST['hospitalname']);
    if(strpos($name,'hospital'))
    {
        $name = str_replace('hospital','',$name);
    }
    $comment = htmlProtection($_POST['hospitalcomment']);
    $address = htmlProtection($_POST['hospitaladdress']);
    $phone = htmlProtection($_POST['hospitalphone']);
    $rate = htmlProtection(($_POST['hospitalrate']));
    $city = htmlProtection($_POST['hospitalcity']);
    if(!isset($name) or $name=="" or $name == null)
    {
        show_message('please fill the name.');
    }
    else if(!isset($comment) or $comment=="" or $comment == null)
    {
        show_message('please fill the comment.');
    }
    else if(!isset($address) or $address=="" or $address == null)
    {
        show_message('please fill the address.');
    }
    else if(!isset($phone) or $phone=="" or $phone == null)
    {
        show_message('please fill the phone.');
    }
    else if(!isset($rate) or $rate=="" or $rate == null)
    {
        show_message('please fill the rate.');
    }
    else if(!isset($city) or $city=="" or $city == null)
    {
        show_message('please fill the city.');
    }
    else{
        if(validity_insertion_to_db($name))
        {
            $query ="SELECT * FROM hospitals WHERE name=:name";
            $s = $pdo ->prepare($query);
            $s -> bindValue(':name',$name);
            $s->execute();
            $rows = $s->fetchAll();
            if(count($rows)==0 or is_null($rows))
            {
                $query = "INSERT INTO hospitals ( name, comment, address, phone ,city,rate ) VALUES (:name, :comment, :address,:phone ,:city,:rate);";
                $s = $pdo -> prepare($query);
                $s -> bindValue(':name',$name);
                $s -> bindValue(':comment',$comment);
                $s -> bindValue(':address',$address);
                $s -> bindValue(':phone',$phone);
                $s -> bindValue(':rate',$rate);
                $s -> bindValue(':city',$city);
                $s -> execute();

                //making table for room plans of this hotel.
                $hospitalServices = $name."hospitalservices";
                $query="CREATE TABLE $hospitalServices (
                medicalServices VARCHAR(256) NOT NULL,
                cost INT NOT NULL
                )";
                $s = $pdo -> prepare($query);
                $s -> execute();

                //making table for images of this hotel.

                $hospitalImages = $name."hospitalimages";
                $query="CREATE TABLE $hospitalImages (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                filename VARCHAR(256) NOT NULL
                )";
                $s = $pdo -> prepare($query);
                $s -> execute();

                echo '<script type="text/javascript">window.location.href="AdminPanel.php";</script>';
                show_message('new hotel added successfully. for adding room plans or images check the edit hotel on the admin panel.');

            }
        }
        else{
            show_message('invalid characters in name field.');
        }
    }
}
