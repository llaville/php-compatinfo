<?php
class Item
{
    public static function doSomething()
    {
        echo __METHOD__ . PHP_EOL;
    }
}

Item::doSomething(...);
