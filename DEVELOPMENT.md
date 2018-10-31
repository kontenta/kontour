# Development

## Development install

1. Clone this repo in your development environment
2. Run `composer install`

### Install for development within a laravel app

1. Remove any existing directory `vendor/kontenta/kontour`
2. Install the package from git using `composer install --prefer-source`
3. Run `cd vendor/kontenta/kontour` and `composer install` to install dependencies within the package.

## Updating composer dependencies

- `composer update --prefer-lowest` can be used before running tests for testing backwards compatibility.
- `composer show -D -o` can be used to check how far behind latest version the currently installed dependencies are.
- `composer update` will install the latest versions of dependencies.

## Testing

`composer test` from the project directory will run the default test suite.

If you want your own local configuration for phpunit,
copy the file `phpunit.xml.dist` to `phpunit.xml` and modify the latter to your needs.

## Following PSR2

This project can be checked against configured coding standars using `composer phpcs` from the project directory.
