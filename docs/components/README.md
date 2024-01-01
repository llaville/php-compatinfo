<!-- markdownlint-disable MD013 -->
# Components

- Parsing PHP 5, PHP 7 or PHP 8 code into an abstract syntax tree (AST) is provided by
  the [PHP-Parser](https://github.com/nikic/PHP-Parser) library.

- Contextual elements and minimum PHP versions detection provided by following node visitors.

## PHP-Parser [Node Visitors](./parser/README.md)

- Parent references with the `ParentContextVisitor`
- Name Resolution with the `NameResolverVisitor`
- Version Resolution with the `VersionResolverVisitor`

## [Profiler](./profiler/README.md)

- Data Collector(s) with common `DataCollector` and specialized `VersionDataCollector` classes
- Data Collector(s) contract with the `CollectorInterface`
- Collector Handler for both Profile and Profiler with `CollectorTrait`
- Profile information for a single data source with `Profile`

## [Sniffs](./sniffs/README.md)

They are grouped by categories to solve PHP features (from 4.0 to 8.3)

- Arrays (3)
- Attributes (4)
- Classes (11)
- Constants (6)
- ControlStructures (4)
- Enumerations (1)
- Expressions (4)
- Fibers (1)
- FunctionCalls (1)
- FunctionDeclarations (7)
- Generators (1)
- Keywords (1)
- Numbers (2)
- Operators (5)
- TextProcessing (2)
- UseDeclarations (2)

## [Extensions](./extensions/README.md)

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

## [Polyfills](./polyfills/README.md)

They are identified by services that implements the `Bartlett\CompatInfo\Application\Polyfills\PolyfillInterface`.

