<!-- markdownlint-disable MD013 -->
# About

Two different ways to exclude directories from scan.

## With Console (CLI)

Since version 5.5.2, you can provide the new `--exclude` option. This option accept multiple values as shown next:

```bash
bin/phpcompatinfo analyser:run . --exclude vendor --exclude tests
```

## With php script (API)

```php
require_once 'autoload.php';

use Bartlett\CompatInfo\Application\Profiler\Profile;
use Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery;
use Bartlett\CompatInfo\Application\Query\QueryBusInterface;

use Symfony\Component\Messenger\Exception\HandlerFailedException;

$container = require 'config/container.php';

$queryBus = $container->get(QueryBusInterface::class);

// perform request, on a data source with default analyser
$dataSource = __DIR__;
// exclude some folders from scanning
$excludeDirs = ['vendor', 'tests'];

// equivalent to CLI command `phpcompatinfo analyser:run . --exclude vendor --exclude tests`
$compatibilityQuery = new GetCompatibilityQuery($dataSource, $excludeDirs, false);
try {
    /** @var Profile $profile */
    $profile = $queryBus->query($compatibilityQuery);
    $data = $profile->getData();
    $dump = reset($data);
    var_export($dump);
} catch (HandlerFailedException $e) {
    foreach ($e->getWrappedExceptions() as $ex) {
        printf('Exception -- %s >> %s%s' . $ex->getMessage(), $ex->getTraceAsString(), PHP_EOL);
    };
}
```
