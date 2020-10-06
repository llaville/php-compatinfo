# Table Of Contents

## [Components](01_Components)

* Parsing PHP 5 and PHP 7 code into an abstract syntax tree (AST) is provided by
the [PHP-Parser](https://github.com/nikic/PHP-Parser) library.

* Contextual elements and minimum PHP versions detection provided by following node visitors.

### PHP-Parser [Node Visitors](01_Components/01_PHP-Parser/Visitors.md)

  * Parent references with the `ParentContextVisitor`

  * Name Resolution with the `NameResolverVisitor`

  * Version Resolution with the `VersionResolverVisitor`

### [Profiler](01_Components/02_Profiler/Collectors.md)

  * Data Collector(s) with common `DataCollector` and specialized `VersionDataCollector` classes

  * Data Collector(s) contract with the `CollectorInterface`

  * Collector Handler for both Profile and Profiler with `CollectorTrait`

  * Profile information for a single data source with `Profile`

### [Sniffs](01_Components/03_Sniffs/Features.md)

  They are grouped by categories to solve PHP features (from 4.0 to 7.4)

  * Arrays (2)
  * Classes (6)
  * Constants (3)
  * ControlStructures (2)
  * Expressions (3)
  * FunctionDeclarations (3)
  * Generators (1)
  * Keywords (1)
  * Numbers (1)
  * Operators (4)
  * TextProcessing (1)
  * UseDeclarations (2)

## [Configuration(s)](02_Configs/README.md)

Load a config for CLI Application with the `--config` option.

Read [How to Load --config With Services in Symfony Console](https://tomasvotruba.com/blog/2018/05/14/how-to-load-config-with-services-in-symfony-console/) to learn more.
