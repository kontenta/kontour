# Development

## Development install

1. Clone this repo in your development environment
2. Run `composer install`
3. You'll find a VCS version of the contracts package in `vendor/kontenta/kontour`

## Updating composer dependencies

- `composer update --prefer-lowest` can be used before running tests for testing backwards compatibility.
- `composer show -D -o` can be used to check how far behind latest version the currently installed dependencies are.
- `composer update` will install the latest versions of dependencies.

If you're in a branch of this package and getting problems with `kontenta/kontour`
requiring some specific version of this package you can add that version temporarily in `composer.json`
like this (make sure to remove this line before commiting):

```json
"version": "dev-master",
```

## Testing

`composer test` from the project directory will run the default test suite.

If you want your own local configuration for phpunit,
copy the file `phpunit.xml.dist` to `phpunit.xml` and modify the latter to your needs.
