document.body.addEventListener("submit", function(event) {
  let formData = new FormData(event.target);
  let method = (formData.getAll('_method').pop() || event.target.method).toUpperCase();
  let button;

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
