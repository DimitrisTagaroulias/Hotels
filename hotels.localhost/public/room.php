
<?php 
  require __DIR__.'/../boot/boot.php';

  use Hotel\Room;
  use Hotel\Favorite;
  use Hotel\User;
  use Hotel\Review;
  use Hotel\Booking;

  // Initialize Room Service
  $room = new Room();
  $favorite = new Favorite();



  // Check for room id
  $roomId = $_REQUEST['room_id'];
  if (empty($roomId)) {
    header('Location: index.php');
    return;
  }

  // Load room info
  $roomInfo = $room->get($roomId);
  if (empty($roomInfo)) {
    header('Location: index.php');
    return;
  }

  // Get current user id
  $userId = User::getCurrentUserId();

  // Check if room is favorite for current user
  $isFavorite = $favorite->isFavorite($roomId, $userId);

  // Load all room reviews
  $review = new Review;
  $allReviews = $review->getReviewByRoom($roomId);

  // Check for booking room 
  $checkInDate = $_REQUEST['check-in-date']; // Y-m-d
  $checkOutDate = $_REQUEST['check-out-date']; // Y-m-d
  
  // Change date format -> d-m-Y in order to show it in AJAX date inputs
  $dateIn=date('d-m-Y',strtotime($checkInDate));
  $dateOut=date('d-m-Y',strtotime($checkOutDate));

  $alreadyBooked = empty($checkInDate) || empty($checkOutDate);

  // Look for Bookings
  if (!$alreadyBooked){
    $booking = new Booking();
    $alreadyBooked = $booking->isBooked($roomId, $checkInDate, $checkOutDate);
  }
?>
  <!-- HEAD START -->
  <?php require_once('__head.html') ?>

    <title>TravelWorld | Room Info</title>

    <!-- CSS START -->
    <?php require_once('__css.html') ?>

    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/css_room/room_travelworld-main-1.css"
    />

    <link rel="stylesheet" type="text/css" href="assets/css/__media_320_HEADER_11-1.css" media="screen and (min-width:320px)"/>
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/css_room/media_room_320-1.css"
      media="screen and (min-width:320px)"
    />
    <link rel="stylesheet" type="text/css" href="assets/css/css_room/media_room_414-2.css" media="screen and (min-width:414px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/css_room/media_room_481-3.css" media="screen and (min-width:481px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_630_HEADER-14.css" media="screen and (min-width:630px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/css_room/media_room_691-32.css" media="screen and (min-width:691px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/css_room/media_room_769_LS-4.css" media="screen and (min-width: 769px) and (orientation: landscape)"/>
    <!-- CSS END -->
  </head>
  <!-- HEAD END -->

  <!-- BODY START -->
  <body>
      <!-- class= "xxxx unused"= εμειναν μονο για λογους κατανοησης του περιεχομενου -->
    <!-- class= "xxxx unused"= it's only for understanding the content -->

    <!-- HEADER START -->
    <?php require_once('__header.php') ?>
    <!-- HEADER END -->

    <!-- HERO START -->
    <div class="hero-container">
      <div class="after-nav-backgroung-line"></div>

      <!-- MY BOOKINGS START-->
      <!-- MY BOOKINGS START-->
      <!-- MY BOOKINGS START-->
      <main class="search-results" id="room-info">
        <section class="search-results-title">
          <h2>Room Info</h2>
        </section>
        <section class="results-container unused">
          <!-- article Start -->
          <article class="results-article">
            <section class="results-header">
              <h3 class="hotel-name"><?php echo strtoupper($roomInfo['name']);?></h3>
              <p class="destination-info"><?php echo strtoupper(sprintf('%s, %s',$roomInfo['city'],$roomInfo['area'],$roomInfo['area']));?></p>
              <div class="reviews-label">
                Reviews:
                <div class="rating" style="transform:rotateY(0)">
                  <?php $roomAvgReview = $roomInfo['avg_reviews'];?>
                  <?php for ($i = 1; $i<=5; $i++) :
                    if ($roomAvgReview >= $i) :?>
                      <span class="checked-star"></span>
                    <?php else: ?>
                      <span class="empty-star"></span>
                    <?php endif ?>  
                  <?php endfor ?> 
                </div>
                <div id="favorite" class="heart-container">
                  <form name="favoriteForm" id="favoriteForm" action="actions/favorite.php" method="POST">  
                    <div class="bookmarked-heart">
                      <input type="hidden" name="csrf" value="<?php echo User::getCsrf() ?>">
                      <input type="hidden" name="room_id" value="<?php echo $roomId ?>">
                      <input type="checkbox"  id="heart-like" <?php echo $isFavorite ? "checked" : "" ?> />
                      <label for="heart-like"></label>
                      <input type="hidden" name="is_favorite" value="<?php echo $isFavorite ? "1" : "0" ?>">
                    </div>
                  </form>
                </div>
              </div>
              <div class="total-info-middle hidden-cost-header">
                <div class="cost" id="cost-info">Per Night</div>
                <div class="price txt-center" id="cost-content"><?php echo strtoupper($roomInfo['price']);?></div>
              </div>
            </section>
            <section class="hotel-photo">
              <img src="assets/images/rooms/<?php echo $roomInfo['photo_url']; ?>" alt="<?php echo $roomInfo['photo_url']; ?>">
            </section>
            <section class="results-description-container unused">
              <p class="results-description">
              <?php echo $roomInfo['description_long'];?>
              </p>
            </section>
            <section class="results-footer">
              <form name="datesForm" action="actions/booking.php" method="POST" class="datesForm">
                <div class="datepicker-container">
                  <div class="datepicker-inputs">
                    <input type="hidden" name="csrf" value="<?php echo User::getCsrf() ?>">
                    
                    <input type="hidden" name="room_id" value="<?php echo $roomId ?>">  
                    <div class="dateInput">
                      <span class="from-to-date ">From: </span>
                      <input type="text" id="from" class="datepicker" name="check-in-date" placeholder="dd-mm-yyyy" value="<?php echo $dates ? $dateIn : "" ;?>">
                    </div>
                    <div class="dateInput">
                      <span class="from-to-date ">To: </span>
                      <input type="text" id="to" class="datepicker" name="check-out-date" placeholder="dd-mm-yyyy" value="<?php echo $dates ? $dateOut : "" ;?>">
                    </div>
                  </div>
                  <button type="submit">Check availability</button>
                    
                    </div>  

              </form>

              <!-- Κατω επρεπε να ειναι <div> αντι για <p> -->
              <!-- The <p> tag in code below it has to be <div> instead-->
              <p class="book-it-button room-button <?php echo $alreadyBooked ? "booked" : ""?>">
                <a href=""><?php echo $alreadyBooked ? "Already booked" : "Book it now"?></a>
                <form name="bookingForm" action="actions/booking.php" method="POST" class="bookingForm">
                <input type="hidden" name="csrf" value="<?php echo User::getCsrf() ?>">
                <input type="hidden" name="room_id" value="<?php echo $roomId ?>">  
                <input type="hidden" name="check-in-date" value="<?php echo $checkInDate ?>">  
                <input type="hidden" name="check-out-date" value="<?php echo $checkOutDate ?>">  
                </form>
              </p>
              <div class="total-info-container">
                <div class="total-info-left">
                  <div class="count-of-guests" id="guests-info">Count Of Guests</div>
                  <div class="parking" id="parking-info">Parking</div>
                  <div class="room-type" id="room-info">Type of Room</div>
                  <div class="wifi" id="wifi-info">Wifi</div>
                  <div class="pet-friendly" id="pet-info">Pet Friendly</div>
                </div>
                <div class="total-info-right">
                  <div class="guests txt-center" id="guests-content"><?php echo $roomInfo['count_of_guests'];?></div>
                  <div class="type txt-center" id="room-content"><?php echo $roomInfo['type_id'];?></div>
                  <div class="have-parking txt-center" id="parking-content"><?php echo $roomInfo['parking'];?></div>
                  <div class="have-wifi txt-center" id="wifi-content"><?php echo $roomInfo['wifi'];?></div>
                  <div class="is-pet-friendly txt-center" id="pet-content"><?php echo $roomInfo['pet_friendly'];?></div>
                </div>
                <div class="total-info-middle hidden-cost-footer">
                  <div class="cost" id="cost-info">Per Night</div>
                  <div class="price txt-center" id="cost-content"><?php echo $roomInfo['price'];?></div>
                </div>
              </div>
            </section>
          </article>
          <!-- article END -->
        </section>
      </main>
      <!-- MY BOOKINGS END-->
      <!-- MY BOOKINGS END-->
      <!-- MY BOOKINGS END-->

      <!-- MAP MAP MAP MAP MAP START-->
      <!-- MAP MAP MAP MAP MAP START-->
      <div class="mapouter">
        <div class="gmap_canvas">
          <iframe
            width="100%"
            height="165"
            id="gmap_canvas"
            src="<?php echo $roomInfo['map_url'];?>"
            frameborder="0"
            scrolling="no"
            marginheight="0"
            marginwidth="0"
          ></iframe>
          <a href="https://fmovies-online.net"></a>
          <br/>
          <a href="https://www.embedgooglemap.net">google maps widget</a>
        </div>
      </div>
      <!-- MAP MAP MAP MAP MAP END-->
      <!-- MAP MAP MAP MAP MAP END-->

      <!-- USER-REVIEWS START-->
      <!-- USER-REVIEWS START-->
      <!-- USER-REVIEWS START-->

      
      <section class="user-reviews-container">
        <div class="user-reviews-header">Reviews</div>
        <ol class="user-review">
          <?php foreach ($allReviews as $review):?>
            <li class="li-review">
              <span class="user-name"><?php echo $review['user_name']?></span>
              <div class="rating" style="transform:rotateY(0)">
                <?php 
                  for ($i = 1; $i<=5; $i++) :
                    if ($review['rate'] >= $i) :?>
                      <span class="checked-star"></span>
                    <?php else: ?>
                      <span class="empty-star"></span>
                    <?php endif ?>  
                  <?php endfor ?> 
              </div>
              <div class="add-time-container">
                <div class="add-time">Created time:&nbsp;</div>
                <span class="add-time-date"> <?php echo $review['created_time']?></span>
              </div>
              <p class="user-text-review">
                <?php echo htmlentities($review['comment']) ?>
              </p>
            </li>
          <?php endforeach ?>
        </ol>
        <div class="no-reviews-report">
          <?php echo !empty($allReviews) ? '' : 'There isn\'t any review.' ?>
        </div>
      </section>

      <!-- USER-REVIEWS END-->
      <!-- USER-REVIEWS END-->
      <!-- USER-REVIEWS END-->
      <section class="my-review-container">
        <form class="my-review-form" name="my-review-form" action="actions/review.php" method="post">
          <input type="hidden" name="csrf" value="<?php echo User::getCsrf() ?>">
          <input type="hidden" name="room_id" value="<?php echo $roomId ?>">
          <div class="my-review-header">Add review</div>
          <p class="destination-info"><?php echo strtoupper($roomInfo['name']);?></p>
          
          <div class="rating">
            <input type="radio" name="rate" id="star1" value="5"/><label
              for="star1" title="Awesome - 5 stars"
            ></label>
            <input type="radio" name="rate" id="star2" value="4"/><label
              for="star2" title="Pretty good - 4 stars"
            ></label>
            <input type="radio" name="rate" id="star3" value="3"/><label
              for="star3" title="Just good - 3 stars"
            ></label>
            <input type="radio" name="rate" id="star4" value="2"/><label
              for="star4" title="Kinda bad - 2 stars"
            ></label>
            <input type="radio" name="rate" id="star5" value="1"/><label
              for="star5" title="Very Bad - 1 star"
            ></label>
          </div>
          <textarea
            id="comment"
            name="comment"
            placeholder="Write your review..."
          ></textarea>
          <div class="review-rules-Error-container">
            <p class="review-rules-Error hidden">Your review must be at least one star.</p>
          </div>
          <input id="my-review-submit-button" type="submit" value="Submit" />
        </form>
      </section>

      <!-- to #TOP fragment Start -->
      <section class="aside-results-footer unused">
        <div id="nav-frag" class="nav-frag">
          <div class="fragments" id="top-fragment">
            <a href="#top"> #Top <i class="fa-solid fa-angles-up"></i></a>
          </div>
        </div>
      </section>
      <!-- to #TOP fragment End -->
      
    </div>
    <!-- HERO END-->
    <div class="modal">
      <div class="modal-content">
        <div>
          You have to be logged in in order to book a room, check availability on new dates, add a room to favorites or submit a review.
        </div>
        <div class="close-button">
          ok
        </div>
      </div>
    </div>

    <!-- JavaScript START-->
    <?php require_once('__common_JS_files.html') ?>

    <script src="assets/js/room/room.js"></script>
    <script src="assets/js/room/room_ajax.js"></script>
    <!-- JavaScript END-->

    <!-- FOOTER -->
    <?php require_once('__footer.html') ?>
    
