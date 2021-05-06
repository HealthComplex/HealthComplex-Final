<?php
include '../../../connectionDB.php';
if (session_status() === PHP_SESSION_NONE){session_start();}
$query = "SELECT * FROM hotels";
$s = $pdo -> prepare($query);
$s -> execute();

$rows = $s -> fetchAll();

include 'hotels.html.php';