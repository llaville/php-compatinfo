<?php
/**
 * Compatibility Interface
 */
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

define ( 'APPLICATION_ENV' , 'development' );
define("TPL_REPOSITORY",'/repository/templates');

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
