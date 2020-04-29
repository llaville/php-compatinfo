[![Latest Stable Version](https://img.shields.io/packagist/v/bartlett/php-compatinfo.svg?style=flat-square)](https://packagist.org/packages/bartlett/php-compatinfo)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.5-8892BF.svg?style=flat-square)](https://php.net/)

# Introduction

**PHP CompatInfo** is a library that
can find the minimum version and the extensions required for a piece of code to run.

It is distributed as source code (install via composer) and a PHAR version
that bundles all dependencies in a single file.

**CAUTION:** Branch 5.2 will not accept anymore any feature requests.

# Requirements

* PHP 5.5 or greater

# Installation

The recommended way to install this library is [through composer](http://getcomposer.org).
If you don't know yet what is composer, have a look [on introduction](http://getcomposer.org/doc/00-intro.md).

```bash
composer require bartlett/php-compat-info
```

## PHP5 users only

Remove `composer.lock` to be able to install correct dependencies.

Content of this file in repository is for PHP7 users.

# Documentation

The documentation for PHP CompatInfo 5.0
in [English](http://php5.laurent-laville.org/compatinfo/manual/5.0/en/)
is available online or downloadable offline to read it later (multiple formats available).

AsciiDoc source code are available on `docs` folder of the repository.

# Contributors

* Laurent Laville
* Thanks to Nikita Popov who wrote a marvellous https://github.com/nikic/PHP-Parser[PHP Parser] and simplify the job of PHP Reflect.
* Thanks also to Remi Collet, a contributor of first hours.

[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/0)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/0)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/1)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/1)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/2)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/2)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/3)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/3)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/4)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/4)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/5)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/5)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/6)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/6)
[![](https://sourcerer.io/fame/llaville/llaville/php-compat-info/images/7)](https://sourcerer.io/fame/llaville/llaville/php-compat-info/links/7)

# License

This software is licensed under the BSD-3-clauses License - see the `LICENSE` file for details
