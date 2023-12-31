<!-- markdownlint-disable MD013 -->
# Architecture

This guide is dedicated to all PHP developers that want to learn more about each component.

As application is following the [Domain-driven design][ddd-archi] (DDD) principle, the directory structure match this one.

```text
src/
├── Application
├── Infrastructure
└── Presentation
```

## Application layer

### Analyser(s)

The `CompatibilityAnalyser` has the responsibility to collects different metrics to find out the minimum version
and the extensions required for a piece of code to run.

To do so, we mainly use the `PhpParser`, `DataCollector` and `Sniffs`.

![Graph UML Application Analyser](../assets/images/application-analyser.graphviz.svg)

### Collection(s)

![Graph UML Application Collection](../assets/images/application-collection.graphviz.svg)

### Configuration

The `ConfigResolver` component is in charge to handle all arguments/options provided by an instance of `Symfony\Component\Console\Input\InputInterface`

You will find usage into the `Bartlett\CompatInfo\Application\Kernel\ConsoleKernel::createFromInput` function.

### Data Collector(s)

This element is in charge to store data (rule id, php and extension versions found) for later produce results by `Extension/Reporter`.

![Graph UML Application Data Collector](../assets/images/application-datacollector.graphviz.svg)

### Event(s)

`CompatInfo` use the [Symfony Event-Dispatcher][sf-event-dispatcher] component to avoid tight coupling
between a set of interacting objects.

`Bartlett\CompatInfo\Application\Event\Dispatcher\EventDispatcher` is in charge to dispatch all events
to other elements (extensions: logger, progressbar and reporters) of this application.

![Graph UML Application Event](../assets/images/application-event.graphviz.svg)

### Extension(s)

![Graph UML Application Extension](../assets/images/application-extension.graphviz.svg)

### Kernel

This element is the main entry point of the `bin/phpcompatinfo` command line runner.

### Logger

![Application Logger UML](../assets/images/application-logger.graphviz.svg)

### Parser

We use a [PHP Parser][php-parser] to parse source code into an abstract syntax tree (AST).
Each `Sniffs` (rules) identified by a fingerprint (AST nodes) will then be stored into the `DataCollector`.

![Graph UML Application Parser](../assets/images/application-parser.graphviz.svg)

### Polyfill(s)

![Graph UML Application Polyfill](../assets/images/application-polyfills.graphviz.svg)

### Profiler

![Graph UML Application Profiler](../assets/images/application-profiler.graphviz.svg)

### Query(s)

![Graph UML Application Query](../assets/images/application-query.graphviz.svg)

### Service(s)

![Graph UML Application Service](../assets/images/application-service.graphviz.svg)

### Sniffs

Each one has responsibility to detect a specific PHP feature.

![Graph UML Application Sniff](../assets/images/application-sniffs.graphviz.svg)

## Infrastructure layer

Both layers Application and Presentation talk to each other with two buses (one for Queries, and another one for Commands).

We used the use the [Symfony Messenger][sf-messenger] component to realize these actions.

![Graph UML Infrastructure Bus](../assets/images/infrastructure-bus.graphviz.svg)

## Presentation layer

The Command Line Runner of `CompatInfo` is a Symfony Console Application with many Command.

- all `db:*` commands are inherited directly from `CompatInfoDB`
- `analyser:run` is the main command to parse a datasource and print results of analysis
- `rule:list` is a command to identify each rule found during analysis (id, description, sniff used)

![Graph UML Presentation Console](../assets/images/presentation-console.graphviz.svg)

[ddd-archi]: https://en.wikipedia.org/wiki/Domain-driven_design
[sf-event-dispatcher]: https://symfony.com/doc/current/components/event_dispatcher.html
[sf-messenger]: https://symfony.com/doc/current/components/messenger.html
[php-parser]: https://github.com/nikic/PHP-Parser
