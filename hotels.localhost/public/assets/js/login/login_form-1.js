"use strict";

window.addEventListener(
  "DOMContentLoaded",
  addEventListeners_toLoginForm,
  false
);

function addEventListeners_toLoginForm() {
  const logInForm = document.querySelector("#login-form");

  // Καλει τη function addFocusEvents() απο το αρχειο "login_register_common_functions.js"
  // addFocusEvents() has been initialized in "login_register_common_functions.js" file
  addFocusEvents();

  logInForm.addEventListener("submit", loginValidation);

  function loginValidation(e) {
    let emailInput = document.querySelector("input[name=emailLogin]");
    let passwordInput = document.querySelector("input[name=passWordLogin]");

    e.preventDefault();

    if (emailInput.value !== "" && passwordInput.value !== "") {
      e.target.submit();
    }

    //CHECK if user put the right USN & PASSWORD to logIn
  }
}

//--------------LOGIN MODAL - END--------------//
