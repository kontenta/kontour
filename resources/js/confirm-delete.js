document.body.addEventListener("submit", function(event) {
  let method = event.target.method.toUpperCase();
  let button;
  [...event.target.elements].forEach(function(input) {
    if(input.name == '_method' && input.type.toLowerCase() != 'submit') {
      method = input.value.toUpperCase();
    }
    if(input.type == 'submit') {
      button = input;
    }
  });

  if (method == 'DELETE') {
    let message = "Delete item";
    if (button) {
      message =
        button.getAttribute("aria-label") || button.title || button.innerText || message;
    }

    if (!confirm(message)) {
      event.preventDefault();
    }
  }
});
