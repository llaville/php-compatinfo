<!-- markdownlint-disable MD013 MD024 -->
# Changes in 6.x

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/),
using the [Keep a CHANGELOG](http://keepachangelog.com) principles.

## [Unreleased]

## [6.1.0] - 2022-01-06

### Added

- improves `output` option by introducing Reporter extension (see [documentation](docs/01_Components/04_Extensions/Reporter.md))
- [#312](https://github.com/llaville/php-compatinfo/issues/312): Add SARIF output format

### Changed

- moved Doctrine ORM `cli-config.php` file from root folder to `config/` directory (more sense)

- Support **Typed properties** features, now minimum PHP requirement is 7.4

  Read more about this feature at :

  - <https://stitcher.io/blog/typed-properties-in-php-74>
  - <https://php.watch/versions/7.4/typed-properties>

### Removed

- `Bartlett\CompatInfo\Presentation\Console\ApplicationInterface::VERSION` constant that identify current version of Application
- deprecated / End Of Life composer plugin `composer/package-versions-deprecated`, and use Composer 2.2 (LTS) equivalent feature
- `symfony/phpunit-bridge` dependency (not used)

## [6.0.3] - 2022-01-05

### Fixed

- [incompatibility with PHP CompatInfoDb 3.17](https://github.com/llaville/php-compatinfo-db/issues/105)

## [6.0.2] - 2021-12-27

### Fixed

- [GH-313](https://github.com/llaville/php-compatinfo/issues/313) Cannot install CompatInfo as a vendor dependency

## [6.0.1] - 2021-12-13

### Fixed

- [#309](https://github.com/llaville/php-compatinfo/issues/309): Composer 2.2 compatibility for plugins (thanks to @remicollet for reporting)
- [#310](https://github.com/llaville/php-compatinfo/issues/310): Symfony 4 compatibility (thanks to @remicollet for reporting)

## [6.0.0] - 2021-12-11

### Added

- Phar manifest (`--manifest` option) is available with Phar version only (build with `box-project/box` [3.10](https://github.com/box-project/box/releases/tag/3.10.0) or greater)
- [Mega-Linter](https://github.com/megalinter/megalinter) v5 support as QA tool to avoid technical debt
- [#308](https://github.com/llaville/php-compatinfo/issues/308) : Support to PHP 8.1

### Fixed

- [#286](https://github.com/llaville/php-compat-info/issues/286) - Mass method signature mismatch
- [#294](https://github.com/llaville/php-compat-info/issues/294) - Method signature inheritance issue (thanks @szepeviktor)

### Removed

- drop support of PHP 7.2
- drop support for PHP 7.3 has ended 6th December 2021.
- file `config/container.php` replaced by `src/Infrastructure/Framework/Symfony/DependencyInjection/ContainerFactory.php`

[unreleased]: https://github.com/llaville/php-compat-info/compare/6.1.0...HEAD
[6.1.0]: https://github.com/llaville/php-compat-info/compare/6.0.3...6.1.0
[6.0.3]: https://github.com/llaville/php-compat-info/compare/6.0.2...6.0.3
[6.0.2]: https://github.com/llaville/php-compat-info/compare/6.0.1...6.0.2
[6.0.1]: https://github.com/llaville/php-compat-info/compare/6.0.0...6.0.1
[6.0.0]: https://github.com/llaville/php-compat-info/compare/5.5.5...6.0.0
