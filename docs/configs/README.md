<!-- markdownlint-disable MD013 -->
# About

Before version 5.4, PHP CompatInfo used JSON config file
handled by PHP Reflect [Api/V3/Config](https://github.com/llaville/php-reflect/blob/master/src/Bartlett/Reflect/Api/V3/Config.php) object,

With version 5.4+, PHP CompatInfo uses now the Symfony [DependencyInjection](https://symfony.com/components/DependencyInjection) component.
It allows you to standardize and centralize the way objects are constructed in console application.

Read more how [Setting up the Container with Configuration Files](https://symfony.com/doc/current/components/dependency_injection.html#setting-up-the-container-with-configuration-files).

Old plugin system can be replaced with the `Bartlett\CompatInfo\Event\Dispatcher\EventDispatcher` service.

## Default Services and Parameters

The closure returned by `config/set/default.php` file allows loading the following services:

| Service ID                                                    | Service Class                                                 | Description                                                      |
|---------------------------------------------------------------|---------------------------------------------------------------|------------------------------------------------------------------|
| `Symfony\Component\Console\Input\InputInterface`              | `Bartlett\CompatInfo\Console\Input\Input`                     | Represents an input coming from the CLI arguments                |
| `Symfony\Component\Console\Output\OutputInterface`            | `Bartlett\CompatInfo\Console\Output\Output`                   | Is the default class for all CLI output                          |
| `Symfony\Component\Stopwatch\Stopwatch`                       | `Symfony\Component\Stopwatch\Stopwatch`                       | Provides a way to profile your code analysis                     |
| `Psr\Log\LoggerInterface`                                     | `Bartlett\CompatInfo\Logger\DefaultLogger`                    | Provides a default PSR3 compatible logger                        |
| `Symfony\Component\EventDispatcher\EventDispatcherInterface`  | `Bartlett\CompatInfo\Event\Dispatcher\EventDispatcher`        | Dispatcher that handle all listeners attached by two subscribers |

The closure returned by `config/set/default-logger.php` file provides also some parameters for the PSR3 logger:

| Parameter ID                 | Description                                |
|------------------------------|--------------------------------------------|
| `compatinfo.log_stream_path` | Path to a local file                       |
| `compatinfo.log_channel`     | Channel name                               |
| `compatinfo.log_level`       | Minimum logging level that will be handled |
