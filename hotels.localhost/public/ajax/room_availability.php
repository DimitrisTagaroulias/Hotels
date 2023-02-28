<?php
// Boot application
require_once __DIR__ . "/../../boot/boot.php";

// Checks if Room is Booked
require_once('__room_is_booked.php');

// Return operation status
header("Content-Type: application/json;charset=utf-8");
$data=['status'=> $isBooked];
$json= json_encode($data);
echo $json;
?>