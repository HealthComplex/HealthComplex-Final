<?php
include 'connectionDB.php';
include 'SecurityFunctions.php';
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
        <title>add hotel</title>
        <link rel="stylesheet" href="lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
        <script src="lib/jQuery/jquery-3.5.1.min.js"></script>
        <script src="lib/popper/popper.min.js"></script>
        <script src="lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" style="margin-top: 100px;">
            <h5>after creating the hotel you can add room plans or images for this hotel in edit hotel part from admin panel .</h5>
            <h5>do not use any sign in name field like space or ","</h5>
            <form method="POST">
                <div class="form-group">
                    <label for="Name">name of hotel:</label>
                    <input type="text" name="name" id="Name" value="">
                    <br/>
                    <label for="Comment">comment for hotel:</label>
                    <textarea type="text" name="comment" id="Comment" style="width: 400px;height: 300px;" value=""></textarea>
                    <br/>
                    <label for="Address">address of hotel:</label>
                    <input type="text" name="address" id="Address" value="">
                    <br/>
                    <label for="Phone">phone of hotel:</label>
                    <input type="text" name="phone" id="Phone" value="">
                    <br/>

                    <label for="Rate">rate of hotel:</label>
                    <input type="radio" name="rate" id="Rate" value="1">
                    <input type="radio" name="rate" id="Rate" value="2">
                    <input type="radio" name="rate" id="Rate" value="3">
                    <input type="radio" name="rate" id="Rate" value="4">
                    <input type="radio" name="rate" id="Rate" value="5">

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
                    <br>
                    <br/>
                    <input type="submit" name="addhotel" value="add">

                </div>
            </form>
        </div>
    </body>
</html>

<?php

if(isset($_POST['addhotel']) and $_POST['addhotel']!= null and preloggedin())
{
    $name = htmlProtection($_POST['name']);
    if(strpos($name,'hotel'))
    {
        $name = str_replace('hotel','',$name);
    }

    $comment = htmlProtection($_POST['comment']);
    $address = htmlProtection($_POST['address']);
    $phone = htmlProtection($_POST['phone']);
    $city = htmlProtection($_POST['city']);

    if(isset($_POST['rate']))
    {
        $rate = htmlProtection($_POST['rate']);
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
            show_message('please fill the rate.');
        }
        else{
            if(validity_insertion_to_db($name))
            {
                $query ="SELECT * FROM hotels WHERE name=:name";
                $s = $pdo -> prepare($query);
                $s -> bindValue(':name',$name);
                $s->execute();
                $rows = $s-> fetchAll();
                if(count($rows)==0 or is_null($rows))
                {
                    $query = "INSERT INTO hotels ( name, comment, address, phone, rate ,city ) VALUES (:name, :comment, :address,:phone,:rate,:city);";
                    $s = $pdo -> prepare($query);
                    $s -> bindValue(':name',$name);
                    $s -> bindValue(':comment',$comment);
                    $s -> bindValue(':address',$address);
                    $s -> bindValue(':phone',$phone);
                    $s -> bindValue(':rate',$rate);
                    $s -> bindValue(':city',$city);
                    $s -> execute();

                    //making table for room plans of this hotel.
                    $hotleRoomPlans = $name."hotelroomplans";
                    $query="CREATE TABLE $hotleRoomPlans (
                    beds INT NOT NULL,
                    nights INT NOT NULL,
                    cost INT NOT NULL
                    )";
                    $s = $pdo -> prepare($query);
                    $s -> execute();

                    //making table for images of this hotel.

                    $hotleImages = $name."hotelimages";
                    $query="CREATE TABLE $hotleImages (
                    id INT(11) AUTO_INCREMENT PRIMARY KEY,
                    filename VARCHAR(256) NOT NULL
                    )";
                    $s = $pdo -> prepare($query);
                    $s -> execute();

                    echo '<script type="text/javascript">window.location.href="AdminPanel.php";</script>';
                    show_message('new hotel added successfully. for adding room plans or images check the edit hotel on the admin panel.');

                }
                else{
                    show_message('there is another hotel with same name in the database.');
                }
            }
            else{
                show_message('invalid character in name field.');
            }
        }
    }
    else{
        show_message('please fill the rate.');
    }
}

