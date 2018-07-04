SimpleSAMLphp Composer module example
=====================================

This package is an example of a SimpleSAMLphp module installable through
[Composer](https://getcomposer.org/). Installation can be as easy as executing:

```
composer.phar require simplesamlphp/simplesamlphp-module-examplecomposer 1.*
```

That command would install `simplesamlphp/simplesamlphp-module-examplecomposer`
matching version `1.*`.


Once it is installed, you can access the hello-world script at:
`/simplesaml/module.php/examplecomposer/hello.php`

See the [SimpleSAMLphp Composer module installer](https://github.com/simplesamlphp/composer-module-installer)
documentation for more information about creating modules installable
through Composer.


Files
-----

This module consists of the following files:

- `composer.json`: The composer configuration file for this module.
- `default-enable`: A file telling SimpleSAMLphp that the module is enabled by default.
- `README.md`: This document describing the module.
- `www/hello.php`: Script outputing `Hello World!` when executed.
