<?php
  require __DIR__.'/../../boot/boot.php';

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
  $selectedCity = $_REQUEST['city'];
  $selectedTypeId = $_REQUEST['room-type'];
  $selectedRoomTypeTitle=$_REQUEST['room-type-title'];
  $selectedCountOfGuests=$_REQUEST['count-of-guests'];
  $selectedMinPrice=$_REQUEST['min-price'];
  $selectedMaxPrice=$_REQUEST['max-price']; 
  $checkInDate = $_REQUEST['check-in-date'];
  $checkOutDate = $_REQUEST['check-out-date'];
  $SortBy = $_REQUEST['sort-by'];

  // How many records per page
  $rpp = 2;

  // Query db for total records - Search for room without pagination(returns only room_id)
  $totalRecords = $room->search(new DateTime($checkInDate), new DateTime($checkOutDate), $selectedCity,"","", $selectedTypeId, $selectedCountOfGuests, $selectedMinPrice, $selectedMaxPrice);

  // Get total records
  $numRows = count($totalRecords);

  // Get total number of pages
  $totalPages = (($numRows % 2 !== 0) || ($numRows<1)) ? floor($numRows / $rpp)+1 : ($numRows / $rpp );

  // Check for set page
  isset($_GET['page']) && ($_GET['page'] >= 0) && ($_GET['page'] <= $totalPages)? $page = $_GET['page'] : $page = 1;
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
    

<section class="search-results-title <?php echo (count($allAvailableRooms) == 0)?"":"sticky"?>">
  <div class="results-title-sub-container">
    <div class="empty-box"></div>
    <h2>
    Hotels
    </h2>
    <div class="sorting">
      <form action="search_results.php" method="GET" name="sorting-form" id="sorting-form">
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
  <div class="pagination">
    <div class="count-of-results">
      <?php echo $numRows ?> results were found
    </div>
    <div class="pages">
      <span class="prev-page page-arrow <?php echo $page==="1" ? 'non-visible' : '' ?>" title="previous page">
        <a href="" class="turn-page" id="prev-page"><i class="fa-solid fa-caret-left"></i></a>
        &nbsp;
      </span>
      <span class="current-page">
        page <small><span id='current-id-page'><?php echo $page ?></span> / <span id="total-pages"><?php echo $totalPages ?></span></small>
      </span>
      <span class="next-page page-arrow <?php echo $page==$totalPages ? 'non-visible' : '' ?>" title="next page">
        &nbsp;
        <a href="" class="turn-page" id="next-page"><i class="fa-solid fa-caret-right"></i></a>
      </span>
    </div>
  </div>
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
          <a href="#">Go to Room</a>
          <form name="go-to-room-form" action="room.php?" method="GET">
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
  <!-- article END  -->

  <?php if(count($allAvailableRooms) == 0):?>
    <h2 id="no-results" class="no-results">
      There are no rooms !!!
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


