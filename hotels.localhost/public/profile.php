
<?php
  require __DIR__.'/../boot/boot.php';

  use Hotel\Favorite;
  use Hotel\Review;
  use Hotel\Booking;
  use Hotel\User;

  // Check for logged in user
  $userId=User::getCurrentUserId();
  if (empty($userId)){
    $message=urlencode("You have to be Logged In in order to enter Profile page !");
    header('Location: ./login.php?error='.$message);
    return;
  }

  // Get all favorites 
  $favorite = new Favorite();
  $userFavorites = $favorite->getListByUser($userId);

  // Get all reviews
  $review = new Review();
  $userReviews = $review->getListByUser($userId);

  // Get all user bookings
  $booking = new Booking();
  $userBookings = $booking->getListByUser($userId);

  // <!-- HEAD START -->
  require_once('__head.html')
?>
    <title>TravelWorld | My Profile</title>

    <!-- CSS START -->
    <?php require_once('__css.html') ?>
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/css_profile/profile_travelworld-main-1.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/travelworld-animation-9.css"
    />

    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/css_profile/media_profile_320-2.css"
      media="screen and (min-width:320px)"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/__media_414_HEADER-12.css"
      media="screen and (min-width:414px)"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/css_profile/media_profile_481-3.css"
      media="screen and (min-width:481px)"
    />
    <link rel="stylesheet" type="text/css" href="assets/css/__media_630_HEADER-14.css" media="screen and (min-width:630px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_769_Back_Ground_Photo-15.css" media="screen and (min-width:769px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/css_profile/media_profile_769_LS-4.css" media="screen and (min-width: 769px) and (orientation: landscape)"/>
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

    <div class="hero-container">
      <div class="empties empty-top"></div>
      <div class="empties empty-bottom"></div>

      <!-- MY BOOKINGS START-->
      <!-- MY BOOKINGS START-->
      <!-- MY BOOKINGS START-->
      <aside class="search-results" id="booking-results">
        <section class="search-results-title <?php echo (count($userBookings) == 0)?"":"sticky"?>">
          <h2>My bookings</h2>
        </section>
        <section class="results-container unused">
          <?php if (count($userBookings)>0):
            foreach ($userBookings as $booking):?>
              <!-- article Start -->
              <article class="results-article">
                <section class="results-header">
                  <h3><?php echo strtoupper($booking['name']); ?></h3>
                  <p class="destination-info"><?php echo strtoupper(sprintf('%s, %s',$booking['city'],$booking['area'])); ?></p>
                </section>
                <section class="hotel-photo">
                <img src="assets/images/rooms/<?php echo $booking['photo_url']; ?>" alt="<?php echo $booking['photo_url']; ?>">
             
                </section>
                <section class="results-description-container unused">
                  <p class="results-description">
                    <?php echo $booking['description_short']; ?>
                  </p>
                </section>
                <section class="results-footer">
                <p class="go-to-room room-button"><a href="room.php?room_id=<?php echo $booking['room_id']."&check-in-date=".$booking['check_in_date']."&check-out-date=".$booking['check_out_date'] ?>">Go to Room</a></p>
                  <div class="total-info">
                    <div class="cost">Per Night:</div>
                    <div class="price"><?php echo $booking['price']?>€</div>
                    <div class="check-in-date-info">Check-in Date:</div>
                    <div class="in-date"><?php echo $booking['check_in_date']?></div>
                    <div class="check-out-date-info">Check-out Date:</div>
                    <div class="out-date"><?php echo $booking['check_out_date']?></div>
                    <div class="room-type">Type of Room:</div>
                    <div class="type"><?php echo $booking['room_type']?></div>
                    <div class="total-cost">Total cost:</div>
                    <div class="total-price"><?php echo $booking['total_price']?>€</div>
                  </div>
                </section>
              </article>
              <!-- article END -->
            <?php endforeach ?>
          <?php else: ?>
            <h4 class="no-results"> You don't have any booking.</h4>
          <?php endif ?>
        </section>
        <section class="aside-results-footer">
          <div id="nav-frag" class="nav-frag <?php echo (count($userBookings) == 0) ? 'hidden' : '' ?>" >
            <div class="fragments" id="top-fragment">
              <a href="#top"> #Top <i class="fa-solid fa-angles-up"></i></a>
            </div>
          </div>
        </section>
      </aside>
      <!-- MY BOOKINGS END-->
      <!-- MY BOOKINGS END-->
      <!-- MY BOOKINGS END-->

      <!-- OUTER MAIN START -->
      <main id="outer-main">
        <!-- HOME MAIN START -->
        <main id="home-main" class="<?php echo (count($userBookings) == 0)?"":"sticky"?>">
          <div class="reviews-container">
            <div id="favorites">
              <div class="favorites-label">Favorites</div>
              <div class="reviews-data">
                <?php if(count($userFavorites)>0): ?>
                  <ol class="favorites-list">
                    <?php foreach($userFavorites as $favorite):?>
                      <li class="favorites">
                        <a href="room.php?room_id=<?php echo $favorite['room_id']?>"><?php echo $favorite['name']?></a>
                      </li>
                    <?php endforeach ?>
                  </ol>
                <?php else: ?>                  
                  <h4 class="no-results"> You don't have any favorite hotel.</h4>
                <?php endif ?> 
              </div>
            </div>
            <div id="reviews">
              <div class="reviews-label">Reviews</div>
              <div class="reviews-data">
                <?php if(count($userReviews)>0): ?>
                  <ol class="reviews-list">      
                      <?php foreach($userReviews as $review):?>
                        <li class="review-item unused">
                            <a href="room.php?room_id=<?php echo $review['room_id']?>"><?php echo $review['name']?></a>
                            <div class="rating" style="transform:rotateY(0)">
                              <?php for ($i = 1; $i<=5; $i++) :
                                if ($review['rate'] >= $i) :?>
                                  <span class="checked-star"></span>
                                <?php else: ?>
                                  <span class="empty-star"></span>
                                <?php endif ?>  
                              <?php endfor ?> 
                            </div>
                        </li>
                      <?php endforeach ?>
                  </ol>
                <?php else: ?>                  
                  <h4 class="no-results"> You haven't made any review yet.</h4>
                <?php endif ?>
              </div>
            </div>
          </div>
          <div id="offers-scroll-news">
            <!-- SCROLL DOWN ANIMATION START-->
            <?php require_once('__animation_scroll_down.html') ?>
            <!-- SCROLL DOWN ANIMATION END-->
          </div>
        </main>
        <!-- HOME MAIN END -->
      </main>
      <!-- OUTER MAIN END-->
    </div>

    <!-- JavaScript START-->
    <?php require_once('__common_JS_files.html') ?>
    <script src="assets/js/common_files_JS/room_button.js"></script>
    <!-- JavaScript END-->

    <!-- FOOTER -->
    <?php require_once('__footer.html') ?>
    
