
# PHP CompatInfo

| Stable | Upcoming |
|:------:|:--------:|
| [![Latest Stable Version](https://img.shields.io/packagist/v/bartlett/php-compatinfo)](https://packagist.org/packages/bartlett/php-compatinfo) | [![Unstable Version](https://img.shields.io/packagist/vpre/bartlett/php-compatinfo)](https://packagist.org/packages/bartlett/php-compatinfo) |
| [![Minimum PHP Version)](https://img.shields.io/packagist/php-v/bartlett/php-compatinfo)](https://www.php.net/supported-versions.php) | [![Minimum PHP Version)](https://img.shields.io/packagist/php-v/bartlett/php-compatinfo/6.0.x-dev?color=orange)](https://www.php.net/supported-versions.php) |
| [![Branch Master](https://img.shields.io/badge/branch-master-blue)](https://github.com/llaville/php-compat-info) | [![Branch 6.0](https://img.shields.io/badge/branch-6.0-orange)](https://github.com/llaville/php-compat-info/tree/6.0) |

**PHP CompatInfo** is a library that
can find the minimum version and the extensions required for a piece of code to run.

Running on PHP greater than 7.1 for parsing source code in a format PHP 5.2 to PHP 7.4

## Requirements

* PHP 7.1.3 or greater
* PHPUnit 7 or greater (if you want to run unit tests)

## Installation

The recommended way to install this library is [through composer](http://getcomposer.org).
If you don't know yet what is composer, have a look [on introduction](http://getcomposer.org/doc/00-intro.md).

```bash
composer require bartlett/php-compatinfo
```

## Build PHAR distribution

Since release **5.4.2** building of phar version of application is part of composer automated process.

Either when you install or update project with Composer, the `bin/phpcompatinfo.phar` file will be built.

**NOTE**
- You may avoid this by invoking composer command with `--no-scripts` option.
- You may also rebuild the phar file by invoking `composer compile-box` command (shortcut of `run`, `run-script`).

## Documentation

Full documentation is written in MarkDown format, and HTML export is possible with [Daux.io](https://github.com/dauxio/daux.io).
See output results at http://bartlett.laurent-laville.org/php-compatinfo/ or raw `*.md` files in `docs` folder.

**Table of Contents**

* **Features**
  - Parse source code in format PHP 5.2 to PHP 7.4
  - Detect PHP features for each Major/minor versions
  - Detect versions of all directives, constants, functions, classes, interfaces of 100 extensions and more
  - Display/Inspect list of extensions, and their versions supported

* **Components**
  - PHP-Parser [Node Visitors](docs/01_Components/01_PHP-Parser/Visitors.md)
  - [Profiler](docs/01_Components/02_Profiler/Collectors.md)
  - Collection of [Sniffs](docs/01_Components/03_Sniffs/Features.md)

* **Configurations**
  - Use of PSR11 containers to [configure](docs/02_Configs/README.md) application services.

## Contributors

* Laurent Laville (Lead Dev)
* Thanks to Nikita Popov who wrote a marvellous [PHP Parser](https://github.com/nikic/PHP-Parser).
* Thanks also to Remi Collet, a contributor of first hours.
* Credits to [Davey Shafik](https://github.com/dshafik). He introduced his proposal in 2004, that gave birth of a [PEAR package](http://pear.php.net/package/PHP_CompatInfo) named PHP_CompatInfo.

[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/0)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/0)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/1)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/1)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/2)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/2)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/3)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/3)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/4)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/4)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/5)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/5)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/6)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/6)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/7)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/7)

## License

This project is licensed under the BSD-3-Clause License - see the [LICENSE](https://github.com/llaville/php-compat-info/blob/master/LICENSE) file for details
