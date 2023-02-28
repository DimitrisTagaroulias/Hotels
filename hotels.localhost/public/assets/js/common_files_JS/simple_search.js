"use strict";

// GLOBAL VARIABLES
// ------
const $homeForm = $("#home-search-form");
const $hotelsForm = $("#hotels-search-form");
const $searchForm = $(".search-form"); // $searchForm = $homeForm , $hotelsForm
// ------
const $sameDateError = $(".error-same-date");
const $dropDownContainer = $(".drop-down-container");
const $dropDownHeader = $(".drop-header");
const $homeFormListItems = $(".search-form LI.input");
const $dateInput = $(".date-input");
const $Datepicker = $(".datepicker");
const $selectedCityInput = $("#selected-city");
let $currentFormSubmitBtn;

if ($homeForm.length) {
  $currentFormSubmitBtn = "#home-page-submit-button";
}

if ($hotelsForm.length) {
  $currentFormSubmitBtn = "#hotels-page-submit-button";
}

// ---------- DOCUMENT READY START ----------
$(document).ready(function () {
  // --->>> CODE STARTS HERE <<<--- //

  // Date Picker Settings
  $.datepicker.setDefaults({
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    minDate: 0,
    maxDate: "+1Y",
  });

  $("#check-in-date-picker").datepicker({ altField: "#check-in-date-input" });
  $("#check-out-date-picker").datepicker({ altField: "#check-out-date-input" });

  // Get selected dates from HOME SEARCH
  getSelectedDates();
  /////////////////////////////////////////////////////
  /////////////////////////////////////////////////////
  /////////////////////////////////////////////////////

  // -------------addRemoveDateErrorClass() EXPLANATION-----------------
  // Τσεκαρει αν η φορμα του search της current page εχει την κλαση "search-error" ωστε αλλαξει το style του submit button.
  // Checks if search form of the current page has the "search-error" class in order to change the style of submit button.

  // Removes error classes from HOME-search-form  or HOTELS-search-form Submit Button
  addRemoveDateErrorClass(
    $searchForm.hasClass("dates-error"),
    $searchForm.hasClass("city-error"),
    "",
    "",
    "",
    $currentFormSubmitBtn
  );

  $homeFormListItems.on("click", pageForm_Handler);

  $dropDownHeader.on("click", dropHeader_Handler);

  $dropDownContainer.on("click", dropDownContainer_Handler);

  //Date Error Handling
  $dateInput.each(function () {
    $(this).on("input", function () {
      const $dateError = $(".date-error p.error-date-type");
      const regexDate =
        /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;

      if (!regexDate.test($(this).val())) {
        $dateError.removeClass("hidden");
      } else {
        $dateError.addClass("hidden");
      }
      // Adds error classes from HOME-search-form  or HOTELS-search-form Submit Button
      // this = <p class="error-same-date hidden">Check out date must be later than check in date!</p>
      $sameDateError.each(function () {
        addRemoveDateErrorClass(
          "",
          "",
          areDatesEqual(),
          !$selectedCityInput.val(),
          this,
          $currentFormSubmitBtn
        );
      });
    });
  });

  // Τσεκαρει αν οι ημερομηνιες στα altfields των datepickers ειναι ιδιες κατα την επιλογη ημ/νιας(κλικ σε μια ημερα του μηνα).
  // Checks if dates on datepicker altfields are the same while choosing(clicking) a date from date table
  $Datepicker.each(function () {
    this.addEventListener("click", datepickerActions, true);
    return;
  });

  // Set date on datepicker alt input
  $dateInput.each(function () {
    $(this).on("change", function () {
      const $thisDatepicker = $(this)
        .closest(".drop-down-container")
        .find(".datepicker");
      $thisDatepicker.datepicker("setDate", $(this).val());
      $(".date-error p.error-date-type").addClass("hidden");
      // Set date on datepicker alt input
      if (!$thisDatepicker.val()) {
        $thisDatepicker.datepicker("setDate", "today");
      }

      $sameDateError.each(function () {
        addRemoveDateErrorClass(
          "",
          "",
          areDatesEqual(),
          !$selectedCityInput.val(),
          this,
          $currentFormSubmitBtn
        );
      });
    });
  });

  //

  // go-to-room-form Submit
  $(document).click(function (e) {
    if ($(e.target).closest("p.room-button").hasClass("go-to-room")) {
      e.preventDefault();
      $(e.target).closest(".results-footer").find("FORM").submit();
    }
  });

  // --->>> CODE ENDS HERE <<<--- //
});
// ---------- DOCUMENT READY END ----------

//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////

// ----- FUNCTIONS -----

// -- MAIN FUNCTIONS --

function showDropDown($dropList, $parentForm) {
  // Τσεκαρει ποιος dropDown επιλογεας πατηθηκε και τον εμφανιζει.
  // Επισης αναλογα με τα media queries ρυθμιζεται και η διασταση του.

  // Checks which dropDown selector was clicked in order to be appeared.
  // The width of dropDown selector is set based on media queries.
  //
  if ($dropList.hasClass("hidden")) {
    //
    $dropList.removeClass("hidden");
    $(".search-form  .input").css("pointer-events", "none");

    // Check if element has the "date" string in its className
    if ($dropList.attr("id").match(/[\w-]*date[\w-]*/g)) {
      // Βρισκει τo Id της parent form με βαση το Id του element που κλικαριστικε
      // Finds the parent form based on the clicked element's Id
      const homeForm = findParentForm($parentForm) === "home" ? true : false;

      $dropList.css({
        left: "50%",
        transform: "translateX(-50%)",
      });

      // Ελεγχει τα media queries ωστε αναλογα τις διαστασεις που πρωτοφορτωνει η σελιδα να ανοιγουν οι dropDown επιλογεις στις σωστες διαστασεις.
      // Checks media queries on load so the dropDown selector dimensions will appriopriately be set.
      checkMedia($dropList, homeForm);

      // Checks media queries on window resize
      window.addEventListener("resize", function () {
        checkMedia($dropList, homeForm);
      });
    }
  }
}

function pageForm_Handler(e) {
  //Οριζει ποιος dropDown επιλογεας(πχ city,room-type) θα ανοιξει αναλογα με το ποιον κλικαρεις αλλα και τη συμπεριφορα του
  //Defines which dropDown selector(e.g. city,room-type) will be opened when clicking on them and the behaviour of each
  const $ui_Datepicker = $(".ui-datepicker");
  const thisParentForm = $(this).closest("FORM").attr("id");
  const $thisDropList = $(`#${e.currentTarget.id}-container`);

  // αλλαζει το width του datepicker
  // changes datepicker's width
  addWidthClass_100per($ui_Datepicker);
  showDropDown($thisDropList, thisParentForm);
}

function dropDownContainer_Handler(e) {
  // Παιρνει τις value απο το εκαστοτε element που κλικαριστικε και το βαζει σε:
  // 1) ενα input που χρησιμοποιηται απλα για να βλεπεις τι επελεξες
  // 2) ενα input το οποιο δινει τη value του στην $_REQUEST οταν γινεται submit η φορμα του search.

  // It takes the value from the clicked element and puts her:
  // 1) to an input that it used for seeing your choise
  // 2) to an input that gives its value to the $_REQUEST when the search form is being submitted
  if (e.target.tagName === "LI") {
    const thisId = e.target.closest("DIV").id;
    const thisIdType = findIdType(thisId);
    const $thisInput = $(`#${thisIdType}-input`);
    const $thisSelected = $(`#selected-${thisIdType}`);
    const $thisSearchInputChoise = $(`#${thisIdType}-search-input-choise`);
    const choiseText = e.target.innerText;
    const $choiceValue = $(e.target).data("value");

    $thisInput.val(choiseText);
    $thisSelected.val($choiceValue);

    // e.currentTarget = this = <div id="something-container" class=drop-down-container></div>
    if (e.currentTarget.id === "city-container") {
      if ($selectedCityInput.val() !== "") {
        $("#city .city #city-search-input-title")
          .removeClass("errorTextColor")
          .html("City");

        $searchForm.removeClass("city-error");
      }

      addRemoveDateErrorClass(
        "",
        "",
        areDatesEqual(),
        !$selectedCityInput.val(),
        "",
        $currentFormSubmitBtn,
        e.currentTarget
      );
    }
    if ($thisInput.val() !== "") {
      $thisSearchInputChoise.html($thisInput.val());
    }
    dropHeader_Handler();
  }
}

function datepickerActions(e) {
  // Τσεκαρει αν οι ημερομηνιες στα altfields των datepickers ειναι ιδιες (check-in date , check out date input)
  // Checks if dates on datepicker altfields are the same(check-in date , check out date input)

  //-----------------------------------------------
  // checks if target(e) is a date cell(on date table) to execute the IF and disable SEARCH BUTTON
  if (!e) return;
  if ($(e.target).hasClass("ui-datepicker-current")) return;
  if ($(e.target).hasClass("ui-state-default")) {
    const $checkOutDateSearchInputTitle = $(
      "#check-out-date-search-input-title"
    );
    const $checkOutDateSearchInputChoise = $(
      "#check-out-date-search-input-choise"
    );
    const $checkInDateSearchInputChoise = $(
      "#check-in-date-search-input-choise"
    );

    const thisDatepicker = e.target.closest(".datepicker");

    //FIXME: ATTENTION CREATES DOUDLE-CLICK !!!
    e.target.click();

    if (thisDatepicker) {
      const thisDatepickerId = thisDatepicker.id;
      const thisIdType = findIdType(thisDatepickerId);
      const $thisInput = $(`#${thisIdType}-input`);
      const $thisSearchInputChoise = $(`#${thisIdType}-search-input-choise`);

      if ($thisInput.val() !== "") {
        $thisSearchInputChoise.html($thisInput.val());
      }

      // OPEN/CLOSE DROPDOWN INPUTS ON SEARCH MENU
      dropHeader_Handler();

      if (thisDatepicker.id === "check-in-date-picker") {
        if ($checkOutDateSearchInputChoise.html() === "") {
          return;
        }
      }

      if (thisDatepicker.id === "check-out-date-picker") {
        if ($checkInDateSearchInputChoise.html() === "") {
          $checkInDateSearchInputChoise.html($("#check-in-date-input").val());
        }
        $checkOutDateSearchInputTitle.html("Check out Date");
      }
      // this = <p class="error-same-date hidden">Check out date must be later than check in date!</p>
      $sameDateError.each(function () {
        addRemoveDateErrorClass(
          "",
          "",
          areDatesEqual(),
          !$selectedCityInput.val(),
          this,
          $currentFormSubmitBtn
        );
      });

      $checkOutDateSearchInputChoise
        .addClass(`${areDatesEqual() ? "errorTextColor" : "blue-font-color"}`)
        .removeClass(
          `${!areDatesEqual() ? "errorTextColor" : "blue-font-color"}`
        );

      return;
    } else {
      return;
    }
  }
}

// -- HELPER FUNCTIONS --

// Κλεινει τον ανοιχτο dropDown επιλογεα
// Closes the dropdown selector that is opened
function dropHeader_Handler() {
  if (!$(this).hasClass("hidden")) {
    $dropDownContainer.addClass("hidden");
    $(".search-form  .input").removeAttr("style");
  }
}

function addWidthClass_100per($datepicker) {
  if (!$datepicker.hasClass("width-100per")) {
    $datepicker.addClass("width-100per");
  }
}

// Returns the Id without the last word
function findIdType(Id) {
  const thisIdParts = Id.split("-");
  thisIdParts.splice(-1, 1);
  return thisIdParts.join("-");
}

// Returns the first word from Id
function findParentForm(Id) {
  const thisIdParts = Id.split("-");
  const parentForm = thisIdParts.splice(-0, 1);
  const newParentForm = parentForm.join("");
  return newParentForm;
}

function getSelectedDates() {
  let $selectedCheckInDate = $("#check-in-date-input").data("value");
  let $selectedCheckOutDate = $("#check-out-date-input").data("value");

  if ($selectedCheckInDate !== "" && $selectedCheckOutDate !== "") {
    $("#check-in-date-picker").datepicker("setDate", $selectedCheckInDate);
    $("#check-out-date-picker").datepicker("setDate", $selectedCheckOutDate);
  }
}

// Τσεκαρει τα media queries ωστε να αλλαξει διαστασεις στον dropDown επιλογεα
// Checks media queries so the dropDown selector dimensions will appriopriately be set.
function checkMedia($_dropList, $_homeForm) {
  const query_over_481 = window.matchMedia("screen and (min-width: 481px)");
  const query_over_769 = window.matchMedia(
    "screen and (min-width: 769px) and (orientation: landscape)"
  );

  const mediaQuery = query_over_769.matches
    ? "query_over_769"
    : query_over_481.matches
    ? "query_over_481"
    : "query_below_481";

  switch (mediaQuery) {
    case "query_below_481":
      $_dropList.css({
        height: $_homeForm ? "387px" : "475px",
        width: "270px",
      });
      break;
    case "query_over_481":
      $_dropList.css({
        height: $_homeForm ? "402px" : "475px",
        width: "285px",
      });
      break;
    case "query_over_769":
      $_dropList.css({
        height: $_homeForm ? "450px" : "480px",
        width: "100%",
      });
      break;
  }
}

// Function: Add/Remove Error class to currentFormSubmitBtn and hide/show the error messages inside the datepickers in case of dates error
function addRemoveDateErrorClass(
  searchForm_has_datesError_Class = "",
  searchForm_has_cityError_Class = "",
  dates_are_equal = "",
  city_is_not_selected = "",
  element_to_show_or_hide = "",
  currentFormSubmitBtn = "",
  eventTarget = ""
) {
  const element = element_to_show_or_hide;
  const date_error_message = "must be later than check in date!";
  // In our case we pass in "element_to_show_or_hide"($sameDateError) = ".error-same-date hidden" to add/remove error messages on Date Dropdown modals and add/remove submit button error styles
  // else if "element_to_show_or_hide" = ""  we only add/remove submit button error styles
  const $checkOutDateError = $("#check-out-date-error");
  const $checkOutDateSearchInputChoise = $(
    "#check-out-date-search-input-choise"
  );

  if (
    searchForm_has_datesError_Class ||
    searchForm_has_cityError_Class ||
    dates_are_equal ||
    city_is_not_selected
  ) {
    if (eventTarget.id !== "city-container") {
      $(currentFormSubmitBtn)
        .addClass("search-error-report")
        .prop("disabled", true);
    }
  }

  if (city_is_not_selected) {
    $("#city-search-input-title")
      .addClass("errorTextColor")
      .html("City is Required");
  }

  if (eventTarget.id !== "city-container") {
    if (searchForm_has_datesError_Class || dates_are_equal) {
      $checkOutDateSearchInputChoise
        .addClass("margin-top-error-choise")
        .addClass("date-error-fix-margin");

      $checkOutDateError.html(date_error_message);
      if (element !== "") {
        $(element).removeClass("hidden");
      }

      $checkOutDateSearchInputChoise
        .addClass("errorTextColor")
        .html($("#check-out-date-input").val());
    } else {
      $checkOutDateSearchInputChoise
        .removeClass("margin-top-error-choise")
        .removeClass("date-error-fix-margin");
      $checkOutDateError.html("");
      $searchForm.removeClass("dates-error");
      if (element !== "") {
        $(element).addClass("hidden");
      }
    }
  }

  if (
    !(searchForm_has_datesError_Class || dates_are_equal) &&
    !(searchForm_has_cityError_Class || city_is_not_selected)
  ) {
    $(currentFormSubmitBtn)
      .removeClass("search-error-report")
      .prop("disabled", false);
  }

  return;
}

function areDatesEqual() {
  // checks if target(e) is a date box(on date table) to execute the IF and disable SEARCH BUTTON

  const $checkInDateInputValue = $("#check-in-date-input").val();
  const $checkOutDateInputValue = $("#check-out-date-input").val();
  const checkIndateParts = $checkInDateInputValue.split("-"); // [e.g 30-12-2022]
  const checkOutdateParts = $checkOutDateInputValue.split("-"); // [e.g 30-12-2022]
  const checkInYear = checkIndateParts[2];
  const checkInMonth = checkIndateParts[1];
  const checkInDay = checkIndateParts[0];
  const checkOutYear = checkOutdateParts[2];
  const checkOutMonth = checkOutdateParts[1];
  const checkOutDay = checkOutdateParts[0];
  const $checkInDate = new Date(
    checkInYear + "-" + checkInMonth + "-" + checkInDay
  );
  const $checkOutDate = new Date(
    checkOutYear + "-" + checkOutMonth + "-" + checkOutDay
  );
  const $diffTime = $checkOutDate - $checkInDate;
  const $diffDays = Math.ceil($diffTime / (1000 * 60 * 60 * 24));
  const $diffDaysFlag = $diffDays < 1;

  return $diffDaysFlag;
}

export {
  addRemoveDateErrorClass,
  areDatesEqual,
  $currentFormSubmitBtn,
  $selectedCityInput,
};
