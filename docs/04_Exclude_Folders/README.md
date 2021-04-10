### With Console (CLI)

Since version 5.5.2, you can provide the new `--exclude` option. This option accept multiple values as shown next:

```bash
bin/phpcompatinfo analyser:run . --exclude vendor --exclude tests
```

### With php script (API)

```php
require_once 'config/bootstrap.php';

use Bartlett\CompatInfo\Client;

// creates an instance of client
$client = new Client();

// request for a Bartlett\Reflect\Api\Analyser
$api = $client->api('analyser');

// perform request, on a data source with default analyser
$dataSource = __DIR__;
// exclude some folders from scanning
$excludeDirs = ['vendor', 'tests'];

// equivalent to CLI command `phpcompatinfo analyser:run . --exclude vendor --exclude tests`
/** @var \Bartlett\CompatInfo\Profiler\Profile $profile */
$profile = $api->run($dataSource, $excludeDirs);

var_export($profile->getData());
```
