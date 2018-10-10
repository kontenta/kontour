# Development

## Development install

1. Clone this repo in your development environment
2. Run `composer install`
3. You'll find a VCS version of the contracts package in `vendor/kontenta/kontour`

## Updating composer dependencies

- `composer update --prefer-lowest` can be used before running tests for testing backwards compatibility.
- `composer show -D -o` can be used to check how far behind latest version the currently installed dependencies are.
- `composer update` will install the latest versions of dependencies.

## Testing

`composer test` from the project directory will run the default test suite.

If you want your own local configuration for phpunit,
copy the file `phpunit.xml.dist` to `phpunit.xml` and modify the latter to your needs.
