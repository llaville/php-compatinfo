<?php
namespace Foo;

use Doctrine\Common\Cache\Cache;
use DateTime;

class Bar extends DateTime {
    function __construct (Cache $c) {
    }
    function foo (\Foo\Foo $foo) {
    }
}

var_dump(DateTime::ATOM);
$a = new \PDO();
$b = new \Console_Table();
$c = new \SebastianBergmann\Version("1.2");
