<!-- markdownlint-disable MD013 -->
# About

**PHP CompatInfo** is a library that
can find the minimum version and the extensions required for a piece of code to run.

Running on PHP greater or equal than 8.0 for parsing source code in a format PHP 5.2 to PHP 8.2

![Graph Composer](./assets/images/graph-composer.svg)

## Features

- Parse source code in format PHP 5.2 to PHP 8.2
- Detect PHP features for each Major/minor versions
- Detect versions of all directives, constants, functions, classes, interfaces of 100 extensions and more
- Display/Inspect list of extensions, and their versions supported

## Installation

> Learn how to install `CompatInfo` application in different way.

See [Installation Guide](installation.md)

## Architecture

> As a developer you want to learn more about CompatInfo architecture.

See [Architecture's Guide](architecture/README.md)

## Configurations

> Load a configuration for CLI Application with the `--config` option.

See [Configuration(s)](configs/README.md)

**TIP** Read [How to Load --config With Services in Symfony Console](https://tomasvotruba.com/blog/2018/05/14/how-to-load-config-with-services-in-symfony-console/) to learn more.

## Conditional Code

> Learn what code is consider as conditional, detected or not (since CompatInfo 5.4)

See [Conditional Code](conditional-code/README.md)

## Exclusions

> Sometimes you don't want to scan a certain directory while analysing data source.
>
> Learn how to do from console (CLI) or php script (API).

See [Exclude folder(s)](exclusions/README.md)
