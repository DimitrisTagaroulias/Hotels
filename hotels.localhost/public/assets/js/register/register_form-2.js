"use strict";

const validationFlags = {
  username_IsValid: false,
  email_IsValid: false,
  repeatEmail_IsValid: false,
  password_IsValid: false,
};

window.addEventListener(
  "DOMContentLoaded",
  addEventListeners_toRegistrationForm,
  false
);

function addEventListeners_toRegistrationForm() {
  addEventListener_toResetBtn();
  addEventListener_toFormInputs();
  addEventListener_toFinalRegistrationBtn();
}

function addEventListener_toResetBtn() {
  const resetFormBtn = document.querySelector(".resetForm-btn-REG");

  resetFormBtn.addEventListener("click", function () {
    const regInputs = document.querySelectorAll(".reg-input");
    const errorTextsStartsVisible =
      document.querySelectorAll(".starts-visible");
    const errorTextsStartsHidden = document.querySelectorAll(".starts-hidden");

    for (let i in validationFlags) {
      validationFlags[i] = false;
    }

    regInputs.forEach((item) => {
      item.value = "";
      item.classList.remove("reg-input-error");
      item.classList.remove("reg-input-valid");
    });
    errorTextsStartsVisible.forEach((item) => {
      item.classList.remove("registrationRulesError");
    });
    errorTextsStartsHidden.forEach((item) => {
      item.classList.add("hidden");
    });

    if (passwordInput.getAttribute("type") === "text") {
      passwordInput.setAttribute("type", "password");
    }
    showPassword.removeAttribute("style");
    showPassword.checked = false;
  });
}

function addEventListener_toFormInputs() {
  const regErrorEmail = document.querySelector("#reg-ErrorEmail");
  const eMail = document.querySelector("#reg-email");
  const regexEmail =
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  const repeatEmail = document.querySelector("#reg-email-repeat");
  const regErrorEmailRepeat = document.querySelector("#reg-ErrorEmail-repeat");
  const regErrorEmailRepeat2 = document.querySelector(
    "#reg-ErrorEmail-repeat-2"
  );
  const emailRepeat = document.querySelector("#reg-email-repeat");

  // Καλει τη function addFocusEvents() απο το αρχειο "login_register_common_functions.js"
  // addFocusEvents() has been initialized in "login_register_common_functions.js" file

  addFocusEvents();
  checkUserName_REG();
  checkEmail_REG();
  checkEmailMatching_REG();
  checkPassword_REG();

  function checkUserName_REG() {
    const regErrorUserName = document.querySelector("#reg-ErrorUserName");
    const userName = document.querySelector("#reg-user-name");
    const regexUserName =
      /^[a-zA-Z0-9](_(?!(\.|_))|\.(?!(_|\.))|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$/;

    userName.addEventListener("input", function () {
      if (userName.value != "") {
        if (!regexUserName.test(userName.value)) {
          validationFlags["username_IsValid"] = false;
          regErrorUserName.classList.add("registrationRulesError");
          userName.classList.add("reg-input-normal-focus");
          userName.classList.remove("reg-input-valid");
        } //
        else if (regexUserName.test(userName.value)) {
          validationFlags["username_IsValid"] = true;
          regErrorUserName.classList.remove("registrationRulesError");
          userName.removeAttribute("style");
          userName.classList.remove("reg-input-normal-focus");
          userName.classList.add("reg-input-valid");
        } //
        else {
          alert("USERNAME REGEX ERROR");
          validationFlags["username_IsValid"] = false;
        }
      } else {
        regErrorUserName.classList.remove("registrationRulesError");
        validationFlags["username_IsValid"] = false;
        userName.classList.remove("reg-input-valid");
        userName.classList.add("reg-input-normal-focus");
      }
    });
  }

  function checkEmail_REG() {
    eMail.addEventListener("input", checkDeepEmail_REG);

    function checkDeepEmail_REG() {
      if (eMail.value != "") {
        if (!regexEmail.test(eMail.value)) {
          validationFlags["email_IsValid"] = false;
          regErrorEmail.classList.remove("hidden");
          eMail.classList.add("reg-input-normal-focus");
          eMail.classList.remove("reg-input-valid");
          repeatEmail.removeAttribute("style");
          repeatEmail.classList.remove("reg-input-valid");

          if (emailRepeat.value != "") {
            regErrorEmailRepeat.classList.add("hidden");
            regErrorEmailRepeat2.classList.remove("hidden");
            validationFlags["repeatEmail_IsValid"] = false;
          }
        } //
        else if (regexEmail.test(eMail.value)) {
          validationFlags["email_IsValid"] = true;
          regErrorEmail.classList.add("hidden");
          regErrorEmailRepeat2.classList.add("hidden");
          eMail.removeAttribute("style");
          eMail.classList.remove("reg-input-normal-focus");
          eMail.classList.add("reg-input-valid");
          if (emailRepeat.value == eMail.value) {
            regErrorEmailRepeat.classList.add("hidden");
            validationFlags["repeatEmail_IsValid"] = true;
            repeatEmail.removeAttribute("style");
            repeatEmail.classList.remove("reg-input-normal-focus");
            repeatEmail.classList.add("reg-input-valid");
          } //
          else if (
            emailRepeat.value != eMail.value &&
            emailRepeat.value != ""
          ) {
            validationFlags["repeatEmail_IsValid"] = false;
            regErrorEmailRepeat.classList.remove("hidden");
            repeatEmail.removeAttribute("style");
            repeatEmail.classList.remove("reg-input-valid");
          }
        } //
        else {
          alert("EMAIL REGEX ERROR");
          validationFlags["email_IsValid"] = false;
        }
      } else {
        validationFlags["email_IsValid"] = false;
        regErrorEmail.classList.add("hidden");
        eMail.classList.remove("reg-input-valid");
        eMail.classList.add("reg-input-normal-focus");
        if (emailRepeat.value != "") {
          regErrorEmailRepeat.classList.add("hidden");
          regErrorEmailRepeat2.classList.remove("hidden");
        }
      }
    }
  }

  function checkEmailMatching_REG() {
    emailRepeat.addEventListener("input", function () {
      if (emailRepeat.value != "") {
        if (!regexEmail.test(eMail.value)) {
          validationFlags["repeatEmail_IsValid"] = false;
          regErrorEmailRepeat.classList.add("hidden");
          regErrorEmailRepeat2.classList.remove("hidden");
          repeatEmail.classList.remove("reg-input-valid");
          repeatEmail.classList.add("reg-input-normal-focus");
        } //
        else {
          if (emailRepeat.value != eMail.value) {
            validationFlags["repeatEmail_IsValid"] = false;
            regErrorEmailRepeat.classList.remove("hidden");
            regErrorEmailRepeat2.classList.add("hidden");
            repeatEmail.classList.remove("reg-input-valid");
            repeatEmail.classList.add("reg-input-normal-focus");
          } //
          else {
            validationFlags["repeatEmail_IsValid"] = true;
            regErrorEmailRepeat.classList.add("hidden");
            regErrorEmailRepeat2.classList.add("hidden");
            repeatEmail.removeAttribute("style");
            repeatEmail.classList.remove("reg-input-normal-focus");
            repeatEmail.classList.add("reg-input-valid");
          }
        }
      } else {
        validationFlags["repeatEmail_IsValid"] = false;
        regErrorEmailRepeat.classList.add("hidden");
        regErrorEmailRepeat2.classList.add("hidden");
        repeatEmail.classList.remove("reg-input-valid");
        repeatEmail.classList.add("reg-input-normal-focus");
      }
    });
  }

  function checkPassword_REG() {
    const regErrorPassword = document.querySelector("#reg-ErrorPassword");
    const passWord = document.querySelector("#reg-password");
    const regexPassWord =
      /^(?=.*[0-9])(?=.*[- ?!@#$%^&*\/\\])(?=.*[A-Z])(?=.*[a-z])[a-zA-Z0-9- ?!@#$%^&*\/\\]{8,16}$/;

    passWord.addEventListener("input", function () {
      if (passWord.value != "") {
        if (!regexPassWord.test(passWord.value)) {
          validationFlags["password_IsValid"] = false;
          regErrorPassword.classList.add("registrationRulesError");
          passWord.classList.remove("reg-input-valid");
          passWord.classList.add("reg-input-normal-focus");
        } else if (regexPassWord.test(passWord.value)) {
          validationFlags["password_IsValid"] = true;
          regErrorPassword.classList.remove("registrationRulesError");
          passWord.removeAttribute("style");
          passWord.classList.remove("reg-input-normal-focus");
          passWord.classList.add("reg-input-valid");
        } else {
          alert("PASSWORD  REGEX ERROR");
          validationFlags["password_IsValid"] = false;
        }
      } else {
        validationFlags["password_IsValid"] = false;
        regErrorPassword.classList.remove("registrationRulesError");
        passWord.classList.remove("reg-input-valid");
        passWord.classList.add("reg-input-normal-focus");
      }
    });
  }
}

function addEventListener_toFinalRegistrationBtn() {
  let registrationForm = document.querySelector(".register-form");

  registrationForm.addEventListener("submit", registerValidation);

  //Validation Rules
  function registerValidation(e) {
    e.preventDefault();

    if (Object.values(validationFlags).every((value) => value === true)) {
      //....--->>>SUBMIT FORM<<<---....//
      e.target.submit();
    } else {
      Object.values(validationFlags).forEach((item, index) => {
        document.querySelector(`.input-${index}`).removeAttribute("style");
        if (item !== true) {
          //
          document
            .querySelector(`.input-${index}`)
            .classList.add("reg-input-error");
          document
            .querySelector(`.input-${index}`)
            .classList.remove("reg-input-normal-focus");
          document
            .querySelector(`.toBeDisplayedOnSubmit-${index}`)
            .classList.remove("hidden");
          document
            .querySelector(`.toBeDisplayedOnSubmit-${index}`)
            .classList.add("registrationRulesError");
        } //
        else {
          document
            .querySelector(`.input-${index}`)
            .classList.remove("reg-input-error");
          document
            .querySelector(`.input-${index}`)
            .classList.remove("reg-input-normal-focus");
          document
            .querySelector(`.input-${index}`)
            .classList.add("reg-input-valid");
        }
      });
      if (
        validationFlags["email_IsValid"] == true &&
        validationFlags["repeatEmail_IsValid"] == false
      ) {
        document
          .querySelector("#reg-ErrorEmail-repeat-2")
          .classList.add("hidden");
        document
          .querySelector("#reg-ErrorEmail-repeat")
          .classList.remove("hidden");
      }
    }
  }
}
