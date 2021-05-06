<?php
if (session_status() === PHP_SESSION_NONE){session_start();}
include '../../../connectionDB.php';
include '../../SecurityFunctions.php';
include 'login.html';


if(isset($_POST['submit']) and $_POST['submit'] =="login")
{
    $username = htmlProtection($_POST['username']);
    $password = htmlProtection($_POST['password']);

    if(isset($username)  and $username!=""  and isset($password)  and $password!="")
    {
        if(validity_insertion_to_db($username) and validity_insertion_to_db($password))
        {
            $query =  "SELECT * FROM user WHERE username=:username AND password=:password";
            $s = $pdo -> prepare($query);
            $s -> bindValue(':username',$username);
            $s -> bindValue(':password',$password);
            $s -> execute();

            $rows = $s -> fetchAll();
            if(count($rows)==1)
            {
                if(isset($rows))
                {
                    $token = makeToken();
                    $row = $rows[0];
                    $id = $row['id'];

                    $query = "UPDATE user SET token=:token WHERE id=:id";
                    $s = $pdo -> prepare($query);
                    $s -> bindValue(':id',$id);
                    $s -> bindValue('token',$token);
                    $s -> execute();

                    $_SESSION['UserUsername'] = $username;
                    $_SESSION['UserPassword'] = $password;
                    $_SESSION['UserToken'] = $token;
                }
            }
            else{
                //
                //
                //
                //show_message => username or password is not correct.
                show_message("username or password is invalid.");
                //
                //
                //
            }
        }
    }
}
