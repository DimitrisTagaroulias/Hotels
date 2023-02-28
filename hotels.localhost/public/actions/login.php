<?php
// Boot application
require_once __DIR__ . "/../../boot/boot.php";

use Hotel\User;
use Exception;

// Return to home page if not a post request

if (strtolower($_SERVER["REQUEST_METHOD"]) != "post"){
    header("Location: ../index.php");

    return;
}

if (!empty(User::getCurrentUserId())){
    header('Location: ../index.php');
    return;
}

$user = new User();

// Verify User
try{
    if ($user->verify($_REQUEST['emailLogin'],$_REQUEST['passWordLogin'])){
    
    $userInfo = $user->getByEmail($_REQUEST['emailLogin']);
    
    //Generate token
    $token = $user->generateToken($userInfo['user_id']);
    
    //Set cookie
    setcookie('user_token', $token, time() + (30 * 24 * 60 * 60), '/');
    // Return to home page
    header('Location: ../index.php');

    }else{
        throw new Exception("Email or password is invalid.");
    }
    
}catch(Exception $ex){
    $message=urlencode($ex->getMessage());
    header('Location: ../login.php?error='.$message);
    return;
}
?>