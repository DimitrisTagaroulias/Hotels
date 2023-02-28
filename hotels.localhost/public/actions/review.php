<?php
// Boot application
require_once __DIR__ . "/../../boot/boot.php";

use Hotel\User;
use Hotel\Review;

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

// Add review
$review = new Review();
$review->insert($roomId, User::getCurrentUserId(), $_REQUEST['rate'], $_REQUEST['comment']);

// Return to room page
header(sprintf('Location: ../room.php?room_id=%s',$roomId));

?>