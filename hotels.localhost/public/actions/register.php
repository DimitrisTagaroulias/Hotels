<?php
// Boot application
require_once __DIR__ . "/../../boot/boot.php";

use Hotel\User;

// Return to home page if not a post request
if (strtolower($_SERVER["REQUEST_METHOD"]) != "post"){
    header("Location: ../index.php");
    return;
}

// Create new user
$user = new User();
try{
$user-> insert($_REQUEST['userNameREG'], $_REQUEST['emailREG'], $_REQUEST['passWordREG']);
}catch(Exception $ex){
    $error=urldecode($ex->getMessage());
    header('Location: ../register.php?error='.$error);
    return;
};

// Retrieve user
$userInfo = $user->getByEmail($_REQUEST['emailREG']);

//Generate token
$token = $user->generateToken($userInfo['user_id']);

//Set cookie
setcookie('user_token', $token, time() + (30 * 24 * 60 * 60), '/');

// Return to home page
header('Location: ../index.php');
?>
