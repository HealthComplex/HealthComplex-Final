<?php
include 'connectionDB.php';
include 'SecurityFunctions.php';

if (session_status() === PHP_SESSION_NONE){session_start();}
if(preloggedin())
{
    $hospitalServicesTable = $_SESSION['hospitalname']."hospitalservices";
    $query ="SELECT * FROM $hospitalServicesTable";
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
                <th>medical service</th>
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
                        echo '<td>'.$row['medicalServices'].'</td>';
                        echo '<td>'.$row['cost'].'</td>';
                        echo '<td><form method="POST"><input type="hidden" name="medicalservices" value="'.$row['medicalServices'].'" >'
                            .'<input type="hidden" name="medicalcost" value="'.$row['cost'].'" >'
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
            <label for="MedicalServices">MedicalServices:</label>
            <input type="text" name="medicalservices" id="MedicalServices" value="">
            <label for="Cost">cost:</label>
            <input type="text" name="medicalcost" id="Cost" value="">
            <input type="submit" name="addService" value="add">
        </form>
    </div>
    <br>
    <a href="editHospital.php">back</a>
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

if(isset($_POST['addService']) and $_POST['addService'] == 'add'  and preloggedin())
{
    $service = htmlProtection($_POST['medicalservices']);
    $cost = htmlProtection($_POST['medicalcost']);

    if(!isset($service) or $service=="" or $service == null)
    {
        show_message('please fill the service.');
    }
    else if(!isset($cost) or $cost=="" or $cost == null or !is_numeric($cost))
    {
        show_message('please fill the cost. cost must be numeric');
    }
    else{
        $query ="INSERT INTO $hospitalServicesTable  ( medicalServices , cost ) VALUES ( :medicalServices , :cost);";
        $s = $pdo -> prepare($query);
        $s -> bindValue(':medicalServices' ,$service);
        $s -> bindValue(':cost' ,$cost);
        $s -> execute();
        show_message('the service has been added.please refresh the page.');

    }
}

if(isset($_POST['delete']) and $_POST['delete'] ='delete' and preloggedin())
{
    $service = htmlProtection($_POST['medicalservices']);
    $medicalCost = htmlProtection($_POST['medicalcost']);

    $query ="DELETE FROM $hospitalServicesTable WHERE medicalServices=:services AND cost=:cost";
    $s = $pdo -> prepare($query);
    $s -> bindValue(':services',$service);
    $s -> bindValue('cost' ,$medicalCost);
    $s -> execute();
    show_message('the item has been deleted.please refresh the page.');

}