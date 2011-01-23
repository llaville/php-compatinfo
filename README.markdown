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

Using the PHP_CompatInfo API
----------------------------

    <?php
    require_once 'PHP/CompatInfo.php';

    try {
        $pci = new PHP_CompatInfo($options);
        $pci->parse($source);

        $allResultsAtOnce = $pci->toArray();

    } catch (PHP_CompatInfo_Exception $e) {
        echo 'Exception ' . $e->getCode() . PHP_EOL;
        echo $e->getMessage();
    }

Using the `phpci` tool
----------------------

    $ cat sample.php
    <?php
    interface ICompat
    {
        public function getCompat();
        public function toArray();
    }

    class CompatInfo
        extends PHP_CompatInfo
        implements SplSubject, IteratorAggregate, Countable
    {
    }

    function toFile($filename, $data)
    {
        if (function_exists('file_put_contents')) {
            file_put_contents($filename, $data);
        } else {
            $file = fopen($filename, 'wb');
            fwrite($file, $data);
            fclose($file);
        }
    }

    define ('APPLICATION_ENV', 'development');

    xdebug_start_trace();

    $a = array_fill(5, 6, 'banana');
    // no backtrace yet
    $backtrace = null;

    if (function_exists('debug_backtrace')) {
        $backtrace = debug_backtrace();
    } else {
        // no backtrace feature available
        $backtrace = false;
    }

    debug_print_backtrace();

    $a = null;
    ?>
    
    
    $ phpci print sample.php
    PHP COMPAT INFO REPORT SUMMARY
    -------------------------------------------------------------------------------
    FILES                         EXTENSIONS INTERFACES CLASSES FUNCTIONS CONSTANTS
    -------------------------------------------------------------------------------
    BASE: /path/to
    -------------------------------------------------------------------------------
    DIR.:
    sample.php                            4          4       2        11         3
    -------------------------------------------------------------------------------
    A TOTAL OF
     4 EXTENSION(S) 4 INTERFACE(S) 2 CLASSE(S) 11 FUNCTION(S) 3 CONSTANT(S)
    WERE FOUND IN 1 FILE(S)
    WITH CONDITIONAL CODE LEVEL 1
    REQUIRED PHP 5.2.0 (MIN)
    -------------------------------------------------------------------------------
    Time: 1 second, Memory: 5.00Mb
    -------------------------------------------------------------------------------

