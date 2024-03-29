<?php
include 'connectionDB.php';
include 'SecurityFunctions.php';
if (session_status() === PHP_SESSION_NONE){session_start();}
if(preloggedin())
{
    $query = "SELECT name FROM hospitals";
    $s = $pdo -> prepare($query);
    $s -> execute();
    $results = $s->fetchAll();

    ?>
    <html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <title>edit hotel</title>
        <link rel="stylesheet" href="lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
        <script src="lib/jQuery/jquery-3.5.1.min.js"></script>
        <script src="lib/popper/popper.min.js"></script>
        <script src="lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>name</th>
                <th>click</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($results) and count($results)>0)
            {
                foreach($results as $result)
                {
                    if(count($result))
                    {
                        echo '<tr>';
                        echo '<td>'.$result['name'].'</td>';
                        echo '<td><form method="POST"><input type="hidden" name="hospitalname" value="'.$result['name'].'" >'.'<input type="submit" name="click" value="click" class="btn-primary">'."</form></td>";
                        echo '</tr>';
                    }
                }
            }
            ?>
            </tbody>
        </table>
        <?php
        if(isset($_POST['click']) and $_POST['click']=="click" and preloggedin())
        {
            if(isset($_POST['hospitalname']))
            {
                $_SESSION['hospitalname'] = $_POST['hospitalname'];
                if(isset($_SESSION['hospitalname']))
                {
                    $hospitalname = $_SESSION['hospitalname'];
                    $query = "SELECT * FROM hospitals WHERE name=:name";
                    $s = $pdo-> prepare($query);
                    $s -> bindValue(':name',$hospitalname);
                    $s -> execute();

                    $row = $s -> fetch();

                    $name = $row['name'];
                    $comment = $row['comment'];
                    $address = $row['address'];
                    $phone = $row['phone'];
                    $rate = $row['rate'];
                    $city = $row['city']
                    ?>
                    <div style="margin-top: 150px;">
                        <form method="POST">
                            <div class="form-group">
                                <label for="Name">name of hospital:</label>
                                <input type="text" name="name" id="Name" value="<?php echo $name; ?>" readonly>
                                <br/>
                                <label for="Comment">comment for hospital:</label>
                                <textarea type="text" name="comment" id="Comment" style="width: 400px;height: 300px;" value="<?php echo $comment; ?>"><?php echo $comment; ?></textarea>
                                <br/>
                                <label for="Address">address of hospital:</label>
                                <input type="text" name="address" id="Address" value="<?php echo $address; ?>">
                                <br/>
                                <label for="Phone">phone of hospital:</label>
                                <input type="text" name="phone" id="Phone" value="<?php echo $phone; ?>">
                                <br/>
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
                                <br/>
                                <br/>
                                <label for="Rate">rate of hospital:<?php echo $rate; ?></label>
                                <input type="radio" name="rate" id="Rate" value="1">
                                <input type="radio" name="rate" id="Rate" value="2">
                                <input type="radio" name="rate" id="Rate" value="3">
                                <input type="radio" name="rate" id="Rate" value="4">
                                <input type="radio" name="rate" id="Rate" value="5">
                                <br/>
                                <input type="submit" name="edithospital" value="edit">
                                <br/>
                                <a href="AddHospitalImages.php">edit or add images</a>
                                <br>
                                <a href="AddHospitalServices.php">edit or add services</a>

                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
        }

        if(isset($_POST['edithospital']) and $_POST['edithospital'] == "edit" and preloggedin())
        {
            $name = htmlProtection($_POST['name']);
            $comment = htmlProtection($_POST['comment']);
            $address = htmlProtection($_POST['address']);
            $phone = htmlProtection($_POST['phone']);
            $city = htmlProtection($_POST['city']);
            if(isset($_POST['rate']))
            {
                $rate = htmlProtection($_POST['rate']);
                if(!isset($comment) or $comment=="" or $comment == null)
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
                else if(!isset($city) or $city=="" or $city == null)
                {
                    show_message('please fill the city.');
                }
                else{

                    $query = "UPDATE hospitals SET comment=:comment , address=:address , phone=:phone , city=:city ,rate=:rate WHERE name=:name;";
                    $s = $pdo -> prepare($query);
                    $s -> bindValue(':name',$name);
                    $s -> bindValue(':comment',$comment);
                    $s -> bindValue(':address',$address);
                    $s -> bindValue(':phone',$phone);
                    $s -> bindValue(':city',$city);
                    $s -> bindValue(':rate',$rate);
                    $s -> execute();

                    show_message('new hospital added successfully. for adding services or images check the edit hospital page on the admin panel.');
                    echo '<script type="text/javascript">window.location.href="AdminPanel.php";</script>';
                    show_message('new hospital added successfully. for adding services or images check the edit hospital page on the admin panel.');

                }
            }
            else {
                show_message('please fill the rate.');
            }

        }
        ?>
    </div>
    <br>
    <a href="AdminPanel.php">back</a>
    </body>
    </html>

    <?php

}
else{
    unsetSessions();
    show_message('please login again.');
    echo '<script type="text/javascript">window.location.href="loginAdmin.php";</script>';
    show_message('please login again.');
}



