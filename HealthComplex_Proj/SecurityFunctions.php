<?php

if (session_status() === PHP_SESSION_NONE){session_start();}
if(!function_exists('show_message'))
{
    function show_message($message){
        ?>
        <div class="alert alert-info alert-dismissible" role="alert" style="position: fixed; top: 0px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo $message; ?>
        </div>
        <?php
    }
}


if(!function_exists('htmlProtection'))
{
    function htmlProtection($input)
    {
        $input = htmlspecialchars(stripslashes(trim($input)));
        return $input;
    }
}

if(!function_exists('validity_insertion_to_db'))
{
    function validity_insertion_to_db($item)
    {
        if(strpos($item,' ')!== false)
        {
            return false;
        }
        if(strpos($item,'#') !== false)
        {
            return false;
        }
        if(strpos($item,'&') !== false)
        {
            return false;
        }
        if(strpos($item,';') !== false)
        {
            return false;
        }
        if(strpos($item,'!') !== false)
        {
            return false;
        }
        if(strpos($item,'"') !== false)
        {
            return false;
        }if(strpos($item,'$') !== false)
        {
            return false;
        }if(strpos($item,'%') !== false)
        {
            return false;
        }
        if(strpos($item,"'") !== false)
        {
            return false;
        }
        if(strpos($item,'(') !== false)
        {
            return false;
        }
        if(strpos($item,')') !== false)
        {
            return false;
        }
        if(strpos($item,'*') !== false)
        {
            return false;
        }
        if(strpos($item,'+') !== false)
        {
            return false;
        }
        if(strpos($item,',') !== false)
        {
            return false;
        }
        if(strpos($item,'-') !== false)
        {
            return false;
        }
        if(strpos($item,'.') !== false)
        {
            return false;
        }
        if(strpos($item,'/') !== false)
        {
            return false;
        }
        if(strpos($item,':') !== false)
        {
            return false;
        }
        if(strpos($item,'<') !== false)
        {
            return false;
        }
        if(strpos($item,'=') !== false)
        {
            return false;
        }
        if(strpos($item,'>') !== false)
        {
            return false;
        }
        if(strpos($item,'?') !== false)
        {
            return false;
        }
        if(strpos($item,'[') !== false)
        {
            return false;
        }
        if(strpos($item,'\\') !== false)
        {
            return false;
        }
        if(strpos($item,']') !== false)
        {
            return false;
        }
        if(strpos($item,'^') !== false)
        {
            return false;
        }if(strpos($item,'_') !== false)
        {
            return false;
        }if(strpos($item,'`') !== false)
        {
           return false;
        }if(strpos($item,'{') !== false)
        {
          return false;
        }
        if(strpos($item,'|') !== false)
        {
            return false;
        }
        if(strpos($item,'}') !== false)
        {
            return false;
        }
        if(strpos($item,'~') !== false)
        {
            return false;
        }

        return true;
    }
}

if(!function_exists('makeToken'))
{
    function makeToken()
    {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
        $token ="";
        for($i = 0;$i<40;$i++)
        {
            $token .= $str[mt_rand(0,60)];
        }
        return $token;
    }
}


if(!function_exists('unsetSessions'))
{
    function unsetSessions()
    {
        if(isset($_SESSION['username']))
        {
            unset($_SESSION['username']);
        }
        if(isset($_SESSION['password']))
        {
            unset($_SESSION['password']);
        }
        if(isset($_SESSION['token']))
        {
            unset($_SESSION['token']);
        }
    }
}

if(!function_exists('preloggedin'))
{
    function preloggedin()
    {
        if (session_status() === PHP_SESSION_NONE){session_start();}
        if(!isset($_SESSION['username']) or !isset($_SESSION['password']) or !isset($_SESSION['token']))
        {
            return false;
        }
        include 'connectionDB.php';
        $query = "SELECT * FROM admins WHERE username=:username AND password=:password";
        $s = $pdo -> prepare($query);
        $s -> bindValue(':username',$_SESSION['username']);
        $s -> bindValue(':password',$_SESSION['password']);
        $s -> execute();
        $AllResults = $s -> fetchAll();


        if(count($AllResults)!= 1)
        {
            return false;
        }
        if(!isset($AllResults))
        {
            return false;
        }
        $element = $AllResults[0];
        $token = $element['token'];
        if($token === $_SESSION['token'])
        {
            return true;
        }
        else{
            return false;
        }
    }
}
