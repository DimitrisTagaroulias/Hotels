document.addEventListener("DOMContentLoaded", checkCookie("user_token"));

function setCookie(name, value, expDays) {
  let d = new Date();
  d.setTime(d.getTime() + expDays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = name + "=" + value + ";" + expires;
}

function getCookie(name) {
  let cookieName = name + "=";
  let docCookie = document.cookie;
  let start, end;
  if (docCookie.length > 0) {
    start = docCookie.indexOf(cookieName);
    if (start != -1) {
      start += cookieName.length;
      end = docCookie.indexOf(";", start);
      if (end == -1) {
        end = docCookie.length;
      }
      return docCookie.substring(start, end);
    }
  }
  return "";
}

function checkCookie(name) {
  const logInBtn = document.querySelector("#log-in a");

  let userStr = getCookie(name);
  function logOut(e) {
    e.preventDefault();
    deleteCookie(name);

    //Log in  -  Log out
    logInBtn.innerHTML = logInBtn.innerHTML.replace("out", "in");
    logInBtn.removeEventListener("click", logOut);

    window.location.href = "index.php";
  }
  // Ελεγχει αν υπαρχει το  cookie "userStr"
  // Checks if "userStr" cookie exists

  if (userStr != "") {
    logInBtn.innerHTML = logInBtn.innerHTML.replace("in", "out");
    logInBtn.addEventListener("click", logOut);
  }
}

function deleteCookie(name) {
  document.cookie = name + "=;path=/;expires=Thu,01 Jan 2000 00:00:01 UTC";
}
