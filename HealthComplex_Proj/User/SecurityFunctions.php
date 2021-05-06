<?php
//if (session_status() === PHP_SESSION_NONE){session_start();}

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

if(!function_exists('preloggedin'))
{
    function preloggedin($DBpath)
    {
        include $DBpath;
        if(!isset($_SESSION['UserUsername']) or !isset($_SESSION['UserPassword']) and !isset($_SESSION['UserToken']))
        {
            return false;
            unsetUserSession();
        }
        $username = $_SESSION['UserUsername'];
        $password = $_SESSION['UserPassword'];
        $token = $_SESSION['UserToken'];

        $query = "SELECT * FROM user WHERE username=:username AND password=:password";
        $s = $pdo -> prepare($query);
        $s -> bindValue(':username',$username);
        $s ->bindValue(':password',$password);
        $s -> execute();
        $rows = $s -> fetchAll();
        if(count($rows)!=1)
        {
            return false;
            unsetUserSession();
        }
        if(!isset($rows))
        {
            return false;
            unsetUserSession();
        }
        $row = $rows[0];
        if($token === $row['token'])
        {
            return true;
        }
        else{
            return false;
            unsetUserSession();
        }
    }
}

if(!function_exists('unsetUserSession'))
{
    function unsetUserSession()
    {
        if(isset($_SESSION['UserUsername']))
        {
            unset($_SESSION['UserUsername']);
        }
        if(isset($_SESSION['UserPassword']))
        {
            unset($_SESSION['UserPassword']);
        }
        if(isset($_SESSION['UserToken']))
        {
            unset($_SESSION['UserToken']);
        }
    }
}