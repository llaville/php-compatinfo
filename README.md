<!-- markdownlint-disable MD013 -->
# PHP CompatInfo

[![StandWithUkraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/badges/StandWithUkraine.svg)](https://github.com/vshymanskyy/StandWithUkraine/blob/main/docs/README.md)
[![GitHub Discussions](https://img.shields.io/github/discussions/llaville/php-compatinfo)](https://github.com/llaville/php-compatinfo/discussions)

**PHP CompatInfo** is a library that can find the minimum version and the extensions required for a piece of code to run.

Running on PHP greater or equal than 7.4 for parsing source code in a format PHP 5.2 to PHP 8.4

## Versions

| Releases      |                   Branch                    |                              PHP                              |                         Packagist                         |                    License                     |                          Documentation                           |
|:--------------|:-------------------------------------------:|:-------------------------------------------------------------:|:---------------------------------------------------------:|:----------------------------------------------:|:----------------------------------------------------------------:|
| Stable v5.5.x | [![Branch 5.5][Branch_55x-img]][Branch_55x] | [![Minimum PHP Version)][PHPVersion_55x-img]][PHPVersion_55x] | [![Stable Version 5.5][Packagist_55x-img]][Packagist_55x] | [![License 5.5][License_55x-img]][License_55x] | [![Documentation 5.5][Documentation_55x-img]][Documentation_55x] |
| Stable v6.5.x | [![Branch 6.5][Branch_65x-img]][Branch_65x] | [![Minimum PHP Version)][PHPVersion_65x-img]][PHPVersion_65x] | [![Stable Version 6.5][Packagist_65x-img]][Packagist_65x] | [![License 6.5][License_65x-img]][License_65x] | [![Documentation 6.5][Documentation_65x-img]][Documentation_65x] |
| Stable v7.0.x | [![Branch 7.0][Branch_70x-img]][Branch_70x] | [![Minimum PHP Version)][PHPVersion_70x-img]][PHPVersion_70x] | [![Stable Version 7.0][Packagist_70x-img]][Packagist_70x] | [![License 7.0][License_70x-img]][License_70x] | [![Documentation 7.0][Documentation_70x-img]][Documentation_70x] |
| Stable v7.1.x | [![Branch 7.1][Branch_71x-img]][Branch_71x] | [![Minimum PHP Version)][PHPVersion_71x-img]][PHPVersion_71x] | [![Stable Version 7.1][Packagist_71x-img]][Packagist_71x] | [![License 7.1][License_71x-img]][License_71x] | [![Documentation 7.1][Documentation_71x-img]][Documentation_71x] |
| Stable v7.2.x | [![Branch 7.2][Branch_72x-img]][Branch_72x] | [![Minimum PHP Version)][PHPVersion_72x-img]][PHPVersion_72x] | [![Stable Version 7.2][Packagist_72x-img]][Packagist_72x] | [![License 7.2][License_72x-img]][License_72x] | [![Documentation 7.2][Documentation_72x-img]][Documentation_72x] |

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
[Packagist_70x-img]: https://img.shields.io/badge/packagist-v7.0.3-blue
[Packagist_70x]: https://packagist.org/packages/bartlett/php-compatinfo
[License_70x-img]: https://img.shields.io/packagist/l/bartlett/php-compatinfo
[License_70x]: https://github.com/llaville/php-compatinfo/blob/7.0/LICENSE
[Documentation_70x-img]: https://img.shields.io/badge/documentation-v7.0-green
[Documentation_70x]: https://github.com/llaville/php-compatinfo/tree/7.0/docs

[Branch_71x-img]: https://img.shields.io/badge/branch-7.1-orange
[Branch_71x]: https://github.com/llaville/php-compatinfo/tree/7.1
[PHPVersion_71x-img]: https://img.shields.io/packagist/php-v/bartlett/php-compatinfo/7.1.4
[PHPVersion_71x]: https://www.php.net/supported-versions.php
[Packagist_71x-img]: https://img.shields.io/badge/packagist-v7.1.4-blue
[Packagist_71x]: https://packagist.org/packages/bartlett/php-compatinfo
[License_71x-img]: https://img.shields.io/packagist/l/bartlett/php-compatinfo
[License_71x]: https://github.com/llaville/php-compatinfo/blob/7.1/LICENSE
[Documentation_71x-img]: https://img.shields.io/badge/documentation-v7.1-green
[Documentation_71x]: https://github.com/llaville/php-compatinfo/tree/7.1/docs

[Branch_72x-img]: https://img.shields.io/badge/branch-7.2-orange
[Branch_72x]: https://github.com/llaville/php-compatinfo/tree/7.2
[PHPVersion_72x-img]: https://img.shields.io/packagist/php-v/bartlett/php-compatinfo/7.2.2
[PHPVersion_72x]: https://www.php.net/supported-versions.php
[Packagist_72x-img]: https://img.shields.io/badge/packagist-v7.2.2-blue
[Packagist_72x]: https://packagist.org/packages/bartlett/php-compatinfo
[License_72x-img]: https://img.shields.io/packagist/l/bartlett/php-compatinfo
[License_72x]: https://github.com/llaville/php-compatinfo/blob/7.2/LICENSE
[Documentation_72x-img]: https://img.shields.io/badge/documentation-v7.2-green
[Documentation_72x]: https://github.com/llaville/php-compatinfo/tree/7.2/docs

## Documentation

All the documentation is available on [website](https://llaville.github.io/php-compatinfo/7.2),
generated from the [docs](https://github.com/llaville/php-compatinfo/tree/7.2/docs) folder.

## Contributors

* Laurent Laville (Lead Dev)
* Thanks to Nikita Popov who wrote a marvellous [PHP Parser](https://github.com/nikic/PHP-Parser).
* Thanks also to Remi Collet, a contributor of first hours.
* Credits to [Davey Shafik](https://github.com/dshafik). He introduced his proposal in 2004, that gave birth of a [PEAR package](http://pear.php.net/package/PHP_CompatInfo) named PHP_CompatInfo.
