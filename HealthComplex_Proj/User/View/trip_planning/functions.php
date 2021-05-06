<?php

if (session_status() === PHP_SESSION_NONE){session_start();}
header("Content-Type: application/json", true);
include '../../../connectionDB.php';
include '../../SecurityFunctions.php';



if(isset($_POST['city']) and !isset($_POST['hospital']) and !isset($_POST['service']))
{
    $city = $_POST['city'];
    $query = "SELECT * FROM hospitals WHERE city=:city";
    $s = $pdo -> prepare($query);
    $s -> bindValue(':city',$city);
    $s -> execute();
    $results = $s -> fetchAll();

    $hospitals = array();
    if(isset($results) and count($results))
    {
        foreach ($results as $result)
        {
            if(count($result))
            {
                $hospitalname = $result['name'];
                $hospitals[] =array("name"=>$hospitalname);
            }
        }
    }
    echo json_encode($hospitals);
}


if(isset($_POST['hospital']) and !isset($_POST['service']))
{
    $hospital = $_POST['hospital'];
    $hospitalServicesTable = $hospital."hospitalservices";
    $query = "SELECT * FROM $hospitalServicesTable";
    $s = $pdo -> prepare($query);
    $s -> execute();
    $results = $s -> fetchAll();

    $services = array();
    if(isset($results) and count($results))
    {
        foreach ($results as $result)
        {
            if(count($result))
            {
                $service = $result['medicalServices'];
                $services[] =array("medicalServices"=>$service);
            }
        }
    }
    echo json_encode($services);
}

if(isset($_POST['service']) and $_POST['hospital'])
{
    $service = $_POST['service'];
    $hospital = $_POST['hospital'];
    $hospitalServicesTable = $hospital."hospitalservices";
    $query = "SELECT * FROM $hospitalServicesTable WHERE medicalServices=:service";
    $s = $pdo -> prepare($query);
    $s->bindValue(':service',$service);
    $s -> execute();
    $results = $s -> fetchAll();
    $costs = array();
    if(isset($results) and count($results))
    {
        foreach($results as $result)
        {
            if(count($result))
            {
                $cost = $result['cost'];
                $costs [] = array("cost"=>$cost);
            }
        }
    }
    echo json_encode($costs);
}


if(isset($_POST['tourcity']))
{
    $city = $_POST['tourcity'];
    $ToursOfCity = $city."tours";
    $query = "SELECT * FROM $ToursOfCity";
    $s = $pdo -> prepare($query);
    $s -> execute();


    $tours = array();
    $results = $s -> fetchAll();
    if(isset($results) and count($results))
    {
        foreach ($results as $result)
        {
            if(count($result))
            {
                $days = $result['days'];
                $cost = $result['cost'];
                $tours[] = array("days" => $days,"cost"=>$cost);
            }
        }
    }
    echo json_encode($results);
}


if(isset($_POST['hotelcity']) and !isset($_POST['hotelname']))
{
    $hotelcity = $_POST['hotelcity'];
    $query = "SELECT * FROM hotels WHERE city=:city";
    $s = $pdo -> prepare($query);
    $s -> bindValue(':city',$hotelcity);
    $s -> execute();
    $results = $s -> fetchAll();

    $hotels = array();
    if(isset($results) and count($results))
    {
        foreach ($results as $result)
        {
            if(count($result))
            {
                $hotelName = $result['name'];
                $hotels[] =array("name"=>$hotelName);
            }
        }
    }
    echo json_encode($hotels);
}


if(isset($_POST['hotelcity']) and isset($_POST['hotelname']))
{
    $hotelname = $_POST['hotelname'];
    $hotelRoomPlansTable = $hotelname."hotelroomplans";
    $query = "SELECT * FROM $hotelRoomPlansTable";
    $s = $pdo -> prepare($query);
    $s -> execute();
    $results = $s -> fetchAll();

    $rooms = array();
    if(isset($results) and count($results))
    {
        foreach ($results as $result)
        {
            if(count($result))
            {
                $beds = $result['beds'];
                $nights = $result['nights'];
                $cost = $result['cost'];
                $rooms[] =array("beds"=>$beds,"nights"=>$nights,"cost"=>$cost);
            }
        }
    }
    echo json_encode($rooms);
}