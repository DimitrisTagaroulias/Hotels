<?php
// Boot application
require_once __DIR__ . "/../../boot/boot.php";


use Hotel\User;

// Checks if Room is Booked
require_once('__room_is_booked.php');

// Book the room
$status = $booking->insert($roomId, User::getCurrentUserId(), $checkInDate, $checkOutDate);

// Return operation status
header("Content-Type: application/json;charset=utf-8");
$data=['status'=> $status];
$json= json_encode($data);
echo $json;
?>

