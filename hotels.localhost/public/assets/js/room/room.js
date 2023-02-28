"use strict";
const $favoriteBtn = $("#heart-like");
const $favoriteForm = $('FORM[name="favoriteForm"]');
const $myReviewForm = $(".my-review-form");
const $reviewSubmitBtn = $("#my-review-submit-button");
const $myReviewFormRadios = $(".my-review-form [type=radio]");
const $reviewErrorText = $(".review-rules-Error");
const $bookItBtn = $(".book-it-button a");
const $bookingForm = $('FORM[name="bookingForm"]');

// submit favorite Form
$favoriteBtn.on("click", function () {
  $favoriteForm.submit();
});

$reviewSubmitBtn.on("click", function (e) {
  e.preventDefault();
  let checkSum = 0;

  // Checks if user checked at least one star on review
  $myReviewFormRadios.each(function (index, item) {
    if ($(item).prop("checked")) {
      $myReviewForm.submit();
      return;
    } else {
      checkSum += 1;
    }
    if (checkSum === 5) {
      $reviewErrorText.removeClass("hidden");
    }
  });
});

// --------
// In order to "Book" the "Room" because if you click on the "button" and not exactly on "A" tag it does nothing
const $roomButton = $(".room-button");
$roomButton.on("click", (e) => {
  if (e.target.tagName === "A") {
    return;
  } else {
    $bookItBtn.click();
  }
});

$bookItBtn.on("click", function (e) {
  e.preventDefault();
  $bookingForm.submit();
});
// --------

// DATEPICKERS------------START------------
// DATEPICKERS------------START------------
// DATEPICKERS------------START------------

// Functions --- START
// Functions --- START

function leapyear(year) {
  return year % 100 === 0 ? year % 400 === 0 : year % 4 === 0;
}

// Convserts this "Sun Feb 26 2023 00:00:00 GMT+0200 (Eastern European Standard Time)" to "mm-dd-YYYY"
Date.prototype.mmddyyyy = function () {
  const dd = this.getDate().toString();
  const mm = (this.getMonth() + 1).toString();
  const yyyy = this.getFullYear().toString();
  return (
    (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]) + "-" + yyyy
  );
};

// Convserts this "Sun Feb 26 2023 00:00:00 GMT+0200 (Eastern European Standard Time)" to "dd-mm-YYYY"
Date.prototype.ddmmyyyy = function () {
  const dd = this.getDate().toString();
  const mm = (this.getMonth() + 1).toString();
  const yyyy = this.getFullYear().toString();
  return (
    (dd[1] ? dd : "0" + dd[0]) + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + yyyy
  );
};

// Convserts "dd-mm-yyy" to "mm-dd-yyyy"
function convertDateTo_MM_DD_YYYY(datepickerValue) {
  const selectedDateParts = datepickerValue.split("-");
  const dd = selectedDateParts[0];
  const mm = selectedDateParts[1];
  const yyyy = selectedDateParts[2];
  return `${mm}-${dd}-${yyyy}`;
}

function is_SELECTED_date_GREATER_than_TODAYS_date(selectedDate_dd_mm_YYYY) {
  const selectedDate_mm_dd_YYYY = convertDateTo_MM_DD_YYYY(
    selectedDate_dd_mm_YYYY
  );
  const todaysDate_mm_dd_YYYY = new Date().mmddyyyy();
  const todaysDateTime = new Date(todaysDate_mm_dd_YYYY).getTime();
  const selectedDateTime = new Date(selectedDate_mm_dd_YYYY).getTime();
  return selectedDateTime > todaysDateTime;
}

function is_ToDate_grater_than_FromDate(
  FromDate_dd_mm_YYYY,
  ToDate_dd_mm_YYYY
) {
  const FromDate_mm_dd_YYYY = convertDateTo_MM_DD_YYYY(FromDate_dd_mm_YYYY);
  const ToDate_mm_dd_YYYY = convertDateTo_MM_DD_YYYY(ToDate_dd_mm_YYYY);
  const FromDateTime = new Date(FromDate_mm_dd_YYYY).getTime();
  const ToDateTime = new Date(ToDate_mm_dd_YYYY).getTime();
  return ToDateTime > FromDateTime;
}

// "$.datepicker.parseDate(dateFormat, newDate)" Gets a string date e.g "15/02/2023" or "15-02-2023" and converts it to "Sun Feb 26 2023 00:00:00 GMT+0200 (Eastern European Standard Time)"
function getDate(element) {
  let date;
  const newDate = returnNewDate(element.value, element.id);

  try {
    date = $.datepicker.parseDate(dateFormat, newDate);
  } catch (error) {
    console.log("error :", error);
    date = null;
  }
  return date;
}

function setDatepickerssMINMAXdateOption() {
  const $selectedCheckInDate = document.querySelector("#from");
  const $selectedCheckOutDate = document.querySelector("#to");

  // Aπαγορευει στο χρηστη να ορισει check_in_date>=check_Out_date
  // Doesn't allow to user to set check_in_date>=check_Out_date
  if ($selectedCheckInDate.value !== "" && $selectedCheckOutDate.value !== "") {
    to.datepicker(
      "option",
      "minDate",
      returnNewDate($selectedCheckInDate.value, "from")
    );
  }
}

// Παιρνει την ημερομηνια που δεχεται και προσθετει η αφαιρει 1 μερα αναλογα με το date_Id που δεχεται.
// Αυτο κανει το datePicker να διατηρει αναμεσα στο "check_in_date" και "check_out_date" διαφορα μιας ημερας. Δηλαδη δεν μπορεις να ορισεις check_in_date>=check_Out_date
// Makes the datepicker to keep between "check_in_date" and "check_out_date" the difference of one day.In other words you cannot set check_in_date>=check_Out_date
function returnNewDate(dateToSplit_Value, dateElement_Id = "") {
  const date_mm_dd_YYYY = convertDateTo_MM_DD_YYYY(dateToSplit_Value);
  const dateToMilliSec = new Date(date_mm_dd_YYYY).getTime();
  let newDate;
  if (dateElement_Id !== "") {
    const dayDiff =
      dateElement_Id === "from" ? 24 * 60 * 60 * 1000 : -(24 * 60 * 60 * 1000);

    newDate = new Date(dateToMilliSec + dayDiff).ddmmyyyy();
    return newDate;
  }
}

function correctDatePickerOption(datepicker) {
  let dateParts = datepicker.value.split("-");
  dateParts = dateParts.map((part) => parseInt(part));
  const selectedDay = dateParts[0];
  const selectedMonth = dateParts[1];
  const selectedYear = dateParts[2];
  const today = new Date().ddmmyyyy();

  switch (selectedMonth) {
    case 1:
    case 3:
    case 5:
    case 7:
    case 8:
    case 10:
    case 12:
      if (selectedDay > 31) {
        datepicker.value = today;
      }
      break;
    case 4:
    case 6:
    case 9:
    case 11:
      if (selectedDay > 30) {
        datepicker.value = today;
      }
      break;
    case 2:
      const date = convertDateTo_MM_DD_YYYY(datepicker.value);
      const yearIsLeap = leapyear(new Date(date).getFullYear());
      if (selectedDay === 29 && yearIsLeap) {
        break;
      }
      if (selectedDay > 28) {
        datepicker.value = today;
      }
      break;
    default:
      datepicker.value = today;
  }
}

$(".datepicker").on("change", function () {
  correctDatePickerOption(this);
});

// Functions --- END
// Functions --- END

// DatePickerss main code --- START
// DatePickerss main code --- START

const $checkDatesBtn = $(".datepicker-container button[type='submit']");
const $checkInDateInput = $("#from");
const $checkOutDateInput = $("#to");
if (!$checkInDateInput.val() || !$checkOutDateInput.val()) {
  $checkDatesBtn.prop("disabled", true);
}

$(".datepicker").datepicker({
  autoSize: true,
  dateFormat: "dd-mm-yy",
  changeMonth: true,
  changeYear: true,
  minDate: 0,
  showButtonPanel: true,
  maxDate: "+2Y",
});

let dateFormat = "dd-mm-yy";

let from = $("#from")
  .datepicker({
    //
  })
  .on("change", function () {
    if (!is_SELECTED_date_GREATER_than_TODAYS_date(this.value)) {
      this.value = new Date().ddmmyyyy();
    }

    if (!is_ToDate_grater_than_FromDate(this.value, to.val())) {
      // Todays Date + 1
      to.val(returnNewDate(from.val(), "from"));
    }

    to.datepicker("option", "minDate", getDate(this)); //**

    if ($checkInDateInput.val() && $checkOutDateInput.val()) {
      $checkDatesBtn.prop("disabled", false);
    }
  });

let to = $("#to")
  .datepicker({
    //
  })
  .on("change", function () {
    // from.datepicker("option", "maxDate", getDate(this)); //**
    if (!is_ToDate_grater_than_FromDate(from.val(), this.value) && from.val()) {
      this.value = returnNewDate(from.val(), "from");
    }

    if ($checkInDateInput.val() && $checkOutDateInput.val()) {
      $checkDatesBtn.prop("disabled", false);
    }
  });

setDatepickerssMINMAXdateOption();

// DatePickerss main code --- END
// DatePickerss main code --- END

// DATEPICKERS------------END------------
// DATEPICKERS------------END------------
// DATEPICKERS------------END------------

//

//

/* MODAL ALERT WINDOW START */
/* MODAL ALERT WINDOW START */
/* MODAL ALERT WINDOW START */

// A modal window is appeared when you try to book a room, check availability on new dates, add a room to favorites or submit a review without being logged in.

const modal = document.querySelector(".modal");
const closeButton = document.querySelector(".close-button");

function toggleModal() {
  modal.classList.toggle("show-modal");
}

function windowOnClick(event) {
  if (event.target === modal) {
    toggleModal();
  }
}

closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

/* MODAL ALERT WINDOW END */
/* MODAL ALERT WINDOW END */
/* MODAL ALERT WINDOW END */
