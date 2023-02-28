

<?php


error_reporting(E_ERROR);
// ini_set("display_errors", 0);

header('Access-Control-Allow-Origin:http://hotels.localhost');

spl_autoload_register(function ($class){
    // 1. If you use the full path of Class (for ex. app\Hotel\TestClass)
    // require str_replace('\\','/', $class) . '.php';
    //OR
    // 2. If you don't use the full path of Class
    $class = str_replace("\\","/", $class);
    // var_dump(sprintf('app/%s.php', $class));
    require_once sprintf(__DIR__.'/../app/%s.php', $class);
});

// Extends Exception
class MyError extends Exception{};
   
use Hotel\User;

$user = new User();
// error_reporting(0);


$loggedIn=false;

// Check if there is a token in the request
$userToken="";
if (!empty($_COOKIE['user_token'])){

    $userToken =$_COOKIE['user_token'];
    if ($userToken){
    
        // Verify user
        if ($user->verifyToken($userToken)){
            // Set user in memory
            $userInfo = $user->getTokenPayload($userToken);
            User::setCurrentUserId($userInfo['user_id']);

        };
        
    }
}

// check if dates are given on home Page Search
$dates=false;
if(!empty($_REQUEST['check-in-date']) && !empty($_REQUEST['check-out-date'])){
$dates=true;
}
?>



