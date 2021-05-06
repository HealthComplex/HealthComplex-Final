<?php

try{
    $pdo = new PDO('mysql:host=localhost;port=3308;dbname=healthcomplex','root','');
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo ->exec('SET NAMES "utf8"');
} catch (Exception $ex) {
    $output = 'Unable to connect to the database   '.$ex ->getMessage();
    exit();
}