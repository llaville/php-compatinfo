<!-- markdownlint-disable MD013 -->
# Registering Extensions

If you are using the `config/set/default.php` configuration file, your extension classes are already [registered as services](https://symfony.com/doc/current/service_container/tags.html#autoconfiguring-tags).

```php
<?php
use Bartlett\CompatInfo\Application\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void
{
    $services = $containerConfigurator->services();

    $services->instanceof(ExtensionInterface::class)
        ->tag('app.extension')
    ;
}
```

## Hooks

CompatInfo Extensions may implement one or more of these interfaces:

* `BeforeAnalysisInterface` - called before CompatInfo begins to run analysis.

* `AfterAnalysisInterface` - called after CompatInfo has completed its analysis. Use this hook if you want to do something with the analysis results.

* `BeforeFileAnalysisInterface` - called before CompatInfo analyzes a file.

* `AfterFileAnalysisInterface` - called after CompatInfo analyzes a file.

* `BeforeTraverseAstInterface` - called once before AST traversal.

* `AfterTraverseAstInterface` - called once after AST traversal.

* `BeforeProcessNodeInterface` - called before entering a node.

* `AfterProcessNodeInterface` - called after leaving a node.

* `BeforeSetupSniffInterface` - called before initializes a sniff.

* `AfterTearDownSniffInterface` - called after tear down a sniff.

* `BeforeProcessSniffInterface` - called before entering a sniff.

* `AfterProcessSniffInterface` - called after leaving a sniff.

Furthermore, extensions may implement the `Symfony\Component\EventDispatcher\EventSubscriberInterface`.

See built-in extensions `Application\Extension\Logger` and `Application\Extension\ProgressBar` as examples.
