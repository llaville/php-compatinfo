<!-- markdownlint-disable MD013 MD024 -->
# Changes in 6.x

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/),
using the [Keep a CHANGELOG](http://keepachangelog.com) principles.

## [Unreleased]

### Added

- Phar manifest (`--manifest` option) is available with Phar version only
- [Mega-Linter](https://github.com/megalinter/megalinter) v5 support as QA tool to avoid technical debt
- [#308](https://github.com/llaville/php-compatinfo/issues/308) : Support to PHP 8.1

### Fixed

- [#286](https://github.com/llaville/php-compat-info/issues/286) - Mass method signature mismatch
- [#294](https://github.com/llaville/php-compat-info/issues/294) - Method signature inheritance issue (thanks @szepeviktor)

### Removed

- drop support of PHP 7.2
- drop support for PHP 7.3 has ended 6th December 2021.
- file `config/container.php` replaced by `src/Infrastructure/Framework/Symfony/DependencyInjection/ContainerFactory.php`
