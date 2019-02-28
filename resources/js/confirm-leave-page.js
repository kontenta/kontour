(function() {
  document.body.addEventListener("change", function(event) {
    event.target.setAttribute("data-kontour-dirty", "true");
  });

  function kontourConfirmBeforeunload(event) {
    if (document.querySelector('[data-kontour-dirty="true"]')) {
      event.preventDefault();
      event.returnValue = "You have unsaved changes.";
    }
  }

  window.addEventListener("beforeunload", kontourConfirmBeforeunload);

  document.body.addEventListener("submit", function(event) {
    window.removeEventListener("beforeunload", kontourConfirmBeforeunload);
  });
})();
