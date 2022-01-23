<!-- markdownlint-disable MD013 -->
# About

**PHP CompatInfo** is a library that
can find the minimum version and the extensions required for a piece of code to run.

Running on PHP greater or equal than 7.4 for parsing source code in a format PHP 5.2 to PHP 8.1

## Features

- Parse source code in format PHP 5.2 to PHP 8.1
- Detect PHP features for each Major/minor versions
- Detect versions of all directives, constants, functions, classes, interfaces of 100 extensions and more
- Display/Inspect list of extensions, and their versions supported

## [Components](01_Components)

- Parsing PHP 5, PHP 7 or PHP 8 code into an abstract syntax tree (AST) is provided by
the [PHP-Parser](https://github.com/nikic/PHP-Parser) library.

- Contextual elements and minimum PHP versions detection provided by following node visitors.

### PHP-Parser [Node Visitors](01_Components/01_PHP-Parser/Visitors.md)

- Parent references with the `ParentContextVisitor`
- Name Resolution with the `NameResolverVisitor`
- Version Resolution with the `VersionResolverVisitor`

### [Profiler](01_Components/02_Profiler/Collectors.md)

- Data Collector(s) with common `DataCollector` and specialized `VersionDataCollector` classes
- Data Collector(s) contract with the `CollectorInterface`
- Collector Handler for both Profile and Profiler with `CollectorTrait`
- Profile information for a single data source with `Profile`

### [Sniffs](01_Components/03_Sniffs/Features.md)

They are grouped by categories to solve PHP features (from 4.0 to 8.1)

- Arrays (3)
- Attributes (1)
- Classes (9)
- Constants (3)
- ControlStructures (3)
- Enumerations (1)
- Expressions (3)
- Fibers (1)
- FunctionDeclarations (6)
- Generators (1)
- Keywords (1)
- Numbers (2)
- Operators (5)
- TextProcessing (1)
- UseDeclarations (2)

### [Extensions](01_Components/04_Extensions/Hooks.md)

PHPCompatInfo can be extended by registering objects that implement one or more of the following interfaces:

- `BeforeAnalysisInterface`
- `AfterAnalysisInterface`
- `BeforeFileAnalysisInterface`
- `AfterFileAnalysisInterface`
- `BeforeTraverseAstInterface`
- `AfterTraverseAstInterface`
- `BeforeProcessNodeInterface`
- `AfterProcessNodeInterface`
- `BeforeSetupSniffInterface`
- `AfterTearDownSniffInterface`
- `BeforeProcessSniffInterface`
- `AfterProcessSniffInterface`

Furthermore, extensions may implement the `Symfony\Component\EventDispatcher\EventSubscriberInterface` in order to have its event handlers automatically registered with the EventDispatcher when the extension is loaded.

## [Configuration(s)](02_Configs/README.md)

Load a config for CLI Application with the `--config` option.

Read [How to Load --config With Services in Symfony Console](https://tomasvotruba.com/blog/2018/05/14/how-to-load-config-with-services-in-symfony-console/) to learn more.

## [Conditional Code](03_Conditional_Code/1_Introduction.md)

Learn what code is consider as conditional, detected or not (with CompatInfo 5.4)

- [Indirect calls](03_Conditional_Code/2_Indirect_Call.md)
- [Multiple signatures](03_Conditional_Code/3_Multiple_Signature.md)
- [Other limitations](03_Conditional_Code/100_Limitation.md)

## [Exclude folder(s)](04_Exclude_Folders/README.md)

Sometimes you don't want to scan a certain directory while analysing data source.

Learn how to do from console (CLI) or php script (API).
