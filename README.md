<!-- markdownlint-disable MD013 -->
# PHP CompatInfo

**PHP CompatInfo** is a library that can find the minimum version and the extensions required for a piece of code to run.

Running on PHP greater or equal than 7.4 for parsing source code in a format PHP 5.2 to PHP 8.2

[![GitHub Discussions](https://img.shields.io/github/discussions/llaville/php-compatinfo)](https://github.com/llaville/php-compatinfo/discussions)
[![GitHub-Pages](https://github.com/llaville/php-compatinfo/actions/workflows/gh-pages.yml/badge.svg)](https://github.com/llaville/php-compatinfo/actions/workflows/gh-pages.yml)
[![Unit Tests](https://github.com/llaville/php-compatinfo/actions/workflows/unit-tests.yaml/badge.svg)](https://github.com/llaville/php-compatinfo/actions/workflows/unit-tests.yaml)
[![StandWithUkraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/badges/StandWithUkraine.svg)](https://github.com/vshymanskyy/StandWithUkraine/blob/main/docs/README.md)

## Versions

| Releases      |                   Branch                    | PHP | Packagist | License | Documentation |
|:--------------|:-------------------------------------------:|:---------------:|:---------------:|:---------------:|:---------------:|
| Stable v5.5.x | [![Branch 5.5][Branch_55x-img]][Branch_55x] | [![Minimum PHP Version)][PHPVersion_55x-img]][PHPVersion_55x] | [![Stable Version 5.5][Packagist_55x-img]][Packagist_55x] | [![License 5.5][License_55x-img]][License_55x] | [![Documentation 5.5][Documentation_55x-img]][Documentation_55x] |
| Stable v6.5.x | [![Branch 6.5][Branch_65x-img]][Branch_65x] | [![Minimum PHP Version)][PHPVersion_65x-img]][PHPVersion_65x] | [![Stable Version 5.5][Packagist_65x-img]][Packagist_65x] | [![License 5.5][License_65x-img]][License_65x] | [![Documentation 5.5][Documentation_65x-img]][Documentation_65x] |
| Stable v7.0.x | [![Branch 7.0][Branch_70x-img]][Branch_70x] | [![Minimum PHP Version)][PHPVersion_70x-img]][PHPVersion_70x] | [![Stable Version 5.5][Packagist_70x-img]][Packagist_70x] | [![License 5.5][License_70x-img]][License_70x] | [![Documentation 5.5][Documentation_70x-img]][Documentation_70x] |

[Branch_55x-img]: https://img.shields.io/badge/branch-5.5-orange
[Branch_55x]: https://github.com/llaville/php-compatinfo/tree/5.5
[PHPVersion_55x-img]: https://img.shields.io/packagist/php-v/bartlett/php-compatinfo/5.5.6
[PHPVersion_55x]: https://www.php.net/supported-versions.php
[Packagist_55x-img]: https://img.shields.io/badge/packagist-v5.5.6-blue
[Packagist_55x]: https://packagist.org/packages/bartlett/php-compatinfo
[License_55x-img]: https://img.shields.io/packagist/l/bartlett/php-compatinfo
[License_55x]: https://github.com/llaville/php-compatinfo/blob/5.5/LICENSE
[Documentation_55x-img]: https://img.shields.io/badge/documentation-v5.5-green
[Documentation_55x]: https://github.com/llaville/php-compatinfo/tree/5.5/docs

[Branch_65x-img]: https://img.shields.io/badge/branch-6.5-orange
[Branch_65x]: https://github.com/llaville/php-compatinfo/tree/6.5
[PHPVersion_65x-img]: https://img.shields.io/packagist/php-v/bartlett/php-compatinfo/6.5.5
[PHPVersion_65x]: https://www.php.net/supported-versions.php
[Packagist_65x-img]: https://img.shields.io/badge/packagist-v6.5.5-blue
[Packagist_65x]: https://packagist.org/packages/bartlett/php-compatinfo
[License_65x-img]: https://img.shields.io/packagist/l/bartlett/php-compatinfo
[License_65x]: https://github.com/llaville/php-compatinfo/blob/6.5/LICENSE
[Documentation_65x-img]: https://img.shields.io/badge/documentation-v6.5-green
[Documentation_65x]: https://github.com/llaville/php-compatinfo/tree/6.5/docs

[Branch_70x-img]: https://img.shields.io/badge/branch-7.0-orange
[Branch_70x]: https://github.com/llaville/php-compatinfo/tree/7.0
[PHPVersion_70x-img]: https://img.shields.io/packagist/php-v/bartlett/php-compatinfo/7.0.1
[PHPVersion_70x]: https://www.php.net/supported-versions.php
[Packagist_70x-img]: https://img.shields.io/badge/packagist-v7.0.1-blue
[Packagist_70x]: https://packagist.org/packages/bartlett/php-compatinfo
[License_70x-img]: https://img.shields.io/packagist/l/bartlett/php-compatinfo
[License_70x]: https://github.com/llaville/php-compatinfo/blob/7.0/LICENSE
[Documentation_70x-img]: https://img.shields.io/badge/documentation-v7.0-green
[Documentation_70x]: https://github.com/llaville/php-compatinfo/tree/7.0/docs

## Documentation

All the documentation is available on following websites generated from the docs folder.

- <http://llaville.github.io/php-compatinfo/7.x/>

## Contributors

* Laurent Laville (Lead Dev)
* Thanks to Nikita Popov who wrote a marvellous [PHP Parser](https://github.com/nikic/PHP-Parser).
* Thanks also to Remi Collet, a contributor of first hours.
* Credits to [Davey Shafik](https://github.com/dshafik). He introduced his proposal in 2004, that gave birth of a [PEAR package](http://pear.php.net/package/PHP_CompatInfo) named PHP_CompatInfo.
