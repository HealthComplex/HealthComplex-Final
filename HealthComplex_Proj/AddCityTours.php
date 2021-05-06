<?php
include 'connectionDB.php';
include 'SecurityFunctions.php';
if (session_status() === PHP_SESSION_NONE){session_start();}

if(preloggedin() and isset($_SESSION['city']))
{
    $cityTours = $_SESSION['city'].'tours';
    $query ="SELECT * FROM $cityTours";
    $s = $pdo ->prepare($query);
    $s -> execute();
    $rows = $s -> fetchAll();
    ?>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>edit <?php echo $_SESSION['city']; ?></title>
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
                <th>days</th>
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
                        echo '<td>'.$row['days'].'</td>';
                        echo '<td>'.$row['cost'].'</td>';
                        echo '<td><form method="POST"><input type="hidden" name="TourDays" value="'.$row['days'].'" >'
                            .'<input type="hidden" name="TourCost" value="'.$row['cost'].'" >'
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
            <label for="Days">Number of days:</label>
            <input type="text" name="days" id="Days" value="">
            <label for="Cost">cost:</label>
            <input type="text" name="cost" id="Cost" value="">
            <input type="submit" name="addTour" value="add">
        </form>
    </div>
    <br>
    <a href="EditTours.php">back</a>
    </body>
    </html>
<?php
}
if(preloggedin() and isset($_POST['addTour'])  and $_POST['addTour'] == "add")
{
    $cityTours =  $_SESSION['city'].'tours';
    $days = htmlProtection($_POST['days']);
    $cost = htmlProtection($_POST['cost']);

    if(!isset($days) or $days=="" or $days == null  or !is_numeric($days))
    {
        show_message('please fill the days.it should be numeric.');
    }
    else if(!isset($cost) or $cost=="" or $cost == null  or !is_numeric($cost))
    {
        show_message('please fill the days.it should be numeric.');
    }
    else{
        $query ="INSERT INTO $cityTours ( days , cost ) VALUES ( :days , :cost );";
        $s = $pdo -> prepare($query);
        $s -> bindValue(':days',$days);
        $s -> bindValue(':cost',$cost);
        $s -> execute();
        show_message('the tour has been added.please refresh the page.');
    }
}

if(preloggedin() and isset($_POST['delete']) and $_POST['delete'] =="delete")
{
    $cityTours =  $_SESSION['city'].'tours';
    $days = htmlProtection($_POST['TourDays']);
    $cost = htmlProtection($_POST['TourCost']);

    $query = "DELETE FROM $cityTours WHERE days=:days AND cost=:cost";
    $s = $pdo -> prepare($query);
    $s -> bindValue(':days',$days);
    $s -> bindValue(':cost',$cost);
    $s -> execute();
    show_message('the item has been deleted.please refresh the page.');
}