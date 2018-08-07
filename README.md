# Fallback Kontour implementation

**Don't depend on this package!**
For most cases you want the [main package](https://packagist.org/packages/kontenta/kontour)
as your dependency.
Both when you're creating admin tools that need a framework,
as well as when you're creating your own admin framework implementation.

## What this package is

This package contains implementations of the main package's contracts that are used as a fallback whenever no other
implementation has been registered in the Laravel service container.

Overriding implementations may be registered by service providers of other packages or your main application.

## Development install

1. Clone this repo in your development environment
2. Run `composer install`
3. You'll find a VCS version of the contracts package in `vendor/kontenta/kontour`

## Updating composer dependencies

If you're in a local branch of this package and getting problems with `kontenta/kontour`
requiring some specific version of this package you can add that version temporarily in `composer.json`
like this:

```json
"version": "dev-master",
```

## Testing

`composer test` from the project directory will run the default test suite.

If you want your own local configuration for phpunit,
copy the file `phpunit.xml.dist` to `phpunit.xml` and modify the latter to your needs.
