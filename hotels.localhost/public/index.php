
<?php
  require __DIR__.'/../boot/boot.php';

  use Hotel\Room;
  use Hotel\RoomType;

  // Get cities
  $room = new Room();
  $cities = $room->getCities();

  $type =new RoomType();
  $allTypes = $type->getAllTypes();
 
?>
  <!-- HEAD START -->
  <?php require_once('__head.html') ?>
  
    <title>Travel the World | Hotels | Bookings</title>

    <!-- CSS START -->
    <?php require_once('__css.html') ?>

    <link rel="stylesheet" type="text/css" href="assets/css/travelworld-main-3.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/travelworld-animation-9.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/index_media_320-11.css" media="screen and (min-width:320px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_414_HEADER-12.css" media="screen and (min-width:414px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/index_media_481-13.css" media="screen and (min-width:481px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_630_HEADER-14.css" media="screen and (min-width:630px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_769_Back_Ground_Photo-15.css" media="screen and (min-width:769px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/index_media_769_LS-16.css" media="screen and (min-width: 769px) and (orientation: landscape)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/home_page_search.css">
    <link rel="stylesheet" type="text/css" href="assets/css/DATEPICKER.css">
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
      <!-- ASIDE LEFT OFFERS START-->
      <?php require_once('__aside_left_offers.html') ?>
      <!-- ASIDE LEFT OFFERS END-->
      
      <!-- OUTER MAIN START -->
      <main id="outer-main">  
        <!-- HOME MAIN START -->
        <main id="home-main">
          <div id="after-nav"><div class="after-nav">Find Place & Date</div></div>
          <form id="home-search-form" class="search-form <?php echo !empty($_REQUEST['dates_error']) ? "dates-error" : "" ?> <?php echo !empty($_REQUEST['city_error']) ? "city-error" : "" ?>" name ="home-search-form" action="hotels.php" method="get">
            <fieldset id="home-fieldset" class="search-fieldset">
              <li class="input" id="city">
                <span class="emptySpan unused"></span>
                <span class="city search-input ">
                  <span id="city-search-input-title" class="<?php echo !empty($_REQUEST['city_error'])? "errorTextColor" : "" ?>">
                    <?php echo !empty($_REQUEST['city_error'])? "City is Required!" : "<span>City".(!empty($_REQUEST['city']) ? "" : "<small>*</small>")."</span>" ?>
                  </span>
                  <span id="city-search-input-choise" class="blue-font-color font-size-09rem margin-t-b--02"><?php echo !empty($_REQUEST['city']) ? $_REQUEST['city'] : "" ?></span>
              </span>
                <i class="menu-icon fa-solid fa-chevron-down"></i>
              </li>
              <?php require_once('__city_drop_down.php') ?>

              <li class="input" id="room-type">
                <span class="emptySpan unused"></span>
                <span class="room-type-choise-container search-input">
                  <span id="room-type-search-input-title">
                    Room-type
                  </span>
                  <span id="room-type-search-input-choise" class="blue-font-color font-size-09rem margin-t-b--02"><?php echo !empty($_REQUEST['room-type-title']) ? $_REQUEST['room-type-title'] :"";?></span>
                </span>             
                <i class="menu-icon fa-solid fa-chevron-down"></i>
              </li>
              <?php require_once('__room_type_drop_down.php') ?>

              <li class="input" id="check-in-date">
                <span class="emptySpan unused"></span>
                <span class="input-text search-input">
                  <span id="check-in-date-search-input-title">
                    Check in Date
                  </span>
                  <span id="check-in-date-search-input-choise" class="blue-font-color font-size-09rem margin-t-b--02"><?php echo !empty($_REQUEST['check-in-date']) ? $_REQUEST['check-in-date']: "";?></span>
                </span>
                <i class="menu-icon fa-regular fa-calendar-days"></i>
              </li>
              <?php require_once('__check_in_date_drop_down.php') ?>
             
              <li class="input" id="check-out-date">
                  <span class="emptySpan unused"></span>
                  <span class="input-text search-input">
                    <span id="check-out-date-search-input-title">
                      Check out Date<?php echo !empty($_REQUEST['check-out-date']) ? "" : "<small>**</small>" ?>
                    </span>
                    <span id="check-out-date-search-input-choise" class="font-size-09rem margin-t-b--02 <?php echo !empty($_REQUEST['dates_error'])? "errorTextColor" : "blue-font-color" ?>"><?php echo !empty($_REQUEST['check-out-date']) ? $_REQUEST['check-out-date']: "" ?></span>
                    <span id="check-out-date-error" class="font-size-06rem"></span>
                  </span>
                  <i class="menu-icon fa-regular fa-calendar-days"></i>
              </li>
              <?php require_once('__check_out_date_drop_down.php') ?>

              <input
                  type="submit"
                  class="input search-submit-button"
                  id="home-page-submit-button"
                  value="Search"
                  disabled
              />
              <div class="required">
                <div class="required-1">* Required</div>
                <div class="required-2" >** Required and must be later than check in date</div>
              </div>
            </fieldset>
            <input id="selected-city" type="hidden" 
            name="city" value=<?php echo !empty($_REQUEST['city']) ? $_REQUEST['city'] : "" ?>>

            <input id="selected-room-type" type="hidden" name="room-type" value=<?php echo !empty($_REQUEST['room-type']) ? $_REQUEST['room-type'] : "" ?>>

            <input id="initial-results-page" type="hidden" name="page" value="1">

            <input id="home-search" type="hidden" name="home-search" value="1">
            
          </form>
          

          <div id="offers-scroll-news">
            <div class="scroll-section-fragments" id="news-fragment"><a href="#news">
              #News <i class="menu-icon fa-solid fa-chevron-down"></i></a>
            </div>
            <!-- SCROLL DOWN ANIMATION START-->
            <?php require_once('__animation_scroll_down.html') ?>
            <!-- SCROLL DOWN ANIMATION END-->
            <div class="scroll-section-fragments" id="offers-fragment"><a href="#offers">
              #Offers <i class="menu-icon fa-solid fa-chevron-down"></i></a>
            </div>
          </div>
          
        </main>
        <!-- HOME MAIN END -->
      </main>
      <!-- OUTER MAIN END-->

      <!-- ASIDE RIGHT OFFERS START-->
      <?php require_once('__aside_right_offers.html') ?>
      <!-- ASIDE RIGHT OFFERS END-->
    </div>
    <!-- HERO CONTAINER DIV END -->

    <!-- JavaScript START -->
    <?php require_once('__common_JS_files.html') ?>

  
    <script type="module" src="assets/js/common_files_JS/simple_search.js"></script>
    
    <!-- JavaScript END -->

  <!-- FOOTER -->
  <?php require_once('__footer.html') ?>
    
