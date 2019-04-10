// Mark inputs as dirty when they change
["input", "change"].forEach(function(eventname) {
  document.body.addEventListener(eventname, function(event) {
    event.target.setAttribute("data-kontour-dirty", "true");
  });
});

// Mark dirty inputs as saving when their form is submitted
// If you submit via ajax, you will want to removeAttribute("data-kontour-dirty") if the request succeedes.
document.body.addEventListener("submit", function(event) {
  [...event.target.elements].forEach(function(input) {
    if (input.getAttribute("data-kontour-dirty") == "true") {
      input.setAttribute("data-kontour-dirty", "saving");
    }
  });
});

// Alert user if any inputs on the page are dirty before leaving
window.addEventListener("beforeunload", function(event) {
  if (document.querySelector('[data-kontour-dirty="true"]')) {
    event.preventDefault();
    event.returnValue = "You have unsaved changes.";
    document.body.setAttribute("data-kontour-unload-prevented", "true");
  }
});
