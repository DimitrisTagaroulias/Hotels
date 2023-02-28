"usestrict";
// In order to redirect to Room Page because if you click on the "button" and not exactly on "A" tag it does nothing
const $roomButton = $(".room-button");
$roomButton.on("click", (e) => {
  if (e.target.tagName === "A") {
    return;
  } else {
    const aTagURL = $(e.currentTarget).find("a").prop("href");
    window.location.replace(aTagURL);
  }
});
