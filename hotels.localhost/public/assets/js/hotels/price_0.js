"use strict";

const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  progress = document.querySelector(".slider .progress");

let priceGap = 50;

rangeInput.forEach((input) => {
  // "input" event =is activated on every change of input.value
  function sliderHandler(e) {
    // getting two ranges value and parsing them to number
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        // if active slider is the min slider
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  }
  input.addEventListener("input", sliderHandler);
  input.addEventListener("click", sliderHandler);
  $(input).click();
});

priceInput.forEach((input) => {
  function priceInputHandler(e) {
    // getting two inputs value and parsing them to number
    let minVal = parseInt(priceInput[0].value),
      maxVal = parseInt(priceInput[1].value);

    // Η maxPrice ερχεται απο την hotels.php και ειναι php variable
    // The maxPrice is a php variable and has been initialized on hotels.php
    if (maxVal - minVal >= priceGap && maxVal <= maxPrice && minVal >= 0) {
      if (e.target.className === "input-min") {
        // if active input is the min input;
        rangeInput[0].value = minVal;
        progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxVal;
        progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
      }
    } //
  }
  input.addEventListener("input", priceInputHandler);
  input.addEventListener("click", priceInputHandler);
  $(input).click();
  input.addEventListener("blur", function (e) {
    let minVal = parseInt(priceInput[0].value),
      maxVal = parseInt(priceInput[1].value);

    if (
      e.target.className === "input-min" &&
      (e.target.value === "" ||
        e.target.value < 0 ||
        maxVal - minVal < priceGap)
    ) {
      minVal = e.target.value = "0";
      rangeInput[0].value = minVal;
      progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
    }

    if (
      e.target.className === "input-max" &&
      (e.target.value === "" ||
        e.target.value > maxPrice ||
        maxVal - minVal < priceGap)
    ) {
      maxVal = e.target.value = maxPrice;
      rangeInput[1].value = maxVal;
      progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});
