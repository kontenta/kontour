window.addEventListener("beforeunload", function(event) {
  if (document.querySelector('[data-kontour-dirty="true"]')) {
    event.preventDefault();
    event.returnValue = "You have unsaved changes.";
  }
});

document.body.addEventListener("change", function(event) {
  event.target.setAttribute("data-kontour-dirty", "true");
});
