// Mark inputs as dirty when they change
["input", "change"].forEach(function(eventname) {
  document.body.addEventListener(eventname, function(event) {
    event.target.setAttribute("data-kontour-dirty", "true");
  });
});

// Mark dirty inputs as saving when their form is submitted
// If you submit via ajax, you may want to set them back to dirty again if the request fails
document.body.addEventListener("submit", function(event) {
  event.target
    .querySelectorAll('[data-kontour-dirty="true"]')
    .forEach(function(element) {
      element.setAttribute("data-kontour-dirty", "saving");
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