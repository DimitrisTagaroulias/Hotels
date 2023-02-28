"use strict";

// Οριζει style κατα το hover στα συμβολα που βρισκονται δεξια απο τους τιτλους των search inputs
// Sets style to search menu symbols
$(document).ready(function () {
  const $searchFormInputs = $(".search-form .input");
  const $searchSubmitButtonSTRING = ".search-form search-submit-button";

  $searchFormInputs.not($searchSubmitButtonSTRING).hover(
    function () {
      $(this).find("i").css({
        color: "white",
        "text-shadow": "rgb(255, 255, 255) 0 0 1px",
      });
    },
    function () {
      $(this).find("i").css({
        color: "rgb(136, 136, 136)",
        "text-shadow": "unset",
      });
    }
  );
});
