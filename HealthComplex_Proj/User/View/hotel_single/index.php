<?php
include '../../../connectionDB.php';
if (session_status() === PHP_SESSION_NONE){session_start();}

include 'hotel_single.html.php';
