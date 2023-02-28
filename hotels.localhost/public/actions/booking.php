<?php
// Boot application
require_once __DIR__ . "/../../boot/boot.php";

use Hotel\User;
use Hotel\Booking;

// Return to home page if not a post request

if (strtolower($_SERVER["REQUEST_METHOD"]) != "post"){
    header("Location: ../index.php");
    
    return;
}

// If no user is logged in, return to main page

if (empty(User::getCurrentUserId())){
    header('Location: ../index.php');
    return;
}

// Check if room id is given
$roomId = $_REQUEST['room_id'];

if (empty($roomId)) {
    header('Location: ../index.php');
    return;
}

// Verify csrf
$csrf = $_REQUEST['csrf'];
if (empty($csrf) || !User::verifyCsrf($csrf)) {
    header('Location: ../index.php');
    return;
}


// Create booking
$booking = new Booking();
$checkInDate = $_REQUEST['check-in-date'];
$checkOutDate = $_REQUEST['check-out-date'];

// Check if room is already booked
$isBooked = $booking->isBooked($roomId,$checkInDate,$checkOutDate);

if($isBooked){
    header('Location: ../index.php');
    die;
}

// Book the room
$status=$booking->insert($roomId, User::getCurrentUserId(), $checkInDate, $checkOutDate);

// Return to room page
header(sprintf('Location: ../room.php?room_id=%s',$roomId));

?>