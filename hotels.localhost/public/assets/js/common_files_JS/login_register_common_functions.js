/////////////////////////////////////////////////////
// Eμφανιζει/Κρυβει τον κωδικο στη σελιδα Login/Register
// Show/Hide the password in Login/Register page.

//
const showPassword = document.querySelector('[name="show-password"]'); // = checkbox
const passwordInput = document.querySelector(".password");

showPassword.addEventListener("change", function () {
  if (passwordInput.getAttribute("type") === "password") {
    passwordInput.setAttribute("type", "text");
  } else {
    passwordInput.setAttribute("type", "password");
  }
});

/////////////////////////////////////////////////////
// Αλλαζει το χρωμα των περιγραμματων των inputs στη σελιδα Login/Register κατα το Focus/Blur
// Changes the color of input borders in Login/Register page on Focus/Blur
function addFocusEvents() {
  const modal = document.querySelector(".modal");
  const modalInputs = modal.querySelectorAll("INPUT");

  modalInputs.forEach((item) => {
    item.addEventListener("focus", function (e) {
      if (
        e.target.classList.contains("reg-input-error") ||
        e.target.classList.contains("reg-input-valid")
      ) {
      } else {
        e.target.style.outline = "1px solid rgb(39, 187, 255)";
        e.target.style.outlineOffset = "-1px";
        e.target.style.borderRadius = "3px";
        e.target.style.boxShadow = "inset 0px 0px 2px rgb(39, 187, 255)";
      }
    });
    item.addEventListener("blur", function (e) {
      if (
        e.target.classList.contains("reg-input-error") ||
        e.target.classList.contains("reg-input-valid")
      ) {
      } //
      else {
        e.target.style.outline = "none";
        e.target.style.border = "1px solid #ccc";
        e.target.style.boxShadow = "none";
      }
    });
  });
}

/////////////////////////////////////////////////////
