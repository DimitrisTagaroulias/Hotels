<?php
// Boot application
require_once __DIR__ . "/../../boot/boot.php";

use Hotel\User;
use Hotel\Review;
$userId = User::getCurrentUserId();

//Return to home page if not a post request
if (strtolower($_SERVER["REQUEST_METHOD"]) != "post"){
  header("HTTP/1.0 400 This is a post script");
    die;
}

// If no user is logged in, return to main page
if (empty($userId)){
  header("HTTP/1.0 400 No current user for this operation");
    die;
}

// Check if room id is given
$roomId = $_REQUEST['room_id'];
if (empty($roomId)) {
  header("HTTP/1.0 400 No room is given for this operation");
    die;
}

// Verify csrf
$csrf = $_REQUEST['csrf'];
if (empty($csrf) || !User::verifyCsrf($csrf)) {
    die;
}

// Add review
$review = new Review();
$review->insert($roomId, $userId, $_REQUEST['rate'], $_REQUEST['comment']);

// Get all reviews***
$roomReviews = $review->getReviewByRoom($roomId);
$counter = count($roomReviews);

// Load user
$user = new User();
$userInfo = $user->getByUserId($userId);
?>
          <li class="li-review">
            <span class="user-name"><?php echo $userInfo['name']?></span>
            <div class="rating" style="transform:rotateY(0)">
            <?php 
              for ($i = 1; $i<=5; $i++) :
                if ($_REQUEST['rate'] >= $i) :?>
                  <span class="checked-star"></span>
                <?php else: ?>
                  <span class="empty-star"></span>
                <?php endif ?>  
              <?php endfor ?> 
            </div>
            <div class="add-time-container">
              <div class="add-time">Created time:&nbsp;</div>
              <span class="add-time-date"> <?php echo (new DateTime())->format('Y-m-d H:i:s'); ?></span>
            </div>
            <p class="user-text-review">
              <?php echo htmlentities($_REQUEST['comment']); ?>
            </p>
          </li>
    