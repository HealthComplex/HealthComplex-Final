<?php
if(session_status()===PHP_SESSION_NONE){session_start();}
include '../../../connectionDB.php';
include '../../SecurityFunctions.php';
include 'register.html';

if(isset($_POST['submit']) and $_POST['submit'] == "register")
{

    $fname = htmlProtection($_POST['firstname']);
    $lname = htmlProtection($_POST['lastname']);
    $email = htmlProtection($_POST['email']);
    $username = htmlProtection($_POST['username']);
    $password = htmlProtection($_POST['password']);
    $countryCode = htmlProtection($_POST['countryCode']);
    $phoneNumber = htmlProtection($_POST['phonenumber']);
    $city = htmlProtection($_POST['city']);
    $address = htmlProtection($_POST['address']);
    $token = makeToken();

    $query="SELECT * FROM user WHERE username=:username";
    $s = $pdo -> prepare($query);
    $s -> bindValue(':username',$username);
    $s -> execute();
    $rows = $s -> fetchAll();
    if(count($rows)!=0)
    {
        //show_message => another user with this username.
        show_message('there is another account with this username.');
    }
    else{
        if(($fname!="" and isset($fname)) and ($lname!="" and isset($lname)) and ($email!="" and isset($email)) and ($username!="" and isset($username)) and ($password!="" and isset($password)) and ($countryCode!="" and isset($countryCode)) and ($phoneNumber!="" and isset($phoneNumber)) and ($city!="" and isset($city)) and ($address!="" and isset($address)))
        {
            if(validity_insertion_to_db($fname) and validity_insertion_to_db($lname) and validity_insertion_to_db($username) and validity_insertion_to_db($password)  and validity_insertion_to_db($phoneNumber))
            {

                $query = "INSERT INTO user (firstname , lastname , email , username , password , country , phone , city , address , token ) VALUES ( :fname , :lname ,:email, :username , :password , :country , :phone , :city , :address ,:token);";
                $s = $pdo -> prepare($query);
                $s -> bindValue(':fname',$fname);
                $s -> bindValue(':lname',$lname);
                $s -> bindValue(':email',$email);
                $s -> bindValue(':username',$username);
                $s -> bindValue(':password',$password);
                $s -> bindValue(':country',$countryCode);
                $s -> bindValue(':phone',$phoneNumber);
                $s -> bindValue(':city',$city);
                $s -> bindValue(':address',$address);
                $s -> bindValue(':token',$token);
                $s -> execute();


            }
            else{
                show_message("incorrect characters detected.");
                //show message -> incorrect characters detected.
            }
        }
        else{
            //show message -> please fill the form completely .
        }
    }

}

