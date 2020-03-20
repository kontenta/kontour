function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

// Show confirm dialog before submitting any spoofed DELETE method form
document.body.addEventListener("submit", function (event) {
  var method;
  var deleteButton; // Take last spoofed method using FormData if available

  if (FormData instanceof Object) {
    var formData = new FormData(event.target);

    if (typeof formData.getAll == "function") {
      method = (formData.getAll("_method").pop() || event.target.method).toUpperCase();
    }
  }

  _toConsumableArray(event.target.elements).forEach(function (input) {
    // Take first spoofed method if FormData was not available
    if (!method && input.name == "_method") {
      method = input.value.toUpperCase();
    } // Take first submit button


    if (!deleteButton && input.type == "submit") {
      deleteButton = input;
    } // Take last DELETE button over first button


    if (input.type == "submit" && input.name == "_method" && input.value.toUpperCase() == "DELETE") {
      deleteButton = input;
    }
  });

  if (method == "DELETE") {
    var message = "Delete item";

    if (deleteButton) {
      message = deleteButton.getAttribute("aria-label") || deleteButton.title || deleteButton.innerText || message;
    }

    if (!confirm(message)) {
      event.preventDefault();
    }
  }
});
/*! @preserve
 * If you submit a form by some other mechanism than default page navigation
 * (e.g. ajax), call
 * removeAttribute("data-kontour-dirty")
 * on every input in the form.
 */
// Mark inputs as dirty when they change

["input", "change"].forEach(function (eventname) {
  document.body.addEventListener(eventname, function (event) {
    if (event.target.form && event.target.name && event.target.type != "search") {
      event.target.setAttribute("data-kontour-dirty", "true");
    }
  });
}); // Mark dirty inputs as saving when their form is submitted

document.body.addEventListener("submit", function (event) {
  _toConsumableArray(event.target.elements).forEach(function (input) {
    input.setAttribute("data-kontour-dirty", "saving");
  });
}); // Alert user if any inputs on the page are dirty before leaving

window.addEventListener("beforeunload", function (event) {
  if (document.querySelector('[data-kontour-dirty="true"]')) {
    event.preventDefault();
    event.returnValue = "You have unsaved changes.";
    document.body.setAttribute("data-kontour-unload-prevented", "true");
  }
});
