# Change Log

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/),
using the [Keep a CHANGELOG](http://keepachangelog.com) principles.

## [Unreleased]

### Added

- [GH-305](https://github.com/llaville/php-compat-info/issues/305) `--exclude` option to be able to filter data source

### Fixed

- [GH-301](https://github.com/llaville/php-compat-info/issues/301) Multiple conditions not displayed
- [GH-303](https://github.com/llaville/php-compat-info/issues/303) Report unavailable extension more clearly
- issue (on static context) when running single TestCase with commit [14b16b3](https://github.com/llaville/php-compat-info/commit/14b16b3a2454316d699ab4a587497e24f0f87235)
- report unavailable database more clearly

## [5.5.1] - 2021-03-13

### Fixed

- Autoloader regression when using as dependency in another project

## [5.5.0] - 2021-03-13

**CAUTION:** uses `config/bootstrap.php` to apply autoloader and initialize environment variables (`APP_ENV` and `APP_PROXY_DIR`)

### Changed

- raise PHP minimum requirement to version 7.2
- raise `bartlett/php-compatinfo-db` dependency to version 3.4

## [5.4.4] - 2021-02-22

### Added

- [GH-271](https://github.com/llaville/php-compat-info/issues/271) CI with Github Actions Workflow

### Removed

- Composer Automation to build PHAR distribution (removed only `humbug/box` dev dependency)

## [5.4.3] - 2021-02-12

### Fixed

- [GH-292](https://github.com/llaville/php-compat-info/issues/292) - Uncaught Error: Object of class PhpParser\Node\UnionType could not be converted to string

## [5.4.2] - 2020-11-20

### Changed

- Phar manifest (`--manifest` option) is no more available. Will be back in major version 6.0 with another format.
- [GH-270](https://github.com/llaville/php-compat-info/issues/270) - Composer Automation to build PHAR distribution
- [PR-289](https://github.com/llaville/php-compat-info/pull/289) - Link the EOL page of php.net in README (thanks to @szepeviktor)

### Fixed

- [GH-284](https://github.com/llaville/php-compat-info/issues/284) - Errors while running on empty files

## [5.4.1] - 2020-10-06

### Changed

- `NodeNormalizer` did not raise anymore a `LogicException` when node is not support

### Fixed

- [GH-277](https://github.com/llaville/php-compat-info/issues/277) - Clean-up Monolog references (thanks to @remicollet to his report GH-276)
- [GH-278](https://github.com/llaville/php-compat-info/issues/278) - Clean-up BARTLETTRC references and MAN page (thanks to @remicollet to his report GH-276)
- [GH-279](https://github.com/llaville/php-compat-info/issues/279) - Implicit Composer requirement to doctrine/collection (thanks to @remicollet to his report GH-276)
- [GH-280](https://github.com/llaville/php-compat-info/issues/280) - Tests failure with PHPUnit on version 5.4.0 (thanks to @remicollet to his report GH-276)
- [GH-281](https://github.com/llaville/php-compat-info/issues/281) - `--output` doesn't work anymore (thanks to @remicollet)
- [PR-282](https://github.com/llaville/php-compat-info/pull/282) - Named parameters confusion with PHP 8 (thanks to @remicollet)

## [5.4.0] - 2020-10-01

### Added

- introduces new `DeclareSniff` to enhance PHP 7 declare control structure detection - (see also [GH-268](https://github.com/llaville/php-compat-info/issues/268))
- new `AnonymousClassSniff` to detect anonymous class - (see also [GH-269](https://github.com/llaville/php-compat-info/issues/269))
- new `ReturnTypeDeclarationSniff` to enhance PHP 7 detection - (see also [GH-233](https://github.com/llaville/php-compat-info/issues/233). Thanks to @CybotTM)
- new `ParamTypeDeclarationSniff` to detect type hint on function signatures - (see also [GH-273](https://github.com/llaville/php-compat-info/issues/273))
- new `ReservedSniff` to enhance PHP 7 detection - (see also [GH-186](https://github.com/llaville/php-compat-info/issues/186). Thanks to @fabiang)
- uses new `NullCoalesceOperatorSniff` instead of internal compatibility analyser code - (see also [GH-260](https://github.com/llaville/php-compat-info/issues/260))
- new `PowOperatorSniff` to solve issues [GH-142](https://github.com/llaville/php-compat-info/issues/142) and [GH-211](https://github.com/llaville/php-compat-info/issues/211)
- new `UseTraitSniff` to solve issue [GH-227](https://github.com/llaville/php-compat-info/issues/227)
- new `ClassMemberAccessSniff` to solve issue [GH-154](https://github.com/llaville/php-compat-info/issues/154)
- new `GeneratorSniff` to solve issue [GH-226](https://github.com/llaville/php-compat-info/issues/226)
- new `GotoSniff` to solve issue [GH-200](https://github.com/llaville/php-compat-info/issues/200)
- new `EmptySniff` to solve issues [GH-207](https://github.com/llaville/php-compat-info/pull/207) and [GH-238](https://github.com/llaville/php-compat-info/issues/238)
- new `PropertyDeclarationSniff` to solve issue [GH-119](https://github.com/llaville/php-compat-info/issues/119)
- new `MagicClassConstantSniff` to solve issue [GH-218](https://github.com/llaville/php-compat-info/issues/218)
- new `CryptStringSniff` to solve issue [GH-220](https://github.com/llaville/php-compat-info/issues/220)
- new `ConditionalCodeSniff` to detection conditional code
- replaces metrics structure by an OOP mechanism (Profiler/Profile/DataCollector)

### Changed

- [Application version strategy](https://github.com/llaville/php-compat-info/issues/267) : `composer/package-versions-deprecated` is used to handle version in Composer/Git strategy
- speed-up analysis process by removing priority file queue that is no more necessary

### Removed

- Removes usage of `jean85/pretty-package-versions` package to handle Composer/Git version strategy
- column `matches` in compatibility analyser output
- `php.all` information that was confusing for lot of users

### Fixed

- issue [GH-275](https://github.com/llaville/php-compat-info/issues/275) Missing extension when class name FQN is resolved under user namespace

## [5.3.0] - 2020-07-08

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

[unreleased]: https://github.com/llaville/php-compat-info/compare/5.5.0...HEAD
[5.5.0]: https://github.com/llaville/php-compat-info/compare/5.4.4...5.5.0
[5.4.4]: https://github.com/llaville/php-compat-info/compare/5.4.3...5.4.4
[5.4.3]: https://github.com/llaville/php-compat-info/compare/5.4.2...5.4.3
[5.4.2]: https://github.com/llaville/php-compat-info/compare/5.4.1...5.4.2
[5.4.1]: https://github.com/llaville/php-compat-info/compare/5.4.0...5.4.1
[5.4.0]: https://github.com/llaville/php-compat-info/compare/5.3.0...5.4.0
[5.3.0]: https://github.com/llaville/php-compat-info/compare/5.2.3...5.3.0
[5.2.3]: https://github.com/llaville/php-compat-info/compare/5.2.2...5.2.3
[5.2.2]: https://github.com/llaville/php-compat-info/compare/5.2.1...5.2.2
[5.2.1]: https://github.com/llaville/php-compat-info/compare/5.2.0....5.2.1
[5.2.0]: https://github.com/llaville/php-compat-info/compare/5.1.0....5.2.0
[5.1.0]: https://github.com/llaville/php-compat-info/compare/5.0.12....5.1.0
