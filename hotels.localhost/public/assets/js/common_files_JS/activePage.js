"use strict";

// Τσεκαρει ποια ειναι η current page και χρωματιζει με ασπρο το αντιστοιχο εικονιδιο στο μενου.
// Checks what is the current page and highlight with white color the corresponding icon on the menu.

const path = window.location.pathname;
const currentPage = path.split("/").pop();
const navBarElements = document.querySelectorAll(".header-ul li a");

navBarElements.forEach((navBarElement) => {
  let currentElement = navBarElement.innerText.trim().toLowerCase();

  if (currentElement.includes("home")) {
    currentElement = "index";
  }

  if (currentElement.includes("log")) {
    currentElement = "login";
  }

  if (currentElement.includes("about")) {
    currentElement = "about";
  }

  if (currentPage.includes(currentElement)) {
    navBarElement.closest("LI").classList.add("active");
  }
});
