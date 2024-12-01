<!-- markdownlint-disable MD013 -->
# Sniffs

Before version 5.4, PHP CompatInfo and its compatibility analyser was monolithic code.

Since version 5.4, PHP CompatInfo used a sniff architecture that simplify maintainability of existing code
and allows to extend it more easily.

Each sniff, is in charge to detect a PHP language feature.
Here is the list of features supported and their corresponding sniffs :

## [PHP 5.0](PHP50.md)

## [PHP 5.1](PHP51.md)

## [PHP 5.2](PHP52.md)

## [PHP 5.3](PHP53.md)

## [PHP 5.4](PHP54.md)

## [PHP 5.5](PHP55.md)

## [PHP 5.6](PHP56.md)

## [PHP 7.0](PHP70.md)

## [PHP 7.1](PHP71.md)

## [PHP 7.2](PHP72.md)

## [PHP 7.3](PHP73.md)

## [PHP 7.4](PHP74.md)

## [PHP 8.0](PHP80.md)

## [PHP 8.1](PHP81.md)

## [PHP 8.2](PHP82.md)

## [PHP 8.3](PHP83.md)

## [PHP 8.4](PHP84.md)

## Special cases

* **Namespaces** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Classes** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Interfaces** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Traits** declaration have no sniff, because its detected by the `VersionResolverVisitor`
* **Closures** are initialized by the `VersionResolverVisitor` and keywords (this, self, parent, static) are detected with `ClosureSniff`
* **Arrow functions** have no sniff, because its detected by the `VersionResolverVisitor`, but has its test case with `ArrowFunctionSniffTest`
