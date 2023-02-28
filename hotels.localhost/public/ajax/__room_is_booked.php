<?php
// Boot application
require_once __DIR__ . "/../../boot/boot.php";

use Hotel\User;
use Hotel\Booking;

// Return to home page if not a post request
if (strtolower($_SERVER["REQUEST_METHOD"]) != "post"){
    echo "This is a post script";
    die;
}

// If no user is logged in, return to main page
if (empty(User::getCurrentUserId())){
    echo "No current user for this operation";
    die;
}
// Check if room id is given
$roomId = $_REQUEST['room_id'];

if (empty($roomId)) {
    echo "No room is given for this operation";
    die;
}

// Verify csrf
$csrf = $_REQUEST['csrf'];
if (empty($csrf) || !User::verifyCsrf($csrf)) {
    die;
}

// Create booking
$booking = new Booking();
$checkInDate = $_REQUEST['check-in-date'];
$checkOutDate = $_REQUEST['check-out-date'];


// Check if room is already booked
$isBooked = $booking->isBooked($roomId,$checkInDate,$checkOutDate);



