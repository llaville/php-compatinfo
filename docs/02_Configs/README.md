<!-- markdownlint-disable MD013 -->
# About

Before version 5.4, PHP CompatInfo used JSON config file
handled by PHP Reflect [Api/V3/Config](https://github.com/llaville/php-reflect/blob/master/src/Bartlett/Reflect/Api/V3/Config.php) object,

With version 5.4+, PHP CompatInfo uses now the Symfony [DependencyInjection](https://symfony.com/components/DependencyInjection) component.
It allows you to standardize and centralize the way objects are constructed in console application.

Read more how [Setting up the Container with Configuration Files](https://symfony.com/doc/current/components/dependency_injection.html#setting-up-the-container-with-configuration-files).

Old plugin system can be replaced with the `Bartlett\CompatInfo\Event\Dispatcher\EventDispatcher` service.
Default version add two subscribers (`ProfileEventSubscriber` and `LogEventSubscriber`) to listen and handle all Application events.
