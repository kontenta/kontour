# Development

## Development install

1. Clone this repo in your development environment
2. Run `composer install`

### Install for development within a Laravel app

1. Remove any existing directory `vendor/kontenta/kontour`
2. Install the package from git using `composer install --prefer-source`
3. Run `cd vendor/kontenta/kontour` and `composer install` to install dependencies within the package.

## Testing

`composer test` from the project directory will run the default test suite containing all tests.

`composer test -- --testsuite=Feature` will run the Feature tests only.

`composer test -- --testsuite=Dusk` will run the Dusk tests only.

`composer test -- --filter=...` will pass through options to phpunit.

`composer report` will run the tests and generate coverage reports.

If you want your own local configuration for phpunit,
copy the file `phpunit.xml.dist` to `phpunit.xml` and modify the latter to your needs.

### Test logs

Any Laravel log messages generated during testing can be found in the
`vendor/orchestra/testbench-dusk/laravel/storage/logs` directory.

### Testing with different versions

[Travis CI](https://travis-ci.org/kontenta/kontour) is set up to run tests
against PHP `7.1`, `7.2` & `7.3` in combination with Laravel `5.7` & `5.8`.
See `.travis.yml` for details.

- `composer update --prefer-lowest` can be used before running tests for testing backwards compatibility.
- `composer show -D -o` can be used to check how far behind latest version the currently installed dependencies are.
- `composer update` will install the latest versions of dependencies.

### Troubleshooting tests

#### Chrome versions

If tests report wrong Chrome versions, run
`./vendor/bin/dusk-updater detect --auto-update`
to set it right before running tests again.

## Following PSR2

This project can be checked against configured coding standards using `composer phpcs` from the project directory.

Automatic attempt to fix some reported coding standard violations can be run with
`./vendor/bin/phpcbf` from the project directory.

## Building assets

We're using [Laravel Mix](https://github.com/JeffreyWay/laravel-mix) for building assets.
You can find the build script in `webpack.mix.js`, run `npm install` to get started.

- `npm run dev` will run a development build
- `npm run watch` will watch files for changes and run development builds
- `npm run production` will build assets for release

### Testing assets within a Laravel app

If you're editing and building assets within a repo in the vendor folder of a real Laravel app,
running this command will publish the updated styles:

```bash
php artisan vendor:publish --tag="kontour-styling" --force
```

Or you can softlink the generated css file of this package from your public css directory.
