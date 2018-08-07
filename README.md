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
