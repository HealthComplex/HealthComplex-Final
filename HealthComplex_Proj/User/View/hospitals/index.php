<?php

include '../../../connectionDB.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$query = "SELECT * FROM hospitals";
$s = $pdo->prepare($query);
$s->execute();

$rows = $s->fetchAll();

include 'hospitals.html.php';