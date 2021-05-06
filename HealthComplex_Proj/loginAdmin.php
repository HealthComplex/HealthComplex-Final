<?php
if (session_status() === PHP_SESSION_NONE){session_start();}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>adminLogin</title>
        <link rel="stylesheet" href="lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
        <script src="lib/jQuery/jquery-3.5.1.min.js"></script>
        <script src="lib/popper/popper.min.js"></script>
        <script src="lib/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" style="margin-top: 100px;">
            <h3>welcome to Admin Panel login form:</h3>
            <form  method="POST">
                <div class="form-group">
                    <label for="Username">username:</label>
                    <input type="text" name="username" value="" id="Username">
                    <label for="Password">Password:</label>
                    <input type="text" name="password" value="" id="Password">
                    <br>
                    <input type="submit" name="loginbtn" value="login">
                </div>
            </form>
        </div>
    </body>
</html>


<?php
include 'connectionDB.php';
include 'SecurityFunctions.php';
if(isset($_POST['loginbtn']) and $_POST['loginbtn']!=null)
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = htmlProtection($username);
    $password = htmlProtection($password);

    if(!validity_insertion_to_db($username))
    {
        show_message('Error : your username or password has incorrect characters.');
        exit();
    }
    else if(!validity_insertion_to_db($password))
    {
        show_message('Error : your username or password has incorrect characters.');
        exit();
    }
    else {
        $query = "SELECT * FROM admins WHERE username=:username AND password=:password";

        $s = $pdo -> prepare($query);
        $s -> bindValue(':username',$username);
        $s -> bindValue(':password',$password);
        $s -> execute();
        $result = $s->fetchAll();
        if(count($result)!=1)
        {
            show_message('your password or username is incorrect .');
        }
        else{
            //update token
            $token = makeToken();
            $query = "UPDATE admins SET token=:token WHERE username=:username AND password=:password";
            $s = $pdo ->prepare($query);
            $s -> bindValue(':username',$username);
            $s -> bindValue(':password',$password);
            $s -> bindValue(':token',$token);
            $s -> execute();
            //sessions
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['token'] = $token;


            show_message('you logged in successfully.');
            echo '<script type="text/javascript">window.location.href="AdminPanel.php";</script>';
            show_message('you logged in successfully.');
        }
    }
}
