<?php
include 'connectionDB.php';
include 'SecurityFunctions.php';

if (session_status() === PHP_SESSION_NONE){session_start();}
if(preloggedin())
{
    $hotelRoomPlansTable = $_SESSION['hotelname']."hotelroomplans";
    $query ="SELECT * FROM $hotelRoomPlansTable";
    $s = $pdo -> prepare($query);
    $s -> execute();
    $rows = $s -> fetchAll();
    ?>
    <html>
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
                            <th>beds</th>
                            <th>nights</th>
                            <th>cost</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($rows))
                    {
                        foreach ($rows as $row)
                        {
                            if(count($row))
                            {
                                echo '<tr>';
                                echo '<td>'.$row['beds'].'</td>';
                                echo '<td>'.$row['nights'].'</td>';
                                echo '<td>'.$row['cost'].'</td>';
                                echo '<td><form method="POST"><input type="hidden" name="roombeds" value="'.$row['beds'].'" >'
                                    .'<input type="hidden" name="roomnights" value="'.$row['nights'].'" >'
                                    .'<input type="hidden" name="roomcost" value="'.$row['cost'].'" >'
                                    .'<input type="submit" name="delete" value="delete" class="btn-primary">'."</form></td>";
                                echo '</tr>';
                            }
                        }
                    }

                    ?>
                    </tbody>
                </table>
                <br>
                <form class="form-group" method="post">
                    <label for="Beds">Beds:</label>
                    <input type="text" name="beds" id="Beds" value="">
                    <label for="Nights">nights:</label>
                    <input type="text" name="nights" id="Nights" value="">
                    <label for="Cost">cost:</label>
                    <input type="text" name="cost" id="Cost" value="">
                    <input type="submit" name="addroom" value="add">
                </form>
            </div>
        <br>
        <a href="edithotel.php">back</a>
        </body>
    </html>
    <?php
}
else
{
    unsetSessions();
    show_message('please login again.');
    echo '<script type="text/javascript">window.location.href="loginAdmin.php";</script>';
    show_message('please login again.');
}

if(isset($_POST['addroom']) and $_POST['addroom'] == 'add'  and preloggedin())
{
    $beds = htmlProtection($_POST['beds']);
    $nights = htmlProtection($_POST['nights']);
    $cost = htmlProtection($_POST['cost']);

    if(!isset($beds) or $beds=="" or $beds == null or !is_numeric($beds))
    {
        show_message('please fill the beds. beds must be numeric');
    }
    else if(!isset($nights) or $nights=="" or $nights == null or !is_numeric($nights))
    {
        show_message('please fill the nights. nights must be numeric');
    }
    else if(!isset($cost) or $cost=="" or $cost == null or !is_numeric($cost))
    {
        show_message('please fill the cost. cost must be numeric');
    }
    else{
        $query ="INSERT INTO $hotelRoomPlansTable  ( beds , nights , cost ) VALUES ( :beds ,:nights , :cost);";
        $s = $pdo -> prepare($query);
        $s -> bindValue(':beds' ,$beds);
        $s -> bindValue('nights',$nights);
        $s -> bindValue('cost' ,$cost);
        $s -> execute();
        show_message('the room plan has been added.please refresh the page.');

    }
}

if(isset($_POST['delete']) and $_POST['delete'] ='delete' and preloggedin())
{
    $beds = htmlProtection($_POST['roombeds']);
    $nights = htmlProtection($_POST['roomnights']);
    $cost = htmlProtection($_POST['roomcost']);

    $query ="DELETE FROM $hotelRoomPlansTable WHERE beds=:beds AND nights=:nights AND cost=:cost";
    $s = $pdo -> prepare($query);
    $s -> bindValue(':beds',$beds);
    $s -> bindValue('nights',$nights);
    $s -> bindValue('cost' ,$cost);
    $s -> execute();
    show_message('the item has been deleted.please refresh the page.');

}