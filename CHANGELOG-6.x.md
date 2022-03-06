<!-- markdownlint-disable MD013 MD024 -->
# Changes in 6.x

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/),
using the [Keep a CHANGELOG](http://keepachangelog.com) principles.

## [Unreleased]

<!-- MARKDOWN-RELEASE:START -->
### Added

- [#347](https://github.com/llaville/php-compatinfo/issues/347) : Automate creation of new GitHub Release with PHAR version as asset

Experimental

- new `Bartlett\CompatInfo\Application\Extension\Reporter\RuleReporter` to display Compatibility Analyser by feature rules (see `sarif` format)

### Fixed

- [#345](https://github.com/llaville/php-compatinfo/issues/345) : class `PhpParser\Node\Expr\PropertyFetch` could not be converted to string
- [#346](https://github.com/llaville/php-compatinfo/issues/346) : Improves displaying Error in Datasource Analysis
- [#348](https://github.com/llaville/php-compatinfo/issues/348) : TrailingCommaSniff give wrong results
<!-- MARKDOWN-RELEASE:END -->

## [6.2.0] - 2022-02-06

### Added

- `about` command to display current long version and more information about this package.
- new environment variable `APP_VENDOR_DIR` that identify `vendor` directory (auto-detection)
- `APP_DATABASE_URL` contains full path without placeholders for SQLite driver.
- `APP_CACHE_DIR` identifies directory where you may find the SQLite database version (`compatinfo-db.sqlite`).
- `APP_HOME_DIR` identifies user home directory (whatever platform).
- [Simplify database initialization processus](https://github.com/llaville/php-compatinfo/issues/321) with bridge to new command `db:create` (from CompatInfoDB)
- [#322](https://github.com/llaville/php-compatinfo/issues/322) : new sniff to detect PHP (8.1) Enumerations
- [#323](https://github.com/llaville/php-compatinfo/issues/323) : new sniff to detect PHP (8.1) Readonly Properties
- [#324](https://github.com/llaville/php-compatinfo/issues/324) : new sniff to detect PHP (8.1) First class callable syntax
- [#325](https://github.com/llaville/php-compatinfo/issues/325) : new sniff to detect PHP (8.1) New in initializers
- [#329](https://github.com/llaville/php-compatinfo/issues/329) : new sniff to detect PHP (8.1) Explicit Octal numeral notation
- [#330](https://github.com/llaville/php-compatinfo/issues/330) : new sniff to detect PHP (8.1) Fibers
- [#331](https://github.com/llaville/php-compatinfo/issues/331) : new sniff to detect PHP (8.1) Array unpacking support
- [#334](https://github.com/llaville/php-compatinfo/issues/334) : new sniff to detect PHP (8.0) Named arguments
- [#335](https://github.com/llaville/php-compatinfo/issues/335) : new sniff to detect PHP (8.0) Attributes
- [#336](https://github.com/llaville/php-compatinfo/issues/336) : new sniff to detect PHP (8.0) Constructor property promotion
- [#337](https://github.com/llaville/php-compatinfo/issues/337) : new sniff to detect PHP (8.0) Match expressions
- [#338](https://github.com/llaville/php-compatinfo/issues/338) : new sniff to detect PHP (8.0) Nullsafe operator syntax
- [#340](https://github.com/llaville/php-compatinfo/issues/340) : new sniff to detect PHP (8.0) Trailing comma syntax in parameters list and closure use list
- [#341](https://github.com/llaville/php-compatinfo/issues/341) : new sniff to detect PHP (8.0) Non-capturing catches syntax

### Changed

- [#326](https://github.com/llaville/php-compatinfo/issues/326) : update sniffs to detect PHP (8.1) Intersection types
- [#327](https://github.com/llaville/php-compatinfo/issues/327) : update sniffs to detect PHP (8.1) Never return type
- [#328](https://github.com/llaville/php-compatinfo/issues/328) : update sniffs to detect PHP (8.1) Final class constants
- option `--version` display now only long version without application description.
- Checker service handle now, and print into diagnostic the application environment variables (keys/values).
- Launch an auto-diagnose on `db:*` commands (excluding `db:create`) or `analyser:run`.
- [#343](https://github.com/llaville/php-compatinfo/issues/343) : Allow displaying PHP suggested version on each reporter
- Adjust Composer constraints to follow logical OR syntax with two pipes (see <https://getcomposer.org/doc/articles/versions.md#version-range>)

### Fixed

- [#342](https://github.com/llaville/php-compatinfo/issues/342) : Sniff `AttributeSniff` raise `php.min` too much

## [6.1.2] - 2022-01-28

### Changed

- fix `bartlett/php-compatinfo-db` constraint to fix conflict with future versions 3.19 or greater

## [6.1.1] - 2022-01-18

### Changed

- [GH-319](https://github.com/llaville/php-compatinfo/issues/319) Add Platform to composer.json (thanks to @remicollet)
- fix `php-compatinfo-db` constraint to avoid conflict with new version feature introduced in 3.17.0

### Fixed

- [GH-339](https://github.com/llaville/php-compatinfo/issues/339) Stop on empty/broken files during analysis (thanks to @yuri-ccp for reporting)

### Removed

- [drop support of Composer v1](https://github.com/llaville/php-compatinfo/issues/320)

## [6.0.4] - 2022-01-18

### Fixed

- [GH-339](https://github.com/llaville/php-compatinfo/issues/339) Stop on empty/broken files during analysis (thanks to @yuri-ccp for reporting)

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

[unreleased]: https://github.com/llaville/php-compat-info/compare/6.2.0...HEAD
[6.2.0]: https://github.com/llaville/php-compat-info/compare/6.1.2...6.2.0
[6.1.2]: https://github.com/llaville/php-compat-info/compare/6.1.1...6.1.2
[6.1.1]: https://github.com/llaville/php-compat-info/compare/6.1.0...6.1.1
[6.1.0]: https://github.com/llaville/php-compat-info/compare/6.0.4...6.1.0
[6.0.4]: https://github.com/llaville/php-compat-info/compare/6.0.3...6.0.4
[6.0.3]: https://github.com/llaville/php-compat-info/compare/6.0.2...6.0.3
[6.0.2]: https://github.com/llaville/php-compat-info/compare/6.0.1...6.0.2
[6.0.1]: https://github.com/llaville/php-compat-info/compare/6.0.0...6.0.1
[6.0.0]: https://github.com/llaville/php-compat-info/compare/5.5.5...6.0.0
