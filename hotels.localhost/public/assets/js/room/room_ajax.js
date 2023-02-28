"use strict";
(function ($) {
  let isLoadingFavorite = false;
  let isLoadingBooking = false;
  let isLoadingReview = false;
  let isLoadingCheckingDates = false;

  // Favorite Form STARTS
  $(document).on("submit", "form#favoriteForm", function (e) {
    // Stop default form behavior
    e.preventDefault();

    // Get form data
    const formData = $(this).serialize();

    // Ajax request
    if (!isLoadingFavorite) {
      isLoadingFavorite = true;

      $.ajax("http://hotels.localhost/ajax/room_favorite.php", {
        type: "POST",
        dataType: "json",
        data: formData,
        success(result) {
          if (result.status) {
            $("input[name=is_favorite]").val(result.is_favorite ? 1 : 0);
          } else {
            $("#heart-like").prop("checked", !result.is_favorite);
          }
        },
        error(req, ajaxStatus, error) {
          $(".modal").addClass("show-modal");

          $("#heart-like").prop("checked", !$("#heart-like").prop("checked"));
          console.log("something went wrong", req, ajaxStatus, error);
        },
        complete() {
          isLoadingFavorite = false;
        },
      });
    }
  });
  // Favorite Form ENDS

  // Booking STARTS
  $(document).on("submit", "form.bookingForm", function (e) {
    // Stop default form behavior
    e.preventDefault();

    // Get form data
    const formData = $(this).serialize();

    // Ajax request
    if (!isLoadingBooking) {
      isLoadingBooking = true;
      $(".book-it-button").addClass("waiting");
      $(".book-it-button a").text("Wait...");

      $.ajax("http://hotels.localhost/ajax/room_booking.php", {
        type: "POST",
        dataType: "json",
        data: formData,
        success(result) {
          if (result.status) {
            $(".book-it-button").removeClass("waiting");
            $(".book-it-button").addClass("booked");
            $(".book-it-button a").text("Already booked");
          } else {
            $(".book-it-button").removeClass("waiting");
            $(".book-it-button a").text("Book it now");
          }
        },
        error(req, ajaxStatus, error) {
          $(".modal").addClass("show-modal");

          $(".book-it-button").removeClass("waiting");
          $(".book-it-button a").text("Book it now");
          console.log(
            "something went wrong on booking",
            req,
            ajaxStatus,
            error
          );
        },
        complete() {
          isLoadingBooking = false;
        },
      });
    }
  });
  // Booking ENDS

  // Review Form STARTS
  $(document).on("submit", "form.my-review-form", function (e) {
    // Stop default form behavior
    e.preventDefault();

    // Get form data
    const formData = $(this).serialize();

    // Ajax request
    if (!isLoadingReview) {
      isLoadingReview = true;
      $("form.my-review-form textarea")
        .addClass("disabled")
        .val("Please wait for submitting to be completed...");

      $("form.my-review-form input, form.my-review-form textarea").attr(
        "disabled",
        true
      );

      $.ajax("http://hotels.localhost/ajax/room_review.php", {
        type: "POST",
        dataType: "html",
        data: formData,
      })
        .done(function (result) {
          if (result.trim().length !== 0) {
            //
            // Append results to container
            $(".user-review").prepend(result);

            // Reset review form
            $("form.my-review-form").trigger("reset");

            // Remove no-review Report
            $(".no-reviews-report").html("");
          } else {
            console.log("CSRF ATTACK");
          }
        })
        .fail(function (req, ajaxStatus, error) {
          $(".modal").addClass("show-modal");
          $("form.my-review-form").trigger("reset");

          console.log("something went wrong", req, ajaxStatus, error);
        })
        .always(function () {
          $("form.my-review-form textarea").removeClass("disabled");
          $("form.my-review-form input, form.my-review-form textarea").attr(
            "disabled",
            false
          );
          isLoadingReview = false;
        });
    }
  });
  // Review Form ENDS

  // DatesForm STARTS
  $(document).on("submit", "form[name='datesForm']", function (e) {
    // Stop default form behavior
    e.preventDefault();

    // Get form data
    let formData = $(this).serialize();
    let historyPushState = "http://hotels.localhost/room.php?";

    // Ajax request
    if (!isLoadingCheckingDates) {
      isLoadingCheckingDates = true;

      $("form[name='datesForm'] button").addClass("waiting");
      $("form[name='datesForm'] button").text("Wait...");

      $.ajax("http://hotels.localhost/ajax/room_availability.php", {
        type: "POST",
        dataType: "json",
        data: formData,
      })
        .done(function (result) {
          const $check_AvailDate_In = $(
            "form[name='datesForm'] input[name='check-in-date']"
          );
          const $check_AvailDate_Out = $(
            "form[name='datesForm'] input[name='check-out-date']"
          );

          const $check_BookDate_In = $(
            "form[name='bookingForm'] input[name='check-in-date']"
          );

          const $check_BookDate_Out = $(
            "form[name='bookingForm'] input[name='check-out-date']"
          );

          $check_BookDate_In.val($check_AvailDate_In.val());
          $check_BookDate_Out.val($check_AvailDate_Out.val());

          if (result.status) {
            // Disable book-it button
            $(".book-it-button").addClass("booked");
            $(".book-it-button a").text("Already booked");
          } else {
            // Enable book-it button
            $(".book-it-button").removeClass("booked");
            $(".book-it-button a").text("Book it now");
          }
          // Push url state
          const regex = /csrf=(?<=csrf=)\w+\&/g;
          formData = formData.replace(regex, "");
          history.pushState({}, "", historyPushState + formData);
        })
        .fail(function (req, ajaxStatus, error) {
          $(".modal").addClass("show-modal");

          console.log("something went wrong", req, ajaxStatus, error);
          console.log("Maybe a CSRF ATTACK");
        })
        .always(function () {
          $("form[name='datesForm'] button").removeClass("waiting");
          $("form[name='datesForm'] button").text("Check availability");
          isLoadingCheckingDates = false;
        });
    }
  });
  // DatesForm ENDS
})(jQuery);
