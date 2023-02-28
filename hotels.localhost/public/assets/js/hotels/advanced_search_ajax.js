"use strict";
import {
  addRemoveDateErrorClass,
  areDatesEqual,
  $currentFormSubmitBtn,
  $selectedCityInput,
} from "../common_files_JS/simple_search.js";

(function ($) {
  let $sortingData;
  function ajaxSearch(e) {
    // Get form data
    const $hotelsSearchForm = $("form#hotels-search-form");
    let formData = $hotelsSearchForm.serialize();
    let historyPushState = "http://hotels.localhost/hotels.php?";
    const totalPages = $("#total-pages");
    const pageRegex = /(?<=page=)\d+/;
    const currentPage = formData.match(pageRegex)[0];
    let nextPage = currentPage;

    // Checks if an element from the "sorting dropdown list" has been clicked
    if (e.target.id === "sorting-list") {
      // Defines what will be the next page to be displayed.
      nextPage = 1;
      // In order to show page 1 of results
      formData = formData.replace(pageRegex, nextPage);
    }

    // $(e.target).closest("a") = τα βελακια που αλλαζουμε σελιδα(κατω απο τη sorting-list)
    // $(e.target).closest("a") = turn page arrow symbols(below the "sorting dropdown list")
    //
    // Αν επιλεχθει στοιχειο απο τη "sorting dropdown list" η γινει submit η φορμα τα αποτελεσματα ξεκινουν ξανα απο την πρωτη σελιδα
    // If an element from the "sorting dropdown list" will be selected ,the results will start from page 1
    if (
      e.target.id === "hotels-search-form" ||
      $(e.target).closest("a").hasClass("turn-page")
    ) {
      // Stop default form behavior
      e.preventDefault();

      addRemoveDateErrorClass(
        "",
        "",
        areDatesEqual(),
        !$selectedCityInput.val(),
        "",
        $currentFormSubmitBtn,
        ""
      );

      if (areDatesEqual() || !$selectedCityInput.val()) return;

      // Defines what will be the next page to be displayed.
      nextPage = 1;
      // In order to show page 1 of results
      formData = formData.replace(pageRegex, nextPage);
    }

    if (
      $(e.target).closest("a").attr("id") === "prev-page" &&
      currentPage > 1
    ) {
      nextPage = parseInt(currentPage) - 1;
      formData = formData.replace(pageRegex, nextPage);
    }

    if (
      $(e.target).closest("a").attr("id") === "next-page" &&
      currentPage < totalPages.html()
    ) {
      nextPage = parseInt(currentPage) + 1;
      formData = formData.replace(pageRegex, nextPage);
    }

    formData += $sortingData ? "&" + $sortingData : "";
    historyPushState += formData;

    // Ajax request
    $.ajax("http://hotels.localhost/ajax/search_results.php", {
      type: "GET",
      dataType: "html",
      data: formData,
    })
      .done(function (result) {
        // Clear results container
        $("#hotel-results").html("");

        // Append results to container
        $("#hotel-results").append(result);

        // Παιρνει τιμη η current page
        $("#current-page").val(nextPage);

        // Push url state
        history.pushState({}, "", historyPushState);
      })
      .fail(function (req, ajaxStatus, error) {
        console.log("something went wrong", req, ajaxStatus, error);
      });
  }

  // Search Room, Pagination, Sorting

  $(document)
    .on("submit", "form#hotels-search-form", ajaxSearch)
    .on("click", ".turn-page", ajaxSearch)
    .on("change", "#sorting-list", function (e) {
      $sortingData = $("form#sorting-form").serialize();
      $("form#sorting-form").submit(ajaxSearch(e));
    });
  //
})(jQuery);
