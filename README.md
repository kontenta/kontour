# Default implementations of the Admin Manager contracts

**Don't depend on this package!**
For most cases you want the [contracts package](https://github.com/kontenta/kontour)
as your dependency, not this package.
Both when you're creating admin tools that need a framework,
as well as when you're creating your own admin framework implementation.

## Requirements
You need at least **Laravel 5.5** and **PHP 7.0** to use this package.

## Package development
 
### Development install
1. Clone this repo in your development environment
2. Run `composer install`
3. You'll find a VCS version of the contracts package in `vendor/kontenta/kontour`
 
### Testing
`composer test` from the project directory will run the default test suite.

If you want your own local configuration for phpunit,
copy the file `phpunit.xml.dist` to `phpunit.xml` and modify the latter to your needs.
