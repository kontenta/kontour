document.body.addEventListener("submit", function(event) {
  let method = event.target.method.toUpperCase();
  let button;

  let formData = new FormData(event.target);
  method = (formData.getAll('_method').pop() || method).toUpperCase();

  [...event.target.elements].forEach(function(input) {
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
