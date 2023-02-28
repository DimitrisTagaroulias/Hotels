<?php
  require __DIR__.'/../boot/boot.php';

  use Hotel\Room;
  use Hotel\RoomType;

  // Get cities
  $room = new Room();
  $cities = $room->getCities();
  $minPrice = $room->getMinPrice();
  $maxPrice = $room->getMaxPrice();
  $countOfGuests= $room->getCountOfGuests();

  // Get types of rooms
  $type =new RoomType();
  $allTypes = $type->getAllTypes();

  //Get page parameters
  $homesearchFlag = $_REQUEST['home-search'];
  $selectedCity = $_REQUEST['city'];
  $selectedTypeId = $_REQUEST['room-type'];
  $selectedRoomTypeTitle=$_REQUEST['room-type-title'];
  $selectedCountOfGuests=$_REQUEST['count-of-guests'];
  $selectedMinPrice=$_REQUEST['min-price'];
  $selectedMaxPrice=$_REQUEST['max-price'];
  $checkInDate = $_REQUEST['check-in-date'];
  $checkOutDate = $_REQUEST['check-out-date'];
  $SortBy = $_REQUEST['sort-by'];


  // Checking if you came in this page via "home-page-search button" or you just click "Hotels" tab
  if($homesearchFlag){

    // Checking for dates' difference
    $daysDiffOk = Room::checkDateDifference($checkInDate,$checkOutDate);
  
    $main_Request_Parameters_String ='city='.$selectedCity.'&room-type='.$selectedTypeId.'&room-type-title='.$selectedRoomTypeTitle.'&check-in-date='.$checkInDate.'&check-out-date='.$checkOutDate;
    
    // Checking if dates' difference is > 1 AND if city is selected
    if (!$daysDiffOk && empty($selectedCity)){
      header("Location: ./index.php?".$main_Request_Parameters_String."&city_error=1&dates_error=1");
      die;
    }
  
    // Checking if dates' difference is > 1
    if (!$daysDiffOk){
      header("Location: ./index.php?".$main_Request_Parameters_String."&dates_error=1");
      die;
    }
  
     // Checking if City is selected
     if (empty($selectedCity)){
       header("Location: ./index.php?".$main_Request_Parameters_String."&city_error=1");
       die;
     }

  }




  // Checking for prices difference
  $priceDiffOk = $room ->checkPriceDifference($selectedMinPrice, $selectedMaxPrice);
  if(!$priceDiffOk){
    $selectedMinPrice=0;
    $selectedMaxPrice=$maxPrice;
  }

  // Pagination Start
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $regex='/&page=\d+/';
  $actual_link = preg_replace($regex,'',$actual_link)."&";

  // How many records per page
  $rpp = 2;

  // Query db for total records - Search for room without pagination(returns only room_id)
  $totalRecords = $room->search(new DateTime($checkInDate), new DateTime($checkOutDate), $selectedCity,"","", $selectedTypeId, $selectedCountOfGuests, $selectedMinPrice, $selectedMaxPrice);
  
  // Get total records
  $numRows = count($totalRecords);
  
  // Get total number of pages
  $totalPages = (($numRows % 2 !== 0) || ($numRows<1)) ? floor($numRows / $rpp)+1 : ($numRows / $rpp );
  
  // Check for set page
  isset($_GET['page']) && ($_GET['page'] > 0) && ($_GET['page'] <= $totalPages)? $page = $_GET['page'] : $page = 1;
  // Check for page 1
  if($page > 1) {
    $start = ($page * $rpp) - $rpp;
  }else{
    $start = 0;
  }
  
  // Query results - Search for room with pagination
  $allAvailableRooms = $room->search(new DateTime($checkInDate), new DateTime($checkOutDate), $selectedCity,$start, $rpp, $selectedTypeId, $selectedCountOfGuests, $selectedMinPrice, $selectedMaxPrice, $SortBy);
  
  // Pagination End

?>  
    <!-- Η "maxPrice" χρειαζεται στο αρχειο "price_0.js" και οριζει στο max input να παιρνει τιμη οσο η $maxPrice -->
    <!-- "maxPrice" is needed in file "price_0.js" for setting max input value =  $maxPrice value -->

    <script type="text/javascript">
    const maxPrice = "<?php echo $maxPrice; ?>";
    </script>

  <!-- HEAD START -->
  <?php require_once('__head.html') ?>
    
    <title>TravelWorld | Hotels</title>

    <!-- CSS START -->
    <?php require_once('__css.html') ?>

    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/css_hotels/hotels_travelworld-main-1.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/css_hotels/hotels_travelworld-price-2.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/travelworld-animation-9.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/css_hotels/media_hotels_320-3.css"
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
      href="assets/css/css_hotels/media_hotels_481-4.css"
      media="screen and (min-width:481px)"
    />
    <link rel="stylesheet" type="text/css" href="assets/css/__media_630_HEADER-14.css" media="screen and (min-width:630px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_769_Back_Ground_Photo-15.css" media="screen and (min-width:769px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/css_hotels/media_hotels_769_LS-5.css" media="screen and (min-width: 769px) and (orientation: landscape)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/home_page_search.css">
    <link rel="stylesheet" type="text/css" href="assets/css/css_hotels/home_page_search_FIX.css">
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

    <!--  -->
    <div class="hero-container">
      <div class="empties empty-top"></div>
      <div class="empties empty-bottom"></div>

      <!-- SEARCH RESULTS START-->
      <!-- SEARCH RESULTS START-->
      <!-- SEARCH RESULTS START-->
        
      <aside class="search-results" id="hotel-results">
        <section class="search-results-title <?php echo (count($allAvailableRooms) == 0)?"":"sticky"?>">
          <div class="results-title-sub-container">
            <div class="empty-box"></div>
            <h2>
              Hotels
            </h2>
            <div class="sorting">
              <form action="#" method="GET" name="sorting-form" id="sorting-form">
                <select name="sort-by" id="sorting-list">
                  <option value="" selected disabled hidden>Sort by... </option>
                  <option value="name ASC">Name (A &#xf30b; Z)</span></option>
                  <option value="city ASC">City (A &#xf30b; Z)</option>
                  <option value="price ASC">Price (Ascending &#xf30c; )</option>
                  <option value="price DESC">Price (Descending &#xf309; )</option>
                </select>
              </form>
            </div>
          </div>
        
          <?php if($homesearchFlag):?>
            <div class="pagination">
              <div class="count-of-results">
                <?php echo $numRows ?> results were found
              </div>
              <div class="pages">
                <span class="prev-page page-arrow <?php echo $page==="1" ? 'non-visible' : '' ?>" title="previous page">
                  <a href="<?php echo $actual_link."&page=".($page>1 ? $page-1 : $page) ?>" class="turn-page" id="prev-page"><i class="fa-solid fa-caret-left"></i></a>
                  &nbsp;
                </span>
                <span class="current-page">
                  page <small><span id='current-id-page'><?php echo $page ?></span> / <span id="total-pages"><?php echo $totalPages ?></span></small>
                </span>
                <span class="next-page page-arrow <?php echo $page==$totalPages ? 'non-visible' : '' ?>" title="next page">
                  &nbsp;
                  <a href="<?php echo $actual_link."&page=".($page<$totalPages ? $page+1 : $page) ?>" class="turn-page" id="next-page"><i class="fa-solid fa-caret-right"></i></a>
                </span>
              </div>
            </div>
          <?php endif ?>
        </section>
        <section class="results-container unused">
          <!-- article Start -->
          <?php foreach ($allAvailableRooms as $AvailableRoom) :
            $resultsRoomType=$type->getTypeTitle($AvailableRoom['type_id']);?>
            <article class="results-article">
              <section class="results-header">
                <h3>
                  <?php echo strtoupper($AvailableRoom['name']); ?>
                </h3>
                <p class="destination-info">
                  <?php echo strtoupper(sprintf('%s, %s',$AvailableRoom['city'],$AvailableRoom['area'])) ?>
                </p>
              </section>
              <section class="hotel-photo">
                <img src="assets/images/rooms/<?php echo $AvailableRoom['photo_url']; ?>" alt="<?php echo $AvailableRoom['photo_url']; ?>">
              </section>
              <section class="results-description-container unused">
                <p class="results-description">
                  <?php echo $AvailableRoom['description_short']; ?>
                </p>
              </section>
              <section class="results-footer">
                <p class="go-to-room room-button">
                  <a id="" href="#">Go to Room</a>
                  <form name="go-to-room-form-<?php echo  $AvailableRoom['room_id'];?>" action="room.php?" method="GET">
                    <input type="hidden" name="room_id" value="<?php echo  $AvailableRoom['room_id'];?>">
                    <input type="hidden" name="check-in-date" value="<?php echo $dates ?"$checkInDate": "";?>">
                    <input type="hidden" name="check-out-date" value="<?php echo $dates ?"$checkOutDate": "";?>">
                  </form>
                </p>
                <div class="total-info">
                  <div class="cost">
                    Per Night:
                  </div>
                  <div class="price">
                    <?php echo $AvailableRoom['price']; ?>
                  </div>
                  <div class="guests-number">
                    Count of Guest:
                  </div>
                  <div class="people">
                    <?php echo $AvailableRoom['count_of_guests']; ?>
                  </div>
                  <div class="room-type">
                    Type of Room:
                  </div>
                  <div class="type">
                    <?php echo $resultsRoomType['title']; ?>
                  </div>
                </div>
              </section>
            </article>
          <?php endforeach ?>
          <!-- article END -->
          <?php if(count($allAvailableRooms) == 0):?>
          <h2 id="no-results" class="no-results">
            <?php echo $homesearchFlag ? "There are no rooms !!!" : "Begin your search..." ?>
          </h2>
          <?php endif ?>
        </section>
        <section class="aside-results-footer">
          <div id="nav-frag" class="nav-frag <?php echo (count($allAvailableRooms) == 0)?"hidden":""?>" >
            <div class="fragments" id="top-fragment">
              <a href="#top"> #Top <i class="fa-solid fa-angles-up"></i></a>
            </div>
          </div>
        </section>
      </aside>
      <!-- SEARCH RESULTS END-->
      <!-- SEARCH RESULTS END-->
      <!-- SEARCH RESULTS END-->

      <!-- OUTER MAIN START -->
      <main id="outer-main">
        <!-- HOME MAIN START -->
        <main id="home-main" class="<?php echo (count($allAvailableRooms) == 0)?"":"sticky"?>">
          <div id="after-nav" ><div class="after-nav">Find the Perfect Hotel</div></div>
          <form id="hotels-search-form" class="search-form <?php echo !$daysDiffOk ? 'search-error':''?>" name="hotels-search-form" action="hotels.php" method="get">
            <fieldset id="hotels-fieldset" class="search-fieldset">
              <li class="input" id="guests">
                <span class="emptySpan unused"></span>
                <span class="guests-choise-container search-input">
                  <span id="guests-search-input-title" >Count of Guests</span>
                  <span id="guests-search-input-choise" class="blue-font-color font-size-09rem margin-t-b--02"><?php echo !empty($_REQUEST['count-of-guests']) ? $_REQUEST['count-of-guests'] :"";?></span>
                </span>             
                <i class="menu-icon fa-solid fa-chevron-down"></i>
              </li>
              <?php require_once('__count_of_guests_drop_down.php'); ?>

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
              <?php require_once('__city_drop_down.php'); ?>

              <li class="input" id="room-type">
                <span class="emptySpan unused"></span>
                <span class="room-type-choise-container search-input">
                  <span id="room-type-search-input-title">Room-type</span>
                  <span id="room-type-search-input-choise" class="blue-font-color font-size-09rem margin-t-b--02"><?php echo !empty($_REQUEST['room-type-title']) ? $_REQUEST['room-type-title'] :"";?></span>
                </span>             
                <i class="menu-icon fa-solid fa-chevron-down"></i>
              </li>
              <?php require_once('__room_type_drop_down.php'); ?>
              
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
              <?php require_once('__check_in_date_drop_down.php'); ?>

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
              <?php require_once('__check_out_date_drop_down.php'); ?>

              <input
                type="submit"
                class="input search-submit-button"
                id="hotels-page-submit-button"
                value="Search"
              />

              <!-- PRICE INPUT START -->
              <li class="input wrapper-price">
                <div class="price-input">
                  <input type="number" class="input-min" value="<?php echo !empty($selectedMinPrice) ? $selectedMinPrice : $minPrice ?>" />
                  <input type="number" class="input-max" value="<?php echo !empty($selectedMaxPrice) ? $selectedMaxPrice :$maxPrice?>" />
                </div>
                <div class="slider-container">
                  <div class="slider">
                    <div class="progress"></div>
                  </div>
                </div>
                <div class="range-input">
                  <input
                    type="range"
                    name="min-price"
                    class="range-min"
                    min="0"
                    max="<?php echo $maxPrice?>"
                    value="<?php echo !empty($selectedMinPrice) && $selectedMinPrice>$minPrice ? $selectedMinPrice : $minPrice ?>"
                    step="1"
                  />
                  <input
                    type="range"
                    name="max-price"
                    class="range-max"
                    min="0"
                    max="<?php echo $maxPrice?>"
                    value="<?php echo !empty($selectedMaxPrice) ? $selectedMaxPrice :$maxPrice?>"
                    step="1"
                  />
                </div>
                <div class="price-text">
                  <div class="min-price">Min price</div>
                  <div class="max-price">Max price</div>
                </div>
              </li>
              <!-- PRICE INPUT END -->
              <div class="required">
                <div class="required-1">* Required</div>
                <div class="required-2" >** Required and must be later date than check in date</div>
              </div>
            </fieldset>
            
            <input 
            id="selected-city" 
            type="hidden" 
            name="city" 
            value=
            "<?php echo !empty($_REQUEST['city']) ? $_REQUEST['city'] :"";?>"
            >

            <input id="selected-room-type" 
            type="hidden" 
            name="room-type"
            value=
            "<?php echo !empty($_REQUEST['room-type']) ? $_REQUEST['room-type'] :"";?>"
            >

            <input id="current-page" type="hidden" name="page" value="<?php echo $page ?>">

            
              
          </form>
          <!-- FORM END -->

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


    <script src="assets/js/hotels/price_0.js"></script>
    <script type="module" src="assets/js/common_files_JS/simple_search.js"></script>
    <script type="module" src="assets/js/hotels/advanced_search_ajax.js"></script>

     <!-- JavaScript END-->

    <!-- FOOTER -->
    <?php require_once('__footer.html') ?>
    
