document.body.addEventListener("submit", function(event) {
  if (event.target.querySelector('input[name="_method"][value="delete"]')) {
    let message = "Delete item";
    let button = event.target.querySelector('[type="submit"]');
    if (button) {
      message =
        button.getAttribute("aria-label") || button.innerText || message;
    }

    if (!confirm(message)) {
      event.preventDefault();
    }
  }
});
