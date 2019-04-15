// Show confirm dialog before submitting any spoofed DELETE method form
document.body.addEventListener("submit", function(event) {
  let method;
  let deleteButton;

  // Take last spoofed method using FormData if available
  if (FormData instanceof Object) {
    let formData = new FormData(event.target);
    if (typeof formData.getAll == "function") {
      method = (
        formData.getAll("_method").pop() || event.target.method
      ).toUpperCase();
    }
  }

  [...event.target.elements].forEach(function(input) {
    // Take first spoofed method if FormData was not available
    if (!method && input.name == "_method") {
      method = input.value.toUpperCase();
    }
    // Take first submit button
    if (!deleteButton && input.type == "submit") {
      deleteButton = input;
    }
    // Take last DELETE button over first button
    if (
      input.type == "submit" &&
      input.name == "_method" &&
      input.value.toUpperCase() == "DELETE"
    ) {
      deleteButton = input;
    }
  });

  if (method == "DELETE") {
    let message = "Delete item";
    if (deleteButton) {
      message =
        deleteButton.getAttribute("aria-label") ||
        deleteButton.title ||
        deleteButton.innerText ||
        message;
    }

    if (!confirm(message)) {
      event.preventDefault();
    }
  }
});
