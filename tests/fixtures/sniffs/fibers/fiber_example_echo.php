<?php
// @link https://php.watch/versions/8.1/fibers#fiber-example-echo

$fiber = new Fiber(function(): void {
    echo "Hello from the Fiber...\n";
    Fiber::suspend();
    echo "Hello again from the Fiber...\n";
});

echo "Starting the program...\n";
$fiber->start();
echo "Taken control back...\n";
echo "Resuming Fiber...\n";
$fiber->resume();
echo "Program exits...\n";
