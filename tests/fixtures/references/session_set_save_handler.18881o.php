<?php // @link https://www.php.net/manual/en/function.session-set-save-handler.php

class MySessionHandler implements SessionHandlerInterface
{
    // implement interfaces here
}

$handler = new MySessionHandler();
session_set_save_handler($handler, true);
session_start();
