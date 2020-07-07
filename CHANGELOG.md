# Change Log

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/),
using the [Keep a CHANGELOG](http://keepachangelog.com) principles.

## [Unreleased]

### Changed

- Drop support to PHP 5
- Drop support to CompatInfoDB 1.x
- Sets PHP minimum requirement to 7.1.3
- Clean-up phpDoc tags
- `jean85/pretty-package-versions` handles now the Application version rather than `sebastian/version`

## [5.2.3] - 2020-04-29

### Fixed

- PHP 7.4 compatibility (thanks to @remicollet for his [PR](https://github.com/llaville/php-compat-info/pull/254))

## [5.2.2] - 2020-04-29

### Fixed

- issue [GH-260](https://github.com/llaville/php-compat-info/issues/260), null coalesce operator not detected.

## [5.2.1] - 2019-10-21

#### Fixed

- compatibility with CompatInfoDB 1.x and 2.x

## [5.2.0] - 2019-06-01

#### Fixed

- compatibility with CompatInfoDB 1.x and 2.x and PHP 7.2

## [5.1.0] - 2018-11-27

#### Changed

- add support to PHP-Parser 3.1 for running on PHP >= 5.5 and for parsing code PHP 5.2 to PHP 7.2

[unreleased]: https://github.com/llaville/php-compat-info/compare/5.2.3...HEAD
[5.2.3]: https://github.com/llaville/php-compat-info/compare/5.2.2...5.2.3
[5.2.2]: https://github.com/llaville/php-compat-info/compare/5.2.1...5.2.2
[5.2.1]: https://github.com/llaville/php-compat-info/compare/5.2.0....5.2.1
[5.2.0]: https://github.com/llaville/php-compat-info/compare/5.1.0....5.2.0
[5.1.0]: https://github.com/llaville/php-compat-info/compare/5.0.12....5.1.0
