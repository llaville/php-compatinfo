PHP_CompatInfo
==============

**PHP_CompatInfo** is a library that 
find out the minimum version and the extensions required for a piece of code to run.

Installation
------------

PHP_CompatInfo should be installed using the [PEAR Installer](http://pear.php.net/). 
This installer is the backbone of PEAR, which provides a distribution system for PHP packages, 
and is shipped with every release of PHP since version 4.3.0.

The PEAR channel (`bartlett.laurent-laville.org`) that is used to distribute PHP_CompatInfo 
needs to be registered with the local PEAR environment. 
Furthermore, components that PHP_CompatInfo depends upon is hosted on the eZ Components PEAR channel (`components.ez.no`),
and on the PHPUnit PEAR channel (`pear.phpunit.de`).

    $ pear channel-discover bartlett.laurent-laville.org
    Adding Channel "bartlett.laurent-laville.org" succeeded
    Discovery of channel "bartlett.laurent-laville.org" succeeded

    $ pear channel-discover components.ez.no
    Adding Channel "components.ez.no" succeeded
    Discovery of channel "components.ez.no" succeeded

    $ pear channel-discover pear.phpunit.de
    Adding Channel "pear.phpunit.de" succeeded
    Discovery of channel "pear.phpunit.de" succeeded
    
This has to be done only once. Now the PEAR Installer can be used to install packages from the Bartlett channel.

    $ pear install bartlett/PHP_CompatInfo
    downloading PHP_CompatInfo-2.0.0RC1.tgz ...
    Starting to download PHP_CompatInfo-2.0.0RC1.tgz (82,395 bytes)
    .........................done: 82,395 bytes
    install ok: channel://bartlett.laurent-laville.org/PHP_CompatInfo-2.0.0RC1

After the installation you can find the PHP_CompatInfo source files inside your local PEAR directory.


Documentation
-------------

The documentation for PHP_CompatInfo is available in different formats:

* [English, multiple HTML files](http://php5.laurent-laville.org/compatinfo/manual/2.0/en/index.html)
* [English, single HTML file](http://php5.laurent-laville.org/compatinfo/manual/2.0/en/phpci-book.html)
* [English, PDF](http://php5.laurent-laville.org/compatinfo/manual/2.0/en/phpci-book.pdf)
* [English, CHM](http://php5.laurent-laville.org/compatinfo/manual/2.0/en/phpci-book.zip)
