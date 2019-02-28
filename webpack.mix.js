let mix = require("laravel-mix");

mix
  .sass("resources/sass/kontour.scss", "resources/css/kontour.css")
  .babel(
    ["resources/js/confirm-delete.js", "resources/js/confirm-leave-page.js"],
    "resources/js/kontour.js"
  );
