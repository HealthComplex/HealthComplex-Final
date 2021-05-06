<?php
error_reporting(0);
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

if(isset($_SESSION['hospitalname']))
{
    $hospitalImageTable = $_SESSION['hospitalname']."hospitalimages";
    $query ="SELECT * FROM $hospitalImageTable";
    $s = $pdo -> prepare($query);
    $s -> execute();
    $rows = $s -> fetchAll();
}
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>

<head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <script src="lib/jQuery/jquery-3.5.1.min.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <script src="lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <style>
        #content{
            width: 50%;
            margin: 20px auto;
            border: 1px solid #cbcbcb;
        }
        form{
            width: 50%;
            margin: 20px auto;
        }
        form div{
            margin-top: 5px;
        }
        #img_div{
            width: 80%;
            padding: 5px;
            margin: 15px auto;
            border: 1px solid #cbcbcb;
        }
        #img_div:after{
            content: "";
            display: block;
            clear: both;
        }
        img{
            float: left;
            margin: 5px;
            width: 300px;
            height: 140px;
        }
    </style>
</head>

<body>
<div id="content">
    <?php
    if(isset($rows) and count($rows))
    {
        foreach($rows as $row)
        {
            if(count($row))
            {
                echo '<div style="width: 100px;height: 100px;"><img src="images/'.$hospitalImageTable.'/'.$row['filename'].'" </div>';
            }
        }
    }

    ?>
    <br>
    <br>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="uploadfile" value="" />

        <div>
            <button type="submit" name="upload">UPLOAD</button>
        </div>
    </form>
</div>
<a href ="editHospital.php">back</a>
</body>

</html>
<?php
$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload']) and preloggedin() and isset($_SESSION['hospitalname'])) {
    $hospitalImageTables = $_SESSION['hospitalname'].'hospitalimages';

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/".$hospitalImageTables.'/';

    if(!file_exists($folder))
    {
        mkdir($folder);
    }

    $folder = $folder .$filename;

    $query ="INSERT INTO $hospitalImageTables (filename) VALUES ( :filename )";
    $s = $pdo -> prepare($query);
    $s -> bindValue(':filename',$filename);
    $s -> execute();


    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
    show_message($msg);
}
?>


