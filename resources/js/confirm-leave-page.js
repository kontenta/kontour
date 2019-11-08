/*! @preserve
 * If you submit a form by some other mechanism than default page navigation
 * (e.g. ajax), call
 * removeAttribute("data-kontour-dirty")
 * on every input in the form.
 */

// Mark inputs as dirty when they change
["input", "change"].forEach(function(eventname) {
  document.body.addEventListener(eventname, function(event) {
    if (
      event.target.form &&
      event.target.name &&
      event.target.type != "search"
    ) {
      event.target.setAttribute("data-kontour-dirty", "true");
    }
  });
});

// Mark dirty inputs as saving when their form is submitted
document.body.addEventListener("submit", function(event) {
  [...event.target.elements].forEach(function(input) {
    input.setAttribute("data-kontour-dirty", "saving");
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
