<!-- markdownlint-disable MD013 -->
# Polyfills

Before version 6.4, PHP CompatInfo and its compatibility analyser was not able to detect packages that provides compatibility layers for some extensions and functions.

Since version 6.4, PHP CompatInfo used a polyfill architecture to detect such packages that backports features found in the latest PHP versions.

Each polyfill package must be supported both with [PHP CompatInfoDB](https://github.com/llaville/php-compatinfo-db) (since release 4.2.0) to identify PHP features (classes, constants, functions), and CompatInfo itself by services implementing the `Bartlett\CompatInfo\Application\Polyfills\PolyfillInterface`

Here is the list of available polyfill services supported (namespace `Bartlett\CompatInfo\Application\Polyfills`) :

## [Ctype extension](https://github.com/symfony/polyfill-ctype)

| Polyfill class name | Description                                                                                                    |
|---------------------|----------------------------------------------------------------------------------------------------------------|
| `SymfonyCtype`      | This polyfill detects PHP native `ctype_*` functions to users who run php versions without the ctype extension |

Available since release 6.4.0

## [Iconv extension](https://github.com/symfony/polyfill-iconv)

| Polyfill class name | Description                                                                                                    |
|---------------------|----------------------------------------------------------------------------------------------------------------|
| `SymfonyIconv`      | This polyfill detects PHP native `iconv_*` functions to users who run php versions without the iconv extension |

Available since release 6.4.0

## [Mbstring extension](https://github.com/symfony/polyfill-mbstring)

| Polyfill class name | Description                                                                                                    |
|---------------------|----------------------------------------------------------------------------------------------------------------|
| `SymfonyMbstring`   | This polyfill detects PHP native `mb_*` functions to users who run php versions without the mbstring extension |

Available since release 6.4.0

## [PHP 7.0](https://github.com/symfony/polyfill-php70)

| Polyfill class name | Description                                                             |
|---------------------|-------------------------------------------------------------------------|
| `SymfonyPhp70`      | This polyfill detects features unavailable in releases prior to PHP 7.0 |

Available since release 6.4.0

## [PHP 7.1](https://github.com/symfony/polyfill-php71)

| Polyfill class name | Description                                                             |
|---------------------|-------------------------------------------------------------------------|
| `SymfonyPhp71`      | This polyfill detects features unavailable in releases prior to PHP 7.1 |

Available since release 6.4.0

## [PHP 7.2](https://github.com/symfony/polyfill-php72)

| Polyfill class name | Description                                                             |
|---------------------|-------------------------------------------------------------------------|
| `SymfonyPhp72`      | This polyfill detects features unavailable in releases prior to PHP 7.2 |

Available since release 6.4.0

## [PHP 7.3](https://github.com/symfony/polyfill-php73)

| Polyfill class name | Description                                                             |
|---------------------|-------------------------------------------------------------------------|
| `SymfonyPhp73`      | This polyfill detects features unavailable in releases prior to PHP 7.3 |

Available since release 6.4.0

## [PHP 7.4](https://github.com/symfony/polyfill-php74)

| Polyfill class name | Description                                                             |
|---------------------|-------------------------------------------------------------------------|
| `SymfonyPhp74`      | This polyfill detects features unavailable in releases prior to PHP 7.4 |

Available since release 6.4.0

## [PHP 8.0](https://github.com/symfony/polyfill-php80)

| Polyfill class name | Description                                                             |
|---------------------|-------------------------------------------------------------------------|
| `SymfonyPhp80`      | This polyfill detects features unavailable in releases prior to PHP 8.0 |

Available since release 6.4.0

## [PHP 8.1](https://github.com/symfony/polyfill-php81)

| Polyfill class name | Description                                                             |
|---------------------|-------------------------------------------------------------------------|
| `SymfonyPhp81`      | This polyfill detects features unavailable in releases prior to PHP 8.1 |

Available since release 6.4.0

## [PHP 8.2](https://github.com/symfony/polyfill-php82)

| Polyfill class name | Description                                                             |
|---------------------|-------------------------------------------------------------------------|
| `SymfonyPhp82`      | This polyfill detects features unavailable in releases prior to PHP 8.2 |

Available since release 6.5.0

## [PHP 8.3](https://github.com/symfony/polyfill-php83)

| Polyfill class name | Description                                                             |
|---------------------|-------------------------------------------------------------------------|
| `SymfonyPhp83`      | This polyfill detects features unavailable in releases prior to PHP 8.3 |

Available since release 7.2.0

## [PHP 8.4](https://github.com/symfony/polyfill-php84)

| Polyfill class name | Description                                                             |
|---------------------|-------------------------------------------------------------------------|
| `SymfonyPhp84`      | This polyfill detects features unavailable in releases prior to PHP 8.4 |

Available since release 7.2.0
