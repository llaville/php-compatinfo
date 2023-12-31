<!-- markdownlint-disable MD013 -->
# Profiler

The `Profiler` Component of new architecture 5.4 gets its information using services called "DataCollector".

This is the same data collected during source code analysis that are passed to different views displayed
to the User.

## Data Collectors

While walking the AST, different [visitors](../parser/README.md) will initialize context and capture results
of the PHP versions detected of all elements (namespaces, classes, interfaces, traits, methods, functions, constants).

At the end of parsing a source file, the `afterTraverse()` method calls the `Profiler` and each collector attached to it.

These "DataCollectors" that must implement `DataCollectorInterface` contract will retrieve information written in AST nodes
that have an `nodeAttributeKeyStore` attribute.

The `VersionDataCollector` is a specific data collector to `CompatibilityAnalyser`.

## VersionDataCollector

The `VersionDataCollector` is in charge to initialize minimum PHP versions of all major elements
(namespaces, classes, interfaces, traits, methods, functions, constants) of a source file.
