<!-- markdownlint-disable MD013 -->
# Default Services and Parameters

The closure returned by `config/default.php` file allows loading the following services:

| Service ID | Service Class | Description |
|---|---|---|
| `Symfony\Component\Console\Input\InputInterface`   | `Bartlett\CompatInfo\Console\Input\Input`   | Represents an input coming from the CLI arguments  |
| `Symfony\Component\Console\Output\OutputInterface` | `Bartlett\CompatInfo\Console\Output\Output` | Is the default class for all CLI output            |
| `Symfony\Component\Stopwatch\Stopwatch`            | `Symfony\Component\Stopwatch\Stopwatch`     | Provides a way to profile your code analysis       |
| `Psr\Log\LoggerInterface`                          | `Bartlett\CompatInfo\Logger\DefaultLogger`  | Provides a default PSR3 compatible logger          |
| `Bartlett\CompatInfo\Event\Subscriber\ProfileEventSubscriber` | `Bartlett\CompatInfo\Event\Subscriber\ProfileEventSubscriber`  | Subscriber that provides listeners to profile console commands    |
| `Bartlett\CompatInfo\Event\Subscriber\LogEventSubscriber`     | `Bartlett\CompatInfo\Event\Subscriber\LogEventSubscriber`      | Subscriber that provides listeners to log all application events  |
| `Symfony\Component\EventDispatcher\EventDispatcherInterface`  | `Bartlett\CompatInfo\Event\Dispatcher\EventDispatcher`         | Dispatcher that handle all listeners attached by two subscribers  |

Provides also some parameters for the PSR3 logger:

| Parameter ID | Description |
|---|---|
| `app.log_stream_path` | Path to a local file                       |
| `app.log_channel`     | Channel name                               |
| `app.log_level`       | Minimum logging level that will be handled |
